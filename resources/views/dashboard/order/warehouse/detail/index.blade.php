@extends('dashboard.order.warehouse.show', ['tab' => 'detail'])
@section('tab-content')
    @if (!$detail)
        @php
            $column_detail = [
                't_wh_contract_detail_id' => ['name' => 'Gudang', 'type' => 'TextSel', 'val' => ['wh_name'], 'desc' => ['address_detail'], 'share' => ['address_detail' => 0, 'price_per_meter_daily' => 0, 'price_per_meter_monthly' => 0], 'api' => 'warehouse', 'full' => true],
                'desc' => ['key' => 't_wh_contract_detail_id', 'val' => 'address_detail', 'name' => 'Alamat Gudang', 'type' => 'RefArea', 'full' => true],
                'ppmd' => ['key' => 't_wh_contract_detail_id', 'val' => 'price_per_meter_daily', 'name' => 'Harga Per Meter Perhari', 'type' => 'Reference', 'full' => false],
                'ppmm' => ['key' => 't_wh_contract_detail_id', 'val' => 'price_per_meter_monthly', 'name' => 'Harga Per Meter Sebulan', 'type' => 'Reference', 'full' => false],
                'start_project' => ['name' => 'Proyek Dimulai', 'type' => 'Date', 'full' => false],
                'wh_large' => ['name' => 'Luas Gudang', 'type' => 'Number', 'step' => '0.01', 'full' => true],
                'flag_daily_monthly' => ['name' => 'Tipe Pesanan Gudang', 'type' => 'Radio', 'option' => ['Daily', 'Monthly'], 'full' => true],
                'long_used' => ['name' => 'Penggunaan Jangka Panjang', 'type' => 'Number', 'step' => '1', 'full' => true],
                'order_note' => ['name' => 'Catatan', 'type' => 'TextArea', 'full' => true],
            ];
            $column_detail = json_encode($column_detail);
        @endphp

        <x-add unique="provider" :column="$column_detail" title="Tambah Detail Kontrak" :data="$data" :select="$select"
            idk="id">
        </x-add>
    @endif

    <?php
    $table_detail = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'wh' => [
            'name' => 'Gudang',
            'type' => 'Multi',
            'children' => [
                'wh_name' => ['by' => 'contract_rpt', 'name' => 'Nama', 'type' => 'SString', 'class' => 'font-semibold border-b border-blue-300'],
                'contract_rpt' => ['by' => 'contract_rpt', 'name' => 'Alamat', 'type' => 'STextArea', 'child' => 'address_detail'],
            ],
        ],
        'start_project' => ['name' => 'Mulai Proyek', 'type' => 'Date'],
        'wh_large' => ['name' => 'Luas Dipesan', 'type' => 'Number'],
        'flag_daily_monthly' => ['name' => 'Tipe', 'type' => 'SState', 'title' => (object) [0 => 'Daily', 1 => 'Monthly'], 'color' => (object) [0 => 'green', 1 => 'blue'], 'align'=>'center'],
        'delete' => $detail ? null : ['name' => 'Action', 'type' => 'Delete', 'align' => 'center', 'sort' => false],
        'act' => ['name' => 'Action', 'type' => $detail ? 'Show' : 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    // echo $data->detail[0]->contract_rpt;
    ?>
    <x-table title="Daftar Gudang" :lim="false" :column="$table_detail" :datas="$data->detail">
    </x-table>
    @yield('more-content')
@endsection
