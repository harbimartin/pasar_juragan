@extends('dashboard.contract.warehouse.show', ['tab' => 'detail'])
@section('tab-content')
    @if (!$detail)
        @php
            $column_detail = [
                'm_warehouse_id' => ['name' => 'Gudang', 'type' => 'TextSel', 'val' => ['wh_name'], 'desc' => ['address_detail'], 'api' => 'warehouse', 'full' => true],
                'price_per_meter_daily' => ['name' => 'Harga Per Meter Perhari', 'type' => 'Number', 'step' => '0.01', 'full' => false],
                'price_per_meter_monthly' => ['name' => 'Harga Per Meter Perbulan', 'type' => 'Number', 'step' => '0.01', 'full' => false],
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
                'wh_name' => ['by' => 'warehouse', 'name' => 'Gudang', 'type' => 'SString'],
                'warehouse' => ['child' => 'address_detail', 'name' => 'Alamat', 'type' => 'STextArea'],
            ],
        ],
        'price_per_meter_daily' => ['name' => 'Harga Per Meter<br>Perhari', 'type' => 'Number', 'full' => true],
        'price_per_meter_monthly' => ['name' => 'Harga Per Meter<br>Sebulan', 'type' => 'Number', 'full' => true],
        'status' => $detail ? null : ['name' => 'Status', 'type' => 'State'],
        'toggle' => $detail ? null : ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => $detail ? null : ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_detail" :datas="$data->detail">
    </x-table>
@endsection
