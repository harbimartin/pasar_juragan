@extends('dashboard._index')
@section('content')
    @php
        $column_detail = [
            'm_origin_id' => ['name' => 'Asal', 'type' => 'TextSel', 'val' => ['origin_name', 'origin_desc'], 'desc' => [], 'api' => 'origin', 'full' => false],
            'm_destination_id' => ['name' => 'Tujuan', 'type' => 'TextSel', 'val' => ['destination_name', 'destination_desc'], 'desc' => [], 'api' => 'destination', 'full' => false],
            'm_truck_type_id' => ['name' => 'Tipe Truk', 'type' => 'TextSel', 'val' => ['truck_type'], 'desc' => [], 'api' => 'truck_type', 'full' => false],
            'm_commodity_id' => ['name' => 'Barang', 'type' => 'TextSel', 'val' => ['commodity_name', 'commodity_desc'], 'desc' => [], 'api' => 'commodity', 'full' => false],
            'price_per_ton' => ['name' => 'Harga Per Ton', 'type' => 'Number', 'step' => '0.01', 'full' => true],
            'price_per_rit' => ['name' => 'Harga Per Rit', 'type' => 'Number', 'step' => '0.01', 'full' => true],
            'minimum_ton' => ['name' => 'Minimum Tonase', 'type' => 'Number', 'step' => '0.01', 'full' => true],
        ];
        $column_detail = json_encode($column_detail);
    @endphp
    <x-update unique="address" :column="$column_detail" title="Address" :data="$data" idk="id" :select="$select">
    </x-update>
@endsection
