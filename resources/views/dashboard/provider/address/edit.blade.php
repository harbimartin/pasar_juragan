@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'provider_address_detail' => ['name' => 'Alamat', 'type' => 'TextArea', 'rows' => 4, 'full' => true],
            'provider_province' => ['name' => 'Provinsi', 'type' => 'TextSel', 'val' => ['province_code', 'province_name'], 'desc' => [], 'api' => 'province', 'full' => false],
            'provider_city' => ['name' => 'Kota', 'type' => 'TextSel', 'val' => ['city_name'], 'desc' => [], 'api' => 'city', 'full' => false],
            'provider_country' => ['name' => 'Negara', 'type' => 'String', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="address" :column="$column" title="Address" :data="$data" idk="id" :select="$select">
    </x-update>
@endsection
