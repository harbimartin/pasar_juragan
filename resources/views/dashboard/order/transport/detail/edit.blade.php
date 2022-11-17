@extends('dashboard._index')
@section('content')
    @if ($detail)
        @php
            $column_detail = [
                // 't_truck_contract_detail_id' => ['name' => 'Tariff', 'type' => 'TextSel', 'val' => ['truck_type_desc', 'commodity_name'], 'desc' => ['origin_name', 'destination_name'], 'share' => ['origin_name' => 0, 'destination_name' => 0, 'price_per_ton' => 0, 'price_per_rit' => 0, 'minimum_ton' => 0], 'api' => 'tariff', 'full' => true],
                'contract_rpt' => ['name' => 'Tariff', 'type' => 'SString', 'child' => ['truck_type_desc', 'commodity_name'], 'full' => true],
                'origin_name' => ['by' => 'contract_rpt', 'name' => 'Asal', 'type' => 'SString'],
                'destination_name' => ['by' => 'contract_rpt', 'name' => 'Tujuan', 'type' => 'SString'],
                'price_per_ton' => ['by' => 'contract_rpt', 'name' => 'Harga Per Ton', 'type' => 'SString'],
                'price_per_rit' => ['by' => 'contract_rpt', 'name' => 'Harga Per Rit', 'type' => 'SString'],
                'minimum_ton' => ['by' => 'contract_rpt', 'name' => 'Minimum Tonase', 'type' => 'SString'],
                'picking_date' => ['name' => 'Tgl. Barang Diambil', 'type' => 'Date', 'full' => true],
                'loading' => ['name' => 'Alamat Diambil', 'type' => 'SString', 'child' => ['name'], 'full' => true],
                'loading_address' => ['by' => 'loading', 'name' => 'Alamat Diambil', 'type' => 'STextArea', 'child' => 'address', 'full' => true],
                'due_date' => ['name' => 'Target Tgl. Sampai', 'type' => 'Date', 'full' => true],
                'unloading' => ['name' => 'Alamat Penerima', 'type' => 'SString', 'child' => ['name'], 'full' => true],
                'unloading_address' => ['by' => 'unloading', 'name' => 'Alamat Diterima', 'type' => 'STextArea', 'child' => 'address', 'full' => true],
                'tonage' => ['name' => 'Tonase', 'type' => 'Number', 'step' => '0.01'],
            ];
            $column_detail = json_encode($column_detail);
        @endphp
    @else
        @php
            $column_detail = [
                't_truck_contract_detail_id' => ['name' => 'Tariff', 'type' => 'TextSel', 'val' => ['truck_type_desc', 'commodity_name'], 'desc' => ['origin_name', 'destination_name'], 'share' => ['origin_name' => 0, 'destination_name' => 0, 'price_per_ton' => 0, 'price_per_rit' => 0, 'minimum_ton' => 0], 'api' => 'tariff', 'full' => true],
                'origin_name' => ['key' => 't_truck_contract_detail_id', 'val' => 'origin_name', 'name' => 'Asal', 'type' => 'Reference'],
                'origin_destination_name' => ['key' => 't_truck_contract_detail_id', 'val' => 'destination_name', 'name' => 'Tujuan', 'type' => 'Reference'],
                'price_per_ton' => ['key' => 't_truck_contract_detail_id', 'val' => 'price_per_ton', 'name' => 'Harga Per Ton', 'type' => 'Reference'],
                'price_per_rit' => ['key' => 't_truck_contract_detail_id', 'val' => 'price_per_rit', 'name' => 'Harga Per Rit', 'type' => 'Reference'],
                'minimum_ton' => ['key' => 't_truck_contract_detail_id', 'val' => 'minimum_ton', 'name' => 'Minimum Tonase', 'type' => 'Reference'],
                'picking_date' => ['name' => 'Tgl. Barang Diambil', 'type' => 'Date', 'full' => true],
                'm_loading_address_id' => ['name' => 'Alamat Diambil', 'type' => 'TextSel', 'val' => ['name'], 'desc' => ['address'], 'share' => ['address' => 0], 'api' => 'loading', 'full' => true],
                'due_date' => ['name' => 'Target Tgl. Sampai', 'type' => 'Date', 'full' => true],
                'm_unloading_address_id' => ['name' => 'Alamat Penerima', 'type' => 'TextSel', 'val' => ['name'], 'desc' => ['address'], 'share' => ['address' => 0], 'api' => 'unloading', 'full' => true],
                'tonage' => ['name' => 'Tonase', 'type' => 'Number', 'step' => '0.01'],
            ];
            $column_detail = json_encode($column_detail);
        @endphp
    @endif
    <x-update unique="detail" :column="$column_detail" title="Detail Pesanan" :data="$data" idk="id" :select="$select"
        :detail="$detail">
    </x-update>
    @yield('more-content')
@endsection
