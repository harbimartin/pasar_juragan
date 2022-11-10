@extends('admin._index')
@section('content')
    @php
        $column = [
            'contact_type' => ['name' => 'Nama Tipe', 'type' => 'String', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="contact_type" :data="$data" :column="$column" title="Update Tipe Kontak" :select="$select"
        idk="id">
    </x-update>
@endsection
