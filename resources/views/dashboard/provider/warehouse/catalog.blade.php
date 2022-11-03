@extends('dashboard.provider.index', ['tab' => 'warehouse'])
@section('tab-content')
    <?php
    $table_warehouse = json_encode([
        'image' => ['type' => 'Image', 'module' => 'product_image'],
        'wh' =>
            $target == 'provider'
                ? null
                : [
                    'name' => 'Juragan',
                    'type' => 'Multi',
                    'children' => [
                        'wh_name' => ['type' => 'String', 'class' => 'text-lg font-semibold'],
                        'wh_large_uom' => ['type' => 'CString', 'sub'=>'Luas', 'class' => 'ml-auto my-auto'],
                    ],
                ],
        // 'address_detail' => ['type' => 'TextArea'],
        'city_province' => ['type' => 'String'],
        'location' => ['type' => 'Location', 'lat' => 'latitude', 'long' => 'longitude', 'class'=>'border-b w-full'],
        'function' => ['type' => 'CString', 'child' => ['wh_function'], "class"=>"text-xs px-3 pt-1", 'sub'=>'function'],
        'category' => ['type' => 'CString', 'child' => ['wh_category'], "class"=>"text-xs px-3 pt-1", 'sub'=>'category'],
        'storage_method' => ['type' => 'CString', 'child' => ['wh_storage_methode'], "class"=>"text-xs px-3 pt-1", 'sub'=>'methode'],
    ]);
    ?>
    <x-grid :column="$table_warehouse" :datas="$warehouses" :prop="$prop" :selfilter="$sel_filter">
    </x-grid>
@endsection
