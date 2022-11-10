@extends('admin._index')
@section('content')
    @php
        $column = [
            'city_name' => ['name' => 'Kota', 'type' => 'String'],
            'm_province_id' => ['name' => 'Provinsi', 'type' => 'TextSel', 'val' => ['province_name'], 'desc' => [], 'api' => 'province', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="city" :column="$column" title="Tambah Kota" :select="$select" idk="id">
    </x-add>

    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'city_name' => ['name' => 'Kota', 'type' => 'String'],
        'province' => ['name' => 'Province', 'type' => 'SString', 'child' => 'province_name'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Kota" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
