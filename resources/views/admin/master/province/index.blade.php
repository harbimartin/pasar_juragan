@extends('admin._index')
@section('content')
    @php
        $column = [
            'province_code' => ['name' => 'Kode', 'type' => 'String'],
            'province_name' => ['name' => 'Nama', 'type' => 'String'],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="province" :column="$column" title="Tambah Provinsi" :select="$select" idk="id">
    </x-add>

    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'province_code' => ['name' => 'Kode', 'type' => 'String'],
        'province_name' => ['name' => 'Nama', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Provinsi" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
