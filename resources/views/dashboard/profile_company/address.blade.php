@extends('dashboard.profile_company.index')
@section('tab-content')
    @php
        $column_address = [
            'comp_address_detail' => ['name' => 'Alamat', 'type' => 'TextArea', 'rows'=>4, 'full' => true],
            'comp_city' => ['name' => 'Kota', 'type' => 'String', 'full' => true],
            'comp_province' => ['name' => 'Provinsi', 'type' => 'String', 'full' => true],
            'comp_country' => ['name' => 'Negara', 'type' => 'String', 'full' => true, 'lock' => true],
        ];
        $column_address = json_encode($column_address);
    @endphp

    <x-add unique="company_address" :column="$column_address" title="Tambah Alamat Perusahaan" :data="$data" :select="$select"
        idk="id">
    </x-add>

    <?php
    $table_address = json_encode([
        'index' => [ "name"=>"No.", "type"=>"Index"],
        'comp_address_detail' => [ "name"=>"Alamat", "type"=>"TextArea"],
        'comp_city' => [ "name"=>"Kota", "type"=>"String"],
        'comp_provice' => [ "name"=>"Provinsi", "type"=>"String"],
        'comp_country' => [ "name"=>"Negara", "type"=>"String"],
        'status'=>[ 'name'=>"Status", 'type'=>"State" ],
        'toggle'=>[ 'by'=>'status', 'name'=>"Aktifkan", 'type'=>'Toggle', 'sort'=>false, 'align'=>'center', 'value'=>'toggle-comp_contact'],
        'act'=>[ 'name'=>"Action", 'type' => 'Edit', 'route'=>"dashboard.company-profile.address.edit", 'align'=>'center', 'sort'=>false]
    ]);
    ?>
    <x-table :lim="false" :column="$table_address" :datas="$data->address">
    </x-table>
@endsection
