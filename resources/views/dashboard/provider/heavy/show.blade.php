@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'provider' => ['name' => 'Juragan Alat Berat', 'type' => 'SString', 'child' => ['provider_name'], 'full' => true],
            'type' => ['name' => 'Equipment Type', 'type' => 'SString', 'child' => ['heavy_equipment_type']],
            'equipment_code' => ['name' => 'Equipment Code', 'type' => 'String'],
            'equipment_brand' => ['name' => 'Equipment Brand', 'type' => 'String', 'full' => false],
            'operational_weight' => ['name' => 'Operational Weight', 'type' => 'Number', 'full' => false],
            'equipment_desc' => ['name' => 'Equipment Desc', 'type' => 'TextArea', 'full' => true],
            'equipment_attachment' => ['name' => 'Upload', 'type' => 'Upload', 'accept' => 'pdf/*', 'key' => 'file_equipment', 'folder' => 'file_tdg', 'mono' => true, 'full' => true],
            'image' => ['name' => 'Foto Alat Berat', 'type' => 'Upload', 'accept' => 'image/*', 'key' => 'file_image', 'desc_key' => 'image_desc', 'folder' => 'image_product', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-update unique="gudang_update" :data="$data" :column="$column" title="Detail Gudang" :select="$select" idk="id"
        detail="true">
    </x-update>
@endsection
