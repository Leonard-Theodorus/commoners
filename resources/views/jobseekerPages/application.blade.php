@extends('layouts.mainlayout')

@section('content')
    <div class="flex-row">
        @foreach ($app as $a)
            <div class="flex justify-between rounded border-2 my-4 px-4 py-2 ">
                <div class="flex-row">
                    <div class="flex items-center h-full">
                        <div class="flex-row">
                            <p class="text-m "> {{$a->judul_iklan}} </p>
                            @if ($a->is_accepted == null)
                                <p class="text-m">Status: Application In Review</p>
                                @elseif ($a->is_accepted == false)
                                    <p class="text-m text-red-500">
                                        Status: Application Rejected

                                    </p>
                                @else
                                <p class="text-m text-green-500">
                                    Status: Application Accepted
                                </p>

                            @endif

                            <p class="text-m">Applied at: {{$a->proposal_date}} </p>
                        </div>

                    </div>

                </div>
                <div class="flex-row">
                    @if (str_starts_with($a->img, 'https'))
                        <img class="w-24 object-contain shadow rounded-full  border-none" src=" {{ $a->img }} " alt="logo umkm">
                        @else
                        <img class="w-24 object-contain shadow rounded-full  border-none" src=" {{asset('storage/'. $a->img) }} " alt="logo umkm">

                    @endif
                    <p class="text-m"> {{$a->umkm}} </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
