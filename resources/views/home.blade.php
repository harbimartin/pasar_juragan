@extends('index')
@section('content')
    <section class="bg-white">
        <div class="grid py-8 px-4 mx-auto max-w-screen-xl lg:gap-8 xl:gap-0 lg:py-28 lg:grid-cols-12 h-screenq">
            <div class="place-self-center mr-auto lg:col-span-7">
                <h1 class="mb-4 max-w-2xl text-4xl font-extrabold leading-none md:text-5xl xl:text-6xl">Platform untuk
                    Pelayanan Logistik Perusahaan</h1>
                <p class="mb-6 max-w-2xl font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">Dari penyimpanan, checkout,
                    pengiriman internasional mempercayai Juragan sebagai ahlinya.</p>
                <a href="#"
                    class="inline-flex justify-center items-center py-3 px-5 mr-3 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                    Mulai Sekarang
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="#"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
                    Kontak Sales
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="https://media.istockphoto.com/photos/world-map-with-logistic-network-distribution-logistic-and-transport-picture-id1025834892"
                    alt="mockup">
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-32">
            <!-- <h2 class="mb-4 text-3xl font-extrabold tracking-tight leading-tight text-center text-gray-900 lg:mb-8 md:text-4xl">Produk Kami</h2>
                            <h2 class="text-gray-500 mb-8 text-xl font-semibold tracking-tight leading-tight text-center text-gray-900 lg:mb-16 md:text-2xl">Berikut kegunaan produk kami sebagai solusi dari semua kebutuhan bisnis Anda</h2> -->
            <div class="grid grid-cols-3 gap-8 text-gray-500 sm:gap-12 md:grid-cols-4 lg:grid-cols-4">
                <div class="justify-center text-center">
                    <svg class="mx-auto" height="46" viewBox="0 0 46 46" aria-hidden="true" tabindex="-1"
                        title="home">
                        <path
                            d="M10.807 45.247h30.168c2.514 0 4.525-2.026 4.525-4.557V19.93c0-2.278-1.006-4.303-2.765-5.57L25.64 1.45c-1.509-1.266-3.771-1.266-5.28 0L3.265 14.36C1.505 15.628.5 17.653.5 19.93v21.013c0 2.532 2.011 4.557 4.525 4.557h5.782v-.253Zm3.771-3.798v-6.582h6.537v6.582h-6.537Zm10.559 0v-6.582h6.536v6.582h-6.536Zm6.536-10.38h-6.536v-6.582h6.536v6.583ZM4.271 40.944V19.93c0-1.012.503-2.025 1.257-2.531L22.623 4.487c.251 0 .251-.253.503-.253.251 0 .251 0 .502.253L40.724 17.4c.754.506 1.256 1.519 1.256 2.531v21.013c0 .506-.25.76-.754.76h-5.782V23.727c0-1.772-1.508-3.038-3.017-3.038h-8.044c-1.76 0-3.268 1.266-3.268 3.038v7.342h-7.04c-1.76 0-3.016 1.519-3.016 3.038v7.341H5.025c-.503 0-.754-.253-.754-.506Z">
                        </path>
                    </svg>
                    <div class="text-gray-600 font-extrabold text-3xl pb-4 pt-7">
                        0
                    </div>
                    <div class="lg:text-lg font-semibold text-center">
                        Gudang Tersedia
                    </div>
                </div>
                <div class="justify-center text-center">
                    <svg class="mx-auto" height="46" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-truck" viewBox="0 0 16 16">
                        <path
                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                    <div class="text-gray-600 font-extrabold text-3xl pb-4 pt-7">
                        0
                    </div>
                    <div class="lg:text-lg font-semibold text-center">
                        Angkutan Terdaftar
                    </div>
                </div>
                <div class="justify-center text-center">
                    <svg class="mx-auto" height="46" viewBox="0 0 50 40" aria-hidden="true" tabindex="-1"
                        title="forklift" class="jsx-3823162721 jsx-1567859774">
                        <path
                            d="M47.761 32.201h-7.96c-.498 0-.746-.251-.746-.755V2.014c0-1.007-.746-2.013-1.99-2.013s-1.99.755-1.99 2.013v25.911h-1.493v-.251c0-2.264-1.741-4.025-3.731-4.025l-.995-.252L23.88 5.031C23.134 2.013 20.398 0 17.413 0H8.706C6.22 0 4.23 2.013 4.23 4.528v14.843H3.98c-2.239 0-3.98 1.761-3.98 4.025v8.805c0 2.264 1.741 4.025 3.98 4.025h.746C5.473 38.24 7.463 40 9.95 40c2.488 0 4.478-1.51 5.473-3.774h3.234C19.403 38.491 21.642 40 24.129 40c2.488 0 4.478-1.51 5.473-3.774h.249c2.239 0 3.98-1.76 3.98-4.025v-.251h1.492c0 2.515 1.99 4.528 4.478 4.528h8.209c.995 0 1.99-.755 1.99-2.013a2.242 2.242 0 0 0-2.239-2.264ZM8.706 3.774h8.707c1.492 0 2.736 1.006 3.234 2.515l4.477 16.604L7.96 19.874V4.528c0-.503.498-.754.746-.754ZM9.95 36.226c-.995 0-1.99-1.006-1.99-2.012S8.955 32.2 9.95 32.2s1.99 1.007 1.99 2.013-.746 2.012-1.99 2.012Zm13.93 0c-.994 0-1.99-1.006-1.99-2.012s.996-2.013 1.99-2.013c.996 0 1.99 1.007 1.99 2.013s-.994 2.012-1.99 2.012Zm6.22-4.276c0 .251-.25.251-.25.251h-.745c-.747-2.264-2.986-3.773-5.473-3.773-2.488 0-4.229 1.76-5.224 3.773h-2.985c-.746-2.012-2.985-3.773-5.473-3.773-2.487 0-4.477 1.76-5.224 3.773H3.98c-.249 0-.249-.251-.249-.251v-8.554c0-.251 0-.251.25-.251l25.621 4.276h.249c.248 0 .248.252.248.252v4.277Z">
                        </path>
                    </svg>
                    <div class="text-gray-600 font-extrabold text-3xl pb-4 pt-7">
                        0
                    </div>
                    <div class="lg:text-lg font-semibold text-center">
                        Alat Berat Terdaftar
                    </div>
                </div>
                <div class="justify-center text-center">
                    <svg class="mx-auto" height="46" viewBox="0 0 40 46" aria-hidden="true" tabindex="-1" title="avatar"
                        class="jsx-1803565313 jsx-1567859774">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M20.25 22.378c-6 0-11-4.972-11-10.939S14.25.5 20.25.5s11 4.972 11 10.94c0 5.966-5 10.938-11 10.938Zm7-10.939c0-3.978-3.25-7.21-7.25-7.21s-7.25 3.232-7.25 7.21c0 3.978 3.25 7.21 7.25 7.21s7.25-3.232 7.25-7.21ZM0 37.792c0-1.988 1-3.977 2.5-5.22 4.75-4.227 11-6.465 17.5-6.216 6.5 0 12.75 2.238 17.5 6.216 1.5 1.491 2.5 3.232 2.5 5.22v3.233c0 2.486-2 4.475-4.5 4.475h-31C2 45.5 0 43.51 0 41.025v-3.233Zm36.25 3.233v-3.233c0-.994-.5-1.74-1.25-2.486-4-3.48-9.25-5.47-15-5.47s-11 1.99-15 5.47c-.75.746-1.25 1.492-1.25 2.486v3.233c0 .497.25.745.75.745h31c.5 0 .75-.248.75-.745Z">
                        </path>
                    </svg>
                    <div class="text-gray-600 font-extrabold text-3xl pb-4 pt-7">
                        0
                    </div>
                    <div class="lg:text-lg font-semibold text-center">
                        Pelanggan Telah Dilayani
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-50">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-28">
            <h2
                class="mb-4 text-3xl font-extrabold tracking-tight leading-tight text-center text-gray-900 lg:mb-8 md:text-4xl">
                Produk Kami</h2>
            <h2
                class="text-gray-500 mb-8 text-xl font-semibold tracking-tight leading-tight text-center text-gray-900 lg:mb-16 md:text-2xl">
                Berikut kegunaan produk kami sebagai solusi dari semua kebutuhan bisnis Anda</h2>
            <div class="grid grid-cols-3 gap-8 text-gray-500 sm:gap-8 md:grid-cols-4 lg:grid-cols-4">
                <div class="bg-white shadow-lg group cursor-pointer flex flex-col">
                    <div class="px-8 pt-4 flex-grow">
                        <svg class="mx-auto py-6" width="48" viewBox="0 0 48 48" aria-hidden="true" tabindex="-1"
                            title="shipper" class="jsx-2497349149 jsx-1567859774">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.239 5.143h23.643c.596 0 1.055.55.964 1.144l-.368 2.289H14.291l3.076-3.067c.23-.229.55-.366.872-.366ZM41.33 15.441H7.45l3.397-3.433h31.034l-.551 3.433ZM7.45 18.828l3.397 3.433H33.71l-3.443-3.433H7.45Zm29.657 6.866 3.443 3.432H17.734l-3.443-3.433h22.816ZM6.12 35.992h31.034l3.443-3.433H6.67l-.551 3.433Zm.045 6.865c-.643 0-1.102-.595-1.01-1.19l.367-2.242H33.71l-3.076 3.066c-.23.23-.551.366-.872.366H6.165Z">
                            </path>
                        </svg>
                        <div class="lg:text-xl font-semibold text-center text-gray-600">
                            Transportation
                            Marketplace
                        </div>
                        <div class="py-4">
                            Cepat, mudah, dan fleksibel. Temukan tarif terendah dan kirimkan semua produk Anda dalam
                            sekejap.
                        </div>
                    </div>
                    <div class="py-4 group-hover:bg-gray-200 transition px-8">
                        Lihat Detail Produk
                    </div>
                </div>
                <div class="bg-white shadow-lg group cursor-pointer flex flex-col">
                    <div class="px-8 pt-4 flex-grow">
                        <svg class="mx-auto py-6" width="48" viewBox="0 0 48 48" aria-hidden="true" tabindex="-1"
                            title="shipper" class="jsx-2497349149 jsx-1567859774">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.239 5.143h23.643c.596 0 1.055.55.964 1.144l-.368 2.289H14.291l3.076-3.067c.23-.229.55-.366.872-.366ZM41.33 15.441H7.45l3.397-3.433h31.034l-.551 3.433ZM7.45 18.828l3.397 3.433H33.71l-3.443-3.433H7.45Zm29.657 6.866 3.443 3.432H17.734l-3.443-3.433h22.816ZM6.12 35.992h31.034l3.443-3.433H6.67l-.551 3.433Zm.045 6.865c-.643 0-1.102-.595-1.01-1.19l.367-2.242H33.71l-3.076 3.066c-.23.23-.551.366-.872.366H6.165Z">
                            </path>
                        </svg>
                        <div class="lg:text-xl font-semibold text-center text-gray-600">
                            Warehouse<br>
                            Marketplace
                        </div>
                        <div class="py-4">
                            Kami menyediakan rangkaian solusi pergudangan yang lengkap dan sesuai untuk semua kebutuhan
                            bisnis Anda.
                        </div>
                    </div>
                    <div class="py-4 group-hover:bg-gray-200 transition px-8">
                        Lihat Detail Produk
                    </div>
                </div>
                <div class="bg-white shadow-lg group cursor-pointer flex flex-col">
                    <div class="px-8 pt-4 flex-grow">
                        <svg class="mx-auto py-6" width="48" viewBox="0 0 48 48" aria-hidden="true" tabindex="-1"
                            title="international" class="jsx-2388836653 jsx-1567859774">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M26.15 6.055C16.447 6.055 8.584 14.089 8.584 24c0 5.041 2.035 9.597 5.311 12.857 1.822-1.366 3.908-3.052 6.283-5.106a1.267 1.267 0 0 1 1.811.155c.459.553.391 1.382-.15 1.85a124.708 124.708 0 0 1-5.916 4.836 17.237 17.237 0 0 0 10.226 3.353c9.702 0 17.566-8.034 17.566-17.945 0-.725.576-1.313 1.285-1.313.71 0 1.286.588 1.286 1.313 0 11.361-9.016 20.571-20.137 20.571-4.683 0-8.992-1.633-12.413-4.372-1.78 1.258-3.31 2.203-4.615 2.875-1.48.762-2.752 1.219-3.817 1.338-1.072.12-2.153-.09-2.88-.952-.685-.813-.776-1.886-.675-2.813.104-.96.438-2.024.907-3.104.94-2.158 2.527-4.614 4.45-6.84A20.945 20.945 0 0 1 6.013 24c0-11.361 9.015-20.571 20.136-20.571 2.742 0 5.36.56 7.746 1.577.655.279.964 1.048.691 1.717a1.276 1.276 0 0 1-1.68.707 17.188 17.188 0 0 0-6.756-1.375ZM8.235 33.404c-1.414 1.783-2.543 3.625-3.23 5.206-.411.943-.638 1.733-.702 2.327-.068.626.065.805.068.809l.009.007a.274.274 0 0 0 .07.03c.09.026.268.053.573.019.625-.07 1.58-.372 2.94-1.073 1.064-.548 2.325-1.314 3.8-2.334a20.626 20.626 0 0 1-3.528-4.991Zm14.378-18.223c-1.107-.902-1.067-2.634.08-3.483l.893-.66a2.946 2.946 0 0 1 2.97-.32l8.117 3.66 2.233-1.65a8.348 8.348 0 0 1 5.083-1.643l.142.002c1.372.019 2.488 1.135 2.537 2.536a4.166 4.166 0 0 1-1.672 3.495l-14.99 11.084a3.716 3.716 0 0 1-3.829.367l-6.053-2.909c-1.121-.54-1.265-2.11-.261-2.852l1.08-.799a4.64 4.64 0 0 1 3.253-.888l2.12.226a2.109 2.109 0 0 0 1.479-.404l2.037-1.506-5.219-4.256Zm2.044-1.693 5.923 4.83a1.508 1.508 0 0 1-.055 2.369l-3.223 2.384a4.64 4.64 0 0 1-3.253.888l-2.12-.226a2.104 2.104 0 0 0-1.247.254l4.59 2.205c.399.192.869.147 1.227-.117L41.49 14.99a1.52 1.52 0 0 0 .61-1.274v-.002h-.002v-.002h-.002l-.141-.002a5.816 5.816 0 0 0-3.541 1.145l-2.819 2.084c-.377.28-.871.332-1.298.14l-8.778-3.96a.42.42 0 0 0-.424.047l-.437.322Z">
                            </path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M26.15 6.055C16.447 6.055 8.584 14.089 8.584 24c0 5.041 2.035 9.597 5.311 12.857 1.822-1.366 3.908-3.052 6.283-5.106a1.267 1.267 0 0 1 1.811.155c.459.553.391 1.382-.15 1.85a124.708 124.708 0 0 1-5.916 4.836 17.237 17.237 0 0 0 10.226 3.353c9.702 0 17.566-8.034 17.566-17.945 0-.725.576-1.313 1.285-1.313.71 0 1.286.588 1.286 1.313 0 11.361-9.016 20.571-20.137 20.571-4.683 0-8.992-1.633-12.413-4.372-1.78 1.258-3.31 2.203-4.615 2.875-1.48.762-2.752 1.219-3.817 1.338-1.072.12-2.153-.09-2.88-.952-.685-.813-.776-1.886-.675-2.813.104-.96.438-2.024.907-3.104.94-2.158 2.527-4.614 4.45-6.84A20.945 20.945 0 0 1 6.013 24c0-11.361 9.015-20.571 20.136-20.571 2.742 0 5.36.56 7.746 1.577.655.279.964 1.048.691 1.717a1.276 1.276 0 0 1-1.68.707 17.188 17.188 0 0 0-6.756-1.375ZM8.235 33.404c-1.414 1.783-2.543 3.625-3.23 5.206-.411.943-.638 1.733-.702 2.327-.068.626.065.805.068.809l.009.007a.274.274 0 0 0 .07.03c.09.026.268.053.573.019.625-.07 1.58-.372 2.94-1.073 1.064-.548 2.325-1.314 3.8-2.334a20.626 20.626 0 0 1-3.528-4.991Zm14.378-18.223c-1.107-.902-1.067-2.634.08-3.483l.893-.66a2.946 2.946 0 0 1 2.97-.32l8.117 3.66 2.233-1.65a8.348 8.348 0 0 1 5.083-1.643l.142.002c1.372.019 2.488 1.135 2.537 2.536a4.166 4.166 0 0 1-1.672 3.495l-14.99 11.084a3.716 3.716 0 0 1-3.829.367l-6.053-2.909c-1.121-.54-1.265-2.11-.261-2.852l1.08-.799a4.64 4.64 0 0 1 3.253-.888l2.12.226a2.109 2.109 0 0 0 1.479-.404l2.037-1.506-5.219-4.256Zm2.044-1.693 5.923 4.83a1.508 1.508 0 0 1-.055 2.369l-3.223 2.384a4.64 4.64 0 0 1-3.253.888l-2.12-.226a2.104 2.104 0 0 0-1.247.254l4.59 2.205c.399.192.869.147 1.227-.117L41.49 14.99a1.52 1.52 0 0 0 .61-1.274v-.002h-.002v-.002h-.002l-.141-.002a5.816 5.816 0 0 0-3.541 1.145l-2.819 2.084c-.377.28-.871.332-1.298.14l-8.778-3.96a.42.42 0 0 0-.424.047l-.437.322Z">
                            </path>
                        </svg>
                        <div class="lg:text-xl font-semibold text-center text-gray-600">
                            Trace
                            &
                            Track<br>&nbsp;
                        </div>
                        <div class="py-4">
                            Semua proses dan riwayat anda tetap terekam dan dapat dicek kapanpun dan dimanapun.
                        </div>
                    </div>
                    <div class="py-4 group-hover:bg-gray-200 transition px-8">
                        Lihat Detail Produk
                    </div>
                </div>
                <div class="bg-white shadow-lg group cursor-pointer flex flex-col">
                    <div class="px-8 pt-4 flex-grow">
                        <svg class="mx-auto py-6" width="48" viewBox="0 0 48 48" aria-hidden="true" tabindex="-1"
                            title="international" class="jsx-2388836653 jsx-1567859774">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M26.15 6.055C16.447 6.055 8.584 14.089 8.584 24c0 5.041 2.035 9.597 5.311 12.857 1.822-1.366 3.908-3.052 6.283-5.106a1.267 1.267 0 0 1 1.811.155c.459.553.391 1.382-.15 1.85a124.708 124.708 0 0 1-5.916 4.836 17.237 17.237 0 0 0 10.226 3.353c9.702 0 17.566-8.034 17.566-17.945 0-.725.576-1.313 1.285-1.313.71 0 1.286.588 1.286 1.313 0 11.361-9.016 20.571-20.137 20.571-4.683 0-8.992-1.633-12.413-4.372-1.78 1.258-3.31 2.203-4.615 2.875-1.48.762-2.752 1.219-3.817 1.338-1.072.12-2.153-.09-2.88-.952-.685-.813-.776-1.886-.675-2.813.104-.96.438-2.024.907-3.104.94-2.158 2.527-4.614 4.45-6.84A20.945 20.945 0 0 1 6.013 24c0-11.361 9.015-20.571 20.136-20.571 2.742 0 5.36.56 7.746 1.577.655.279.964 1.048.691 1.717a1.276 1.276 0 0 1-1.68.707 17.188 17.188 0 0 0-6.756-1.375ZM8.235 33.404c-1.414 1.783-2.543 3.625-3.23 5.206-.411.943-.638 1.733-.702 2.327-.068.626.065.805.068.809l.009.007a.274.274 0 0 0 .07.03c.09.026.268.053.573.019.625-.07 1.58-.372 2.94-1.073 1.064-.548 2.325-1.314 3.8-2.334a20.626 20.626 0 0 1-3.528-4.991Zm14.378-18.223c-1.107-.902-1.067-2.634.08-3.483l.893-.66a2.946 2.946 0 0 1 2.97-.32l8.117 3.66 2.233-1.65a8.348 8.348 0 0 1 5.083-1.643l.142.002c1.372.019 2.488 1.135 2.537 2.536a4.166 4.166 0 0 1-1.672 3.495l-14.99 11.084a3.716 3.716 0 0 1-3.829.367l-6.053-2.909c-1.121-.54-1.265-2.11-.261-2.852l1.08-.799a4.64 4.64 0 0 1 3.253-.888l2.12.226a2.109 2.109 0 0 0 1.479-.404l2.037-1.506-5.219-4.256Zm2.044-1.693 5.923 4.83a1.508 1.508 0 0 1-.055 2.369l-3.223 2.384a4.64 4.64 0 0 1-3.253.888l-2.12-.226a2.104 2.104 0 0 0-1.247.254l4.59 2.205c.399.192.869.147 1.227-.117L41.49 14.99a1.52 1.52 0 0 0 .61-1.274v-.002h-.002v-.002h-.002l-.141-.002a5.816 5.816 0 0 0-3.541 1.145l-2.819 2.084c-.377.28-.871.332-1.298.14l-8.778-3.96a.42.42 0 0 0-.424.047l-.437.322Z">
                            </path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M26.15 6.055C16.447 6.055 8.584 14.089 8.584 24c0 5.041 2.035 9.597 5.311 12.857 1.822-1.366 3.908-3.052 6.283-5.106a1.267 1.267 0 0 1 1.811.155c.459.553.391 1.382-.15 1.85a124.708 124.708 0 0 1-5.916 4.836 17.237 17.237 0 0 0 10.226 3.353c9.702 0 17.566-8.034 17.566-17.945 0-.725.576-1.313 1.285-1.313.71 0 1.286.588 1.286 1.313 0 11.361-9.016 20.571-20.137 20.571-4.683 0-8.992-1.633-12.413-4.372-1.78 1.258-3.31 2.203-4.615 2.875-1.48.762-2.752 1.219-3.817 1.338-1.072.12-2.153-.09-2.88-.952-.685-.813-.776-1.886-.675-2.813.104-.96.438-2.024.907-3.104.94-2.158 2.527-4.614 4.45-6.84A20.945 20.945 0 0 1 6.013 24c0-11.361 9.015-20.571 20.136-20.571 2.742 0 5.36.56 7.746 1.577.655.279.964 1.048.691 1.717a1.276 1.276 0 0 1-1.68.707 17.188 17.188 0 0 0-6.756-1.375ZM8.235 33.404c-1.414 1.783-2.543 3.625-3.23 5.206-.411.943-.638 1.733-.702 2.327-.068.626.065.805.068.809l.009.007a.274.274 0 0 0 .07.03c.09.026.268.053.573.019.625-.07 1.58-.372 2.94-1.073 1.064-.548 2.325-1.314 3.8-2.334a20.626 20.626 0 0 1-3.528-4.991Zm14.378-18.223c-1.107-.902-1.067-2.634.08-3.483l.893-.66a2.946 2.946 0 0 1 2.97-.32l8.117 3.66 2.233-1.65a8.348 8.348 0 0 1 5.083-1.643l.142.002c1.372.019 2.488 1.135 2.537 2.536a4.166 4.166 0 0 1-1.672 3.495l-14.99 11.084a3.716 3.716 0 0 1-3.829.367l-6.053-2.909c-1.121-.54-1.265-2.11-.261-2.852l1.08-.799a4.64 4.64 0 0 1 3.253-.888l2.12.226a2.109 2.109 0 0 0 1.479-.404l2.037-1.506-5.219-4.256Zm2.044-1.693 5.923 4.83a1.508 1.508 0 0 1-.055 2.369l-3.223 2.384a4.64 4.64 0 0 1-3.253.888l-2.12-.226a2.104 2.104 0 0 0-1.247.254l4.59 2.205c.399.192.869.147 1.227-.117L41.49 14.99a1.52 1.52 0 0 0 .61-1.274v-.002h-.002v-.002h-.002l-.141-.002a5.816 5.816 0 0 0-3.541 1.145l-2.819 2.084c-.377.28-.871.332-1.298.14l-8.778-3.96a.42.42 0 0 0-.424.047l-.437.322Z">
                            </path>
                        </svg>
                        <div class="lg:text-xl font-semibold text-center text-gray-600">
                            Heavy Equipment Marketplace
                        </div>
                        <div class="py-4">
                            Semua proses dan riwayat anda tetap terekam dan dapat dicek kapanpun dan dimanapun.
                        </div>
                    </div>
                    <div class="py-4 group-hover:bg-gray-200 transition px-8">
                        Lihat Detail Produk
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="bg-gray-50">
                        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                            <div class="mb-8 max-w-screen-md lg:mb-16">
                                <h2 class="mb-4 text-4xl font-extrabold text-gray-900">Designed for business teams like yours</h2>
                                <p class="text-gray-500 sm:text-xl">Here at Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive economic growth.</p>
                            </div>
                            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                                <div>
                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-100 lg:h-12 lg:w-12">
                                        <svg class="w-5 h-5 text-blue-600 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <h3 class="mb-2 text-xl font-bold">Marketing</h3>
                                    <p class="text-gray-500">Plan it, create it, launch it. Collaborate seamlessly with all  the organization and hit your marketing goals every month with our marketing plan.</p>
                                </div>
                                <div>
                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-100 lg:h-12 lg:w-12">
                                        <svg class="w-5 h-5 text-blue-600 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path></svg>
                                    </div>
                                    <h3 class="mb-2 text-xl font-bold">Legal</h3>
                                    <p class="text-gray-500">Protect your organization, devices and stay compliant with our structured workflows and custom permissions made for you.</p>
                                </div>
                                <div>
                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-100 lg:h-12 lg:w-12">
                                        <svg class="w-5 h-5 text-blue-600 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"></path><path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"></path></svg>
                                    </div>
                                    <h3 class="mb-2 text-xl font-bold">Business Automation</h3>
                                    <p class="text-gray-500">Auto-assign tasks, send Slack messages, and much more. Now power up with hundreds of new templates to help you get started.</p>
                                </div>
                                <div>
                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-100 lg:h-12 lg:w-12">
                                        <svg class="w-5 h-5 text-blue-600 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <h3 class="mb-2 text-xl font-bold">Finance</h3>
                                    <p class="text-gray-500">Audit-proof software built for critical financial operations like month-end close and quarterly budgeting.</p>
                                </div>
                                <div>
                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-100 lg:h-12 lg:w-12">
                                        <svg class="w-5 h-5 text-blue-600 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                                    </div>
                                    <h3 class="mb-2 text-xl font-bold">Enterprise Design</h3>
                                    <p class="text-gray-500">Craft beautiful, delightful experiences for both marketing and product with real cross-company collaboration.</p>
                                </div>
                                <div>
                                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-blue-100 lg:h-12 lg:w-12">
                                        <svg class="w-5 h-5 text-blue-600 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
                                    </div>
                                    <h3 class="mb-2 text-xl font-bold">Operations</h3>
                                    <p class="text-gray-500">Keep your company’s lights on with customizable, iterative, and structured workflows built for all efficient teams and individual.</p>
                                </div>
                            </div>
                        </div>
                      </section> -->

    <!-- <section class="bg-white">
                        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
                            <div class="font-light text-gray-500 sm:text-lg">
                                <h2 class="mb-4 text-4xl font-extrabold text-gray-900">We didn't reinvent the wheel</h2>
                                <p class="mb-4">We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need. Small enough to be simple and quick, but big enough to deliver the scope you want at the pace you need.</p>
                                <p>We are strategists, designers and developers. Innovators and problem solvers. Small enough to be simple and quick.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-8">
                                <img class="w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-2.png" alt="office content 1">
                                <img class="mt-4 w-full rounded-lg lg:mt-10" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-1.png" alt="office content 2">
                            </div>
                        </div>
                    </section> -->

    <!-- <section class="bg-gray-50">
                        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                            <div class="max-w-screen-lg text-gray-500 sm:text-lg">
                                <h2 class="mb-4 text-4xl font-bold text-gray-900">Powering innovation at <span class="font-extrabold">200,000+</span> companies worldwide</h2>
                                <p class="mb-4 font-light">Track work across the enterprise through an open, collaborative platform. Link issues across Jira and ingest data from other software development tools, so your IT support and operations teams have richer contextual information to rapidly respond to requests, incidents, and changes.</p>
                                <p class="mb-4 font-medium">Deliver great service experiences fast - without the complexity of traditional ITSM solutions.Accelerate critical development work, eliminate toil, and deploy changes with ease.</p>
                                <a href="#" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-800">
                                    Learn more
                                    <svg class="ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                </a>
                            </div>
                        </div>
                      </section> -->

    <section class="bg-white">
        <div class="py-12 px-4 mx-auto max-w-screen-xl sm:py-24 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h2 class="mb-4 text-4xl font-extrabold leading-tight text-gray-900">Daftar Sekarang, Gratis!</h2>
                <p class="mb-6 text-gray-500 md:text-lg">Gunakan Fitur Juragan untuk memulai. Tanpa persyaratan Kartu
                    Kredit.</p>
                <a href="{{ route('register') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Daftar
                    Akun Baru</a>
                <p class="mt-12 text-gray-500 md:text-md">Sudah punya Akun ?
                    <a href="{{ route('login') }}" class="underline font-medium py-2.5 mr-2 mb-2 hover:text-blue-800">Log
                        in.</a>
                </p>
            </div>
        </div>
    </section>
@endsection
