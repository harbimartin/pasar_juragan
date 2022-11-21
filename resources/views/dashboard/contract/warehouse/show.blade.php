@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'status' => Provider::status_attr(),
            'juragan_gudang_id' => ['name' => 'Juragan Gudang', 'type' => 'Select', 'val' => ['provider_name'], 'api' => 'gudang', 'full' => true],
            'juragan_barang_id' => ['name' => 'Juragan Barang', 'type' => 'Select', 'val' => ['comp_name'], 'api' => 'barang', 'full' => true],
            'contract_no' => ['name' => 'No. Kontrak', 'type' => 'String', 'full' => true],
            'contract_desc' => ['name' => 'Judul Kontrak', 'type' => 'String', 'full' => true],
            'contract_date' => ['name' => 'Tanggal Kontrak', 'type' => 'Date', 'full' => true],
            'contract_expired' => ['name' => 'Tanggal Expired', 'type' => 'Date', 'full' => true],
            'doc' => ['name' => 'Upload Lampiran', 'type' => 'Upload', 'accept' => 'application/pdf', 'key' => 'file', 'folder' => 'file_contract', 'desc_key' => 'doc_name', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="kontrak-gudang" :column="$column" title="Kontrak Barang" :data="$data" burl="none"
        route="dashboard.kontrak-gudang" :select="$select" idk="id" :detail="$detail">
        <x-popup-button key="propose" color="blue" name="Propose" show="{{ $data->status == 'Draft' }}"></x-popup-button>
        <x-popup-header>
            <x-slot name="content">
                <x-popup-content name="Propose" key="propose" color="blue">
                    Apa anda yakin ingin melakukan propose {{ $data->provider_code }} ?
                </x-popup-content>
            </x-slot>
            <x-slot name="submit">
                <x-popup-submit name="Propose" key="propose" color="blue" route="dashboard.kontrak-gudang"></x-popup-submit>
            </x-slot>
        </x-popup-header>
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
