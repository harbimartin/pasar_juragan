@extends('admin._index')
@section('content')
    @php
        $column = [
            'city_name' => ['name' => 'Kota', 'type' => 'String'],
            'm_province_id' => ['name' => 'Provinsi', 'type' => 'TextSel', 'val' => ['province_name'], 'desc' => [], 'api' => 'province', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="city" :data="$data" :column="$column" title="Update Kota" :select="$select" idk="id">
    </x-update>
@endsection
