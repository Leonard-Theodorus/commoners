@extends('layouts.mainlayout')

@section('content')
    <div class="flex flex-col my-8">
        <h2 class="font-normal text-lg mt-60 place-self-center"> {{$message}} </h2>
        <a class="w-36 rounded-md p-2 bg-yellow-400 font-semibold text-center place-self-center my-4" href="{{ url()->previous() }}">Kembali</a>
    </div>
@endsection
