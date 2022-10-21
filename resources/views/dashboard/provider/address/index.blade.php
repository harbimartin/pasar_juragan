@extends('dashboard.provider.index', ['tab' => 'address'])
@section('tab-content')
    @php
        $column_address = [
            'provider_address_detail' => ['name' => 'Alamat', 'type' => 'TextArea', 'rows' => 4, 'full' => true],
            'provider_city' => ['name' => 'Kota', 'type' => 'String', 'full' => true],
            'provider_province' => ['name' => 'Provinsi', 'type' => 'String', 'full' => true],
            'provider_country' => ['name' => 'Negara', 'type' => 'String', 'full' => true],
        ];
        $column_address = json_encode($column_address);
    @endphp

    <x-add unique="provider" :column="$column_address" title="Tambah Alamat Juragan Gudang" :data="$data" :select="$select"
        idk="id">
    </x-add>

    <?php
    $table_address = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'provider_address_detail' => ['name' => 'Alamat', 'type' => 'TextArea'],
        'provider_city' => ['name' => 'Kota', 'type' => 'String'],
        'provider_province' => ['name' => 'Provinsi', 'type' => 'String'],
        'provider_country' => ['name' => 'Negara', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_address" :datas="$data->address">
    </x-table>
@endsection
