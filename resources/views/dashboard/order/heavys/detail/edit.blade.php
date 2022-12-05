@extends('dashboard._index')
@section('content')
    @if ($detail)
        @php
            $column_detail = [
                'wh_name' => ['by'=>'contract_rpt', 'name' => 'Gudang', 'type' => 'SString', 'full' => true],
                'address' => ['by'=>'contract_rpt', 'name' => 'Alamat Gudang', 'child'=>'address_detail', 'type' => 'STextArea', 'full' => true],
                'price_per_meter_daily' => ['by'=>'contract_rpt', 'name' => 'Harga Per Meter Perhari', 'type' => 'SString', 'full' => false],
                'price_per_meter_monthly' => ['by'=>'contract_rpt', 'name' => 'Harga Per Meter Sebulan', 'type' => 'SString', 'full' => false],
                'start_project' => ['name' => 'Proyek Dimulai', 'type' => 'Date', 'full' => false],
                'wh_large' => ['name' => 'Luas Gudang', 'type' => 'Number', 'step' => '0.01', 'full' => true],
                'flag_daily_monthly' => ['name' => 'Tipe Pesanan Gudang', 'type' => 'Radio', 'option' => ['Daily', 'Monthly'], 'full' => true],
                'long_used' => ['name' => 'Penggunaan Jangka Panjang', 'type' => 'Number', 'step' => '1', 'full' => true],
                'order_note' => ['name' => 'Catatan', 'type' => 'TextArea', 'full' => true],
            ];
            $column_detail = json_encode($column_detail);
        @endphp
    @else
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
    @endif
    <x-update unique="detail" :column="$column_detail" title="Detail Pesanan Gudang" :data="$data" idk="id" :select="$select"
        :detail="$detail">
    </x-update>
@endsection
