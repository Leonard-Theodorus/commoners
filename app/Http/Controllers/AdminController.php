<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use App\Models\Kategori;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PDO;

class AdminController extends Controller
{
    public function viewalliklan(){
        return view('adminPages.adminviewiklan');
    }
    public function adminUmkmSearch(){
        $search = request()->search_keyword;
        $corr_umkm = User::where('name', 'like', "%". $search . "%")->first();
        if(empty($corr_umkm)){
            return view('miscPages.notfound', ['message' => "Tidak ada umkm dengan keyword tersebut"]);
        }
        $umkm_detail = Umkm::where('user_id', $corr_umkm->id)->first();
        $iklan_umkm = Iklan::where('id_umkm', $umkm_detail->id)->paginate(3);
        foreach($iklan_umkm as $i){
            $id_bidang = $i->kategori_iklan;
            $coresponding = Kategori::where('id', $id_bidang)->first();
            $kategori = $coresponding->nama_kategori;
            $i->bidang = $kategori;
            $nama_umkm = $corr_umkm->name;
            $logo_umkm = $umkm_detail->logo;
            $i->umkm = $nama_umkm;
            $i->logo = $logo_umkm;
        }
        return view('adminPages.search', ['iklan' => $iklan_umkm, 'search' => $search]);
    }
    public function adminManageBidang(){
        $categories = Kategori::all();
        return view('adminPages.bidang',['categories' => $categories]);
    }
    public function addBidang(){
        $new_bidang = request()->new_bidang;
        $n_record = new Kategori;
        $n_record->nama_kategori = $new_bidang;
        $n_record->save();
        return redirect(route('managebidang'))->with('add_bidang_succ', "Bidang berhasil ditambahkan!");
    }
    public function deleteBidang(){
        Kategori::where('id', request()->id_kat)->delete();
        return redirect(route('managebidang'))->with('del_bidang_succ', "Bidang berhasil dihapus!");
    }
    public function deleteiklan(){
        $iklan = Iklan::where('id', request()->id_iklan)->first();
        $iklan->delete();
        return redirect(route('home'))->with('del_iklan_succ', "Iklan Berhasil Dihapus!");
    }
}
// ->paginate(
//     $perPage = 3, $columns = ["*"], $pagename = "iklan". strval($i)
// );
