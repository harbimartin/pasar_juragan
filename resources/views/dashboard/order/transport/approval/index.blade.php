@extends('dashboard._index')
@section('content')
    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'contract' => ['name' => 'Kontrak', 'type' => 'SString', 'child' => ['contract_no', 'contract_desc'], 'full' => true],
        'to_no' => ['name' => 'No. Order', 'type' => 'String', 'full' => true],
        'to_date' => ['name' => 'Tanggal Order', 'type' => 'Date', 'full' => true],
        'to_desc' => ['name' => 'Deskripsi Order', 'type' => 'TextArea', 'full' => true],
        'status' => ['name' => 'Status', 'type' => 'SState'],
        'act' => ['name' => 'Action', 'type' => 'Show', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Permintaan Kontrak Barang" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
