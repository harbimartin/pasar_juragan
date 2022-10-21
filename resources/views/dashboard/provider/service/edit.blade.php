@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'provider_address_detail' => ['name' => 'Alamat', 'type' => 'TextArea', 'rows' => 4, 'full' => true],
            'provider_city' => ['name' => 'Kota', 'type' => 'String', 'full' => true],
            'provider_province' => ['name' => 'Provinsi', 'type' => 'String', 'full' => true],
            'provider_country' => ['name' => 'Negara', 'type' => 'String', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="service" :column="$column" title="Service Gudang" :data="$data" idk="id">
    </x-update>
@endsection
