@extends('layouts.stylelayout1')

@section('content')
    <div class="flex justify-center mt-4">
        <div class="flex-col w-1/2">
            @if (str_starts_with($iklan->banner, 'https'))
                <img class="block w-full h-1/4 " src="{{ $iklan->banner }}" alt="banner">
            @else
                <img class="block w-full h-1/4 " src="{{ asset('storage/' . $iklan->banner) }}" alt="banner">
            @endif
            <div class="flex-row px-5 py-2 mt-2 gray-800 border-2 rounded">
                <div class="flex-row">
                        <h2 class="font-bold text-4xl text-center"> {{ $iklan->umkm }} </h2>
                        <h2 class="font-bold text-xl text-center"> {{ $iklan->judul_iklan }} </h2>
                    </div>
                <div class="flex p-3 mt-2 gray-800 border-2 rounded">

                    <div class="flex-col p-1">
                        <img class="w-64 h-64" src={{ $iklan->logo }} alt="logo">
                    </div>
                    <div class="px-5 py-1 flex-row-col justify-between">
                        <div class="flex">
                            <p class="font-medium"> {{ $iklan->shortdesc }} </p>
                        </div>
                        <div class="flex justify-evenly">
                            <div class="flex-col mt-4">
                                <p class="font-medium text-xl m-5">Lokasi: {{ $iklan->kota_lokasi }} </p>
                                <p class="font-medium text-xl m-5">Durasi: {{ $iklan->durasi }} </p>
                            </div>
                            <div class="flex-col ">
                                <p class="font-medium text-xl m-5">
                                @if ($iklan->gaji == 0)
                                    UMKM tidak menampilkan gaji
                                @else
                                    Gaji:Rp{{ $iklan->gaji }}
                                @endif
                            </p>
                                <p class="font-medium text-xl m-5"> {{ $iklan->bidang }} </p>
                            </div>
                        </div>

                    <div class="flex mt-2 justify-center">
                        @if (!Auth::check())
                            <form action=" {{ route('login') }} " method="get" class="w-full flex justify-center">
                                <button type="submit"
                                    class="text-white hover:bg-red-600 duration-300 border-2 rounded bg-gray-400 px-2 py-4 w-96">
                                    Login To Apply
                                </button>
                            </form>
                        @else
                            @cannot('umkm')
                                @if (auth()->user()->cv_file == null || auth()->user()->phone_number == null)
                                    <div class="flex-row mt-2 justify-center">
                                        <p class="text-xl font-bold text-red-500">
                                            Tolong lengkapi CV dan nomor telepon Anda sebelum melamar!
                                        </p>
                                        <form action="{{ route('profile') }}" method="get">
                                            <button class="rounded border-2 bg-yellow-300 w-full p-2"> Profil Anda </button>
                                        </form>
                                    </div>
                                @else
                                    @cannot('admin')
                                            <button type="button"
                                                class="text-white @if (!$applied) hover:bg-neutral-500 @endif  duration-300 border-2 rounded @if ($applied) bg-gray-500
                                                    @else
                                                        bg-blue-800 @endif  px-2 py-4"
                                                data-modal-toggle="applydialog" @if ($applied || $iklan->is_available === 0) disabled @endif>
                                                @if (!$applied && $iklan->is_available === 1)
                                                        Apply Now
                                                    @elseif(!$applied && $iklan->is_available === 0)
                                                        Iklan Sedang Ditutup
                                                @else
                                                    Applied
                                                @endif
                                            </button>
                                            <div id="applydialog" tabindex="-1" data-modal-backdrop="static" aria-hidden="true"
                                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <div
                                                            class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Konfirmasi
                                                            </h3>
                                                            <button type="button"
                                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                data-modal-toggle="applydialog">
                                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                                                                    <input class="border p-4 rounded" type="text" disabled
                                                                        name="cv_url" value=" {{ auth()->user()->cv_file }} ">
                                                                    <button class="rounded bg-stone-300 w-full"
                                                                        @if (auth()->user()->cv_file == null) disabled @endif> Download
                                                                        CV</button>
                                                                </div>
                                                                @csrf
                                                            </form>
                                                            <form action="{{ url('/application') }}" method="post">
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
                                                                <label
                                                                    class="block mb-2 text-l font-medium text-gray-900 dark:text-white">Upload
                                                                    New CV</label>
                                                                <input
                                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                                    id="file_input" name="new_cv" type="file">


                                                                    <div class="flex items-center border-2  rounded p-2 w-full mt-4">

                                                                        <input type="text" name="port" id="port"
                                                                            class="w-full rounded border-2"
                                                                            placeholder="Additional Portfolio Link">

                                                                    </div>
                                                                </div>
                                                        </div>
                                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                                        <input type="hidden" name="id_iklan" value="{{ $iklan->id }}">
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
                                            </div>

                                    @endcannot
                                    @can('admin')
                                        <form action=" {{ route('editiklanpage', ['id_iklan' => $iklan->id]) }} " method="get">
                                            @csrf
                                            <input type="hidden" name="id_iklan" value=" {{ $iklan->id }} ">
                                            <button type="submit"
                                                class="text-white hover:bg-neutral-500 duration-300 border-2 rounded bg-green-600 px-2 py-4">
                                                Update
                                            </button>

                                        </form>
                                        <button type="submit" data-modal-toggle="deletedialog"
                                            class="text-white hover:bg-neutral-500 duration-300 border-2 rounded bg-red-600 px-2 py-4">
                                            Delete
                                        </button>

                                        <div id="deletedialog" tabindex="-1" data-modal-backdrop="static" aria-hidden="true"
                                            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
                                            <div class="relative w-full h-full max-w-2xl md:h-auto">
                                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                    <div
                                                        class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                            Delete Confirmation
                                                        </h3>
                                                        <button type="button"
                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-toggle="deletedialog">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor"
                                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd"
                                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                                    clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                    </div>

                                                    <div class="p-6 space-y-6">
                                                        <h1 class="text-sky-900 text-xl my-1"> Anda yakin ingin menghapus iklan
                                                            ini? </h1>
                                                        <div class="flex w-full bg-green-500">
                                                            <form action=" {{route('deleteiklan')}} " method="post" class="w-full">
                                                                @csrf
                                                                <input type="hidden" name="id_iklan" value=" {{$iklan->id}} ">
                                                                <button type="submit"
                                                                    class="text-white bg-green-500 px-2 py-4 w-full">
                                                                    Ya
                                                                </button>
                                                            </form>
                                                            <button type="submit" data-modal-toggle="deletedialog"
                                                                class="text-white bg-red-500 px-2 py-4 w-full">
                                                                Tidak
                                                            </button>


                                                        </div>


                                                    </div>


                                                </div>
                                            </div>

                                        </div>

                                    @endcan
                                @endcannot
                            @endif
                        @endif
                        @can('umkm')
                            <form action=" {{ route('editiklanpage', ['id_iklan' => $iklan->id]) }} " method="get"
                                class="w-full flex justify-center">
                                @csrf
                                @if ($iklan->id_umkm == auth()->user()->id)
                                    <button class="border-2 p-2 rounded bg-yellow-300 w-96"> Edit </button>
                                    </button>
                                @endif
                            </form>
                            @endcan
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
