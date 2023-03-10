<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use App\Models\Kategori;
use App\Models\Pendaftaran;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(){
        $categories = Kategori::all();
        $iklan = Iklan::paginate(3);
        foreach($iklan as $i){
            $id_umkm = $i->id_umkm;
            $id_bidang = $i->kategori_iklan;
            $coresponding = Kategori::where('id', $id_bidang)->first();
            $kategori = $coresponding->nama_kategori;
            $i->bidang = $kategori;
            $corr_umkm = Umkm::where('id', $id_umkm)->first();
            $corr_user = User::where('id', $corr_umkm->user_id)->first();
            $nama_umkm = $corr_user->name;
            $logo_umkm = $corr_umkm->logo;
            $i->umkm = $nama_umkm;
            $i->logo = $logo_umkm;
        }
        return view('guestPages.home', ['categories' => $categories, 'iklan' => $iklan]);
    }
    public function about(){
        return view('miscPages.about');
    }
    public function search(){
        $result = Iklan::where('judul_iklan', 'LIKE', '%' . request()->search_keyword .'%')
        ->when(request()->search_category, function($query){
            $query->where('kategori_iklan', request()->search_category);
        })
        ->when(request()->search_kota,function($query){
            $query->where('kota_lokasi', 'LIKE', '%'. request()->search_kota. '%');
        })
        ->when(request()->search_duration, function($query){
            $query->where('durasi', 'LIKE', request()->search_duration);
        });
        $tmp = $result;
        $result_arr = $result->get();
        if(count($result_arr) == 0){
            return view('miscPages.notfound', ['message' => "Tidak ada iklan dengan filter pencarian tersebut!"]);
        }
        foreach($result_arr as $r){
            $id_bidang = $r->kategori_iklan;
            $coresponding = Kategori::where('id', $id_bidang)->first();
            $kategori = $coresponding->nama_kategori;
            $r->bidang = $kategori;
            $id_umkm = $r->id_umkm;
            $corr_umkm = Umkm::where('id', $id_umkm)->first();
            $corr_user = User::where('id', $corr_umkm->user_id)->first();
            $nama_umkm = $corr_user->name;
            $logo_umkm = $corr_umkm->logo;
            $r->umkm = $nama_umkm;
            $r->logo = $logo_umkm;
        }
        $categories = Kategori::where('id', '!=', request()->search_category)->get();
        return view('guestPages.search', ['res' => $result_arr, 'categories' => $categories]);
    }
    public function detail(){
        $iklan = request()->id_iklan;
        $iklan = Iklan::where('id', $iklan)->first();
        $id_umkm = $iklan->id_umkm;
        $bidang = Kategori::where('id', $iklan->kategori_iklan)->first();
        $corr_umkm = Umkm::where('id', $id_umkm)->first();
        $corr_user = User::where('id', $corr_umkm->user_id)->first();
        $nama_umkm = $corr_user->name;
        $logo_umkm = $corr_umkm->logo;
        $iklan->umkm = $nama_umkm;
        $iklan->logo = $logo_umkm;
        $iklan->bidang = $bidang->nama_kategori;
        $jobdesc = $iklan->jobdesc;
        $jobdesc_list = explode(".", $jobdesc);
        if(Auth::check()){
            $app = Pendaftaran::where([
                ['id_iklan' , '=', request()->id_iklan],
                ['id_user', '=', auth()->user()->id]
            ])->first();
            $applied = ($app) ? true : false;
            return view('guestPages.detail', ['iklan' => $iklan, 'jobdesc' => $jobdesc_list,
        'applied' => $applied]);
        }
        else{
            return view('guestPages.detail', ['iklan' => $iklan, 'jobdesc' => $jobdesc_list]);

        }
    }
    public function profile(){
        $is_umkm = auth()->user()->is_umkm;
        $id = auth()->user()->id;
        if($is_umkm){
            $umkm_detail = Umkm::where('user_id', $id)->first();
            $all_category = Kategori::all();
            $kategori = Kategori::where('id', $umkm_detail->kategori_umkm)->first();
            $kategori = $kategori->nama_kategori;
            $umkm_detail->kategori = $kategori;
            return view('profilePages.umkmprofile', ['user' => auth()->user() , 'umkm' => $umkm_detail, 'kategori' => $all_category] );
        }
        else{
            return view('profilePages.jobseekerprofile', ['user' => auth()->user()]);
        }
    }
}
