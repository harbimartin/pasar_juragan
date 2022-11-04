@extends('dashboard._index')
@section('content')
    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'juragan_angkutan' => ['name' => 'Juragan Angkutan', 'type' => 'SString', 'child' => ['provider_name'], 'full' => true],
        'juragan_barang' => ['name' => 'Juragan Barang', 'type' => 'SString', 'child' => ['comp_name'], 'full' => true],
        'contract_no' => ['name' => 'No. Kontrak', 'type' => 'String', 'full' => true],
        'contract_desc' => ['name' => 'Judul Kontrak', 'type' => 'String', 'full' => true],
        'contract_date' => ['name' => 'Tanggal Kontrak', 'type' => 'Date', 'full' => true],
        'contract_expired' => ['name' => 'Tanggal Expired', 'type' => 'Date', 'full' => true],
        'status' => ['name' => 'Status', 'type' => 'SState'],
        'act' => ['name' => 'Action', 'type' => 'Show', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Permintaan Kontrak Barang" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
