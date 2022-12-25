@extends('layouts.mainlayout')

@section('content')
@if (empty($res))
    {{-- design kalau tidak ada search result --}}
    @else
    <div class="flex justify-center mt-32">
        @foreach ($res as $r)
            <form action= {{route('detail')}} method="post" class="max-w-sm rounded overflow-hidden shadow-lg mx-4">
                <button type="submit" class="h-full">
                    <img class="w-full" src= {{$r->logo}} alt="Banner">
                    <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{$r->judul_iklan}}</div>
                    <div class="font-bold text-xl mb-2">{{$r->umkm}}</div>
                    <p class="text-gray-700 text-base">
                        {{$r->shortdesc}}
                    </p>
                    </div>
                    <div class="flex  px-6 pt-4 pb-2">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{$r->kota_lokasi}}</span>
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"> {{$r->bidang}} </span>
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

@endif
@endsection
