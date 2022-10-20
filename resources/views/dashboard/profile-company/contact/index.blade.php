@extends('dashboard.profile-company.index', ['tab' => 'contact'])
@section('tab-content')
    @php
        $column_contact = [
            'm_contact_type_id' => ['name' => 'Tipe Kontak', 'type' => 'Select', 'val' => ['contact_type'], 'api' => 'contact_type', 'full' => true],
            'comp_contact_name' => ['name' => 'Nama Kontak', 'type' => 'String', 'full' => true],
            'comp_contact_position' => ['name' => 'Posisi Kontak', 'type' => 'String', 'full' => true, 'lock' => true],
            'comp_contact' => ['name' => 'Kontak', 'type' => 'String', 'full' => true],
        ];
        $column_contact = json_encode($column_contact);
    @endphp
    <x-add unique="company_contact" :column="$column_contact" title="Tambah Kontak Perusahaan" :data="$data" :select="$select"
        idk="id">
    </x-add>

    <?php
    $table_contact = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'type' => ['name' => 'Tipe Kontak', 'type' => 'SString', 'child' => ['contact_type']],
        'tgl_um' => [
            'name' => 'Nama/Posisi',
            'type' => 'Multi',
            'children' => [
                'comp_contact_name' => ['type' => 'String', 'iclass' => 'font-semibold text-gray-600'],
                'comp_contact_position' => ['name' => 'Nama Kontak', 'type' => 'Index'],
            ],
        ],
        'comp_contact' => ['name' => 'Kontak', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'route' => 'dashboard.profile-company.contact.edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_contact" :datas="$data->contact">
    </x-table>
@endsection
