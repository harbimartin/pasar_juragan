@extends('dashboard._index')
@section('content')
    @php
        $column_detail = [
            't_truck_order_voucher_id' => ['name' => 'Angkutan', 'type' => 'TextSel', 'val' => ['plate_no', 'driver_name'], 'desc' => [], 'api' => 'voucher', 'full' => true],
            't_truck_order_detail_id' => ['name' => 'Pesanan', 'type' => 'TextSel', 'val' => ['commodity_name', 'truck_type_desc'], 'desc' => ['origin_name', 'destination_name'], 'share' => ['tonage' => 0, 'origin_name' => 0, 'destination_name' => 0], 'api' => 'order', 'full' => true],
            'origin_name' => ['key' => 't_truck_order_detail_id', 'val' => 'origin_name', 'name' => 'Asal', 'type' => 'Reference', 'full' => true],
            'destination_name' => ['key' => 't_truck_order_detail_id', 'val' => 'destination_name', 'name' => 'Tujuan', 'type' => 'Reference', 'full' => true],
            'tonage' => ['key' => 't_truck_order_detail_id', 'val' => 'tonage', 'name' => 'Tonase Total (Pesanan)', 'type' => 'Reference', 'full' => true],
            'cargo_code' => ['name' => 'Kode Kargo', 'type' => 'String', 'full' => true],
            'tonnage' => ['name' => 'Tonase', 'type' => 'Number', 'step' => '0.01', 'full' => true],
            'pcs' => ['name' => 'Pcs', 'type' => 'Number', 'step' => '0.01', 'full' => true],
            'notes' => ['name' => 'Catatan', 'type' => 'TextArea', 'full' => true],
        ];
        $column_detail = json_encode($column_detail);
    @endphp

    <x-update unique="detail" :column="$column_detail" :data="$data" title="Update Rincian Pesanan Truk (Barang)"
        :select="$select" idk="id">
    </x-update>
@endsection
