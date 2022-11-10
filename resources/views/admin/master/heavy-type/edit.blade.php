@extends('admin._index')
@section('content')
    @php
        $column = [
            'heavy_equipment_type' => ['name' => 'Nama Tipe', 'type' => 'String', 'full' => true],
            'heavy_equipment_type_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="heavy_equipment_type" :data="$data" :column="$column" title="Update Tipe Alat Berat"
        :select="$select" idk="id">
    </x-update>
@endsection
