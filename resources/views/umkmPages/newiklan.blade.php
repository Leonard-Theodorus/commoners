@extends('layouts.stylelayout1')

@section('content')
    <script>
        function imageData() {
        return {
            previewUrl: "",
            updatePreview() {
            var reader,
                files = document.getElementById("thumbnail").files;

            reader = new FileReader();

            reader.onload = e => {
                this.previewUrl = e.target.result;
            };

            reader.readAsDataURL(files[0]);
            },
            clearPreview() {
            document.getElementById("thumbnail").value = null;
            this.previewUrl = "";
            }
        };
    }
    </script>
    @if (session()->has('create_success'))
    <div id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
            {{session('create_success')}}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-dismiss-target="#alert-3" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
    @endif
    @if (session()->has('create_error'))
    <div id="alert-2" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
            {{session('create_error')}}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300" data-dismiss-target="#alert-2" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
      </div>
    @endif

    <div class="flex-row">
        <form enctype="multipart/form-data" action=" {{route('createiklan')}} " method="post">
            @csrf
            <div class="flex bg-gray-200 mt-8 px-4 py-2">
                <div class="flex-row w-2/4 ">
                        <h1 class="text-sky-900 text-xl my-2 mx-3"> Judul Iklan </h1>
                        <div class=" w-full my-2 ">
                            <input class="w-full border-2 rounded p-2" required type="text" name="new_judul" id="" placeholder="Judul Iklan Baru" value="{{old('new_judul')}}">
                        </div>
                        <div class="flex">
                            <div class="flex-row w-1/2">
                                <h1 class="text-sky-900 text-xl my-2 mx-3"> Lokasi (Kota) </h1>
                                <div class="w-full my-2 ">
                                    <input class="w-full border-2 rounded p-2" required type="text" name="new_lokasi" id="" placeholder="Kota" value="{{old('new_lokasi')}}">
                                </div>
                            </div>
                            <div class="flex-row w-1/2">
                                <h1 class="text-sky-900 text-xl my-2 mx-3"> Alamat </h1>
                                <div class=" w-full my-2 ">
                                    <input class="w-full border-2 rounded p-2 ml-2" required type="text" name="new_alamat" id="" placeholder="Alamat" value="{{old('new_alamat')}}">
                                </div>

                            </div>
                        </div>
                        <h1 class="text-sky-900 text-xl my-2 mx-3"> Bidang Iklan </h1>
                        <select class="w-full p-2 rounded border-2  type="text" name="new_category" required value="{{old('new_category')}}">
                            <option value="" selected="true" disabled="disabled">Kategori Iklan</option>
                            @foreach ($categories as $cat )
                            <option value= {{$cat->id}}> {{$cat->nama_kategori}} </option>
                            @endforeach
                        </select>
                        <h1 class="text-sky-900 text-xl my-2 mx-3"> Banner Iklan </h1>
                        <div class="w-full  p-8  bg-white rounded-lg">
                            <div class="" x-data="imageData()">
                                <div x-show="previewUrl == ''">
                                    <p class="text-center text-bold">
                                        <label for="thumbnail" class="cursor-pointer">
                                            Upload Banner Iklan
                                        </label>
                                        <input type="file" name="thumbnail" id="thumbnail" class="hidden form-control @error('thumbnail') is-invalid @enderror" @change="updatePreview()">
                                        @error('thumbnail')
                                        <div class="invalid-feedback text-red-500">
                                            {{$message}}

                                        </div>
                                        @enderror
                                </p>
                            </div>
                            <div x-show="previewUrl !== ''">
                                <img :src="previewUrl" alt="" class="rounded">
                                <div class="">
                                    <button type="button" class="" @click="clearPreview()">Ganti Banner</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="flex-row w-1/4 ml-4 w-1/2 ">
                    <h1 class="text-sky-900 text-xl my-2 mx-3"> Durasi Pekerjaan </h1>
                    <select class="w-full p-2 border-2  rounded  type="text" name="new_duration" required  value="{{old('new_duration')}}">
                        <option value="" selected="true" disabled>Durasi Pekerjaan</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Magang">Magang</option>
                    </select>
                    <h1 class="text-sky-900 text-xl my-3 mx-3"> Gaji Dalam Rupiah </h1>
                    <input class="w-full border-2 rounded p-2"   type="text" name="new_gaji" value="{{old('new_gaji')}}" placeholder="Gaji Dalam Rupiah" >

                    <h1 class="text-sky-900 text-xl my-3 mx-3"> Deskripsi Singkat </h1>
                <input class="w-full border-2 rounded p-2 " type="text" name="new_desc" id="" placeholder="Deskripsi Singkat Iklan" value="{{old('new_desc')}}">
                    <h1 class="text-sky-900 text-xl my-3 mx-3"> Job-description (setiap poin dipisahkan oleh titik (".") ) </h1>
                    <textarea class="block p-2.5 w-full rounded "  required name="new_jobdesc" id="" cols="30" rows="10" placeholder="Contoh: Deskripsi Pertama. Deskripsi Kedua."></textarea>
                </div>
            </div>
            <div class="flex bg-gray-200 justify-center">
                <button class="rounded w-96 p-2 border-2 bg-yellow-300 " type="submit">Buat Iklan Baru</button>

            </div>

        </form>

    </div>
@endsection
