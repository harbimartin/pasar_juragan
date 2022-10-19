@extends('admin._auth_index')
@section('content')
    <section class="bg-white">
        <div class="grid mx-auto max-w-screen-xl lg:gap-8 xl:gap-0 lg:py-4 lg:grid-cols-2 h-screen overflow-hidden">
            <form class="place-self-center mr-auto w-full px-20" method="POST" action="{{ request()->fullUrl() }}">
                @csrf
                <h1 class="mb-4 max-w-2xl text-4xl font-bold leading-none md:text-5xl xl:text-4xl border-b border-gray-700">
                    Login Juragan Tanah</h1>
                <div class="flex flex-col gap-1">
                    <x-error-box></x-error-box>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username_mail">
                            Email
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="username_mail" name="username_mail" type="text" placeholder="email...">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="password" type="password" name="password" placeholder="Password...">
                    </div>
                    <div class="flex items-center justify-between">
                        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                            href="#">
                            Forgot Password?
                        </a>
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Sign In
                        </button>
                    </div>
                </div>
                <div class="py-20 text-center">
                    Tidak Punya Akun?
                    <a href="#" class="cursor-pointer hover:text-blue-700 underline">Hubungi Tim Teknis.</a>
                </div>
            </form>
            <div class="hidden lg:flex w-screen relative flex">
                <img src="https://t3.ftcdn.net/jpg/03/13/73/56/360_F_313735618_kFi8yhrwHlUt4dfpGR1O017ZLjcIVw96.jpg"
                    alt="mockup">
                <div class="text-white absolute top-1/3 px-20 bg-black bg-opacity-50 py-6">
                    <div class="text-4xl font-semibold pb-2 border-b">
                        Juragan Tanah
                    </div>
                    <div class="text-xl font-light">
                        Kegiatan proses logistik di tangan anda.
                    </div>
                </div>
            </div>
    </section>
@endsection
