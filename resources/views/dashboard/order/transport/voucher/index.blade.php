@extends('dashboard.order.transport.show', ['tab' => 'voucher'])
@section('tab-content')
    @if (!$voucher_detail)
        @php
            $column_detail = [
                'voucher_date' => ['name' => 'Tanggal Mulai', 'type' => 'Date', 'full' => true],
                'voucher_close_date' => ['name' => 'Tanggal Selesai', 'type' => 'Date', 'full' => true],
                'm_truck_id' => ['name' => 'Truk', 'type' => 'TextSel', 'val' => ['plate_no'], 'desc' => [], 'api' => 'truck', 'full' => true],
                'm_driver_id' => ['name' => 'Sopir', 'type' => 'TextSel', 'val' => ['driver_name'], 'desc' => ['license_no'], 'api' => 'driver', 'full' => true],
                'notes' => ['name' => 'Catatan', 'type' => 'TextArea', 'full' => true],
            ];
            $column_detail = json_encode($column_detail);
        @endphp

        <x-add unique="provider" :column="$column_detail" title="Tambah Pesanan Truk" :data="$data" :select="$select" idk="id">
        </x-add>
    @endif

    <?php
    $table_detail = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'voucher_date' => ['name' => 'Tanggal Mulai', 'type' => 'Date', 'full' => true],
        'voucher_close_date' => ['name' => 'Tanggal Selesai', 'type' => 'Date', 'full' => true],
        'truck' => ['name' => 'Truk', 'type' => 'SString', 'child' => 'plate_no'],
        'driver' => ['name' => 'Sopir', 'type' => 'SString', 'child' => 'driver_name'],
        'notes' => ['name' => 'Catatan', 'type' => 'TextArea', 'empty' => 'Tidak ada Catatan', 'full' => true],
        'status' => ['name' => 'Status', 'type' => 'State', 'center', 'sort' => false],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => $voucher_detail ? null : ['name' => 'Action', 'type' => 'Show', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_detail" :datas="$data->voucher">
    </x-table>
@endsection
