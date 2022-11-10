@extends('admin._index')
@section('content')
    @php
        $column = [
            'wh_category' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'wh_category_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="wh_category" :data="$data" :column="$column" title="Update Kategori Gudang" :select="$select"
        idk="id">
    </x-update>
@endsection
