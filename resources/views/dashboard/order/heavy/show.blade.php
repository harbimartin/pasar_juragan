@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'status' => Provider::status_attr(),
            't_he_contract_id' => $detail ? null : ['name' => 'Kontrak', 'type' => 'TextSel', 'val' => ['contract_no', 'contract_desc'], 'desc' => ['contract_desc'], 'share' => ['contract_desc' => 0, 'contract_date' => 0, 'contract_expired' => 0], 'api' => 'contract', 'full' => true],
            'contract_desc' => $detail ? null : ['key' => 't_he_contract_id', 'val' => 'contract_desc', 'name' => 'Deskripsi Kontrak', 'type' => 'RefArea', 'full' => true],
            'contract_date' => $detail ? null : ['key' => 't_he_contract_id', 'val' => 'contract_date', 'name' => 'Tanggal Kontrak', 'type' => 'Reference', 'full' => true],
            'contract_expired' => $detail ? null : ['key' => 't_he_contract_id', 'val' => 'contract_expired', 'name' => 'Tgl Kadaluarsa Kontrak', 'type' => 'Reference', 'full' => true],
            // 'heo_no' => ['name' => 'No.', 'type' => 'String', 'full' => true],
            'heo_desc' => ['name' => 'Deskripsi', 'type' => 'TextArea', 'full' => true],
            'heo_date' => ['name' => 'Tgl Order', 'type' => 'Date', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="kontrak-alatberat" :column="$column" title="Pesanan Alat Berat ({{ $data->heo_no }})"
        :data="$data" burl="none" route="dashboard.pesanan-alatberat" :select="$select" idk="id" :detail="$detail">

        <?php
        $timelines = [
            'log' => [
                'proposed' => ['title' => 'Pengajuan', 'col' => 'blue-500', 'name' => 'Diajukan', 'by' => 'Juragan'],
                'approved' => ['title' => 'Persetujuan', 'col' => 'blue-500', 'name' => 'Disetujui', 'by' => 'Juragan'],
            ],
        ];
        $on_next = '';
        ?>
        <x-popup-button key="propose" color="blue" name="Propose" show="{{ $data->status == 'Draft' }}"></x-popup-button>
        <x-popup-header>
            <x-slot name="content">
                <x-popup-content name="Propose" key="propose" color="blue">
                    Apa anda yakin ingin melakukan propose {{ $data->provider_code }} ?
                </x-popup-content>
            </x-slot>
            <x-slot name="submit">
                <x-popup-submit name="Propose" key="propose" color="blue" route="dashboard.kontrak-barang"></x-popup-submit>
            </x-slot>
        </x-popup-header>
        @if ($data->status != 'Draft')
            <x-history :timelines="$timelines" :data="$data" module="Pesanan"></x-history>
        @endif
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
