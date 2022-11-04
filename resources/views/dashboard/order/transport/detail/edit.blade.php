@extends('dashboard._index')
@section('content')
    @php
        $column_detail = [
            't_truck_contract_detail_id' => ['name' => 'Tariff', 'type' => 'TextSel', 'val' => ['truck_type_desc', 'commodity_name'], 'desc' => ['origin_name', 'destination_name'], 'share' => ['origin_name' => 0, 'destination_name' => 0, 'price_per_ton' => 0, 'price_per_rit' => 0, 'minimum_ton' => 0], 'api' => 'tariff', 'full' => true],
            'origin_name' => ['key' => 't_truck_contract_detail_id', 'val' => 'origin_name', 'name' => 'Asal', 'type' => 'Reference', 'full' => false],
            'origin_destination_name' => ['key' => 't_truck_contract_detail_id', 'val' => 'destination_name', 'name' => 'Tujuan', 'type' => 'Reference', 'full' => false],
            'price_per_ton' => ['key' => 't_truck_contract_detail_id', 'val' => 'price_per_ton', 'name' => 'Harga Per Ton', 'type' => 'Reference', 'full' => false],
            'price_per_rit' => ['key' => 't_truck_contract_detail_id', 'val' => 'price_per_rit', 'name' => 'Harga Per Rit', 'type' => 'Reference', 'full' => false],
            'minimum_ton' => ['key' => 't_truck_contract_detail_id', 'val' => 'minimum_ton', 'name' => 'Minimum Tonase', 'type' => 'Reference', 'full' => false],
            'picking_date' => ['name' => 'Tgl. Barang Diambil', 'type' => 'Date', 'full' => true],
            'm_loading_address_id' => ['name' => 'Alamat Diambil', 'type' => 'TextSel', 'val' => ['name'], 'desc' => ['address'], 'share' => ['address' => 0], 'api' => 'loading', 'full' => true],
            'due_date' => ['name' => 'Target Tgl. Sampai', 'type' => 'Date', 'full' => true],
            'm_unloading_address_id' => ['name' => 'Alamat Penerima', 'type' => 'TextSel', 'val' => ['name'], 'desc' => ['address'], 'share' => ['address' => 0], 'api' => 'unloading', 'full' => true],
            'tonage' => ['name' => 'Tonase', 'type' => 'Number', 'step' => '0.01', 'full' => true],
        ];
        $column_detail = json_encode($column_detail);
    @endphp
    <x-update unique="address" :column="$column_detail" title="Address" :data="$data" idk="id" :select="$select">
    </x-update>
@endsection
