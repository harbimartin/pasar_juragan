@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_doc_id' => ['name' => 'Tipe Dokumen1130001047', 'type' => 'Select', 'val' => ['business_category'], 'api' => 'business_category', 'full' => true],
            'doc_no' => ['name' => 'Alamat', 'type' => 'TextArea', 'rows' => 4, 'full' => true],
            'doc_date' => ['name' => 'Kota', 'type' => 'String', 'full' => true],
            'doc_expired' => ['name' => 'Provinsi', 'type' => 'String', 'full' => true],
            'doc_attachment' => ['name' => 'Negara', 'type' => 'String', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="address" :column="$column" title="Document" :data="$data" idk="id">
    </x-update>
@endsection
