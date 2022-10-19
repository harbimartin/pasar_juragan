@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'comp_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'comp_npwp' => ['name' => 'NPWP', 'type' => 'String', 'full' => true, 'lock' => true],
            'comp_website' => ['name' => 'Website', 'type' => 'String', 'full' => true],
            'm_business_category_id' => ['name' => 'Kategori Bisnis', 'type' => 'Select', 'val' => ['business_category'], 'api' => 'business_category', 'full' => true],
            'comp_logo' => ['name' => 'Logo', 'type' => 'Image', 'folder' => 'file_logo'],
            'file_logo' => ['name' => 'Upload Logo', 'type' => 'Upload', 'accept' => 'image/*', 'key' => 'file', 'folder' => 'comp_logo', 'mono' => true, 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="profile_company" :column="$column" title="Profil Perusahaan" :data="$data" burl="none"
        :select="$select" idk="id">
    </x-update>

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
        'index' => [ "name"=>"No.", "type"=>"Index"],
        'type' => [ "name"=>"Tipe Kontak", "type"=>"SString", "child"=>["contact_type"]],
        'tgl_um' => [
            'name' => 'Nama/Posisi',
            'type' => 'Multi',
            'children' => [
                'comp_contact_name' => ['type' => 'String', 'iclass' => 'font-semibold text-gray-600'],
                'comp_contact_position' => [ "name"=>"Nama Kontak", "type"=>"Index"]
            ],
        ],
        'comp_contact' => [ "name"=>"Kontak", "type"=>"String"],
        'status'=>[ 'name'=>"Status", 'type'=>"State" ],
        'toggle'=>[ 'by'=>'status', 'name'=>"Aktifkan", 'type'=>'Toggle', 'sort'=>false, 'align'=>'center', 'value'=>'toggle-comp_contact'],
        'act'=>[ 'name'=>"Action", 'type' => 'Edit', 'route'=>"dashboard.company-profile.contact.edit", 'align'=>'center', 'sort'=>false]
    ]);
    ?>
    <x-table :lim="false" :column="$table_contact" :datas="$data->contact">
    </x-table>

    {{-- SECTION ADDRESS --}}

    @php
        $column_address = [
            'comp_address_detail' => ['name' => 'Alamat', 'type' => 'TextArea', 'rows'=>4, 'full' => true],
            'comp_city' => ['name' => 'Kota', 'type' => 'String', 'full' => true],
            'comp_province' => ['name' => 'Provinsi', 'type' => 'String', 'full' => true],
            'comp_country' => ['name' => 'Negara', 'type' => 'String', 'full' => true, 'lock' => true],
        ];
        $column_address = json_encode($column_address);
    @endphp

    <x-add unique="company_contact" :column="$column_address" title="Tambah Alamat Perusahaan" :data="$data" :select="$select"
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
