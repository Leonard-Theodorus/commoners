<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\User;
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
            ]);
            if($validator->fails()){
                return redirect(route('profile'))->withErrors($validator)->withInput()
                ->with('update_error', 'Profile not updated, click the update button again for more detail!');
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
            ]);
            if($validator->fails()){
                return redirect(route('profile'))->withErrors($validator)->withInput()
                ->with('update_error', 'Profile not updated, click the edit button again for more detail!');
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
        return redirect(route('profile'))->with('update_success', 'Profile Sucessfully Updated!');
    }
    public function cv_download(){

        return Storage::download(request()->cv_url);
    }
}
