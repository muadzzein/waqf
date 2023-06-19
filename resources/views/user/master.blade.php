<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donor Home Page</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="{{asset('https://use.fontawesome.com/releases/v5.3.1/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css')}}"/> <!--Replace with your tailwind.css once created-->
    <link href="{{asset('https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet')}}"> <!--Totally optional :) -->
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js')}}" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>

</head>

<body class="bg-black font-sans leading-normal tracking-normal mt-12">

@yield('admin')


<main>

    <div class="flex flex-col md:flex-row">
        <nav aria-label="alternative nav">
            <div class="bg-black shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center">

                <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                    <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                        <li class="mr-3 flex-1">
                            <a href="{{route('trustee.list')}}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                                <i class="fa fa-handshake pr-0 md:pr-3 text-yellow-400"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Trustees</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{route('faraid.index')}}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-blue-600">
                                <i class="fas fa-calculator pr-0 md:pr-3 text-yellow-400"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">Calculator</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{route('chat')}}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-blue-600">
                                <i class="fas fa-calculator pr-0 md:pr-3 text-yellow-400"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">Chat with us</span>
                            </a>
                        </li>
                    </ul>
                </div>


            </div>
        </nav>
        <section>
                <div class="bg-black pt-3">
                    <div class="rounded-tl-3xl bg-gradient-to-r from-yellow-400 to-gray-800 p-4 shadow text-2xl text-white">
                        <h1 class="font-bold pl-2">KIWF Management System</h1>
                    </div>
                </div>

                @if(Session::has('error'))
                    <div class="alert alert-success" role="alert" >
                        <div>
                            {{ session::get('error')}}
                        </div>
                    </div>
                @endif
                <div class="alert alert-info" role="alert">
                    Welcome, {{ user()->name }}
                </div>


                <div class="w-full md:w-1/2 xl:w-1/2 p-6">
                    <div class="bg-white border-transparent rounded-lg shadow-xl">
                        <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                            <h2 class="font-bold uppercase text-gray-600">Donors</h2>
                        </div>
                        <div class="p-5">
                            <table class="w-full p-5 text-gray-700">
                                <thead>
                                <tr>
                                    <th class="text-left text-blue-900">User ID</th>
                                    <th class="text-left text-blue-900">Name</th>
                                    <th class="text-left text-blue-900">Email</th>
                                </tr>
                                </thead>
                                @foreach($user as $item)
                                    <tbody>
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>

                            <!-- <p class="py-2"><a href="#">See More issues...</a></p> -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>




<script>
    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
        var input, filter, ul, li, a, i;
        input = document.getElementById(myDropMenuSearch);
        filter = input.value.toUpperCase();
        div = document.getElementById(myDropMenu);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
            var dropdowns = document.getElementsByClassName("dropdownlist");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('invisible')) {
                    openDropdown.classList.add('invisible');
                }
            }
        }
    }
</script>


</body>

</html>

<?php
