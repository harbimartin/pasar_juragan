@extends('dashboard.provider.index', ['tab' => 'document'])
@section('tab-content')
    @php
        $column_document = [
            'm_doc_id' => ['name' => 'Tipe Dokumen', 'type' => 'Select', 'val' => ['doc_name'], 'api' => 'document', 'full' => true],
            'doc_no' => ['name' => 'Kota', 'type' => 'String', 'full' => true],
            'doc_date' => ['name' => 'Provinsi', 'type' => 'String', 'full' => true],
            'doc_expired' => ['name' => 'Negara', 'type' => 'String', 'full' => true],
            'doc_attachment' => ['name' => 'Negara', 'type' => 'String', 'full' => true],
        ];
        $column_document = json_encode($column_document);
    @endphp

    <x-add unique="provider" :column="$column_document" title="Tambah Dokumen Juragan Gudang" :data="$data" :select="$select"
        idk="id">
    </x-add>

    <?php
    $table_document = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'comp_document_detail' => ['name' => 'Alamat', 'type' => 'TextArea'],
        'comp_city' => ['name' => 'Kota', 'type' => 'String'],
        'comp_provice' => ['name' => 'Provinsi', 'type' => 'String'],
        'comp_country' => ['name' => 'Negara', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'route' => 'dashboard.profile-company.document.edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_document" :datas="$data->document">
    </x-table>
@endsection
