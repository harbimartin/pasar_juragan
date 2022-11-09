@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_provider_id' => ['name' => 'Juragan', 'type' => 'Select', 'val' => ['provider_name'], 'api' => 'provider', 'full' => true],
            'driver_name' => ['name' => 'Nomor STNK', 'type' => 'String', 'full' => false],
            'license_no' => ['name' => 'Nomor KIR', 'type' => 'String', 'full' => false],
            'expired_license' => ['name' => 'Expired STNK', 'type' => 'Date', 'full' => false],
            'phone' => ['name' => 'Expired KIR', 'type' => 'String', 'full' => false],
            'email' => ['name' => 'Gps IMEI', 'type' => 'String', 'full' => false],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="transport_update" :data="$data" :column="$column" title="Update Transport" :select="$select"
        idk="id">
    </x-update>
@endsection
