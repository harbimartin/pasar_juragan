<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juragan Tanah</title>
    <meta name="description"
        content="Get started with a free landing page built with Tailwind CSS and the Flowbite Blocks system.">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input.hide-ico::-webkit-calendar-picker-indicator {
            display: none !important;
        }

        .bg-sky-500 {
            background-color: rgb(14 165 233);
        }

        .hover\:bg-sky-600:hover {
            background-color: rgb(2 132 199);
        }

        .hshow {
            display: block !important;
        }

        .loader {
            border: 4px solid #e0f2ff;
            /* Light grey */
            border-top: 3px solid #66abd8;
            /* Blue */
            border-radius: 90%;
            width: 25px;
            height: 25px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .chat {
            /* background-color:currentColor; */
            transition: background-color .25s;
        }

        .minimize {
            visibility: hidden;
            max-width: 0px;
        }

        @media (min-width: 768px) {
            .max-w-90 {
                max-width: 90vw;
            }

            .fw-nav {
                min-width: 14rem;
                max-width: 14rem;
            }

            .group:hover .group-hover\:ml-2 {
                margin-left: 0.5rem
                    /* 8px */
                ;
            }

            .group:hover .group-hover\:maxim {
                visibility: visible;
                transition: max-width .75s;
                max-width: 1000px;
                /* display: block; */
            }
        }

        .thidden {
            transition: max-height .5s;
            transition-timing-function: cubic-bezier(0.075, 0.82, 0.165, 1);
            max-height: 0px;
            overflow: hidden;
        }

        .thidden.block {
            transition: .5s;
            max-height: 400px;
        }

        input+label {
            filter: grayscale(80%);
        }

        input+label:hover {
            background-color: #edf8ff;
            filter: grayscale(40%);
            cursor: pointer;
        }

        input:checked+label {
            filter: none;
            font-weight: 500;
            color: black;
        }

        input:checked+label>span {
            display: block;
        }
    </style>
</head>

<body>
    <section id="vue-menu" class="fixed navigation w-full md:max-h-screen md:border-gray-300 overflow-auto"
        style="width:15vw;">
        <div class="md:hidden block">
            <div class="flex justify-end py-2 px-2">
                <img src="{{ url('/assets/menu.svg') }}" alt="menu">
            </div>
        </div>
        <div class="md:block top-0 left-0 bottom-0 right-0">
            <div class="avatar inline-flex md:block md:text-center md:my-5 md:mb-5 px-3">
                <img src="{{ url('/assets/avatar.svg') }}" class="rounded-full mr-4 md:mx-auto bg-black" alt="avatar"
                    width="96" height="96">
                <?php
                $username = Auth::guard('admin')->user()->username_name;
                $nik = Auth::guard('admin')->user()->username_position;
                ?>
                <div class="my-auto md:my-2">
                    <h6 class="font-semibold">{{ $username }}</h6>
                    <h6 class="">{{ $nik }}</h6>
                </div>
            </div>
            <a href="{{ route('admin.home') }}">
                <div
                    class="inline-flex w-full px-3 py-2.5 cursor-pointer {{ isset($on) && $on == 'home' ? 'bg-blue-100 hover:bg-blue-200' : 'hover:bg-gray-100 ' }}">
                    <img class="h-5 w-5 my-auto" src="{{ url('/assets/home.svg') }}">
                    <p class="my-auto ml-3 text-sm font-semibold">Home</p>
                </div>
            </a>

            @php
                $menus = MenuAdmin::getMenu();
            @endphp
            @foreach ($menus as $imenu => $menu)
                <x-sub-menu :menu="$menu" :level="'tmenu'" :index="$imenu">
                </x-sub-menu>
            @endforeach
            <a href="{{ route('admin.logout') }}">
                <div class="inline-flex w-full px-3 py-2.5 cursor-pointer hover:bg-gray-100">
                    <img class="h-5 w-5 my-auto" src="{{ url('/assets/logout.svg') }}">
                    <p class="my-auto ml-3 text-sm font-semibold">Logout</p>
                </div>
            </a>
        </div>
    </section>
    <div id="vue-app" class="absolute bg-gray-100 min-h-screen" style="width:85vw; right:0px;">
        @yield('content')
    </div>
</body>
@extends('components.vue')

</html>
