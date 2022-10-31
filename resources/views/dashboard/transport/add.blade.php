@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_provider_id' => ['name' => 'Juragan', 'type' => 'Select', 'val' => ['provider_name'], 'api' => 'provider', 'full' => true],
            'plate_no' => ['name' => 'Plat Nomor', 'type' => 'String', 'full' => false],
            'm_truck_type_id' => ['name' => 'Type Truck', 'type' => 'TextSel', 'val' => ['truck_type', 'truck_type_desc'], 'desc' => [], 'api' => 'truck_type', 'full' => false],
            'stnk_no' => ['name' => 'Nomor STNK', 'type' => 'String', 'full' => false],
            'kir_no' => ['name' => 'Nomor KIR', 'type' => 'String', 'full' => false],
            'expired_stnk' => ['name' => 'Expired STNK', 'type' => 'Date', 'full' => false],
            'expired_kir' => ['name' => 'Expired KIR', 'type' => 'Date', 'full' => false],
            'gps_imei' => ['name' => 'Gps IMEI', 'type' => 'String', 'full' => false],
            'gps_url' => ['name' => 'Gps Url', 'type' => 'String', 'full' => true],
            'gps_api_key' => ['name' => 'GPS Key', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="transport_add" :column="$column" title="Buat Transport" :select="$select" idk="id">
    </x-add>
@endsection
