@extends('dashboard.order.transport.detail.edit', ['tab' => 'monitoring'])
@section('more-content')
    <?php
    $table_detail = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'status' => ['name' => 'Status', 'type' => 'CState', 'child' => 'status_desc', 'align' => 'center', 'sort' => false],
        'voucher_date' => ['name' => 'Tanggal Mulai', 'type' => 'Date', 'full' => true],
        'voucher_close_date' => ['name' => 'Tanggal Selesai', 'type' => 'Date', 'full' => true],
        'driver_name' => ['name' => 'Truk', 'type' => 'String', 'child' => 'plate_no'],
        'plate_no' => ['name' => 'Sopir', 'type' => 'String', 'child' => 'driver_name'],
        'notes' => ['name' => 'Catatan', 'type' => 'TextArea', 'empty' => 'Tidak ada Catatan', 'full' => true],
        'status' => ['name' => 'Status', 'type' => 'CState', 'child' => 'status_desc', 'align' => 'center', 'sort' => false],
        'cargo_code' => ['name' => 'Kode Kargo', 'type' => 'String'],
        'tonnage' => ['name' => 'Tonase', 'type' => 'Number', 'step' => '0.01', 'align' => 'center'],
        'pcs' => ['name' => 'Pcs', 'type' => 'Number', 'step' => '0.01', 'align' => 'center'],
        // 'delete' => ['name' => 'Action', 'type' => 'Delete', 'align' => 'center', 'sort' => false],
        'act' => ['name' => 'Action', 'type' => 'Show', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Truk" :lim="false" :column="$table_detail" :datas="$truck">
    </x-table>
    @yield('more-content')
@endsection
