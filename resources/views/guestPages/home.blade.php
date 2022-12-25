@extends('layouts.mainlayout')

@section('content')
    <div class="flex w-full bg-slate-800 items-center justify-center">
        <div class="flex items-center mt-4">
            <h2 class="text-white font-sans text-3xl">
                Jelajahi UMKM yang cocok untukmu!
            </h2>
        </div>
    </div>
    <div class="flex w-full bg-slate-800 items-center justify-evenly">
        <div class="flex items-center mt-5">
            <form action= "/search" class="flex space-x-4" role="search" method="post">
                @csrf
                <input class="w-96 h-8 rounded-md pl-4" name="search_keyword" type="search" placeholder="Cari Lowongan Kerja" aria-label="Search">
                <select class="w-80 h-8 pl-2 rounded  type="text" name="search_category"  value="{{old ('search_category')}}">
                    <option value="" selected="true" disabled="disabled">Kategori Pekerjaan</option>
                    @foreach ($categories as $cat )
                        <option value= {{$cat->id}}> {{$cat->nama_kategori}} </option>
                    @endforeach
                </select>
                <input class="w-80 h-8 rounded-md pl-4" name="search_kota" type="search" placeholder="Kota" aria-label="Search">
                <select class="w-80 h-8 pl-2 rounded  type="text" name="search_duration"  value="">
                    <option value="" selected="true" disabled>Durasi Pekerjaan</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Magang">Magang</option>
                </select>
                <button class="py-1 px-2 border border-green-800 rounded-md hover:font-bold text-white" type="submit">Search</button>
            </form>
        </div>
    </div>
    <div class="flex justify-center mt-32">
        @foreach ($iklan as $i)
            <form action= {{route('detail', ['id_iklan' => $i->id])}} method="post" class="max-w-sm rounded overflow-hidden shadow-lg mx-4">
                @csrf
                <button type="submit" class="h-full">
                    <img class="w-full" src= {{$i->logo}} alt="Banner">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">{{$i->judul_iklan}}</div>
                        <div class="font-bold text-xl my-2">{{$i->umkm}}</div>
                        <p class="text-gray-700 text-base">
                            {{$i->shortdesc}}
                        </p>
                    </div>
                    <div class="flex  px-6 pt-4 pb-2">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$i->kota_lokasi}}</span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"> {{$i->bidang}} </span>
                    </div>

                </button>

            </form>

            {{-- <div class="max-w-sm rounded overflow-hidden shadow-lg mx-4">
                <img class="w-full" src= {{$i->banner}} alt="Banner">
                    <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{$i->judul_iklan}}</div>
                    <p class="text-gray-700 text-base">
                        {{$i->shortdesc}}
                    </p>
                    </div>
                    <div class="flex  px-6 pt-4 pb-2">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$i->kota_lokasi}}</span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"> {{$i->bidang}} </span>
                    </div>

            </div> --}}


        @endforeach

    </div>
@endsection
