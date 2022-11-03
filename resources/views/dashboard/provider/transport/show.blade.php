@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'provider' => ['name' => 'Juragan Gudang', 'type' => 'SString', 'child' => ['provider_name'], 'full' => true],
            'wh_name' => ['name' => 'Nama Gudang', 'type' => 'String', 'full' => true],
            'province' => ['name' => 'Provinsi', 'type' => 'SString', 'child' => ['province_code', 'province_name'], 'full' => false],
            'city' => ['name' => 'Kota', 'type' => 'SString', 'child' => ['city_name'], 'full' => false],
            'address_detail' => ['name' => 'Alamat Gudang', 'type' => 'TextArea', 'full' => true],
            'longitude' => ['name' => 'Latitude', 'type' => 'String', 'full' => false],
            'latitude' => ['name' => 'Longitude', 'type' => 'String', 'full' => false],
            'wh_pic_email' => ['name' => 'Email PIC', 'type' => 'String', 'full' => false],
            'wh_pic_telephone' => ['name' => 'No. Telp PIC', 'type' => 'String', 'full' => false],
            'wh_pic_fax' => ['name' => 'No. Fax PIC', 'type' => 'String', 'full' => false],
            'wh_pic_phone' => ['name' => 'No. Handphone PIC', 'type' => 'String', 'full' => false],
            'tdg_no' => ['name' => 'No. TDG', 'type' => 'String', 'full' => false],
            'tdg_date' => ['name' => 'Tanggal TDG', 'type' => 'Date', 'full' => false],
            'tdg_expired_date' => ['name' => 'Expired TDG', 'type' => 'Date', 'full' => false],
            'tdg_attachment' => ['name' => 'Lampiran TDG', 'type' => 'Upload', 'accept' => 'pdf/*', 'key' => 'file', 'folder' => 'file_tdg', 'mono' => true, 'full' => true],

            'category' => ['name' => 'Kategori', 'type' => 'SString', 'child' => ['wh_category'], 'api' => 'category', 'full' => true],
            'function' => ['name' => 'Tipe Fungsi', 'type' => 'SString', 'child' => ['wh_function'], 'api' => 'function', 'full' => true],
            'storage_method' => ['name' => 'Metode Penyimpanan', 'type' => 'SString', 'child' => ['wh_storage_methode'], 'api' => 'storage_methode', 'full' => true],

            'day_open' => ['name' => 'Hari & Jam Buka', 'type' => 'OpenHour', 'val' => ['name'], 'api' => 'days', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-update unique="gudang_update" :data="$data" :column="$column" title="Detail Gudang" :select="$select" idk="id"
        detail="true">
    </x-update>
@endsection
