@extends('admin._index')
@section('content')
    <?php
    $title = 'REGISTRASI JURAGAN GUDANG';
    $code = 'Kode';
    $isVerify = false;
    $hasVFile = [];
    $sort = false;
    ?>
    <form action="{{ Routing::getUpdateWithID($data->id, 'admin.gudang.regist') }}" method="POST"
        class="md:px-3 text-sm md:text-base" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="absolute m-2 md:m-4">
            <a class="inline-flex rounded-3xl border px-3 bg-gray-500 hover:bg-blue-400 transition mr-5 cursor-pointer text-white md:text-base"
                type="button" href="{{ url()->previous() }}">
                <svg class="my-auto mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="20" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path
                        d="M5.83 5.146a.5.5 0 0 0 0 .708L7.975 8l-2.147 2.146a.5.5 0 0 0 .707.708l2.147-2.147 2.146 2.147a.5.5 0 0 0 .707-.708L9.39 8l2.146-2.146a.5.5 0 0 0-.707-.708L8.683 7.293 6.536 5.146a.5.5 0 0 0-.707 0z" />
                    <path
                        d="M13.683 1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-7.08a2 2 0 0 1-1.519-.698L.241 8.65a1 1 0 0 1 0-1.302L5.084 1.7A2 2 0 0 1 6.603 1h7.08zm-7.08 1a1 1 0 0 0-.76.35L1 8l4.844 5.65a1 1 0 0 0 .759.35h7.08a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1h-7.08z" />
                </svg>
                <span class="my-2 font-semibold"> Kembali</span>
            </a>
        </div>
        <div class="container md:rounded-lg shadow my-3 py-7 md:px-3 bg-white">
            {{-- Table Uang Muka : BEGIN --}}
            {{-- <img src="{{ url('/assets/logo.png') }}" class="mx-auto w-32 md:w-48"> --}}
            <h1 class="border-gray-200 mt-5 underline font-bold text-center">{{ $title }}</h1>
            <p class="text-center text-xs md:text-sm">No. {{ $code }}: {{ $data->id }}</p>
            <div class="mt-8 ml-1 md:w-1/3 text-sm md:text-base">
                <span class="text-gray-500 font-semibold">Rincian Juragan</span>
            </div>
            <div class="px-3">
                <div class="mt-2 text-gray-700">
                    @php
                        $attr = [
                            'category' => ['name' => 'Jenis Bisnis', 'type' => 'SString', 'child' => 'business_category'],
                            'provider_code' => ['name' => 'Kode Juragan'],
                            'provider_name' => ['name' => 'Alasan'],
                            'provider_npwp' => ['name' => 'NPWP'],
                            'provider_website' => ['name' => 'Website'],
                            'provider_logo' => ['name' => 'Logo'],
                        ];
                    @endphp
                    <table>
                        @foreach ($attr as $ak => $at)
                            <tr>
                                <td class="pr-6 font-semibold text-xs md:text-sm text-gray-500">{{ $at['name'] }}</td>
                                <td class="w-3">:</td>
                                <td class="text-xs md:text-base">
                                    @switch($at['type'] ?? null)
                                        @case('Money')
                                            @if ($data[$ak] == null)
                                                -
                                            @else
                                                {{ 'Rp.' . number_format($data[$ak], 2, ',', '.') }}
                                            @endif
                                        @break

                                        @case('Date')
                                            {{ date('j F Y', strtotime($data[$ak])) }}
                                        @break

                                        @case('SString')
                                            {{ $data[$ak][$at['child']] }}
                                        @break

                                        @default
                                            {{ $data[$ak] }}
                                        @break
                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="px-3">
                @yield('detail')
            </div>
            {{-- Lampiran User, History Verifikasi & History Pending : BEGIN --}}
            <?php
            $column_address = [
                'index' => ['name' => 'No.', 'type' => 'Index'],
                'provider_address_detail' => ['name' => 'Alamat', 'type' => 'TextArea'],
                'provider_city' => ['name' => 'Kota', 'type' => 'String'],
                'provider_province' => ['name' => 'Provinsi', 'type' => 'String'],
                'provider_country' => ['name' => 'Negara', 'type' => 'String'],
                'status' => ['name' => 'Status', 'type' => 'State'],
            ];
            $column_contact = [
                'index' => ['name' => 'No.', 'type' => 'Index'],
                'type' => ['name' => 'Tipe Kontak', 'type' => 'SString', 'child' => ['contact_type']],
                'tgl_um' => [
                    'name' => 'Nama/Posisi',
                    'type' => 'Multi',
                    'children' => [
                        'provider_contact_name' => ['type' => 'String', 'iclass' => 'font-semibold text-gray-600'],
                        'provider_contact_position' => ['name' => 'Nama Kontak', 'type' => 'String'],
                    ],
                ],
                'provider_contact' => ['name' => 'Kontak', 'type' => 'String'],
                'status' => ['name' => 'Status', 'type' => 'State'],
            ];
            $column_document = [
                'index' => ['name' => 'No.', 'type' => 'Index'],
                'doc_no' => ['name' => 'No. Dokumen', 'type' => 'String', 'full' => true],
                'doc_date' => ['name' => 'Tgl. Dokumen', 'type' => 'String', 'full' => true],
                'doc_expired' => ['name' => 'Tgl. Kadaluarsa', 'type' => 'String', 'full' => true],
                'doc_attachment' => ['name' => 'Lampiran', 'type' => 'Upload', 'folder' => 'file_provider'],
                'status' => ['name' => 'Status', 'type' => 'State'],
            ];
            $column_service = [
                'index' => ['name' => 'No.', 'type' => 'Index'],
                'service_title' => ['name' => 'Judul', 'type' => 'String'],
                'service_desc' => ['name' => 'Deskripsi', 'type' => 'String'],
                'service_reference' => ['name' => 'Referensi', 'type' => 'String'],
                'status' => ['name' => 'Status', 'type' => 'State'],
            ];
            $tables = [['title' => 'Address', 'data' => $data->address, 'column' => $column_address], ['title' => 'Contact', 'data' => $data->contact, 'column' => $column_contact], ['title' => 'Document', 'data' => $data->document, 'column' => $column_document], ['title' => 'Service', 'data' => $data->service, 'column' => $column_service]];
            ?>
            @if (sizeof($tables) > 0)
                @foreach ($tables as $table)
                    <div class="mt-8 ml-1 md:w-1/3 text-sm md:text-base">
                        <span class="text-gray-500 font-semibold">{{ $table['title'] }}</span>
                    </div>
                    <div class="flex flex-col mt-1">
                        <div class="-my-2 overflow-x-auto">
                            <div class="py-2 align-middle inline-block min-w-full lg:px-1">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50 md:tracking-wider text-gray-500 text-xs md:text-sm">
                                            <tr>
                                                @foreach ($table['column'] as $key => $param)
                                                    <th
                                                        class="px-2 py-3 uppercase {{ isset($param['align']) ? 'text-' . $param['align'] : '' }} {{ isset($param['class']) ? $param['class'] : '' }} {{ isset($param['bolder']) ? 'font-semibold' : 'font-medium' }}">
                                                        {!! $param['name'] !!}
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200 text-xs md:text-sm text-gray-900">
                                            @if (sizeof($table['data']) == 0)
                                                <tr>
                                                    <td colspan="100%" height="50"
                                                        class="text-center bg-gray-50 text-gray-400">
                                                        <div class="inline-block  py-5">
                                                            <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg"
                                                                width="32" height="32" fill="currentColor"
                                                                class="bi bi-inbox" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .496-.438L14.933 9zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .105.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z" />
                                                            </svg>
                                                            <div>Tidak Ada Data</div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endif
                                            @foreach ($table['data'] as $iind => $item)
                                                <tr class="text-gray-900 text-xs md:text-sm">
                                                    @foreach ($table['column'] as $key => $param)
                                                        <td
                                                            class="@if ($sort) pr-3 @endisset py-4 px-2 whitespace-nowrap {{ isset($param['align']) ? 'text-' . $param['align'] : ($param['type'] == 'State' || $param['type'] == 'Boolean' || $param['type'] == 'Edit' ? 'text-center' : '') }} @isset($param->if){{ ($item[$param->if[0]] == $param->if[1]) == $param->if[2] ? '' : 'hidden' }}@endisset @isset($param->shrink) @if ($param->shrink) shrink @endif @endisset">
                                                            @switch($param['type'])
                                                                @case('Multi')
                                                                    @foreach ($param['children'] as $ckey => $cparam)
                                                                        <x-tswitch :key="$ckey" :param="(object) $cparam"
                                                                            :item="$item" :iind="$iind"></x-tswitch>
                                                                    @endforeach
                                                                @break

                                                                @case('Index')
                                                                    <div class="mr-3">
                                                                        {{ $iind + 1 }}
                                                                    </div>
                                                                @break

                                                                @default
                                                                    <x-tswitch :key="$key" :param="(object) $param" :item="$item"
                                                                        :iind="$iind"></x-tswitch>
                                                                @break
                                                            @endswitch
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            <div class="flex mt-10">
                <div class="md:inline-flex mx-auto">
                    <div class="flex mt-2 md:mt-0 gap-2">
                        <x-popup-button-mid key="pending" color="yellow" name="Pending" :show="$data->status == 'Proposed'">
                        </x-popup-button-mid>
                        <x-popup-button-mid key="approve" color="green" name="Setujui" :show="$data->status == 'Proposed'">
                        </x-popup-button-mid>
                    </div>
                </div>
            </div>
            <x-popup-header>
                <x-slot name="content">
                    <x-popup-content name="Pending" key="pending" color="yellow">
                        Apa anda yakin ingin melakukan pending pada Juragan {{ $data->provider_code }} ?
                        <div class="my-2 text-sm text-gray-500 font-semibold">Alasan Pending : </div>
                        <textarea id="reason" name="reason" class="border rounded shadow w-full text-sm px-2 py-1"
                            placeholder="Tulis alasan anda menunda Pengajuan ini"></textarea>
                    </x-popup-content>
                    <x-popup-content name="Setujui" key="approve" color="green">
                        Apa anda yakin ingin menyetujui Juragan {{ $data->provider_code }} ?
                    </x-popup-content>
                </x-slot>
                <x-slot name="submit">
                    <x-popup-submit name="Pending" key="pending" color="yellow" route="dashboard.juragan-gudang">
                    </x-popup-submit>
                    <x-popup-submit name="Setujui" key="approve" color="green" route="dashboard.juragan-gudang">
                    </x-popup-submit>
                </x-slot>
            </x-popup-header>
        @endsection
</form>
