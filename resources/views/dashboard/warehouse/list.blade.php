@extends('dashboard._index')
@section('content')
    <?php
    $table_warehouse = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'nama' => ['name' => 'Nama', 'type' => 'String'],
        'city' => ['name' => 'City', 'type' => 'String'],
        'no_tdg' => ['name' => 'No TDG', 'type' => 'String'],
        'exp_tdg' => ['name' => 'EXP TDG', 'type' => 'String'],
        // 'status' => ['name' => 'Status', 'type' => 'SState'],
        // 'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'route' => 'dashboard.warehouse.list', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_warehouse" :datas="$data">
    </x-table>
@endsection
