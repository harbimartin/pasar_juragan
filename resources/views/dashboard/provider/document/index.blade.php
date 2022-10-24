@extends('dashboard.provider.index', ['tab' => 'document'])
@section('tab-content')
    @php
        $column_document = [
            'm_doc_id' => ['name' => 'Tipe Dokumen', 'type' => 'Select', 'val' => ['doc_name'], 'api' => 'document', 'full' => true],
            'doc_no' => ['name' => 'No. Dokumen', 'type' => 'String', 'full' => true],
            'doc_date' => ['name' => 'Tgl. Dokumen', 'type' => 'Date', 'full' => true],
            'doc_expired' => ['name' => 'Tgl. Kadaluarsa', 'type' => 'Date', 'full' => true],
            'doc_attachment' => ['name' => 'Upload Dokumen', 'type' => 'Upload', 'accept' => 'application/pdf', 'folder' => 'provider_doc', 'mono' => true, 'full' => true],
        ];
        $column_document = json_encode($column_document);
    @endphp

    <x-add unique="provider" :column="$column_document" title="Tambah Dokumen Juragan Gudang" :data="$data" :select="$select"
        idk="id">
    </x-add>

    <?php
    $table_document = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'doc_no' => ['name' => 'No. Dokumen', 'type' => 'String', 'full' => true],
        'doc_date' => ['name' => 'Tgl. Dokumen', 'type' => 'String', 'full' => true],
        'doc_expired' => ['name' => 'Tgl. Kadaluarsa', 'type' => 'String', 'full' => true],
        'doc_attachment' => ['name' => 'Lampiran', 'type' => 'String', 'full' => true],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'route' => 'dashboard.profile-company.document.edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_document" :datas="$data->document">
    </x-table>
@endsection
