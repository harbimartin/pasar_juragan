@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'name' => ['name' => 'Nama Gudang', 'type' => 'String', 'full' => true],
            'address' => ['name' => 'Alamat Gudang', 'type' => 'TextArea', 'full' => true],
            'province' => ['name' => 'Provinsi', 'type' => 'Select', 'val' => ['nama'], 'api' => 'province', 'full' => false],
            'city' => ['name' => 'Kota', 'type' => 'Select', 'val' => ['nama'], 'api' => 'city', 'full' => false],
            'longitude' => ['name' => 'Latitude', 'type' => 'String', 'full' => false],
            'latitude' => ['name' => 'Longitude', 'type' => 'String', 'full' => false],
            'no_tdg' => ['name' => 'No TDG', 'type' => 'String', 'full' => false],
            'tgl_tdg' => ['name' => 'Tanggal TDG', 'type' => 'Date', 'full' => false],
            'exp_tdg' => ['name' => 'Expired TDG', 'type' => 'Date', 'full' => false],
            'file_tdg' => ['name' => 'Upload TDG', 'type' => 'Upload', 'accept' => 'pdf/*', 'key' => 'file', 'folder' => 'tdg', 'mono' => true, 'full' => false],
            'day_open' => ['name' => 'Hari Buka', 'type' => 'Select', 'val' => ['nama'], 'api' => 'days', 'full' => false],
            'time_open' => ['name' => 'Jam Buka', 'type' => 'Time', 'full' => false],
            'w_type' => ['name' => 'Jenis Gudang', 'type' => 'Select', 'val' => ['nama'], 'api' => 'warehouse_type', 'full' => false],
            'w_func' => ['name' => 'Fungsi Gudang', 'type' => 'Select', 'val' => ['nama'], 'api' => 'warehouse_func', 'full' => false],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="gudang_add" :column="$column" title="Buat Gudang" :select="$select" idk="id">
    </x-add>
@endsection
