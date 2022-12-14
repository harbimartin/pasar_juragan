@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_business_category_id' => ['name' => 'Kategori Bisnis', 'type' => 'Select', 'val' => ['business_category'], 'api' => 'business_category', 'def' => $data->m_business_category_id, 'full' => true],
            'provider_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true, 'def' => $data->comp_name],
            'provider_npwp' => ['name' => 'NPWP', 'type' => 'String', 'full' => true, 'def' => $data->comp_npwp],
            'provider_website' => ['name' => 'Website', 'type' => 'String', 'full' => true, 'def' => $data->comp_website],
            'file_logo' => ['name' => 'Upload Logo', 'type' => 'Upload', 'accept' => 'image/*', 'key' => 'file', 'folder' => 'comp_logo', 'mono' => true, 'full' => true],
            'comp_logo' => ['name' => 'Logo', 'type' => 'Image', 'module' => 'company', 'def' => $data->comp_logo],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="gudang_regist" :column="$column" title="Tambah Juragan {{$module}}" :select="$select" idk="id">
    </x-add>
@endsection
