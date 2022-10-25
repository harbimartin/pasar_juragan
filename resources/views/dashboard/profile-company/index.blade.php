@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'comp_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'comp_npwp' => ['name' => 'NPWP', 'type' => 'String', 'full' => true, 'lock' => true],
            'comp_website' => ['name' => 'Website', 'type' => 'String', 'full' => true],
            'm_business_category_id' => ['name' => 'Kategori Bisnis', 'type' => 'Select', 'val' => ['business_category'], 'api' => 'business_category', 'full' => true],
            'comp_logo' => ['name' => 'Logo', 'type' => 'Image', 'module' => 'company'],
            'file_logo' => ['name' => 'Upload Logo', 'type' => 'Upload', 'accept' => 'image/*', 'key' => 'file', 'folder' => 'comp_logo', 'anonymous' => true, 'mono' => true, 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="profile-company" :column="$column" title="Profil Perusahaan" :data="$data" burl="none"
        route="dashboard.profile-company" :select="$select" idk="id">
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
