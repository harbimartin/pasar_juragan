@extends('admin._auth_index')
@section('content')
    <section class="bg-white">
        <div class="flex max-w-screen lg:gap-8 xl:gap-0 lg:py-4 lg:grid-cols-2 h-screen">
            <div class="m-auto pb-10 text-center flex flex-col gap-2">
                @if ($success)
                    <div class="text-2xl font-semibold shadow px-10 py-3 rounded-lg">
                        Terimakasih, Aktivasi Email anda telah berhasil.
                    </div>
                    <a href="{{ route('login') }}"
                        class="px-3 py-1 bg-blue-700 hover:bg-blue-800 text-white mx-auto rounded cursor-pointer">Menuju
                        Login
                    </a>
                @else
                    <div class="text-2xl font-semibold shadow px-10 py-3 rounded-lg">
                        Mohon Maaf, Aktivasi Email tidak berhasil!
                    </div>
                    <div class="text-xl font-semibold shadow px-10 py-3 rounded-lg">
                        Silahkan Kirim kembali permintaan Aktivasi Email kembali dengan melakukan Login.
                    </div>
                    <a href="{{ route('login') }}"
                        class="px-3 py-1 bg-blue-700 hover:bg-blue-800 text-white mx-auto rounded cursor-pointer">Menuju
                        Login
                    </a>
                @endif
            </div>
        </div>
    </section>
@endsection
