@extends('admin._index')
@section('content')
    @php
        $column = [
            'truck_type' => ['name' => 'Nama Tipe', 'type' => 'String', 'full' => true],
            'truck_type_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="truck_type" :data="$data" :column="$column" title="Update Tipe Truk" :select="$select" idk="id">
    </x-update>
@endsection
