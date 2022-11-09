@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_provider_id' => ['name' => 'Juragan', 'type' => 'Select', 'val' => ['provider_name'], 'api' => 'provider', 'full' => true],
            'driver_name' => ['name' => 'Nomor STNK', 'type' => 'String', 'full' => false],
            'license_no' => ['name' => 'Nomor KIR', 'type' => 'String', 'full' => false],
            'expired_license' => ['name' => 'Expired STNK', 'type' => 'Datetime', 'full' => false],
            'phone' => ['name' => 'Expired KIR', 'type' => 'Datetime', 'full' => false],
            'email' => ['name' => 'Gps IMEI', 'type' => 'String', 'full' => false],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="transport_add" :column="$column" title="Buat Transport" :select="$select" idk="id">
    </x-add>
@endsection
