@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_provider_id' => ['name' => 'Juragan', 'type' => 'Select', 'val' => ['provider_name'], 'api' => 'provider', 'full' => true],
            'm_heavy_equipment_type_id' => ['name' => 'Equipment Type', 'type' => 'Select', 'val' => ['heavy_equipment_type', 'heavy_equipment_type_desc'], 'api' => 'heavy_type', 'full' => true],
            'equipment_code' => ['name' => 'Equipment Code', 'type' => 'String', 'full' => false],
            'equipment_brand' => ['name' => 'Equipment Brand', 'type' => 'String', 'full' => false],
            'operational_weight' => ['name' => 'Operational Weight', 'type' => 'Number', 'full' => false],
            'equipment_desc' => ['name' => 'Equipment Desc', 'type' => 'TextArea', 'full' => true],
            'equipment_attachment' => ['name' => 'Upload', 'type' => 'Upload', 'accept' => 'pdf/*', 'key' => 'file', 'folder' => 'file_tdg', 'mono' => true, 'full' => true],
            'image' => ['name' => 'Foto Alat Berat', 'type' => 'Upload', 'accept' => 'image/*', 'key' => 'file_image', 'folder' => 'image_product', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="heavy_update" :data="$data" :column="$column" title="Update Heavy" :select="$select" idk="id">
    </x-update>
@endsection
