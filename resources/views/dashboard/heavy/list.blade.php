@extends('dashboard._index')
@section('content')
    <?php
    $table_heavy = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'identity' => [
            'name' => 'Kode/Tipe Alat',
            'type' => 'Multi',
            'children' => [
                'equipment_code' => ['name' => 'Code', 'type' => 'String', 'class' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'type' => ['name' => 'Type', 'type' => 'SString', 'child' => ['heavy_equipment_type']],
            ],
        ],
        'place' => [
            'name' => 'Brand / Deskripsi',
            'type' => 'Multi',
            'children' => [
                'equipment_code' => ['name' => 'Brand', 'type' => 'String', 'class' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'equipment_desc' => ['name' => 'Desc', 'type' => 'TextArea'],
            ],
        ],
        'weight' => [
            'name' => 'Berat',
            'type' => 'Multi',
            'children' => [
                'operational_weight' => ['name' => 'Weight', 'type' => 'Number'],
            ],
        ],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Aksi', 'type' => 'Edit', 'route' => 'dashboard.transport.list', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_heavy" :datas="$data" :prop="$prop" :selfilter="$sel_filter">
    </x-table>
@endsection
