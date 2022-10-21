@extends('dashboard._index')
@section('content')
    <?php
    $table_alat_berat = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'provider_code' => ['name' => 'Kode', 'type' => 'String'],
        'provider_name' => ['name' => 'Nama', 'type' => 'String'],
        'provider_npwp' => ['name' => 'NPWP', 'type' => 'String'],
        'provider_website' => ['name' => 'Website', 'type' => 'String'],
        // 'status' => ['name' => 'Status', 'type' => 'SState'],
        // 'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'route' => 'dashboard.juragan-alatberat.show', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_alat_berat" :datas="$data" :prop="$prop">
    </x-table>
@endsection
