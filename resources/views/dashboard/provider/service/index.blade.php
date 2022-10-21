@extends('dashboard.provider.index', ['tab' => 'service'])
@section('tab-content')
    @php
        $column_service = [
            'comp_service_detail' => ['name' => 'Alamat', 'type' => 'TextArea', 'rows' => 4, 'full' => true],
            'comp_city' => ['name' => 'Kota', 'type' => 'String', 'full' => true],
            'comp_province' => ['name' => 'Provinsi', 'type' => 'String', 'full' => true],
            'comp_country' => ['name' => 'Negara', 'type' => 'String', 'full' => true],
        ];
        $column_service = json_encode($column_service);
    @endphp

    <x-add unique="provider" :column="$column_service" title="Tambah Alamat Perusahaan" :data="$data" :select="$select" idk="id">
    </x-add>

    <?php
    $table_service = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'comp_service_detail' => ['name' => 'Alamat', 'type' => 'TextArea'],
        'comp_city' => ['name' => 'Kota', 'type' => 'String'],
        'comp_provice' => ['name' => 'Provinsi', 'type' => 'String'],
        'comp_country' => ['name' => 'Negara', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'route' => 'dashboard.profile-company.service.edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_service" :datas="$data->service">
    </x-table>
@endsection
