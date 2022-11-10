@extends('admin._index')
@section('content')
    @php
        $column = [
            'destination_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'destination_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="destination" :column="$column" title="Tambah Tujuan" :select="$select" idk="id">
    </x-add>

    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'destination_name' => ['name' => 'Kode', 'type' => 'String'],
        'destination_desc' => ['name' => 'Nama', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Tujuan" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
