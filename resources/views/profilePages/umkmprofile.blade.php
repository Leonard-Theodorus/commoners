@extends('layouts.stylelayout1')

@section('content')
    <script>
         function imageData() {
            return {
                previewUrl: "",
                updatePreview() {
                var reader,
                    files = document.getElementById("thumbnail").files;

                reader = new FileReader();

                reader.onload = e => {
                    this.previewUrl = e.target.result;
                };

                reader.readAsDataURL(files[0]);
                },
                clearPreview() {
                document.getElementById("thumbnail").value = null;
                this.previewUrl = "";
                }
            };
        }
    </script>
    @if (session()->has('update_success'))
        <div id="alert-3" class="flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Info</span>
            <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                {{session('update_success')}}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>

    @endif
    @if (session()->has('update_error'))
    <div id="alert-2" class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Info</span>
        <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
            {{session('update_error')}}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300" data-dismiss-target="#alert-2" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
      </div>
    @endif
    <div class="flex-col">
        <div  class="flex justify-evenly min-h-full w-full mt-24 bg-gray-100 ">
            <div id="cnt1" class="flex-col w-2/4  ">
                <h1 class="text-sky-900 text-xl my-2"> Nama UMKM </h1>
                <div class="border-2 rounded p-4 w-full my-2">
                    <p class="text-xl"> {{$user->name}} </p>
                </div>
                <h1 class="text-sky-900 text-xl my-2"> Email </h1>
                <div class="border-2 rounded p-4 w-full my-2">
                    <p class="text-xl"> {{$user->email}} </p>
                </div>
                <form action=" {{route('pass_view')}} " method="post">
                    @csrf
                    <button class="border-2 rounded p-2 bg-yellow-300 w-full my-2">Ubah Password</button>
                </form>
                <h1 class="text-sky-900 text-xl my-2"> Kategori UMKM </h1>
                <div class="border-2 rounded p-4 w-full my-2">
                    <p class="text-xl"> {{$umkm->kategori}} </p>
                </div>
                <h1 class="text-sky-900 text-xl my-2"> Deskripsi Singkat </h1>
                <div class="border-2 rounded p-4 w-full my-2">
                    <p class="text-xl"> {{$umkm->short_desc}} </p>
                </div>
            </div>
            <div id="cnt2" class="flex-col w-2/4 hidden">
                <form enctype="multipart/form-data" action="{{route('profile')}}" method="post">
                    @csrf
                    <input type="hidden" name="umkm", value= "1">
                    <input type="hidden" name="id" value=" {{$user->id}} ">
                    <h1 class="text-sky-900 text-xl my-2"> Logo </h1>
                    <div class="w-full -2xl p-8 mx-auto bg-white rounded-lg">
                        <div class="" x-data="imageData()">
                          <div x-show="previewUrl == ''">
                            <p class="text-center text-bold">
                              <label for="thumbnail" class="cursor-pointer">
                                Upload Logo Baru
                              </label>
                              <input type="file" name="thumbnail" id="thumbnail" class="hidden form-control @error('thumbnail') is-invalid @enderror" @change="updatePreview()">
                              @error('thumbnail')
                                <div class="invalid-feedback text-red-500">
                                    {{$message}}

                                </div>
                              @enderror
                            </p>
                          </div>
                          <div x-show="previewUrl !== ''">
                            <img :src="previewUrl" alt="" class="rounded">
                            <div class="">
                              <button type="button" class="" @click="clearPreview()">Ganti Image</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <h1 class="text-sky-900 text-xl my-2"> Nama UMKM </h1>
                    <input type="text" class="w-full border-2 p-4 my-2 @error('name')
                        is-invalid
                    @enderror" name="name" value = "{{$user->name}}" >
                    @error('name')
                        <div class="invalid-feedback text-red-500">
                            {{$message}}
                        </div>
                    @enderror
                    <h1 class="text-sky-900 text-xl my-2"> Email </h1>
                    <input type="email" class="w-full border-2 p-4 my-2 @error('email')
                        is-invalid
                    @enderror" name="email" value = "{{$user->email}}" >
                    @error('email')
                        <div class="invalid-feedback text-red-500">
                            {{$message}}
                        </div>
                    @enderror
                    <h1 class="text-sky-900 text-xl my-2"> Kategori UMKM </h1>
                    <select type= "text" name="kategori" class="w-full border-2 p-4 my-2">
                        <option selected value=" {{$umkm->kategori_umkm}} ">{{$umkm->kategori}} </option>
                        @foreach ($kategori as $k )
                            <option  value=" {{$k->id}} ">{{$k->nama_kategori}} </option>

                        @endforeach
                    </select>
                    <h1 class="text-sky-900 text-xl my-2"> Nomor Telepon </h1>
                    <div class="flex items-center border-2  rounded p-2 w-full my-2">
                        <div class="text-xl mr-2">
                            <p>+62</p>
                        </div>
                        <input type="tel" name="phone" id="phone" class="w-full rounded border-2" value=" {{$user->phone_number}} ">
                    </div>
                    <h1 class="text-sky-900 text-xl my-2"> Deskripsi Singkat </h1>
                    <input type="text" name="short_desc" class="w-full border-2 p-4 my-2 @error('short_desc')
                        is-invalid
                    @enderror" value=" {{$umkm->short_desc}} ">
                    @error('short_desc')
                        <div class="invalid-feedback text-red-500">
                            {{$message}}
                        </div>
                    @enderror
                    <div class="flex bg-gray-100 justify-center">
                        <button class="w-1/4 bg-yellow-300 rounded py-2 px-4 hover:font-bold" type="submit"> Update Profile </button>

                    </div>

                </form>
                <div id="dis-2" class="flex bg-gray-100 justify-center mt-2">
                    <button onclick="cancelEdit()" id="cancelbtn"  class="w-1/4 bg-red-400 rounded mx-4 py-2 px-4 hover:font-bold">  Cancel </button>
                </div>
            </div>
            <div id="dis-3" class="flex-col">
                <h1 class="text-sky-900 text-xl my-2"> Logo UMKM </h1>
                <div class="w-48  px-2">
                    @if (str_starts_with($umkm->logo, 'https'))
                        <img src= "{{$umkm->logo}}"  alt="logo" class="shadow rounded-full max-w-full h-auto align-middle border-none" />

                        @else
                        <img src= "{{asset('storage/'. $umkm->logo)}}"  alt="logo" class="shadow rounded-full max-w-full h-auto align-middle border-none" />

                    @endif
                </div>
                <h1 class="text-sky-900 text-xl my-2"> Nomor Telepon </h1>
                <div class="flex justify-start w-48">
                    <div class="flex border-2 divide-x-2 divide-stone-500 rounded p-2 w-full my-2">
                        <div class="text-xl mr-2">
                            <p>+62</p>
                        </div>
                        <div>
                            <p class="text-xl ml-2"> {{$user->phone_number}} </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="dis-1" class="flex bg-gray-100 justify-center">
            <button onclick="enableEdit()" id="editbtn"  class="w-1/4 bg-yellow-300 rounded-md mt-2 py-2 px-4 hover:font-bold">  Edit </button>
        </div>
    </div>
    <script>
        function enableEdit(){
            $("#cnt1").attr("style", "display:none");
            $("#cnt2").attr("style", "display:inline");
            $("#dis-1").attr("style", "display:none");
            $("#dis-3").attr("style", "display:none");
        }
        function cancelEdit(){
            $("#cnt1").attr("style", "display:inline");
            $("#cnt2").attr("style", "display:none");
            $("#dis-1").attr("style", "display:flex");
            $("#dis-3").attr("style", "display:inline")
        }
    </script>
@endsection
