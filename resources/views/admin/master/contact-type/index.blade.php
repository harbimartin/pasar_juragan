@extends('admin._index')
@section('content')
    @php
        $column = [
            'contact_type' => ['name' => 'Nama Tipe', 'type' => 'String', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="bussinescategory" :column="$column" title="Tambah Tipe Kontak" :select="$select" idk="id">
    </x-add>

    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'contact_type' => ['name' => 'Nama Tipe Kontak', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Tipe Kontak" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
