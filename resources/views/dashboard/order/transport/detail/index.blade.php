@extends('dashboard.order.transport.show', ['tab' => 'detail'])
@section('tab-content')
    @if (!$detail)
        @php
            $column_detail = [
                't_truck_contract_detail_id' => ['name' => 'Tariff', 'type' => 'TextSel', 'val' => ['truck_type_desc', 'commodity_name'], 'desc' => ['origin_name', 'destination_name'], 'share' => ['origin_name' => 0, 'destination_name' => 0, 'price_per_ton' => 0, 'price_per_rit' => 0, 'minimum_ton' => 0], 'api' => 'tariff', 'full' => true],
                'origin_name' => ['key' => 't_truck_contract_detail_id', 'val' => 'origin_name', 'name' => 'Asal', 'type' => 'Reference', 'full' => false],
                'origin_destination_name' => ['key' => 't_truck_contract_detail_id', 'val' => 'destination_name', 'name' => 'Tujuan', 'type' => 'Reference', 'full' => false],
                'price_per_ton' => ['key' => 't_truck_contract_detail_id', 'val' => 'price_per_ton', 'name' => 'Harga Per Ton', 'type' => 'Reference', 'full' => false],
                'price_per_rit' => ['key' => 't_truck_contract_detail_id', 'val' => 'price_per_rit', 'name' => 'Harga Per Rit', 'type' => 'Reference', 'full' => false],
                'minimum_ton' => ['key' => 't_truck_contract_detail_id', 'val' => 'minimum_ton', 'name' => 'Minimum Tonase', 'type' => 'Reference', 'full' => false],
                'picking_date' => ['name' => 'Tgl. Barang Diambil', 'type' => 'Date', 'full' => true],
                'm_loading_address_id' => ['name' => 'Alamat Diambil', 'type' => 'TextSel', 'val' => ['name'], 'desc' => ['address'], 'share' => ['address' => 0], 'api' => 'loading', 'full' => true],
                'loading_address' => ['key' => 'm_loading_address_id', 'val' => 'address', 'name' => 'Rincian Alamat Diambil', 'type' => 'RefArea', 'desc' => ['address'], 'full' => true],
                'due_date' => ['name' => 'Target Tgl. Sampai', 'type' => 'Date', 'full' => true],
                'm_unloading_address_id' => ['name' => 'Alamat Diterima', 'type' => 'TextSel', 'val' => ['name'], 'desc' => ['address'], 'share' => ['address' => 0], 'api' => 'unloading', 'full' => true],
                'unloading_address' => ['key' => 'm_unloading_address_id', 'val' => 'address', 'name' => 'Rincian Alamat Penerima', 'type' => 'RefArea', 'desc' => ['address'], 'full' => true],
                'tonage' => ['name' => 'Tonase', 'type' => 'Number', 'step' => '0.01', 'full' => true],
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
        'plan' => [
            'name' => 'Tariff',
            'type' => 'Multi',
            'children' => [
                'origin' => ['by' => 'contract_rpt', 'name' => 'Asal', 'type' => 'CString', 'child' => ['origin_name'], 'sub' => 'Asal', 'sclass' => 'mr-auto'],
                'destination_name' => ['by' => 'contract_rpt', 'name' => 'Tujuan', 'type' => 'CString', 'child' => ['destination_name'], 'sub' => 'Tujuan', 'sclass' => 'mr-auto'],
            ],
        ],
        'truck_type' => ['by' => 'contract_rpt', 'name' => 'Tipe Truk', 'type' => 'SString', 'child' => ['truck_type_desc']],
        'commodity' => ['by' => 'contract_rpt', 'name' => 'Barang', 'type' => 'SString', 'child' => ['commodity_name']],
        'picking' => [
            'name' => 'Barang Diambil',
            'type' => 'Multi',
            'children' => [
                'unloading_name' => ['by' => 'unloading', 'name' => 'Alamat Diambil', 'type' => 'SString', 'child' => 'name', 'class' => 'font-semibold border-b border-blue-300'],
                'unloading_address' => ['by' => 'unloading', 'name' => 'Alamat Diambil', 'type' => 'STextArea', 'child' => 'address'],
                'picking_date' => ['name' => 'Barang Diambil', 'type' => 'Date', 'class' => 'font-semibold text-xs text-gray-500 pt-1 text-right'],
            ],
        ],
        'unload' => [
            'name' => 'Barang Sampai',
            'type' => 'Multi',
            'children' => [
                'loading_name' => ['by' => 'loading', 'name' => 'Alamat Diambil', 'type' => 'SString', 'child' => 'name', 'class' => 'font-semibold border-b border-blue-300'],
                'loading_address' => ['by' => 'loading', 'name' => 'Alamat Diambil', 'type' => 'STextArea', 'child' => 'address'],
                'due_date' => ['name' => 'Barang Diambil', 'type' => 'Date', 'class' => 'font-semibold text-xs text-gray-500 pt-1 text-right'],
            ],
        ],

        'tonage' => ['name' => 'Tonase', 'type' => 'Number', 'step' => '0.01', 'full' => true],
        'estimate_truck_required' => ['name' => 'Estimasi Truk Diperlukan', 'type' => 'String', 'align' => 'center'],
        'order_note' => ['name' => 'Catatan', 'type' => 'TextArea', 'empty' => 'Tidak ada Catatan'],
        // 'status' => $detail ? null : ['name' => 'Status', 'type' => 'State'],
        // 'toggle' => $detail ? null : ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'delete' => $detail ? null : ['name' => 'Action', 'type' => 'Delete', 'align' => 'center', 'sort' => false],
        'act' => $detail ? null : ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_detail" :datas="$data->detail">
    </x-table>
@endsection
