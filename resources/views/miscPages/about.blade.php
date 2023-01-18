@extends('layouts.mainlayout')

@section('content')
    <div class="flex justify-between bg-red-500 mt-12 bg-gray-300 border-double border-2">
        <div class="flex-row w-2/4 ">
            <div class="flex justify-center">
                <h1 class="text-2xl text-sky-900">Tentang Kami</h1>
            </div>
            <div class="flex justify-center">
                <p class="text-xl text-sky-900 p-4 my-2">
                    Temukan UMKM yang cocok untukmu disini! Commoners yang berati 'orang biasa' adalah platform
                    yang dibuat untuk para 'orang biasa' mencari kesempatan bekerja di UMKM-UMKM Indonesia.
                    Platform ini dibuat dengan tujuan mempertemukan UMKM-UMKM Indonesia dengan para calon tenaga kerja
                    yang mereka butuhkan. Kami berharap sektor UMKM Indonesia akan terbantu dengan adanya aplikasi ini!
                </p>
            </div>
        </div>
        <div class="flex-row w-2/4 ">
            <div class="flex justify-center">
                <a href="{{route('home')}}"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Latin_small_letter_reversed_C_with_dot.svg/643px-Latin_small_letter_reversed_C_with_dot.svg.png" class="w-64 h-64" alt="Logo"></a>

            </div>

        </div>
    </div>
@endsection
