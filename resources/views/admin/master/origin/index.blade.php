@extends('admin._index')
@section('content')
    @php
        $column = [
            'origin_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'origin_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="origin" :column="$column" title="Tambah Asal" :select="$select" idk="id">
    </x-add>

    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'origin_name' => ['name' => 'Kode', 'type' => 'String'],
        'origin_desc' => ['name' => 'Nama', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Asal" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
