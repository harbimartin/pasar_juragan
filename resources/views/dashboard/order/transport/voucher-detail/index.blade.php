@extends('dashboard.order.transport.voucher.show', ['tab' => 'detail'])
@section('tab-content')
    @php
        $column_detail = [
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

    <x-add unique="detail" :column="$column_detail" title="Tambah Rincian Pesanan Truk (Barang)" :select="$select" idk="id">
    </x-add>

    <?php
    $table_detail = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        // 'voucher' => [
        //     'name' => 'Trip',
        //     'type' => 'Multi',
        //     'children' => [
        //         'plate_no' => ['by' => 'voucher', 'name' => 'Asal', 'type' => 'CString', 'child' => ['plate_no'], 'sub' => 'No. Plat', 'sclass' => 'mr-auto'],
        //         'driver_name' => ['by' => 'voucher', 'name' => 'Tujuan', 'type' => 'CString', 'child' => ['driver_name'], 'sub' => 'Sopir', 'sclass' => 'mr-auto'],
        //     ],
        // ],
        'plan' => [
            'name' => 'Trip',
            'type' => 'Multi',
            'children' => [
                'origin' => ['by' => 'order_detail_rpt', 'name' => 'Asal', 'type' => 'CString', 'child' => ['origin_name'], 'sub' => 'Asal', 'sclass' => 'mr-auto'],
                'destination_name' => ['by' => 'order_detail_rpt', 'name' => 'Tujuan', 'type' => 'CString', 'child' => ['destination_name'], 'sub' => 'Tujuan', 'sclass' => 'mr-auto'],
            ],
        ],
        'truck_type' => ['by' => 'order_detail_rpt', 'name' => 'Tipe Truk', 'type' => 'SString', 'child' => ['truck_type_desc']],
        'commodity' => ['by' => 'order_detail_rpt', 'name' => 'Barang', 'type' => 'SString', 'child' => ['commodity_name']],
        'cargo_code' => ['name' => 'Kode Kargo', 'type' => 'String'],
        'tonnage' => ['name' => 'Tonase', 'type' => 'Number', 'step' => '0.01', 'align' => 'center'],
        'pcs' => ['name' => 'Pcs', 'type' => 'Number', 'step' => '0.01', 'align' => 'center'],
        'delete' => ['name' => 'Action', 'type' => 'Delete', 'align' => 'center', 'sort' => false],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_detail" :datas="$list" :prop="$prop">
    </x-table>
@endsection
