@extends('admin._index')
@section('content')
    @php
        $column = [
            'business_category' => ['name' => 'Nama Ketegori', 'type' => 'String', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="bussinescategory" :data="$data" :column="$column" title="Update Kategori Bisnis" :select="$select"
        idk="id">
    </x-update>
@endsection
