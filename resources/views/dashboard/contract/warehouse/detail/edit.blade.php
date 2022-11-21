@extends('dashboard._index')
@section('content')
    @php
        $column_detail = [
            'm_warehouse_id' => ['name' => 'Gudang', 'type' => 'TextSel', 'val' => ['wh_name', 'wh_desc'], 'desc' => [], 'api' => 'warehouse', 'full' => true],
            'price_per_meter_daily' => ['name' => 'Harga Per Meter Perhari', 'type' => 'Number', 'step' => '0.01', 'full' => false],
            'price_per_meter_monthly' => ['name' => 'Harga Per Meter Perbulan', 'type' => 'Number', 'step' => '0.01', 'full' => false],
        ];
        $column_detail = json_encode($column_detail);
    @endphp
    <x-update unique="address" :column="$column_detail" title="Address" :data="$data" idk="id" :select="$select">
    </x-update>
@endsection
