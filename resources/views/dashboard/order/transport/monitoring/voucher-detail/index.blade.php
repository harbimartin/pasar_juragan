@extends('dashboard.order.transport.monitoring.show', ['tab' => 'truck'])
@section('tab-content')
    <?php
    $table_detail = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
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
        'act' => ['name' => 'Action', 'type' => 'Show', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_detail" :datas="$list" :prop="$prop">
    </x-table>
@endsection
