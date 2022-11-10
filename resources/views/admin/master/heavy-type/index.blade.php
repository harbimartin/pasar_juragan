@extends('admin._index')
@section('content')
    @php
        $column = [
            'heavy_equipment_type' => ['name' => 'Nama Tipe', 'type' => 'String', 'full' => true],
            'heavy_equipment_type_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="heavy_equipment_type" :column="$column" title="Tambah Tipe Alat Berat" :select="$select" idk="id">
    </x-add>

    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'heavy_equipment_type' => ['name' => 'Nama', 'type' => 'String'],
        'heavy_equipment_type_desc' => ['name' => 'Deskripsi', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Tipe Alat Berat" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
