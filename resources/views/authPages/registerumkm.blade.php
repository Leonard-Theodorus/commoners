@extends('layouts.mainlayout')

@section('content')
<<<<<<< Updated upstream
<div class="flex justify-center items-center min-h-full w-full mt-24">
=======
<div class="flex justify-center items-center min-h-full w-full mt-20">
>>>>>>> Stashed changes
    <form action="/register/umkm" onsubmit="process(event)" method="post" class="flex flex-col w-2/4 space-y-4">
        <h1 class="text-sky-900 text-xl">Register Sebagai UMKM</h1>
        @csrf
        <input type="text" name="name" class="border p-4 @error('name')is-invalid @enderror" required autofocus value="{{old ('name')}}" placeholder="Nama UMKM">
        @error('name')
            <div class="invalid-feedback text-red-500">
                {{$message}}
            </div>
        @enderror

        <input type="email" name="email" class="border p-4 @error('email') is-invalid @enderror" required  value="{{old ('email')}}"  placeholder="Email">
        @error('email')
            <div class="invalid-feedback text-red-500">
                {{$message}}
            </div>
        @enderror

        <input type="password" name="password" required class="border p-4 @error('password') is-invalid @enderror"  placeholder="Password">
        @error('password')
            <div class="invalid-feedback text-red-500">
                {{$message}}
            </div>
        @enderror

        <input type="password" name="repassword" class="border p-4 @error('repassword') is-invalid @enderror"  placeholder="Konfirmasi Password">
        @error  ('repassword')
            <div class="invalid-feedback text-red-500">
                {{$message}}
            </div>
        @enderror
        <select class="border p-4 @error('umkm_category')
                    is-invalid
                @enderror" type="text" name="umkm_category" required value="{{old ('umkm_category')}}">
                    <option value="" selected="true" disabled="disabled">Kategori UMKM</option>
                    @foreach ($categories as $cat )
                        <option value= {{$cat->id}}> {{$cat->nama_kategori}} </option>
                    @endforeach
        </select>
        <input value="" type="tel" name="phone_num" id="phone_num" class="border p-4 w-full @error('phone_num') is-invalid @enderror"  placeholder="Nomor Telepon Indonesia">
        @error  ('phone_num')
            <div class="invalid-feedback text-red-500">
                {{$message}}
            </div>
        @enderror
        {{-- <script>
            const phoneInputField = document.querySelector("#phone_num");
            const phoneInput = window.intlTelInput(phoneInputField, {
                preferredCountries: ["id"],
                utilsScript:
                "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });
            function process(event){
                const phoneNumber = phoneInput.getNumber();
                document.getElementById('phone_num').setAtrribute('value', phoneNumber);
            }

        </script> --}}
        <button class="bg-yellow-300 rounded-md py-2 px-4 self-end hover:font-bold" type="submit">Register Sekarang</button>
    </form>
</div>
@endsection
