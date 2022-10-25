@extends('dashboard._index')
@section('content')
    <?php
    $table_warehouse = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'identity' => [
            'name' => 'Nama/Alamat',
            'type' => 'Multi',
            'children' => [
                'wh_name' => ['name' => 'Nama', 'type' => 'String', 'iclass' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'address_detail' => ['name' => 'Nama', 'type' => 'TextArea'],
            ],
        ],
        'place' => [
            'name' => 'Nama/Alamat',
            'type' => 'Multi',
            'children' => [
                'province' => ['name' => 'City', 'type' => 'SString', 'child' => ['province_name']],
                'city' => ['name' => 'No TDG', 'type' => 'SString', 'child' => ['city_name']],
            ],
        ],
        'attribute' => [
            'name' => 'Atribut',
            'type' => 'Multi',
            'children' => [
                'function' => ['name' => 'Nama', 'type' => 'SString', 'child' => ['wh_function']],
                'category' => ['name' => 'Nama', 'type' => 'SString', 'child' => ['wh_category']],
                'storage_method' => ['name' => 'Nama', 'type' => 'SString', 'child' => ['wh_storage_methode']],
            ],
        ],
        'tdg' => [
            'name' => 'Nama/Alamat',
            'type' => 'Multi',
            'children' => [
                'tdg_no' => ['name' => 'TDG', 'type' => 'String', 'sub' => 'no'],
                'tdg_date' => ['name' => 'TDG', 'type' => 'Date', 'sub' => 'date'],
                'tdg_expired_date' => ['name' => 'TDG', 'type' => 'Date', 'sub' => 'exp'],
            ],
        ],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'route' => 'dashboard.warehouse.list', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_warehouse" :datas="$data" :prop="$prop">
    </x-table>
@endsection
