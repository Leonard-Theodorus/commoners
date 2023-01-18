@extends('layouts.mainlayout')

@section('content')
    @if (session()->has('del_iklan_success'))
    <div id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
            {{session('del_iklan_success')}}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-dismiss-target="#alert-3" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
    </div>

    @endif
    <div class="flex w-full bg-slate-800 items-center justify-center">
        <div class="flex items-center mt-3">
            <h2 class="text-white font-sans text-3xl">
                Jelajahi UMKM yang cocok untukmu!
            </h2>
        </div>
    </div>
    <div class="flex h-20 w-full bg-slate-800 items-center justify-evenly">
        <div class="flex items-center mt-3">
            <form action= " {{route('search')}} " class="flex space-x-4" role="search" method="get">
                @csrf
                <input class="w-80 h-8 rounded-md pl-4" name="search_keyword" type="search" placeholder="Cari Lowongan Kerja" aria-label="Search">
                <select class="w-80 h-8 pl-2 rounded  type="text" name="search_category"  value="{{old ('search_category')}}">
                    <option value="" selected="true" disabled="disabled">Kategori Pekerjaan</option>
                    @foreach ($categories as $cat )
                        <option value= {{$cat->id}}> {{$cat->nama_kategori}} </option>
                    @endforeach
                </select>
                <input class="w-75 h-8 rounded-md pl-4" name="search_kota" type="search" placeholder="Kota" aria-label="Search">
                <select class="w-75 h-8 pl-2 rounded  type="text" name="search_duration"  value="">
                    <option value="" selected="true" disabled>Durasi Pekerjaan</option>
                    <option value="Part-time">Part-time</option>
                    <option value="Full-time">Full-time</option>
                    <option value="Magang">Magang</option>
                </select>
                <button class="py-1 px-2 border border-green-800 rounded-md hover:font-bold text-white" type="submit">Search</button>
            </form>
        </div>
    </div>
    <div class="flex-row">
        <div class="flex justify-center mt-32">
            @foreach ($iklan as $i)
                <form action= {{route('detail', ['id_iklan' => $i->id])}} method="post" class="max-w-sm rounded overflow-hidden shadow-lg mx-4">
                    @csrf
                    <button type="submit" class="h-full">
                        @if (str_starts_with($i->logo, 'https'))
                            <img class="w-full" src= "{{$i->logo}} " alt="Banner">
                        @else
                            <img class="w-full" src= "{{asset('storage/'. $i->logo)}} " alt="Banner">
                        @endif
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{$i->judul_iklan}}</div>
                            <div class="font-bold text-xl my-2">{{$i->umkm}}</div>
                            <p class="text-gray-700 text-base">
                                {{$i->shortdesc}}
                            </p>
                        </div>
                        <div class="flex px-6 pt-4 pb-2">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$i->kota_lokasi}}</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"> {{$i->bidang}} </span>
                        </div>

                    </button>

                </form>



            @endforeach

        </div>
        <div class="flex justify-center mt-4">
            {{$iklan->links()}}

        </div>

    </div>
@endsection
