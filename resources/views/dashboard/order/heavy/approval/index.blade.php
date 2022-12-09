@extends('dashboard._index')
@section('content')
    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'heo_no' => ['name' => 'No. Order', 'type' => 'String', 'full' => true],
        'contract' => ['name' => 'Kontrak', 'type' => 'SString', 'child' => ['contract_no', 'contract_desc'], 'full' => true],
        'heo_date' => ['name' => 'Tanggal Order', 'type' => 'Date', 'full' => true],
        'heo_desc' => ['name' => 'Deskripsi Order', 'type' => 'TextArea', 'full' => true],
        'status' => ['name' => 'Status', 'type' => 'SState'],
        'act' => ['name' => 'Action', 'type' => 'Show', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Permintaan Kontrak Alat Berat" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
