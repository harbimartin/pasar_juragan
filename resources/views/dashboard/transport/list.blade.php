@extends('dashboard._index')
@section('content')
    <?php
    $table_angkutan = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'identity' => [
            'name' => 'Plate Nomor',
            'type' => 'Multi',
            'children' => [
                'plat_no' => ['name' => 'Nama', 'type' => 'String', 'iclass' => 'text-gray-700 font-semibold border-b border-blue-500'],
            ],
        ],
        // 'place' => [
        //     'name' => 'Plate Nomor',
        //     'type' => 'Multi',
        //     'children' => [
        //         // 'province' => ['name' => 'City', 'type' => 'SString', 'child' => ['province_name']],
        //         'type' => ['name' => 'Type', 'type' => 'SString', 'child' => ['truck_type']],
        //     ],
        // ],
        // 'attribute' => [
        //     'name' => 'Atribut',
        //     'type' => 'Multi',
        //     'children' => [
        //         'function' => ['name' => 'Nama', 'type' => 'SString', 'child' => ['wh_function']],
        //         'category' => ['name' => 'Nama', 'type' => 'SString', 'child' => ['wh_category']],
        //         'storage_method' => ['name' => 'Nama', 'type' => 'SString', 'child' => ['wh_storage_methode']],
        //     ],
        // ],
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
