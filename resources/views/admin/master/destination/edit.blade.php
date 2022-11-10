@extends('admin._index')
@section('content')
    @php
        $column = [
            'destination_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'destination_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="destination" :data="$data" :column="$column" title="Update Tujuan" :select="$select" idk="id">
    </x-update>
@endsection
