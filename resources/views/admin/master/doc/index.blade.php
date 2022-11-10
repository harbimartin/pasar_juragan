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

    <x-add unique="doc" :column="$column" title="Tambah Dokumen" :select="$select" idk="id">
    </x-add>

    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'provider_type' => ['name' => 'Tipe Provider', 'type' => 'SString', 'child' => 'provider_type_name'],
        'doc_name' => ['name' => 'Kode', 'type' => 'String'],
        'doc_desc' => ['name' => 'Nama', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Dokumen" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
