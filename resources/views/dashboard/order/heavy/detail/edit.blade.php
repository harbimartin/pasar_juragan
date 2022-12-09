@extends('dashboard._index')
@section('content')
    @if ($detail)
        @php
            $column_detail = [
                'contract_rpt' => ['name' => 'Alat Berat', 'type' => 'SString', 'full' => true, 'child' => ['equipment_code', 'equipment_brand']],
                'address' => ['by' => 'contract_rpt', 'name' => 'Deskripsi Alat Berat', 'child' => 'equipment_desc', 'type' => 'STextArea', 'full' => true],
                'start_project' => ['name' => 'Proyek Dimulai', 'type' => 'Date', 'full' => false],
                // 'wh_large' => ['name' => 'Luas Alat Berat', 'type' => 'Number', 'step' => '0.01', 'full' => true],
                'flag_daily_monthly' => ['name' => 'Tipe Pesanan Alat Berat', 'type' => 'Radio', 'option' => ['Daily', 'Monthly'], 'full' => true],
                'long_used' => ['name' => 'Penggunaan Jangka Panjang', 'type' => 'Number', 'step' => '1', 'full' => true],
                'order_note' => ['name' => 'Catatan', 'type' => 'TextArea', 'full' => true],
            ];
            $column_detail = json_encode($column_detail);
        @endphp
    @else
        @php
            $column_detail = [
                't_he_contract_detail_id' => ['name' => 'Alat Berat', 'type' => 'TextSel', 'val' => ['equipment_code', 'equipment_brand'], 'desc' => ['equipment_desc'], 'share' => ['equipment_desc' => 0, 'operational_weight' => 0], 'api' => 'a2b', 'full' => true],
                // 'brand' => ['key' => 't_he_contract_detail_id', 'val' => 'equipment_brand', 'name' => 'Brand Alat Berat', 'type' => 'Reference', 'full' => true],
                'desc' => ['key' => 't_he_contract_detail_id', 'val' => 'equipment_desc', 'name' => 'Deskripsi Alat Berat', 'type' => 'RefArea', 'full' => true],
                // 'ppmd' => ['key' => 't_he_contract_detail_id', 'val' => 'price_per_meter_daily', 'name' => 'Harga Per Meter Perhari', 'type' => 'Reference', 'full' => false],
                // 'ppmm' => ['key' => 't_he_contract_detail_id', 'val' => 'price_per_meter_monthly', 'name' => 'Harga Per Meter Sebulan', 'type' => 'Reference', 'full' => false],
                'start_project' => ['name' => 'Proyek Dimulai', 'type' => 'Date', 'full' => false],
                // 'wh_large' => ['name' => 'Luas Alat Berat', 'type' => 'Number', 'step' => '0.01', 'full' => true],
                'flag_daily_monthly' => ['name' => 'Tipe Pesanan Alat Berat', 'type' => 'Radio', 'option' => ['Daily', 'Monthly'], 'full' => true],
                'long_used' => ['name' => 'Penggunaan Jangka Panjang', 'type' => 'Number', 'step' => '1', 'full' => true],
                'order_note' => ['name' => 'Catatan', 'type' => 'TextArea', 'full' => true],
            ];
            $column_detail = json_encode($column_detail);
        @endphp
    @endif
    <x-update unique="detail" :column="$column_detail" title="Detail Pesanan Alat Berat" :data="$data" idk="id"
        :select="$select" :detail="$detail">
    </x-update>
@endsection
