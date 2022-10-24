<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasar Juragan</title>
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
            max-height: 350px;
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
            background-color: #f5fbff;
            filter: none;
            font-weight: 500;
        }

        input:checked+label>span {
            display: block;
        }
    </style>
</head>

<body>
    {{-- <header>
        <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="{{ route('home') }}" class="flex items-center">
                    <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" /> -->
                    <span class="self-center text-2xl font-semibold whitespace-nowrap">Pasar Juragan</span>
                </a>
                <div class="flex items-center lg:order-2">
                    @if (Auth::guard('user')->user())
                        <a href="#"
                            class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none">{{ Auth::guard('user')->user()->username_name }}</a>
                        <a href="{{ route('dashboard.home') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none">Menuju
                            Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none">Log
                            in</a>
                        <a href="{{ route('register') }}"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 focus:outline-none">Daftar</a>
                    @endif
                    <button data-collapse-toggle="mobile-menu-2" type="button"
                        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <a href="{{ route('home') }}"
                                class="block py-2 pr-4 pl-3 text-white rounded bg-blue-700 lg:bg-transparent lg:text-blue-700 lg:p-0"
                                aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0">Company</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0">Marketplace</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0">Features</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0">Team</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-700 lg:p-0">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header> --}}

    <section id="vue-menu" class="fixed h-screen navigation w-full md:h-screen md:max-h-screen md:border-gray-300"
        style="width:15vw;">
        {{-- < class=" md:border-r fw-nav"> --}}
        <div class="md:hidden block">
            <div class="flex justify-end py-2 px-2">
                <img src="{{ url('/assets/menu.svg') }}" alt="menu">
            </div>
        </div>
        <div class="md:block top-0 left-0 bottom-0 right-0" hidden>
            <div class="avatar inline-flex md:block md:text-center md:my-5 md:mb-5 px-3">
                <img src="{{ url('/assets/avatar.svg') }}" class="rounded-full mr-4 md:mx-auto bg-black" alt="avatar"
                    width="96" height="96">
                <?php
                $username = Auth::guard('user')->user()->username_name;
                $nik = Auth::guard('user')->user()->username_position;
                ?>
                <div class="my-auto md:my-2">
                    <h6 class="font-semibold">{{ $username }}</h6>
                    <h6 class="">{{ $nik }}</h6>
                </div>
            </div>
            <a href="{{ route('dashboard.home') }}">
                <div
                    class="inline-flex w-full px-3 py-2.5 cursor-pointer {{ Routing::getCurrentRouteName() == 'dashboard.home' ? 'bg-blue-100 hover:bg-blue-200' : 'hover:bg-gray-100 ' }}">
                    <img class="h-5 w-5 my-auto" src="{{ url('/assets/home.svg') }}">
                    <p class="my-auto ml-3 text-sm font-semibold">Home</p>
                </div>
            </a>

            @php
                $menus = Menu::getMenu();
            @endphp
            @foreach ($menus as $imenu => $menu)
                <x-sub-menu :menu="$menu" :level="'tmenu'" :index="$imenu">
                </x-sub-menu>
            @endforeach
            <a href="{{ route('logout') }}">
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
