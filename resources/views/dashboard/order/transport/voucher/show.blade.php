@extends('dashboard._index')
@section('content')
    @php
        $column_detail = [
            'status_id' => $detail ? ['by' => 'status', 'name' => 'Status', 'type' => 'CState', 'align' => 'center', 'child'=>['status_desc'], 'sort' => false, 'full'=>true] : ['name' => 'Status', 'type' => 'Select', 'api' => 'status', 'val' => ['status_desc'], 'align' => 'center', 'sort' => false, 'full'=>true],
            'voucher_date' => ['name' => 'Tanggal Mulai', 'type' => 'Date'],
            'voucher_close_date' => ['name' => 'Tanggal Selesai', 'type' => 'Date'],
            'plate_no' => ['name' => 'No. Plat', 'type' => 'String'],
            'driver_name' => ['name' => 'Nama Driver', 'type' => 'String'],
            'm_truck_id' => $detail ? null : ['name' => 'Truk', 'type' => 'TextSel', 'val' => ['plate_no'], 'desc' => [], 'api' => 'truck'],
            'm_driver_id' => $detail ? null : ['name' => 'Sopir', 'type' => 'TextSel', 'val' => ['driver_name'], 'desc' => ['license_no'], 'api' => 'driver'],
            'notes' => ['name' => 'Catatan', 'type' => 'TextArea', 'full' => true],
        ];
        $column_detail = json_encode($column_detail);
    @endphp
    <x-update unique="voucher" :column="$column_detail" title="Pesanan Truk ({{ $data->voucher_code }})" :data="$data" idk="id"
        :detail="$detail" :select="$select" route="dashboard.pesanan.juragan-angkutan.voucher">
    </x-update>
    @php
        $routeName = Routing::getCurrentRouteName();
        $baseRoute = substr($routeName, 0, strrpos($routeName, '.'));
    @endphp
    <ul class="list-reset flex border-b px-2 md:px-6 mt-3 md:mt-5 text-xs md:text-base">
        @foreach ($submenu as $menu)
            <li class="mr-1">
                <a class="rounded-md bg-white inline-block py-2 px-4 font-semibold {{ $tab == $menu['key'] ? 'bg-blue-400 text-white' : '' }}"
                    href="{{ route($baseRoute . '.' . $menu['key'], $data->id) }}">{{ $menu['name'] }}</a>
            </li>
        @endforeach
    </ul>
    @yield('tab-content')
@endsection
