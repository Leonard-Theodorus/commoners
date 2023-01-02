@extends('layouts.stylelayout1')

@section('content')
    <div class="flex justify-center mt-4">
        <div class="flex-col">
            <img class="block w-full h-1/4 " src={{ $iklan->banner }} alt="banner">
            <div class="flex mt-2 gray-800 border-2 rounded">
                <div class="flex-col">
                    <img class="w-64 h-64" src={{ $iklan->logo }} alt="logo">
                    <h2 class="font-bold text-2xl"> {{ $iklan->umkm }} </h2>
                    <h2 class="font-bold text-2xl"> {{ $iklan->judul_iklan }} </h2>
                </div>
                <div class="px-6 py-4 flex-col justify-between">
                    <div class="flex">
                        <p class="font-bold"> {{ $iklan->shortdesc }} </p>
                    </div>
                    <div class="flex justify-evenly">
                        <div class="flex-col mt-4">
                            <p class="font-bold text-2xl">Lokasi: {{ $iklan->kota_lokasi }} </p>
                            <p class="font-bold text-2xl"> {{ $iklan->durasi }} </p>
                        </div>
                        <div class="flex-col mt-4">
                            <p class="font-bold text-2xl"> {{ $iklan->gaji }} </p>
                            <p class="font-bold text-2xl"> {{ $iklan->bidang }} </p>
                        </div>
                    </div>

                    <div class="flex mt-2 justify-center">
                        @if (auth()->user()->cv_file == null || auth()->user()->phone_number == null)
                            <div class="flex-row mt-2 justify-center">
                                <p class="text-xl font-bold text-red-500">
                                    Please Provide your Phone number and CV file before applying!
                                </p>
                                <form action="{{route('profile')}}" method="get">
                                    <button  class="rounded border-2 bg-yellow-300 w-full p-2"> Go to profile </button>
                                </form>
                            </div>

                            @else

                                <form action="#" method="post">
                                    <button type="submit"
                                        class="text-white hover:bg-neutral-500 duration-300 border-2 rounded bg-slate-800 px-2 py-4">
                                        Login To Apply (Guest)
                                    </button>
                                </form>


                                <button type="button"
                                    class="text-white @if (!$applied)
                                    hover:bg-neutral-500
                                    @endif  duration-300 border-2 rounded @if ($applied)
                                        bg-gray-500
                                    @else
                                            bg-blue-800
                                    @endif  px-2 py-4"
                                    data-modal-toggle="applydialog" @if ($applied)
                                        disabled
                                    @endif>
                                    Apply Now
                                </button>
                                <div id="applydialog" tabindex="-1" data-modal-backdrop="static" aria-hidden="true"
                                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                    <div class="relative w-full h-full max-w-2xl md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <div
                                                class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Apply Confirmation
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="applydialog">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>

                                            <div class="p-6 space-y-6">
                                                <h1 class="text-sky-900 text-xl my-1"> CV-File </h1>
                                                <form id="down" action="{{ route('download') }}" method="post">
                                                    <div class="flex">
                                                        <input class="border p-4 rounded" type="hidden" name="cv_url"
                                                            value=" {{ auth()->user()->cv_file }} ">
                                                        <input class="border p-4 rounded" type="text" disabled name="cv_url"
                                                            value=" {{ auth()->user()->cv_file }} ">
                                                        <button class="rounded bg-stone-300 w-full" @if (auth()->user()->cv_file == null)
                                                            disabled
                                                        @endif> Download CV</button>
                                                    </div>
                                                    @csrf
                                                </form>
                                                <form action="{{url('/application')}}" method="post">
                                                    @csrf
                                                    <h1 class="text-sky-900 text-xl my-2"> Phone Number </h1>
                                                    <div class="flex items-center border-2  rounded p-2 w-full my-2">
                                                        <div class="text-xl mr-2">
                                                            <p>+62</p>
                                                        </div>
                                                        <input type="tel" name="phone" id="phone"
                                                            class="w-full rounded border-2"
                                                            value=" {{ auth()->user()->phone_number }} ">

                                                    </div>
                                                    <label class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Upload New CV</label>
                                                    <input
                                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                        id="file_input" name="new_cv" type="file">


                                                        <div class="flex items-center border-2  rounded p-2 w-full mt-4">

                                                            <input type="text" name="port" id="port"
                                                                class="w-full rounded border-2"
                                                                placeholder="Additional Portfolio Link">

                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                                    <input type="hidden" name="id_iklan" value="{{$iklan->id}}">
                                                <div
                                                    class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <button data-modal-toggle="applydialog" type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Apply</button>
                                                    <button data-modal-toggle="applydialog" type="button"
                                                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <form action="" method="post">
                                    @csrf
                                </form>
                                <form action="" method="post">
                                    <button type="submit"
                                        class="text-white hover:bg-neutral-500 duration-300 border-2 rounded bg-green-600 px-2 py-4">
                                        Update (UMKM)
                                    </button>

                                </form>
                                <form action="" method="post">
                                    <button type="submit"
                                        class="text-white hover:bg-neutral-500 duration-300 border-2 rounded bg-red-600 px-2 py-4">
                                        Delete (UMKM)
                                    </button>

                                </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex-col mt-2 gray-800 border-2 rounded">
                <div class="flex mt-2">
                    <p class="font-bold text-2xl"> Job Description: </p>
                </div>
                @foreach ($jobdesc as $j)
                    <div class="flex mt-2">
                        <p class="font-bold"> {{ $j }} </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function stop() {
            $("#down").on("submit", function(event) {
                event.preventDefault();
            })
        }
    </script>
@endsection
