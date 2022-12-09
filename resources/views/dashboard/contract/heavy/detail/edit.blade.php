@extends('dashboard._index')
@section('content')
    @php
        $column_detail = [
            'm_heavy_equipment_id' => ['name' => 'Alat Berat', 'type' => 'TextSel', 'val' => ['equipment_code', 'equipment_brand'], 'desc' => ['equipment_desc'], 'api' => 'a2b', 'full' => true],
            'price' => ['name' => 'Harga', 'type' => 'Number', 'step' => '0.01', 'full' => true],
        ];
        $column_detail = json_encode($column_detail);
    @endphp
    <x-update unique="address" :column="$column_detail" title="Address" :data="$data" idk="id" :select="$select">
    </x-update>
@endsection
