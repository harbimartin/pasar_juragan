@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'to_desc' => ['name' => 'Deskripsi Order', 'type' => 'TextArea', 'full' => true],
            't_truck_contract_id' => ['name' => 'Kontrak', 'type' => 'TextSel', 'val' => ['contract_no', 'contract_desc'], 'desc' => ['contract_desc'], 'share' => ['contract_desc' => 0, 'contract_date' => 0, 'contract_expired' => 0], 'api' => 'contract', 'full' => true],
            'contract_desc' => ['key' => 't_truck_contract_id', 'val' => 'contract_desc', 'name' => 'Deskripsi Kontrak', 'type' => 'RefArea', 'full' => true],
            'contract_date' => ['key' => 't_truck_contract_id', 'val' => 'contract_date', 'name' => 'Tanggal Kontrak', 'type' => 'Reference', 'full' => true],
            'contract_expired' => ['key' => 't_truck_contract_id', 'val' => 'contract_expired', 'name' => 'Tgl Kadaluarsa Kontrak', 'type' => 'Reference', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="contract_regist" :column="$column" title="Tambah Pesanan Angkutan" :select="$select" idk="id">
    </x-add>
@endsection
