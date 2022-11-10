@extends('admin._index')
@section('content')
    @php
        $column = [
            'm_provider_type_id' => ['name' => 'Tipe Provider', 'type' => 'Select', 'val' => ['provider_type_name'], 'desc' => [], 'api' => 'type', 'full' => true],
            'doc_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'doc_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="doc" :data="$data" :column="$column" title="Update Dokumen" :select="$select" idk="id">
    </x-update>
@endsection
