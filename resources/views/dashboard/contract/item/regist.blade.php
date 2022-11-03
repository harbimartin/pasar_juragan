@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'juragan_angkutan_id' => ['name' => 'Juragan Angkutan', 'type' => 'Select', 'val' => ['provider_name'], 'api' => 'angkutan', 'full' => true],
            'juragan_barang_id' => ['name' => 'Juragan Barang', 'type' => 'Select', 'val' => ['comp_name'], 'api' => 'barang', 'full' => true],
            'contract_no' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'contract_date' => ['name' => 'Tanggal Kontrak', 'type' => 'Date', 'full' => true],
            'contract_expired' => ['name' => 'Tanggal Expired', 'type' => 'Date', 'full' => true],
            'file' => ['name' => 'Upload Lampiran', 'type' => 'Upload', 'accept' => 'application/pdf', 'key' => 'file', 'folder' => 'file_contract', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="contract_regist" :column="$column" title="Tambah Kontrak" :select="$select" idk="id">
    </x-add>
@endsection
