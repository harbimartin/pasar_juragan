@extends('dashboard._index')
@section('content')
    <div class="w-full px-4 py-2">
        <div class="bg-gray-400 mb-2 text-center font-extrabold text-4xl flex justify-center align-middle"
            style="height:360px;">
            <div>
                Sliding Banner
            </div>
        </div>
        <div class="flex justify-center">
            <div class="rounded-full bg-gray-400 w-3 h-3 mx-2 cursor-pointer"></div>
            <div class="rounded-full bg-gray-400 w-3 h-3 mx-2 cursor-pointer"></div>
            <div class="rounded-full bg-gray-400 w-3 h-3 mx-2 cursor-pointer"></div>
        </div>
    </div>
    <section>
        <div class="py-8 px-4 mx-auto max-w-screen-xl py-12">
            <!-- <h2 class="mb-4 text-3xl font-extrabold tracking-tight leading-tight text-center text-gray-900 lg:mb-8 md:text-4xl">Produk Kami</h2>
                                                                                                                    <h2 class="text-gray-500 mb-8 text-xl font-semibold tracking-tight leading-tight text-center text-gray-900 lg:mb-16 md:text-2xl">Berikut kegunaan produk kami sebagai solusi dari semua kebutuhan bisnis Anda</h2> -->
            <div class="grid grid-cols-3 gap-8 text-gray-500 sm:gap-12">
                <a href="{{ route('dashboard.home.warehouse') }}"
                    class="justify-center text-center hover:bg-blue-50 py-10 shadow rounded-md bg-white cursor-pointer">
                    <svg class="mx-auto" height="46" viewBox="0 0 46 46" aria-hidden="true" tabindex="-1"
                        title="home">
                        <path
                            d="M10.807 45.247h30.168c2.514 0 4.525-2.026 4.525-4.557V19.93c0-2.278-1.006-4.303-2.765-5.57L25.64 1.45c-1.509-1.266-3.771-1.266-5.28 0L3.265 14.36C1.505 15.628.5 17.653.5 19.93v21.013c0 2.532 2.011 4.557 4.525 4.557h5.782v-.253Zm3.771-3.798v-6.582h6.537v6.582h-6.537Zm10.559 0v-6.582h6.536v6.582h-6.536Zm6.536-10.38h-6.536v-6.582h6.536v6.583ZM4.271 40.944V19.93c0-1.012.503-2.025 1.257-2.531L22.623 4.487c.251 0 .251-.253.503-.253.251 0 .251 0 .502.253L40.724 17.4c.754.506 1.256 1.519 1.256 2.531v21.013c0 .506-.25.76-.754.76h-5.782V23.727c0-1.772-1.508-3.038-3.017-3.038h-8.044c-1.76 0-3.268 1.266-3.268 3.038v7.342h-7.04c-1.76 0-3.016 1.519-3.016 3.038v7.341H5.025c-.503 0-.754-.253-.754-.506Z">
                        </path>
                    </svg>
                    <div class="text-gray-600 font-extrabold text-3xl pb-4 pt-7">
                        {{ $total['warehouse'] }}
                    </div>
                    <div class="lg:text-lg font-semibold text-center">
                        Cari Gudang
                    </div>
                </a>
                <a href="{{ route('dashboard.home.transport') }}"
                    class="justify-center text-center hover:bg-blue-50 py-10 shadow rounded-md bg-white cursor-pointer">
                    <svg class="mx-auto" height="46" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-truck" viewBox="0 0 16 16">
                        <path
                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                    <div class="text-gray-600 font-extrabold text-3xl pb-4 pt-7">
                        {{ $total['transport'] }}
                    </div>
                    <div class="lg:text-lg font-semibold text-center">
                        Cari Angkutan
                    </div>
                </a>
                <a href="{{ route('dashboard.home.heavy') }}"
                    class="justify-center text-center hover:bg-blue-50 py-10 shadow rounded-md bg-white cursor-pointer">
                    <svg class="mx-auto" height="46" viewBox="0 0 50 40" aria-hidden="true" tabindex="-1"
                        title="forklift" class="jsx-3823162721 jsx-1567859774">
                        <path
                            d="M47.761 32.201h-7.96c-.498 0-.746-.251-.746-.755V2.014c0-1.007-.746-2.013-1.99-2.013s-1.99.755-1.99 2.013v25.911h-1.493v-.251c0-2.264-1.741-4.025-3.731-4.025l-.995-.252L23.88 5.031C23.134 2.013 20.398 0 17.413 0H8.706C6.22 0 4.23 2.013 4.23 4.528v14.843H3.98c-2.239 0-3.98 1.761-3.98 4.025v8.805c0 2.264 1.741 4.025 3.98 4.025h.746C5.473 38.24 7.463 40 9.95 40c2.488 0 4.478-1.51 5.473-3.774h3.234C19.403 38.491 21.642 40 24.129 40c2.488 0 4.478-1.51 5.473-3.774h.249c2.239 0 3.98-1.76 3.98-4.025v-.251h1.492c0 2.515 1.99 4.528 4.478 4.528h8.209c.995 0 1.99-.755 1.99-2.013a2.242 2.242 0 0 0-2.239-2.264ZM8.706 3.774h8.707c1.492 0 2.736 1.006 3.234 2.515l4.477 16.604L7.96 19.874V4.528c0-.503.498-.754.746-.754ZM9.95 36.226c-.995 0-1.99-1.006-1.99-2.012S8.955 32.2 9.95 32.2s1.99 1.007 1.99 2.013-.746 2.012-1.99 2.012Zm13.93 0c-.994 0-1.99-1.006-1.99-2.012s.996-2.013 1.99-2.013c.996 0 1.99 1.007 1.99 2.013s-.994 2.012-1.99 2.012Zm6.22-4.276c0 .251-.25.251-.25.251h-.745c-.747-2.264-2.986-3.773-5.473-3.773-2.488 0-4.229 1.76-5.224 3.773h-2.985c-.746-2.012-2.985-3.773-5.473-3.773-2.487 0-4.477 1.76-5.224 3.773H3.98c-.249 0-.249-.251-.249-.251v-8.554c0-.251 0-.251.25-.251l25.621 4.276h.249c.248 0 .248.252.248.252v4.277Z">
                        </path>
                    </svg>
                    <div class="text-gray-600 font-extrabold text-3xl pb-4 pt-7">
                        {{ $total['equipment'] }}
                    </div>
                    <div class="lg:text-lg font-semibold text-center">
                        Cari Alat Berat
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection
