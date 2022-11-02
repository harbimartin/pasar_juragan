@extends('dashboard._index')
@section('content')
    <?php
    $table_warehouse = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'provider' =>
            $target == 'provider'
                ? null
                : [
                    'name' => 'Juragan',
                    'type' => 'Multi',
                    'children' => [
                        'provider_code' => ['by' => 'provider', 'name' => 'Nama', 'type' => 'SString', 'class' => 'text-gray-700 font-semibold border-b border-blue-500'],
                        'provider_name' => ['by' => 'provider', 'name' => 'Nama', 'type' => 'Route', 'name' => 'dashboard.home.juragan-gudang.show', 'key' => 'm_provider_id'],
                        'provider_website' => ['by' => 'provider', 'name' => 'Nama', 'type' => 'SLink'],
                    ],
                ],
        'identity' => [
            'name' => 'Nama/Alamat',
            'type' => 'Multi',
            'children' => [
                'wh_name' => ['name' => 'Nama', 'type' => 'String', 'class' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'address_detail' => ['name' => 'Nama', 'type' => 'TextArea'],
                'location' => ['name' => 'Lokasi', 'type' => 'Location', 'lat' => 'latitude', 'long' => 'longitude'],
            ],
        ],
        'place' => [
            'name' => 'Provinsi/Kota',
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
        'tdg' =>
            $target == 'public'
                ? null
                : [
                    'name' => 'TDG',
                    'type' => 'Multi',
                    'children' => [
                        'tdg_no' => ['name' => 'TDG', 'type' => 'String', 'sub' => 'no'],
                        'tdg_date' => ['name' => 'TDG', 'type' => 'Date', 'sub' => 'date'],
                        'tdg_expired_date' => ['name' => 'TDG', 'type' => 'Date', 'sub' => 'exp'],
                    ],
                ],
        'status' => $target == 'public' ? null : ['name' => 'Status', 'type' => 'State'],
        'toggle' => $target == 'public' ? null : ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Action', 'type' => $target == 'public' ? 'Show' : 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_warehouse" :datas="$data" :prop="$prop" :selfilter="$sel_filter">
    </x-table>
@endsection
