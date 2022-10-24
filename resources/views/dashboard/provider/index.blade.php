@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'status' => Provider::status_attr(),
            'm_business_category_id' => ['name' => 'Kategori Bisnis', 'type' => 'Select', 'val' => ['business_category'], 'api' => 'business_category', 'full' => true],
            'provider_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'provider_npwp' => ['name' => 'NPWP', 'type' => 'String', 'full' => true],
            'provider_website' => ['name' => 'Website', 'type' => 'String', 'full' => true],
            'file_logo' => ['name' => 'Upload Logo', 'type' => 'Upload', 'accept' => 'image/*', 'key' => 'file', 'folder' => 'file_provider', 'anonymous' => true, 'mono' => true, 'full' => true],
            'provider_logo' => ['name' => 'Logo', 'type' => 'Image', 'module' => 'provider'],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="juragan-gudang" :column="$column" title="Registrasi Juragan Gudang ({{ $data->provider_code }})"
        :data="$data" burl="none" route="dashboard.juragan-gudang" :select="$select" idk="id">
        <x-popup-button key="propose" color="blue" name="Propose" show="{{ $data->status == 'Draft' }}"></x-popup-button>
        <x-popup-header>
            <x-slot name="content">
                <x-popup-content name="Propose" key="propose" color="blue">
                    Apa anda yakin ingin melakukan propose {{ $data->provider_code }} ?
                </x-popup-content>
            </x-slot>
            <x-slot name="submit">
                <x-popup-submit name="Propose" key="propose" color="blue" route="dashboard.juragan-gudang"></x-popup-submit>
            </x-slot>
        </x-popup-header>
    </x-update>
    <ul class="list-reset flex border-b px-2 md:px-6 mt-3 md:mt-5 text-xs md:text-base">
        <li class="mr-1">
            <a class="rounded-md bg-white inline-block py-2 px-4 font-semibold {{ $tab == 'address' ? 'bg-blue-400 text-white' : '' }}"
                href="{{ route('dashboard.juragan-gudang.address', $data->id) }}">Address</a>
        </li>
        <li class="mr-1">
            <a class="rounded-md bg-white inline-block py-2 px-4 font-semibold {{ $tab == 'contact' ? 'bg-blue-400 text-white' : '' }}"
                href="{{ route('dashboard.juragan-gudang.contact', $data->id) }}">Contact</a>
        </li>
        <li class="mr-1">
            <a class="rounded-md bg-white inline-block py-2 px-4 font-semibold {{ $tab == 'document' ? 'bg-blue-400 text-white' : '' }}"
                href="{{ route('dashboard.juragan-gudang.document', $data->id) }}">Document</a>
        </li>
        <li class="mr-1">
            <a class="rounded-md bg-white inline-block py-2 px-4 font-semibold {{ $tab == 'service' ? 'bg-blue-400 text-white' : '' }}"
                href="{{ route('dashboard.juragan-gudang.service', $data->id) }}">Service</a>
        </li>
    </ul>

    @yield('tab-content')
@endsection
