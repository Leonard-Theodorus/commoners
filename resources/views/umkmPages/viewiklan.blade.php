@extends('layouts.mainlayout')

@section('content')
    <div class="flex-row">
        @foreach ($iklan as $i)
        <form action=" {{route('detail', ['id_iklan' => $i->id])}} " method="post">
            @csrf
            <button type="submit" class="h-full w-full">
                <div class="flex justify-between rounded border-2 my-4 px-4 py-2 ">
                    <div class="flex-row">
                        <div class="flex items-center h-full">
                            <div class="flex-row">
                                <p class="text-m "> {{$i->judul_iklan}} </p>
                                <p class="text-m">{{$i->shortdesc}} </p>
                        </div>

                        </div>

                    </div>
                    <div class="flex-row">
                        @if (str_starts_with($i->banner, 'https'))
                            <img class="w-64 object-contain shadow   border-none" src=" {{$i->banner}} " alt="banner iklan">
                            @else
                            <img class="w-64 object-contain shadow   border-none" src=" {{asset('storage/'. $i->banner) }} " alt="banner iklan">

                        @endif
                    </div>
                </div>

            </button>

        </form>
        @endforeach
    </div>
@endsection
