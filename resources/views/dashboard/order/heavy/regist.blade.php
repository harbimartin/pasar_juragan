@extends('dashboard._index')
@section('content')
    @php
        $column = [
            't_he_contract_id' => ['name' => 'Kontrak', 'type' => 'TextSel', 'val' => ['contract_no', 'contract_desc'], 'desc' => ['contract_desc'], 'share' => ['contract_desc' => 0, 'contract_date' => 0, 'contract_expired' => 0], 'api' => 'contract', 'full' => true],
            'contract_desc' => ['key' => 't_he_contract_id', 'val' => 'contract_desc', 'name' => 'Deskripsi Kontrak', 'type' => 'RefArea', 'full' => true],
            'contract_date' => ['key' => 't_he_contract_id', 'val' => 'contract_date', 'name' => 'Tanggal Kontrak', 'type' => 'Reference', 'full' => true],
            'contract_expired' => ['key' => 't_he_contract_id', 'val' => 'contract_expired', 'name' => 'Tgl Kadaluarsa Kontrak', 'type' => 'Reference', 'full' => true],
            // 'heo_no' => ['name' => 'No.', 'type' => 'String', 'full' => true],
            'heo_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
            'heo_date' => ['name' => 'Tgl Order', 'type' => 'Date', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="contract_regist" :column="$column" title="Tambah Pesanan Alat Berat" :select="$select" idk="id">
    </x-add>
@endsection
