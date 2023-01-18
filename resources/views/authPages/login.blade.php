@extends('layouts.mainlayout')

@section('content')
<div class="flex justify-center items-center min-h-full w-full mt-20">
    <form action="{{ route('login') }}" method="post" class="flex flex-col w-1/4 space-y-4">
        <h1 class="text-sky-900 text-xl">Sign In</h1>
        @csrf
        <input class="border p-4" type="email" name="email" required autofocus value="{{old ('email')}}" placeholder="Email">
        <input class="border p-4" type="password" name="password" id="floatingPassword" placeholder="Password">
        <label for="remember_me" class="text-sky-900"><input type="checkbox" value="remember-me" name="remember_me"> Remember me</label>
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show text-green-500" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show text-red-500" role="alert">
            {{session('loginError')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <button class="w-full bg-yellow-300 rounded-md py-2 self-center hover:font-bold" type="submit">Login</button>
        <div class="flex justify-center">
            <p class="text-xl text-sky-900">Belum Memiliki Akun?</p>
        </div>
        <div class="flex justify-between">
            <a href=" {{route('register_umkm')}} " class="text-sky-900">Register Sebagai UMKM</a>
            <a href=" {{route('register_jobseeker')}} " class="text-sky-900">Register Sebagai Pelamar</a>

        </div>
    </form>
</div>
@endsection
