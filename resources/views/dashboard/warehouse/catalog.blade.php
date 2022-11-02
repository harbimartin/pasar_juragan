@extends('dashboard._index')
@section('content')
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
        'provider' => ['type' => 'CString', 'child' => ['provider_name'], "class"=>"text-xs px-3 pt-1", 'sub'=>'juragan'],
        'function' => ['type' => 'CString', 'child' => ['wh_function'], "class"=>"text-xs px-3 pt-1", 'sub'=>'function'],
        'category' => ['type' => 'CString', 'child' => ['wh_category'], "class"=>"text-xs px-3 pt-1", 'sub'=>'category'],
        'storage_method' => ['type' => 'CString', 'child' => ['wh_storage_methode'], "class"=>"text-xs px-3 pt-1", 'sub'=>'methode'],
    ]);
    ?>
    <x-grid :column="$table_warehouse" :datas="$data" :prop="$prop" :selfilter="$sel_filter">
    </x-grid>
@endsection
