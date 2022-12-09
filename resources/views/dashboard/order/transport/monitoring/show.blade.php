@extends('dashboard._index')
@section('content')
    @php
        $column_detail = [
            'status_id' => $detail ? ['by' => 'status', 'name' => 'Status', 'type' => 'CState', 'align' => 'center', 'sort' => false] : ['name' => 'Status', 'type' => 'Select', 'api' => 'status', 'val' => ['status_desc'], 'align' => 'center', 'sort' => false],
            'voucher_date' => ['name' => 'Tanggal Mulai', 'type' => 'Date'],
            'voucher_close_date' => ['name' => 'Tanggal Selesai', 'type' => 'Date'],
            'm_truck_id' => $detail ? null : ['name' => 'Truk', 'type' => 'TextSel', 'val' => ['plate_no'], 'desc' => [], 'api' => 'truck'],
            'm_driver_id' => $detail ? null : ['name' => 'Sopir', 'type' => 'TextSel', 'val' => ['driver_name'], 'desc' => ['license_no'], 'api' => 'driver'],
            'notes' => ['name' => 'Catatan', 'type' => 'TextArea', 'full' => true],
            'location' => ['name' => 'Tracking', 'type' => 'Location', 'poskey' => ['A' => 'loading', 'B' => 'unloading'], 'posicon' => ['truck.svg' => 'position'], 'lat' => 'latitude', 'lng' => 'longitude', 'full' => true],
        ];
        $column_detail = json_encode($column_detail);
    @endphp
    <x-update unique="voucher" :column="$column_detail" title="Monitoring Pesanan Truk ({{ $data->voucher_code }})"
        :data="$data" idk="id" :detail="$detail" :select="$select" route="dashboard.pesanan.juragan-angkutan.voucher">
        <div class="rounded-t-lg bg-gray-200 px-5 py-1 text-gray-900 font-semibold">
            Riwayat Truk
        </div>
        <div class="grid grid-cols-2">
            <div class="px-4 py-3 bg-gray-100 flex flex-col gap-y-2">
                <div class="font-semibold text-gray-500 py-1">Status :</div>
                @foreach ($data->log as $log)
                    <div class="px-3 py-1 rounded-lg bg-white shadow grid grid-cols-2 justify-between items-center">
                        <div
                            class="font-semibold px-2 text-{{ $log->status->color }}-600 @if ($log->status_note) border-b-2 $border-{{ $log->status->color }}-300 @endif">
                            {{ $log->status->status_desc }}
                        </div>
                        <div class="text-sm text-right">
                            {{ $log->created_at }}
                        </div>
                        @if ($log->status_note)
                            <div class="col-span-2 rounded-lg px-2 py-1 text-sm text-light">Tezt</div>
                        @endif
                    </div>
                @endforeach
            </div>
            <div class="px-4 py-3 bg-gray-100">
                <div class="font-semibold text-gray-500 py-2">Foto :</div>
                <div class="grid grid-cols-4 gap-x-3 gap-y-2">
                    @foreach ($data->file as $image)
                        <div class="bg-black w-full h-full" style="min-height:23vh;">
                            test
                            <img src="{{ $image->url }}" title="{{ $image->url }}">
                        </div>
                    @endforeach
                    @if (sizeof($data->file) == 0)
                        <div class="text-white flex font-semibold font-lg">
                            Maaf, Angkutan ini belum mengunggah foto.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-update>
    @php
        $routeName = Routing::getCurrentRouteName();
        $baseRoute = substr($routeName, 0, strrpos($routeName, '.'));
    @endphp
    <ul class="list-reset flex border-b px-2 md:px-6 mt-3 md:mt-5 text-xs md:text-base">
        @foreach ($submenu as $menu)
            <li class="mr-1">
                <a class="rounded-md bg-white inline-block py-2 px-4 font-semibold {{ $tab == $menu['key'] ? 'bg-blue-400 text-white' : '' }}"
                    href="{{ route($baseRoute . '.' . $menu['key'], Routing::getCurrentParameters()) }}">{{ $menu['name'] }}</a>
            </li>
        @endforeach
    </ul>
    @yield('tab-content')
@endsection
