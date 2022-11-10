@extends('admin._index')
@section('content')
    @php
        $column = [
            'origin_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'origin_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="origin" :data="$data" :column="$column" title="Update Asal" :select="$select" idk="id">
    </x-update>
@endsection
