<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use App\Models\Pendaftaran;
use App\Models\Umkm;
use App\Models\User;
use Carbon\Carbon;

class JobController extends Controller
{
    public function display(){
        $applications = Pendaftaran::where('id_user', auth()->user()->id)->get();
        if(count($applications) == 0){
            return view('miscPages.notfound', ['message' => "Belum ada lamaran pekerjaan!"]);
        }
        foreach($applications as $a){
            $corr_iklan = Iklan::where('id', $a->id_iklan)->first();
            $corr_umkm = Umkm::where('id', $corr_iklan->id_umkm)->first();
            $name = User::where('id', $corr_umkm->user_id)->first();
            $a->judul_iklan = $corr_iklan->judul_iklan;
            $a->umkm = $name->name;
            $a->img = $corr_umkm->logo;

        }
        return view('jobseekerPages.application', ['app' => $applications]);

    }
    public function apply(){
        $corr_user = User::where('id', request()->user_id)->first();
        $corr_user->phone_number = request()->phone;
        if(request()->hasFile('new_cv')){
            $corr_user->cv_file = request()->new_cv;
        }
        $corr_user->save();

        $daftar = new Pendaftaran;
        $daftar->id_user = request()->user_id;
        $daftar->id_iklan = request()->id_iklan;
        $daftar->portfolio_link = request()->port;
        $curr_date = Carbon::now()->toDateString();
        $daftar->proposal_date = $curr_date;
        $daftar->save();
        return redirect(route('application'));
    }
    public function inbox(){
        $id_umkm = Umkm::where('id',auth()->user()->id)->first()->id ;
        $iklan = Iklan::where('id_umkm', $id_umkm)->pluck('id')->toArray();
        $iklan = collect($iklan);
        $app = Pendaftaran::select("*")->whereIn('id_iklan', $iklan)->get();
        if(empty($app)){
            return view('miscPages.notfound', ['message' => "Belum ada yang melamar ke iklan Anda!"]);
        }
        foreach($app as $a){
            $iklan_detail = Iklan::where('id', $a->id_iklan)->first();
            $jobseeker = User::where('id', $a->id_user)->first();
            $a->nama_pelamar = $jobseeker->name;
            $a->email_pelamar = $jobseeker->email;
            $a->cv_pelamar = $jobseeker->cv_file;
            $a->tel_pelamar = $jobseeker->phone_number;
            $a->judul_iklan = $iklan_detail->judul_iklan;
        }
        return view('umkmPages.inbox', ['app' => $app]);
    }
    public function accept(){
        $corr_app = Pendaftaran::where('id', request()->app_id)->first();
        $corr_app->is_accepted = true;
        $corr_app->save();
        return redirect(route('inbox'));
    }
    public function reject(){
        $corr_app = Pendaftaran::where('id', request()->app_id)->first();
        $corr_app->is_accepted = false;
        $corr_app->save();
        return redirect(route('inbox'));
    }
}
