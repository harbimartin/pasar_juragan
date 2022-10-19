@extends('dashboard._index')
@section('content')
    @php
        // nama perusahaan
        // npwp
        // website perusahaan
        // logo perusahaan
        // kategori usaha
        // bidang usaha
        $column = [
            'comp_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'comp_npwp' => ['name' => 'NPWP', 'type' => 'String', 'full' => true, 'lock' => true],
            'comp_website' => ['name' => 'Website', 'type' => 'String', 'full' => true],
            'm_business_category_id' => ['name' => 'Kategori Bisnis', 'type' => 'Select', 'val' => ['business_category'], 'api' => 'business_category', 'full' => true],
            'comp_logo' => ['name' => 'Logo', 'type' => 'Image', 'folder' => 'file_logo'],
            'file_logo' => ['name' => 'Upload Logo', 'type' => 'Upload', 'accept' => 'image/*', 'key' => 'file', 'folder' => 'comp_logo', 'mono' => true, 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="profile_user" :column="$column" title="Profil Perusahaan" :data="$data" burl="none"
        :select="$select" idk="id">
    </x-update>
@endsection
