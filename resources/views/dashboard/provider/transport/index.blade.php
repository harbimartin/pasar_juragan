@extends('dashboard.provider.index', ['tab' => 'transport'])
@section('tab-content')
    <?php
    $table_transport = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'identity' => [
            'name' => 'Plate Nomor/Type Truck',
            'type' => 'Multi',
            'children' => [
                'plate_no' => ['name' => 'Nama', 'type' => 'String', 'class' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'type' => ['name' => 'Type', 'type' => 'SString', 'child' => ['truck_type']],
            ],
        ],
        'place' => [
            'name' => 'STNK No/KIR No',
            'type' => 'Multi',
            'children' => [
                'stnk_no' => ['name' => 'Nama', 'type' => 'String', 'class' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'kir_no' => ['name' => 'Nama', 'type' => 'String'],
            ],
        ],
        'attribute' => [
            'name' => 'Expired KIR/STNK',
            'type' => 'Multi',
            'children' => [
                'expired_kir' => ['name' => 'Nama', 'type' => 'String', 'class' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'expired_stnk' => ['name' => 'Nama', 'type' => 'String'],
            ],
        ],
        'act' => ['name' => 'Action', 'type' => 'Show', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_transport" :datas="$transports" :selfilter="$sel_filter" :lim="false">
    </x-table>
@endsection
