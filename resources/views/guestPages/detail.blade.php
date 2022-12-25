@extends('layouts.mainlayout')

@section('content')
    <div class="flex justify-center mt-4">
        <div class="flex-col">
            <img class="block w-full h-1/4 " src= {{$iklan->banner}} alt="banner">
            <div class="flex mt-2 gray-800 border-2 rounded">
                <div class="flex-col">
                    <img class="w-64 h-64" src= {{$iklan->logo}} alt="logo">
                    <h2 class="font-bold text-2xl"> {{$iklan->umkm}} </h2>
                    <h2 class="font-bold text-2xl"> {{$iklan->judul_iklan}} </h2>
                </div>
                <div class="px-6 py-4 flex-col justify-between">
                    <div class="flex">
                        <p class="font-bold"> {{$iklan->shortdesc}} </p>
                    </div>
                    <div class="flex justify-evenly">
                        <div class="flex-col mt-4">
                            <p class="font-bold text-2xl">Lokasi:  {{$iklan->kota_lokasi}} </p>
                            <p class="font-bold text-2xl"> {{$iklan->durasi}} </p>
                        </div>
                        <div class="flex-col mt-4">
                            <p class="font-bold text-2xl"> {{$iklan->gaji}} </p>
                            <p class="font-bold text-2xl"> {{$iklan->bidang}} </p>
                        </div>
                    </div>
                    <div class="flex mt-2 justify-center">
                        <form action="#" method="post">
                            <button type="submit" class="text-white hover:bg-neutral-500 duration-300 border-2 rounded bg-slate-800 px-2 py-4">
                                Login To Apply (Guest)
                            </button>
                            <button type="submit" class="text-white hover:bg-neutral-500 duration-300 border-2 rounded bg-slate-800 px-2 py-4">
                                Apply Now
                            </button>
                            <button type="submit" class="text-white hover:bg-neutral-500 duration-300 border-2 rounded bg-green-600 px-2 py-4">
                                Update (UMKM)
                            </button>
                            <button type="submit" class="text-white hover:bg-neutral-500 duration-300 border-2 rounded bg-red-600 px-2 py-4">
                                Delete (UMKM)
                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="flex-col mt-2 gray-800 border-2 rounded">
                <div class="flex mt-2">
                    <p class="font-bold text-2xl"> Job Description: </p>
                </div>
               @foreach ($jobdesc as $j )
                   <div class="flex mt-2">
                        <p class="font-bold"> {{$j}} </p>
                   </div>
               @endforeach
            </div>
        </div>
    </div>
@endsection
