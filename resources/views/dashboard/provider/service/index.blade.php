@extends('dashboard.provider.index', ['tab' => 'service'])
@section('tab-content')
    @php
        $column_service = [
            'service_title' => ['name' => 'Judul Service', 'type' => 'String', 'rows' => 4, 'full' => true],
            'service_desc' => ['name' => 'Deskripsi Service', 'type' => 'TextArea', 'full' => true],
            'service_reference' => ['name' => 'Referensi Service', 'type' => 'String', 'full' => true, 'placeholder'=>"Contoh : Domain Website, Akun Sosial Media dan lain-lain."],
        ];
        $column_service = json_encode($column_service);
    @endphp

    <x-add unique="provider" :column="$column_service" title="Tambah Service Juragan" :data="$data" :select="$select" idk="id">
    </x-add>

    <?php
    $table_service = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'service_title' => ['name' => 'Judul', 'type' => 'String'],
        'service_desc' => ['name' => 'Deskripsi', 'type' => 'String'],
        'service_reference' => ['name' => 'Referensi', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center', 'value' => 'toggle-comp_contact'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'route' => 'dashboard.profile-company.service.edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_service" :datas="$data->service">
    </x-table>
@endsection
