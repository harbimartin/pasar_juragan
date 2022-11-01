@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'status' => Provider::status_attr(),
            'm_business_category_id' => ['name' => 'Kategori Bisnis', 'type' => 'Select', 'val' => ['business_category'], 'api' => 'business_category', 'full' => true],
            'provider_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'provider_npwp' => ['name' => 'NPWP', 'type' => 'String', 'full' => true],
            'provider_website' => ['name' => 'Website', 'type' => 'String', 'full' => true],
            'file_logo' => $detail ? null : ['name' => 'Upload Logo', 'type' => 'Upload', 'accept' => 'image/*', 'key' => 'file', 'folder' => 'file_provider', 'anonymous' => true, 'mono' => true, 'full' => true],
            'provider_logo' => ['name' => 'Logo', 'type' => 'Image', 'module' => 'provider'],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="juragan-gudang" :column="$column"
        title="Registrasi Juragan {{ $data->type->provider_type_name }} ({{ $data->provider_code }})" :data="$data"
        burl="none" route="dashboard.juragan-gudang" :select="$select" idk="id" :detail="$detail">
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
