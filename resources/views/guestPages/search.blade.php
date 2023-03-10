@extends('layouts.mainlayout')

@section('content')
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
    <div class="flex justify-center">
        <div class="flex-row  mt-32">
            <div class="grid grid-cols-3 my-2 gap-4">
                @foreach ($res as $r)
                    <div class="">
                        <form action={{ route('detail', ['id_iklan' => $r->id]) }} method="post"
                            class=" max-w-sm min-h-full rounded overflow-hidden shadow-lg mx-4">
                            @csrf
                            <button type="submit" class="h-full">
                                @if (str_starts_with($r->logo, 'https'))
                                    <img class="w-full" src={{ $r->logo }} alt="Banner">
                                @else
                                    <img class="w-full" src={{ asset('storage/' . $r->logo) }} alt="Banner">
                                @endif
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{ $r->judul_iklan }}</div>
                                    <div class="font-bold text-xl mb-2">{{ $r->umkm }}</div>
                                    <p class="text-gray-700 text-base">
                                        {{ $r->shortdesc }}
                                    </p>
                                </div>
                                <div class="flex  px-6 pt-4 pb-2">
                                    <span
                                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $r->kota_lokasi }}</span>
                                    <span
                                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">
                                        {{ $r->bidang }} </span>
                                </div>

                            </button>

                        </form>

                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
