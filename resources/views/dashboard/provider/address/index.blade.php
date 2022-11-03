@extends('dashboard.provider.index', ['tab' => 'address'])
@section('tab-content')
    @if (!$detail)
        @php
            $column_address = [
                'provider_address_detail' => ['name' => 'Alamat', 'type' => 'TextArea', 'rows' => 4, 'full' => true],
                'provider_province' => ['name' => 'Provinsi', 'type' => 'TextSel', 'val' => ['province_code', 'province_name'], 'desc' => [], 'api' => 'province', 'full' => false],
                'provider_city' => ['name' => 'Kota', 'type' => 'TextSel', 'val' => ['city_name'], 'desc' => [], 'api' => 'city', 'full' => false],
                'provider_country' => ['name' => 'Negara', 'type' => 'String', 'full' => true],
            ];
            $column_address = json_encode($column_address);
        @endphp

        <x-add unique="provider" :column="$column_address" title="Tambah Alamat Juragan" :data="$data" :select="$select"
            idk="id">
        </x-add>
    @endif

    <?php
    $table_address = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'provider_address_detail' => ['name' => 'Alamat', 'type' => 'TextArea'],
        'city' => ['name' => 'Kota', 'type' => 'SString', 'child' => ['city_name']],
        'province' => ['name' => 'Provinsi', 'type' => 'SString', 'child' => ['province_code', 'province_name']],
        'country' => ['name' => 'Negara', 'type' => 'SString', 'child' => ['city_name']],
        'status' => $detail ? null : ['name' => 'Status', 'type' => 'State'],
        'toggle' => $detail ? null : ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => $detail ? null : ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_address" :datas="$data->address">
    </x-table>
@endsection
