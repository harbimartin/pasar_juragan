@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_provider_id' => ['name' => 'Juragan Gudang', 'type' => 'Select', 'val' => ['provider_name'], 'api' => 'provider', 'full' => true],
            'wh_name' => ['name' => 'Nama Gudang', 'type' => 'String', 'full' => true],
            'm_province_id' => ['name' => 'Provinsi', 'type' => 'TextSel', 'val' => ['province_code', 'province_name'], 'desc' => [], 'api' => 'province', 'full' => false],
            'm_city_id' => ['name' => 'Kota', 'type' => 'TextSel', 'val' => ['city_name'], 'desc' => [], 'api' => 'city', 'full' => false],
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
            'tdg_attachment' => ['name' => 'Upload TDG', 'type' => 'Upload', 'accept' => 'pdf/*', 'key' => 'file', 'folder' => 'file_tdg', 'mono' => true, 'full' => true],

            'm_wh_category_id' => ['name' => 'Kategori', 'type' => 'TextSel', 'val' => ['wh_category'], 'desc' => ['wh_category_desc'], 'api' => 'category', 'full' => true],
            'm_wh_function_id' => ['name' => 'Tipe Fungsi', 'type' => 'TextSel', 'val' => ['wh_function'], 'desc' => ['wh_function_desc'], 'api' => 'function', 'full' => true],
            'm_wh_storage_methode' => ['name' => 'Metode Penyimpanan', 'type' => 'TextSel', 'val' => ['wh_storage_methode'], 'desc' => ['wh_storage_methode_desc'], 'api' => 'storage_methode', 'full' => true],

            'day_open' => ['name' => 'Hari & Jam Buka', 'type' => 'OpenHour', 'val' => ['name'], 'api' => 'days', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-update unique="gudang_update" :data="$data" :column="$column" title="Update Gudang" :select="$select" idk="id">
    </x-update>
@endsection
