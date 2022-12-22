@extends('layouts.mainlayout')

@section('content')
<div class="flex justify-center items-center min-h-full w-full mt-24">
    <form action="/register/umkm" method="post" class="flex flex-col w-2/4 space-y-4">
        <h1 class="text-sky-900 text-xl">Register As UMKM</h1>
        @csrf
        <input type="text" name="name" class="border p-4 @error('name')is-invalid @enderror" required autofocus value="{{old ('name')}}" id="floatingInput" placeholder="Nama UMKM">
        @error('name')
            <div class="invalid-feedback text-red-500">
                {{$message}}
            </div>
        @enderror

        <input type="email" name="email" class="border p-4 @error('email') is-invalid @enderror" required  value="{{old ('email')}}" id="floatingInput" placeholder="name@example.com">
        @error('email')
            <div class="invalid-feedback text-red-500">
                {{$message}}
            </div>
        @enderror

        <input type="password" name="password" required class="border p-4 @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password">
        @error('password')
            <div class="invalid-feedback text-red-500">
                {{$message}}
            </div>
        @enderror

        <input type="password" name="repassword" class="border p-4 @error('repassword') is-invalid @enderror" id="floatingPassword" placeholder="Re-enter password">
        @error  ('repassword')
            <div class="invalid-feedback text-red-500">
                {{$message}}
            </div>
        @enderror
        <select class="border p-4 @error('umkm_category')
                    is-invalid
                @enderror" type="text" name="umkm_category" required value="{{old ('umkm_category')}}">
                    <option value="" selected="true" disabled="disabled">Choose category</option>
                    @foreach ($categories as $cat )
                        <option value= {{$cat->id}}> {{$cat->nama_kategori}} </option>
                    @endforeach
        </select>
        <button class="bg-yellow-300 rounded-md py-2 px-4 self-end hover:font-bold" type="submit">Register Now</button>
    </form>
</div>
@endsection
