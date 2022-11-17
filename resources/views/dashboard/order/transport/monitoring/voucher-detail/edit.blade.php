@extends('dashboard._index')
@section('content')
    @php
        $column_detail = [
            't_truck_order_detail_id' => $detail ? ['by' => 'order_detail_rpt', 'name' => 'Pesanan', 'type' => 'SString', 'child' => ['commodity_name', 'truck_type_name']] : ['name' => 'Pesanan', 'type' => 'TextSel', 'val' => ['commodity_name', 'truck_type_desc'], 'desc' => ['origin_name', 'destination_name'], 'share' => ['tonage' => 0, 'origin_name' => 0, 'destination_name' => 0], 'api' => 'order', 'full' => true],
            'origin_name' => $detail ? ['by' => 'order_detail_rpt', 'name' => 'Asal', 'type' => 'SString'] : ['key' => 't_truck_order_detail_id', 'val' => 'origin_name', 'name' => 'Asal', 'type' => 'Reference'],
            'destination_name' => $detail ? ['by' => 'order_detail_rpt', 'name' => 'Tujuan', 'type' => 'SString'] : ['key' => 't_truck_order_detail_id', 'val' => 'destination_name', 'name' => 'Tujuan', 'type' => 'Reference'],
            'tonage' => $detail ? ['by' => 'order_detail_rpt', 'name' => 'Tonase Total (Pesanan)', 'type' => 'SString'] : ['key' => 't_truck_order_detail_id', 'val' => 'tonage', 'name' => 'Tonase Total (Pesanan)', 'type' => 'Reference'],
            'cargo_code' => ['name' => 'Kode Kargo', 'type' => 'String'],
            'tonnage' => ['name' => 'Tonase', 'type' => 'Number', 'step' => '0.01'],
            'pcs' => ['name' => 'Pcs', 'type' => 'Number', 'step' => '0.01'],
            'notes' => ['name' => 'Catatan', 'type' => 'TextArea', 'full' => true],
        ];
        $column_detail = json_encode($column_detail);
    @endphp

    <x-update unique="detail" :column="$column_detail" :data="$data" title="Update Rincian Pesanan Truk (Barang)"
        :select="$select" idk="id" detail="detail">
    </x-update>
@endsection
