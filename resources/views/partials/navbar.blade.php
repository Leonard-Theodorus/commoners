<nav class="bg-sky-800 px-12 py-1 top-0 w-full flex items-center justify-evenly">
    <div class="flex">
        <a href="{{route('home')}}"> <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Latin_small_letter_reversed_C_with_dot.svg/643px-Latin_small_letter_reversed_C_with_dot.svg.png" class="w-8 h-8" alt="Logo"></a>
    </div>
    @auth
        <div class="space x-4 p-1 flex items-center ">
            @can('umkm')
                <a href="{{route('inbox')}}" class="text-white hover:font-bold duration-200">Inbox UMKM</a>
            @endcan
            @cannot('umkm')
                @cannot('admin')
                    <a href="{{route('application')}}" class="ml-2 text-white hover:font-bold duration-200"> Lamaran </a>
                @endcannot
            @endcannot
            @can('umkm')
                <li class="ml-2 relative inline-block">
                    <button id="dropdownBtn" onclick="myFunction1()" class="py-1 px-2 border rounded-md text-white hover:font-bold duration-200 active:font-bold flex items-center" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><span class="mr-2">Iklan</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/> </svg></button>
                    <ul id="myDropdown1" class="w-48 absolute flex flex-col bg-white rounded shadow-md mt-2 hidden">
                        <li><a class="px-4 py-2 block font-semibold text-gray-700 hover:bg-sky-700 hover:text-white" href=" {{route('viewiklan')}} ">Lihat Iklan</a></li>
                        <li><a class="px-4 py-2 block font-semibold text-gray-700 hover:bg-sky-700 hover:text-white" href=" {{route('newiklanpage')}} ">Buat Iklan Baru</a></li>
                    </ul>
                </li>

            @endcan
            @can('admin')
                <li class="ml-2 relative inline-block">
                    <button id="dropdownBtn" onclick="myFunction2()" class="py-1 px-2 border rounded-md text-white hover:font-bold duration-200 active:font-bold flex items-center" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><span class="mr-2">Manage Iklan</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/> </svg></button>
                    <ul id="myDropdown2" class="w-48 absolute flex flex-col bg-white rounded shadow-md mt-2 hidden">
                        <li><a class="px-4 py-2 block font-semibold text-gray-700 hover:bg-sky-700 hover:text-white" href=" {{route('viewiklanadmin')}} ">Manage Iklan UMKM</a></li>
                        <li><a class="px-4 py-2 block font-semibold text-gray-700 hover:bg-sky-700 hover:text-white" href=" {{route('managebidang')}} ">Manage Bidang</a></li>
                    </ul>
                </li>
            @endcan
        </div>
        <button class="py-1 rounded-md hover:font-bold duration-200"> <a href= {{route('profile')}} class="text-white"> {{auth()->user()->name}} </a> </button>
        <form action={{route('logout')}} method="post">
            @csrf
            <button type="submit" class="text-white pl-3 hover:font-bold duration-200">Logout</button>
        </form>
        @else
        <div class="space-x-4 p-3  place-self-end ">
            <button class="py-1 px-2 border rounded-md hover:font-bold"><a href= {{route('login')}} class="text-white">Login</a></button>
            <li class="relative inline-block">
                <button id="dropdownBtn" onclick="myFunction()" class="py-1 px-2 border rounded-md text-white hover:font-bold active:font-bold flex items-center" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><span class="mr-2">Register</span><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/> </svg></button>
                <ul id="myDropdown" class="w-48 absolute flex flex-col bg-white rounded shadow-md mt-2 hidden">
                    <li><a class="px-4 py-2 block font-semibold text-gray-700 hover:bg-sky-700 hover:text-white" href={{route('register_umkm')}}>Register Sebagai UMKM</a></li>
                    <li><a class="px-4 py-2 block font-semibold text-gray-700 hover:bg-sky-700 hover:text-white" href= {{route('register_jobseeker') }}>Register Sebagai Pelamar</a></li>
                </ul>
            </li>
        </div>

    @endauth
</nav>

<script>
    function myFunction() {
        if(document.getElementById("myDropdown").classList.contains("hidden")){
            document.getElementById("myDropdown").classList.remove("hidden");
        } else {
            document.getElementById("myDropdown").classList.add("hidden");
        }
    }
    function myFunction1() {
        if(document.getElementById("myDropdown1").classList.contains("hidden")){
            document.getElementById("myDropdown1").classList.remove("hidden");
        } else {
            document.getElementById("myDropdown1").classList.add("hidden");
        }
    }
    function myFunction2() {
        if(document.getElementById("myDropdown2").classList.contains("hidden")){
            document.getElementById("myDropdown2").classList.remove("hidden");
        } else {
            document.getElementById("myDropdown2").classList.add("hidden");
        }
    }
</script>
