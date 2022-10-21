@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'comp_address_detail' => ['name' => 'Alamat', 'type' => 'TextArea', 'rows' => 4, 'full' => true],
            'comp_city' => ['name' => 'Kota', 'type' => 'String', 'full' => true],
            'comp_province' => ['name' => 'Provinsi', 'type' => 'String', 'full' => true],
            'comp_country' => ['name' => 'Negara', 'type' => 'String', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="address" :column="$column" title="Alamat Perusahaan" :data="$data" idk="id">
    </x-update>
@endsection
