<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function reg_job(){
        return view('authPages.registerjob');
    }
    public function ins_jobseeker(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:6', 'max:255'],
            'repassword' => ['same:password'],
            'phone_number' => $request->phone_num
        ],
        [
            'repassword.same' => "Pasword must match"
        ]
        );
        $validated['password'] = Hash::make($validated['password']);
        DB::table('users')->insert([
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'is_umkm' => false,
                'is_admin' => false
            ]
        ]);
        return redirect(route('login'))->with('success', 'Sign-up sucessful! Please login');
    }
    public function reg_umkm(){
        $categories = Kategori::all();
        return view('authPages.registerumkm', ['categories' => $categories]);
    }
    public function ins_umkm(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:6', 'max:255'],
            'repassword' => ['same:password'],
        ],
        [
            'repassword.same' => "Pasword must match"
        ]
        );
        $validated['password'] = Hash::make($validated['password']);
        DB::table('users')->insert([
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
                'is_umkm' => true,
                'is_admin' => false,
                'phone_number' => $request->phone_num
            ]
        ]);
        $prev_id = DB::getPdo()->lastInsertId();
        DB::table('umkm')->insert([
            [
                'user_id' => $prev_id,
                'kategori_umkm' => $request->umkm_category
            ]
        ]);
        return redirect(route('login'))->with('success', 'Sign-up sucessful! Please login');
    }
    public function login_page(){
        return view('authPages.login');
    }
    public function login(Request $req){
        $credentials = $req->validate([
            'email' => ['email:dns', 'required'],
            'password' => ['required'],
        ]);
        $remember_me = $req->has('remember_me') ? true : false;
        if(Auth::attempt($credentials,$remember_me)){
            $req->session()->regenerate();
            return redirect()->intended(route('home'));
        }
        return back()->with('loginError', 'Login Failed!');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
