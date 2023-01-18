<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use App\Models\Kategori;
use App\Models\Umkm;
use Illuminate\Support\Facades\Validator;

class IklanController extends Controller
{
    public function viewiklan(){
        $id_umkm = Umkm::where('id',auth()->user()->id)->first()->id;
        $iklan = Iklan::where('id_umkm', $id_umkm)->get();
        return view('umkmPages.viewiklan', ['iklan' => $iklan]);
    }
    public function newiklanpage(){
        $categories = Kategori::all();
        return view('umkmPages.newiklan', ['categories' => $categories]);
    }
    public function createiklan(){
        $validator = Validator::make(request()->all(), [
            'thumbnail' => ['required', 'image']
        ], [
            'thumbnail.required' => "Banner Iklan berupa file image harus disertakan",
            'thumbnail.image' => "Banner Iklan harus berupa file image"
        ]);
        if($validator->fails()){
            return redirect(route('newiklanpage'))->withErrors($validator)->withInput()
            ->with('create_error', 'Iklan Tidak Berhasil Dibuat!');
        }
        $new_iklan = new Iklan();
        $umkm = Umkm::where('user_id', auth()->user()->id)->first()->id;
        $new_iklan->id_umkm = $umkm;
        $new_iklan->kategori_iklan = request()->new_category;
        $new_iklan->judul_iklan = request()->new_judul;
        if(request()->file('thumbnail')){
            $og_filename = request()->file('thumbnail')->getClientOriginalName();
            $new_iklan->banner = request()->file('thumbnail')->storeAs('bannerIklan', $og_filename);

        }
        $new_iklan->kota_lokasi = request()->new_lokasi;
        $new_iklan->alamat = request()->new_alamat;
        $new_iklan->durasi = request()->new_duration;
        $new_iklan->shortdesc = request()->new_desc;
        $new_iklan->jobdesc = request()->new_jobdesc;
        $new_iklan->is_available = true;
        if(empty(request()->new_gaji)){
            $new_iklan->gaji = 0;
        }
        else{
            $new_iklan->gaji = request()->new_gaji;

        }
        $new_iklan->save();
        return redirect(route('newiklanpage'))->with('create_success', 'Iklan Berhasil Dibuat');
    }
    public function editiklanpage(){
        $iklan = Iklan::where('id', request()->id_iklan)->first();
        $iklan->kategori = Kategori::where('id', $iklan->kategori_iklan)->first()->id;
        $iklan->nama_kategori = Kategori::where('id', $iklan->kategori_iklan)->first()->nama_kategori;
        $categories = Kategori::where('id', '!=', $iklan->kategori_iklan)->get();
        return view ('umkmPages.editiklan', ['iklan' => $iklan, 'categories' => $categories]);
    }
    public function updateiklan(){
        $iklan = Iklan::where('id', request()->id_iklan)->first();
        if(empty(request()->new_gaji)){
            $iklan->gaji = 0;
        }
        else{
            $iklan->gaji = request()->new_gaji;
        }
        $validator = Validator::make(request()->all(), [
            'thumbnail' => ['image'],
            'new_judul' => ['required'],
            'new_lokasi' => ['required'],
            'new_alamat' => ['required'],
            'new_desc' => ['required'],
        ], [
            'thumbnail.image' => "File banner harus berupa image!",
            'new_judul.required' => "Judul iklan harus diisi!",
            'new_lokasi.required' => "Kota harus diisi!",
            'new_alamat.required' => "Alamat harus diisi!",
            'new_desc.required' => "Deskripsi iklan harus diisi!",
        ]);
        if($validator->fails()){
            return redirect(route('editiklanpage', ['id_iklan' => request()->id_iklan]))->withErrors($validator)->with(
                'update_iklan_error', 'Update iklan gagal!')
            ;
        }
        $iklan->judul_iklan = request()->new_judul;
        $iklan->kota_lokasi = request()->new_lokasi;
        $iklan->alamat = request()->new_alamat;
        $iklan->shortdesc = request()->new_desc;
        $iklan->jobdesc = request()->new_jobdesc;
        $iklan->durasi = request()->new_duration;
        $iklan->kategori_iklan = request()->new_category;
        $iklan->is_available = request()->available;
        if(request()->file('thumbnail')){
            $og_filename = request()->file('thumbnail')->getClientOriginalName();
            $iklan->banner = request()->file('thumbnail')->storeAs('bannerIklan', $og_filename);
        }
        $iklan->save();
        return redirect(route('editiklanpage', ['id_iklan' => request()->id_iklan]))->with(
            'update_iklan_success', 'Update iklan berhasil!');
    }
}
