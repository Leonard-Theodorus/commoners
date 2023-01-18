@extends('layouts.stylelayout1')

@section('content')
    <div class="flex justify-center ">
        <h1 class="text-sky-900 text-2xl my-2"> Cari UMKM </h1>
    </div>
    <div class="flex justify-center mt-4">
            <form action= " {{route('adminsearch')}} " class="w-2/4 flex" role="search" method="post">
                @csrf
                <input class="w-full rounded-md pl-3" name="search_keyword" type="search" placeholder="Search nama UMKM (Admin)" aria-label="Search">
                <button class="py-1 px-1 mx-5 border border-green-800 rounded-md hover:font-bold duration-200 " type="submit">Search</button>
            </form>


    </div>
    <div class="flex-row">
        <div class="flex justify-center mt-16">
            <p class="text-2xl text-sky-900">Search Keyword: {{$search}} </p>
        </div>
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

    </div>
@endsection
