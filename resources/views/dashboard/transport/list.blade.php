@extends('dashboard._index')
@section('content')
    <?php
    $table_angkutan = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'identity' => [
            'name' => 'Plate Nomor',
            'type' => 'Multi',
            'children' => [
                // 'plate_no' => ['name' => 'Nama', 'type' => 'String'],
                'type' => ['name' => 'Type', 'type' => 'SString','child' => ['truck_type']],
            ],
        ],
        'place' => [
            'name' => 'STNK No/KIR No',
            'type' => 'Multi',
            'children' => [
                'stnk_no' => ['name' => 'Nama', 'type' => 'String','iclass' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'kir_no' => ['name' => 'Nama', 'type' => 'String'],
            ],
        ],
        'attribute' => [
            'name' => 'Expired KIR/STNK',
            'type' => 'Multi',
            'children' => [
                'expired_kir' => ['name' => 'Nama', 'type' => 'String','iclass' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'expired_stnk' => ['name' => 'Nama', 'type' => 'String'],
            ],
        ],
        // 'tdg' => [
        //     'name' => 'TDG',
        //     'type' => 'Multi',
        //     'children' => [
        //         'tdg_no' => ['name' => 'TDG', 'type' => 'String', 'sub' => 'no'],
        //         'tdg_date' => ['name' => 'TDG', 'type' => 'Date', 'sub' => 'date'],
        //         'tdg_expired_date' => ['name' => 'TDG', 'type' => 'Date', 'sub' => 'exp'],
        //     ],
        // ],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'route' => 'dashboard.transport.list', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_angkutan" :datas="$data" :prop="$prop" :selfilter="$sel_filter">
    </x-table>
@endsection
