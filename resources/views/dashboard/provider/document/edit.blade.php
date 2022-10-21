@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_doc_id' => ['name' => 'Tipe Dokumen', 'type' => 'Select', 'val' => ['doc_name'], 'api' => 'document', 'full' => true],
            'doc_no' => ['name' => 'No. Dokumen', 'type' => 'String', 'full' => true],
            'doc_date' => ['name' => 'Tgl. Dokumen', 'type' => 'Date', 'full' => true],
            'doc_expired' => ['name' => 'Tgl. Kadaluarsa', 'type' => 'Date', 'full' => true],
            'doc_attachment' => ['name' => 'Upload Dokumen', 'type' => 'Upload', 'accept' => 'application/pdf', 'folder' => 'file_provider', 'anonymous'=>true, 'mono' => true, 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="document" :column="$column" title="Document" :data="$data" idk="id" :select="$select">
    </x-update>
@endsection
