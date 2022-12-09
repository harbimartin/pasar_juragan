@extends('dashboard.contract.heavy.show', ['tab' => 'detail'])
@section('tab-content')
    @if (!$detail)
        @php
            $column_detail = [
                'm_heavy_equipment_id' => ['name' => 'Alat Berat', 'type' => 'TextSel', 'val' => ['equipment_code', 'equipment_brand'], 'desc' => ['equipment_desc'], 'api' => 'a2b', 'full' => true],
                'price' => ['name' => 'Harga', 'type' => 'Number', 'step' => '0.01', 'full' => true],
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
        'he' => [
            'name' => 'Alat Berat',
            'type' => 'Multi',
            'children' => [
                'a2b' => ['name' => 'Alat Berat', 'type' => 'SString', 'child' => ['equipment_code', 'equipment_brand'], 'class' => 'font-semibold border-b border-blue-600'],
                'equipment_brand' => ['by' => 'a2b', 'name' => '', 'type' => 'SString'],
            ],
        ],
        'price' => ['name' => 'Harga', 'type' => 'Number', 'format' => 'Rp. ', 'full' => true],
        'status' => $detail ? null : ['name' => 'Status', 'type' => 'State'],
        'toggle' => $detail ? null : ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => $detail ? null : ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_detail" :datas="$data->detail">
    </x-table>
@endsection
