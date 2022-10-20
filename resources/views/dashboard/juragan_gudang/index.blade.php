@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_business_category_id' => ['name' => 'Kategori Bisnis', 'type' => 'Select', 'val' => ['business_category'], 'api' => 'business_category', 'full' => true],
            'provider_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'provider_npwp' => ['name' => 'NPWP', 'type' => 'String', 'full' => true],
            'provider_website' => ['name' => 'Website', 'type' => 'String', 'full' => true],
            'file_logo' => ['name' => 'Upload Logo', 'type' => 'Upload', 'accept' => 'image/*', 'key' => 'file', 'folder' => 'comp_logo', 'mono' => true, 'full' => true],
            'provider_logo' => ['name' => 'Logo', 'type' => 'Image', 'folder' => 'file_logo'],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="profile-company" :column="$column" title="Profil Perusahaan" :data="$data" burl="none"
        route="dashboard.juragan-gudang.update" :select="$select" idk="id">
    </x-update>

    <ul class="list-reset flex border-b px-2 md:px-6 mt-3 md:mt-5 text-xs md:text-base">
        <li class="mr-1">
            <a class="rounded-md bg-white inline-block py-2 px-4 font-semibold {{ $tab == 'address' ? 'bg-blue-400 text-white' : '' }}"
                href="{{ route('dashboard.profile-company.address') }}">Address</a>
        </li>
        <li class="mr-1">
            <a class="rounded-md bg-white inline-block py-2 px-4 font-semibold {{ $tab == 'contact' ? 'bg-blue-400 text-white' : '' }}"
                href="{{ route('dashboard.profile-company.contact') }}">Contact</a>
        </li>
    </ul>

    @yield('tab-content')
@endsection
