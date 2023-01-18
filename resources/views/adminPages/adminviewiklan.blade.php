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
@endsection
