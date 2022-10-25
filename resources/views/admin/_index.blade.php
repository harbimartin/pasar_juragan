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
    {{-- <script src="https://unpkg.com/vue/dist/vue.min.js"></script> --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="fixed h-screen navigation w-full md:h-screen md:max-h-screen md:border-gray-300" style="width:15vw;">
        <div class="md:hidden block">
            <div class="flex justify-end py-2 px-2" v-on:click="show = !show">
                <img src="{{ url('/assets/menu.svg') }}" alt="menu">
            </div>
        </div>
        <div class="md:block top-0 left-0 bottom-0 right-0" hidden v-bind:class="{block:show}">
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
