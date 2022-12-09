@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'provider' => ['name' => 'Juragan Angkutan', 'type' => 'SString', 'child' => ['provider_name'], 'full' => true],
            'plate_no' => ['name' => 'Plat Nomor', 'type' => 'String', 'full' => false],
            'type' => ['name' => 'Type Truck', 'type' => 'SString', 'child' => ['truck_type', 'truck_type_desc'], 'desc' => [], 'api' => 'truck_type', 'full' => false],
            'stnk_no' => ['name' => 'Nomor STNK', 'type' => 'String', 'full' => false],
            'kir_no' => ['name' => 'Nomor KIR', 'type' => 'String', 'full' => false],
            'expired_stnk' => ['name' => 'Expired STNK', 'type' => 'Date', 'full' => false],
            'expired_kir' => ['name' => 'Expired KIR', 'type' => 'Date', 'full' => false],
            'gps_imei' => ['name' => 'Gps IMEI', 'type' => 'String', 'full' => false],
            'gps_url' => ['name' => 'Gps Url', 'type' => 'String', 'full' => true],
            'gps_api_key' => ['name' => 'GPS Key', 'type' => 'TextArea', 'full' => true],
            'image' => ['name' => 'Foto Angkutan', 'type' => 'Upload', 'accept' => 'image/*', 'key' => 'file_image', 'desc_key' => 'image_desc', 'folder' => 'image_product', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-update unique="gudang_update" :data="$data" :column="$column" title="Detail Gudang" :select="$select" idk="id"
        detail="true">
    </x-update>
@endsection
