@extends('admin._auth_index')
@section('content')
    <section>
        <div class="grid mx-auto max-w-screen-xl lg:gap-8 xl:gap-0 w-1/2">
            <form class="bg-white place-self-center mr-auto w-full px-20 shadow py-20 rounded-lg" method="POST"
                action="{{ request()->fullUrl() }}">
                @csrf
                <h1 class="mb-4 max-w-2xl text-4xl font-bold leading-none md:text-5xl xl:text-4xl border-b border-gray-700">
                    Register</h1>
                <div class="flex-col gap-1">
                    <x-error-box></x-error-box>
                    {{-- <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="comp_name">
                            Nama Perusahaan
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="comp_name" name="comp_name" type="text" placeholder="Nama Perusahaan...">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="m_business_category_id">
                            Kategori Bisnis
                        </label>
                        <select
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="m_business_category_id" name="m_business_category_id">
                            <option selected disabled>-- Pilih Kategori Bisnis --</option>
                            @foreach ($select['business_category'] as $option)
                                <option value="{{ $option->id }}">{{ $option->business_category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="comp_npwp">
                            NPWP Perusahaan
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="comp_npwp" name="comp_npwp" type="text" placeholder="NPWP Perusahaan...">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="comp_address_detail">
                            Alamat Perusahaan
                        </label>
                        <textarea
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="comp_address_detail" name="comp_address_detail" placeholder="Alamat Perusahaan..." rows="4"></textarea>
                    </div> --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username_name">
                            Nama Admin
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="username_name" name="username_name" type="text" placeholder="Nama...">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username_position">
                            Jabatan Admin
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="username_position" name="username_position" type="text" placeholder="Jabatan...">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username_mail">
                            Email Admin
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="username_mail" name="username_mail" type="text" placeholder="Email...">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username_phone">
                            No. Hp Admin
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="username_phone" name="username_phone" type="text" placeholder="No. Handphone...">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="password" type="password" name="password">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="repassword">
                            Konfirmasi Password
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="repassword" type="password" name="repassword">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="md:flex md:items-center">
                            <label class="block text-gray-500 font-semibold">
                                <input class="mr-2 leading-tight" type="checkbox">
                                <span class="text-sm">
                                    Saya setuju dengan <a href="{{ url('/syarat-ketentuan') }}" target="_blank"
                                        class="cursor-pointer text-sky-700 hover:text-sky-900 underline">syarat dan
                                        ketentuan</a> yang berlaku.
                                </span>
                            </label>
                        </div>
                        <button
                            class="bg-sky-500 hover:bg-sky-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline text-lg"
                            type="submit">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
