<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function editprofile(){
        if(request()->umkm != 1){
            $validator = Validator::make(request()->all(),[
                'email' => ['email:dns'],
                'short_desc' => ['max:255'],
                'thumbnail' => ['image'],
                'cv' => ['mimetypes:application/pdf'],
                'phone' => ['digits:10']
            ], [
                'email.email' => "Format email tidak valid!",
                'short_desc.max' => "Input melebihi 255 karakter!",
                'thumbnail.image' => "File harus berupa image!",
                'cv.mimetypes' => 'File CV harus berupa pdf',
                'phone.digits' => 'Nomor telepon tidak valid!'
            ]);
            if($validator->fails()){
                return redirect(route('profile'))->withErrors($validator)->withInput()
                ->with('update_error', 'Update profile gagal, tekan tombol edit untuk penjelasan lebih detail!');
            }
            $user_id = request()->id;
            $new_name = request()->name;
            $new_mail = request()->email;
            $new_desc = request()->short_desc;
            $dob = request()->dob;
            $phone = request()->phone;
            $user = User::where('id', $user_id)->first();
            $user->name = $new_name;
            $user->email = $new_mail;
            $user->short_desc = $new_desc;
            $user->dob = $dob;
            $user->phone_number = $phone;
            if(request()->file('thumbnail')){
                $og_filename = request()->file('thumbnail')->getClientOriginalName();
                $user->photo = request()->file('thumbnail')->storeAs('profilePictures', $og_filename);

            }
            if(request()->file('cv')){
                $file_cv = request()->file('cv')->getClientOriginalName();

                $user->cv_file = request()->file('cv')->storeAs('usercv', $file_cv);

            }
            $user->gender = request()->gender;
            $user->save();
        }
        else{
            $validator = Validator::make(request()->all(),[
                'email' => ['email:dns'],
                'short_desc' => ['max:255'],
                'thumbnail' => [ 'image'],
                'phone' => ['digits:10']
            ], [
                'email.email' => "Format email tidak valid!",
                'short_desc.max' => "Input melebihi 255 karakter!",
                'thumbnail.image' => "File harus berupa image!",
                'phone.digits' => 'Nomor telepon tidak valid!'
            ]);
            if($validator->fails()){
                return redirect(route('profile'))->withErrors($validator)->withInput()
                ->with('update_error', 'Update profile gagal, tekan tombol edit untuk penjelasan lebih detail!');
            }
            $user_id = request()->id;
            $new_name = request()->name;
            $new_mail = request()->email;
            $new_desc = request()->short_desc;
            $phone = request()->phone;
            $user = User::where('id', $user_id)->first();
            $user->name = $new_name;
            $user->email = $new_mail;
            $user->phone_number = $phone;
            $user->save();

            $umkm = Umkm::where('user_id', $user_id)->first();
            if(request()->file('thumbnail')){
                $og_filename = request()->file('thumbnail')->getClientOriginalName();
                $umkm->logo = request()->file('thumbnail')->storeAs('umkmlogos', $og_filename);

            }
            $new_kategori = request()->kategori;
            $umkm->short_desc = $new_desc;
            $umkm->kategori_umkm = $new_kategori;
            $umkm->save();

        }
        return redirect(route('profile'))->with('update_success', 'Update Profile Berhasil!');
    }
    public function pass_view(){
        return view('profilePages.changepassword');
    }
    public function change_pass(Request $request){
        $pass = auth()->user()->getAuthPassword();
        $request->request->add(['old_pass' => $pass]);
        $validator = Validator::make(request()->all(), [
            'curr_password' => ['same:old_pass'],
            'new_password' => ['required', 'min:6', 'max:255'],
            're_new_password' => ['same:new_password']
        ], [
            'curr_password.same' => "Password salah!",
            're_new_password.same' => "Password tidak sama!"
        ]);
        if($validator->fails()){
            return redirect(route('pass_view'))->withErrors($validator)
            ->with('change_pass_error', 'Update Password Gagal!');
        }
        $user = User::where('id', auth()->user()->id);
        $user->password(Hash::make(request()->new_password));
        $user->save();
        return redirect(route('pass_view'))->with('change_pass_success','Update Password Berhasil');

    }
    public function cv_download(){

        return Storage::download(request()->cv_url);
    }
}
