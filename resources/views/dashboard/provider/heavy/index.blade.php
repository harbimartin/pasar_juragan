@extends('dashboard.provider.index', ['tab' => 'heavy'])
@section('tab-content')
    <?php
    $table_heavy = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'identity' => [
            'name' => 'Code/Type Equipment',
            'type' => 'Multi',
            'children' => [
                'equipment_code' => ['name' => 'Code', 'type' => 'String', 'class' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'type' => ['name' => 'Type', 'type' => 'SString', 'child' => ['heavy_equipment_type']],
            ],
        ],
        'place' => [
            'name' => 'Brand / Desc',
            'type' => 'Multi',
            'children' => [
                'equipment_code' => ['name' => 'Brand', 'type' => 'String', 'class' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'equipment_desc' => ['name' => 'Desc', 'type' => 'TextArea'],
            ],
        ],
        'weight' => [
            'name' => 'Weight',
            'type' => 'Multi',
            'children' => [
                'operational_weight' => ['name' => 'Weight', 'type' => 'Number'],
            ],
        ],
        'act' => ['name' => 'Action', 'type' => 'Show', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_heavy" :datas="$heavys" :selfilter="$sel_filter" :lim="false">
    </x-table>
@endsection
