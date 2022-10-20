@extends('dashboard._index')
@section('content')
    <?php
    $table_gudang = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'wh_code' => ['name' => 'Kode', 'type' => 'String'],
        'wh_name' => ['name' => 'Nama', 'type' => 'String'],
        'wh_npwp' => ['name' => 'NPWP', 'type' => 'String'],
        'wh_website' => ['name' => 'Website', 'type' => 'String'],
        // 'status' => ['name' => 'Status', 'type' => 'SState'],
        // 'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'route' => 'dashboard.juragan-gudang', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_gudang" :datas="$data" :prop="$prop">
    </x-table>
@endsection
