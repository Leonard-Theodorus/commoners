@extends('layouts.mainlayout')

@section('content')
    <div class="flex-row">
        @foreach ($app as $a)
            <div class="flex justify-between rounded border-2 my-4 px-8 py-2 ">
                <div class="flex-row items-center">
                    <p class="text-m "> {{$a->judul_iklan}} </p>
                    <h1 class="text-sky-900 text-xl my-2"> Pelamar </h1>
                    <div class="flex border-2 divide-x-2 divide-stone-500 rounded px-2 w-full my-2">
                        <div class="text-xl mr-2">
                            <p>Name</p>
                        </div>
                        <div>
                            <p class="text-xl ml-2"> {{$a->nama_pelamar}} </p>
                        </div>
                    </div>
                    <div class="flex border-2 divide-x-2 divide-stone-500 rounded px-2 w-full my-2">
                        <div class="text-xl mr-2">
                            <p>Email</p>
                        </div>
                        <div>
                            <p class="text-xl ml-2"> {{$a->email_pelamar}} </p>
                        </div>
                    </div>
                    <div class="flex border-2 divide-x-2 divide-stone-500 rounded p-2 w-full my-2">
                        <div class="text-xl mr-2">
                            <p>Contact Number</p>
                        </div>
                        <div class="text-xl mr-2">
                            <p>+62</p>
                        </div>
                        <div>
                            <p class="text-xl ml-2"> {{$a->tel_pelamar}} </p>
                        </div>
                    </div>
                    <div class="border-2 rounded p-2 w-3/4 my-2">
                        <form action="{{route('download')}}" method="post">
                            @csrf
                            <input type="hidden" name="cv_url" value=" {{$a->cv_pelamar}} ">
                            <button class="rounded bg-stone-300 w-full" @if ($a->cv_pelamar == null)
                                disabled
                            @endif> Download CV</button>
                        </form>
                    </div>
                    @if ($a->portfolio_link != null)
                        <div class="flex border-2 divide-x-2 divide-stone-500 rounded p-2 w-full my-2">
                            <div class="text-xl mr-2">
                                <p>Portfolio Link</p>
                            </div>
                            <div>
                                <p class="text-xl ml-2"> {{$a->portfolio_link}} </p>
                            </div>
                        </div>
                    @endif
                    <p class="text-m">Applied at: {{$a->proposal_date}} </p>
                </div>
                <div class="flex-row  ">
                    <div class="flex items-center h-full">
                        @if ($a->is_accepted == true)
                            <button class="w-full bg-gray-700 border-2 p-2 rounded text-white" disabled> Accepted </button>
                            @elseif($a->is_accepted == false && $a->is_accepted != null)
                            <button class="w-full bg-gray-700 border-2 p-2 rounded text-white" disabled> Rejected </button>
                            @else
                            <form action="{{route('accept')}}" method="post" class="mx-2">
                                @csrf
                                <input type="hidden" name="app_id" value=" {{$a->id}} ">
                                <button class="rounded border-2 bg-green-500 text-white p-2"> Accept </button>

                            </form>
                            <form action="{{route('reject')}}" method="post">
                                @csrf
                                <input type="hidden" name="app_id" value=" {{$a->id}} ">
                                <button class="rounded border-2 bg-red-500 text-white p-2"> Reject </button>

                            </form>

                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
