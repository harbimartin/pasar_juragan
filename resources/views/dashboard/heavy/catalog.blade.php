@extends('dashboard._index')
@section('content')
    <?php
    // 'm_heavy_equipment_type_id',
    // 'equipment_code',
    // 'equipment_brand',
    // 'equipment_desc',
    // 'equipment_attachment',
    // 'operational_weight',
    $table_heavy = [
        'provider_logo' => ['type' => 'Image', 'module' => 'file_logo'],
        'wh' =>
            $target == 'provider'
                ? null
                : [
                    'name' => 'Juragan',
                    'type' => 'Multi',
                    'children' => [
                        'provider_name' => ['type' => 'String', 'class' => 'text-lg font-semibold'],
                        // 'wh_large_uom' => ['type' => 'CString', 'sub' => 'Luas', 'class' => 'ml-auto my-auto'],
                    ],
                ],
        // 'address_detail' => ['type' => 'TextArea'],
        'city_province' => ['type' => 'String', 'class' => 'border-b w-full'],
        'heavy' => ['type' => 'GString', 'key' => ['type', 'heavy_equipment_type'], 'total'=>'total', "class"=>"text-xs px-3 pt-1"],
    ];
    $table_heavy = json_encode($table_heavy);
    ?>
    <x-grid :column="$table_heavy" :datas="$data" :prop="$prop" :filter="$filter" :selfilter="$sel_filter">
    </x-grid>
@endsection
