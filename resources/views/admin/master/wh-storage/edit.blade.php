@extends('admin._index')
@section('content')
    @php
        $column = [
            'wh_storage_methode' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'wh_storage_methode_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="wh_storage_methode" :data="$data" :column="$column" title="Update Metode Penyimpanan Gudang"
        :select="$select" idk="id">
    </x-update>
@endsection
