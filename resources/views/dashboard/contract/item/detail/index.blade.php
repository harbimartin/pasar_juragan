@extends('dashboard.contract.item.show', ['tab' => 'detail'])
@section('tab-content')
    @if (!$detail)
        @php
            $column_detail = [
                'm_origin_id' => ['name' => 'Asal', 'type' => 'TextSel', 'val' => ['origin_name', 'origin_desc'], 'desc' => [], 'api' => 'origin', 'full' => false],
                'm_destination_id' => ['name' => 'Tujuan', 'type' => 'TextSel', 'val' => ['destination_name', 'destination_desc'], 'desc' => [], 'api' => 'destination', 'full' => false],
                'm_truck_type_id' => ['name' => 'Tipe Truk', 'type' => 'TextSel', 'val' => ['truck_type'], 'desc' => [], 'api' => 'truck_type', 'full' => false],
                'm_commodity_id' => ['name' => 'Barang', 'type' => 'TextSel', 'val' => ['commodity_name', 'commodity_desc'], 'desc' => [], 'api' => 'commodity', 'full' => false],
                'price_per_ton' => ['name' => 'Harga Per Ton', 'type' => 'Number', 'step' => '0.01', 'full' => true],
                'price_per_rit' => ['name' => 'Harga Per Rit', 'type' => 'Number', 'step' => '0.01', 'full' => true],
                'minimum_ton' => ['name' => 'Minimum Tonase', 'type' => 'Number', 'step' => '0.01', 'full' => true],
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
        'origin' => ['name' => 'Asal', 'type' => 'SString', 'child' => 'origin_name'],
        'destination' => ['name' => 'Tujuan', 'type' => 'SString', 'child' => ['destination_name']],
        'truck_type' => ['name' => 'Tipe Truk', 'type' => 'SString', 'child' => ['truck_type']],
        'commodity' => ['name' => 'Barang', 'type' => 'SString', 'child' => ['commodity_name']],
        'price_per_ton' => ['name' => 'Harga Per Ton', 'type' => 'Number', 'full' => true],
        'price_per_rit' => ['name' => 'Harga Per Rit', 'type' => 'Number', 'full' => true],
        'minimum_ton' => ['name' => 'Minimum Tonase', 'type' => 'Number', 'full' => true],
        'status' => $detail ? null : ['name' => 'Status', 'type' => 'State'],
        'toggle' => $detail ? null : ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => $detail ? null : ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_detail" :datas="$data->detail">
    </x-table>
@endsection
