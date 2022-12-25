<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use App\Models\Kategori;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(){
        $categories = Kategori::all();
        $iklan = Iklan::all();
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
    public function search(){
        $result = DB::table('iklan')->where('judul_iklan', 'LIKE', '%' . request()->search_keyword .'%')
        ->when(request()->search_category, function($query){
            $query->where('kategori_iklan', request()->search_category);
        })
        ->when(request()->search_kota,function($query){
            $query->where('kota_lokasi', 'LIKE', '%'. request()->search_kota. '%');
        })
        ->when(request()->search_duration, function($query){
            $query->where('durasi', 'LIKE', request()->search_duration);
        } )->get();
        foreach($result as $r){
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
        return view('guestPages.search', ['res' => $result]);
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
        return view('guestPages.detail', ['iklan' => $iklan, 'jobdesc' => $jobdesc_list]);
    }
}
