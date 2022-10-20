@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_business_category_id' => ['name' => 'Kategori Bisnis', 'type' => 'Select', 'val' => ['business_category'], 'api' => 'business_category', 'full' => true],
            'wh_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'wh_npwp' => ['name' => 'NPWP', 'type' => 'String', 'full' => true],
            'wh_website' => ['name' => 'Website', 'type' => 'String', 'full' => true],
            'file_logo' => ['name' => 'Upload Logo', 'type' => 'Upload', 'accept' => 'image/*', 'key' => 'file', 'folder' => 'comp_logo', 'mono' => true, 'full' => true],
            'wh_logo' => ['name' => 'Logo', 'type' => 'Image', 'folder' => 'file_logo'],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="profile_company" :column="$column" title="Profil Perusahaan" :data="$data" burl="none"
        :select="$select" idk="id">
    </x-update>

    <ul class="list-reset flex border-b px-2 md:px-6 mt-3 md:mt-5 text-xs md:text-base">
        <li class="mr-1">
            <a class="rounded-md bg-white inline-block py-2 px-4 font-semibold {{ $tab == 'address' ? 'bg-blue-400 text-white' : '' }}"
                href="{{ route('dashboard.company-profile.address') }}">Address</a>
        </li>
        <li class="mr-1">
            <a class="rounded-md bg-white inline-block py-2 px-4 font-semibold {{ $tab == 'contact' ? 'bg-blue-400 text-white' : '' }}"
                href="{{ route('dashboard.company-profile.contact') }}">Contact</a>
        </li>
    </ul>

    @yield('tab-content')
@endsection
