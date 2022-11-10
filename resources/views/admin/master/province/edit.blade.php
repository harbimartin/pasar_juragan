@extends('admin._index')
@section('content')
    @php
        $column = [
            'province_code' => ['name' => 'Kota', 'type' => 'String'],
            'province_name' => ['name' => 'Kota', 'type' => 'String'],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="province" :data="$data" :column="$column" title="Update Provinsi" :select="$select" idk="id">
    </x-update>
@endsection
