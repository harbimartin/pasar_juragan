@extends('admin._index')
@section('content')
    @php
        $column = [
            'wh_function' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'wh_function_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="wh_function" :data="$data" :column="$column" title="Update Fungsi Gudang" :select="$select"
        idk="id">
    </x-update>
@endsection
