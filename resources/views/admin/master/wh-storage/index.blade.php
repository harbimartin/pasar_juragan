@extends('admin._index')
@section('content')
    @php
        $column = [
            'wh_storage_methode' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'wh_storage_methode_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="wh_storage_methode" :column="$column" title="Tambah Metode Penyimpanan Gudang" :select="$select"
        idk="id">
    </x-add>

    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'wh_storage_methode' => ['name' => 'Nama', 'type' => 'String'],
        'wh_storage_methode_desc' => ['name' => 'Deskripsi', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Metode Penyimpanan Gudang" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
