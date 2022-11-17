@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_provider_id' => ['name' => 'Juragan', 'type' => 'Select', 'val' => ['provider_name'], 'api' => 'provider', 'full' => true],
            'driver_name' => ['name' => 'Nama Sopir', 'type' => 'String'],
            'license_no' => ['name' => 'Nomor STNK', 'type' => 'String'],
            'expired_license' => ['name' => 'Expired STNK', 'type' => 'Datetime'],
            'phone' => ['name' => 'No Telp', 'type' => 'String'],
            'email' => ['name' => 'Email', 'type' => 'String'],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="transport_update" :data="$data" :column="$column" title="Update Sopir" :select="$select"
        idk="id">
    </x-update>
@endsection
