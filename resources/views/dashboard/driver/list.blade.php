@extends('dashboard._index')
@section('content')
    <?php
    $table_angkutan = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'driver_name' => ['name' => 'Nama Sopir', 'type' => 'String'],
        'phone' => ['name' => 'Telepon', 'type' => 'String'],
        'email' => ['name' => 'Email', 'type' => 'String'],
        'attribute' => [
            'name' => 'Lisensi (SIM)',
            'type' => 'Multi',
            'children' => [
                'license_no' => ['name' => 'No. Lisensi', 'type' => 'String', 'class' => 'text-gray-700 font-semibold border-b border-blue-500'],
                'expired_license' => ['name' => 'Expired', 'type' => 'String'],
            ],
        ],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'route' => 'dashboard.transport.list', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :column="$table_angkutan" :datas="$data" :prop="$prop" :selfilter="$sel_filter">
    </x-table>
@endsection
