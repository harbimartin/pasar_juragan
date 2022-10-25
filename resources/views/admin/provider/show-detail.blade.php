@extends('admin.regist.show')
@section('detail')
    <?php
        $isFirst = true;
        $column['index'] = ['name' => 'No.', 'align' => 'center', 'type' => 'Index'];
        $column['rincian'] = ['name' => 'Description Barang / Jasa', 'type' => 'WrapString'];
        // if ($isVerify) {
        //     $column['qty_pengajuan'] = ['name' => 'Proposed<br>Quantity', 'align' => 'center', 'type' => 'Number'];
        //     $column['harga_pengajuan'] = ['name' => 'Proposed<br>Price', 'align' => 'right', 'type' => 'Float'];
        //     $column['total_pengajuan'] = ['name' => 'Total<br>Proposed', 'align' => 'right'];
        //     $column['qty_evaluasi'] = ['name' => 'Evaluated<br>Quantity', 'align' => 'center'];
        //     $column['harga_evaluasi'] = ['name' => 'Evaluated<br>Price', 'align' => 'center'];
        //     $column['total_evaluasi'] = ['name' => 'Evaluated<br>Amount', 'align' => 'center'];
        // } else {
        if ($data->status_pjum == 'Proposed') {
            $column['qty_evaluasi'] = ['name' => 'Quantity', 'align' => 'center', 'type' => 'Number'];
            $column['harga_evaluasi'] = ['name' => 'Price', 'align' => 'right', 'type' => 'Float'];
            $column['total_evaluasi'] = ['name' => 'Total', 'align' => 'right'];
            $column['qty_pj'] = ['name' => 'Quantity', 'align' => 'center', 'type' => 'Number'];
            $column['harga_pj'] = ['name' => 'Price', 'align' => 'right', 'type' => 'Float'];
            $column['total_pj'] = ['name' => 'Total', 'align' => 'right'];
        } else {
            $column['qty_pengajuan'] = ['name' => 'Quantity', 'align' => 'center', 'type' => 'Number'];
            $column['harga_pengajuan'] = ['name' => 'Price', 'align' => 'right', 'type' => 'Float'];
            $column['total_pengajuan'] = ['name' => 'Total', 'align' => 'right'];
            if ($data->status_um == 'Approved') {
                $column['qty_evaluasi'] = ['type' => 'Number', 'name' => 'Evaluated<br>Quantity', 'align' => 'center'];
                $column['harga_evaluasi'] = ['type' => 'Float', 'name' => 'Evaluated<br>Price', 'align' => 'center'];
                $column['total_evaluasi2'] = ['name' => 'Evaluated<br>Amount', 'align' => 'center'];
            }
        }
        // }
        $attr['tgl_um'] = ['name' => 'Tanggal Dibuat', 'type' => 'Date'];
        $attr['keperluan'] = ['name' => 'Keperluan'];
        $attr['periode'] = ['name' => 'Periode'];
        $attr['status_um'] = ['name' => 'Status'];
        // $attr['nama_peminta'] = ['name' => 'Pemohon'];
        // $attr['posisi_peminta'] = ['name' => 'Posisi Pemohon'];
    ?>
    <div class="flex flex-col mt-2">
        <div class="-my-2 overflow-x-auto -mx-3">
            <div class="py-2 align-middle inline-block min-w-full lg:px-1">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    {{-- <table class="min-w-full divide-y divide-gray-200 text-xs md:text-sm">
                        <thead class="bg-gray-50 md:tracking-wider">
                            <tr>
                                @foreach ($column as $key => $param)
                                    <th
                                        class="text-xs px-2 py-3 text-gray-500 uppercase {{ isset($param['align']) ? 'text-' . $param['align'] : '' }} {{ isset($param['class']) ? $param['class'] : '' }} {{ isset($param['bolder']) ? 'font-semibold' : 'font-medium' }}">
                                        {!! $param['name'] !!}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-xs md:text-sm text-gray-900">
                            @foreach ($data->item as $index => $item)
                                <tr>
                                    @foreach ($column as $key => $param)
                                        <td
                                            class="px-2 py-2 whitespace-nowrap {{ isset($param['align']) ? 'text-' . $param['align'] : '' }} {{ isset($param['class']) ? $param['class'] : '' }} {{ isset($param['bolder']) ? 'font-semibold' : '' }}">
                                            @isset($param['type'])
                                                @switch($param['type'])
                                                    @case('Index')
                                                        <div>{{ $index + 1 }}</div>
                                                    @break

                                                    @case('Number')
                                                    @case('String')
                                                        @if (is_null($item[$key]))
                                                            <div class="text-gray-500">-</div>
                                                        @else
                                                            <div>{{ $item[$key] }}</div>
                                                        @endif
                                                    @break

                                                    @case('WrapString')
                                                        @if (is_null($item[$key]))
                                                            <div class="text-gray-500">-</div>
                                                        @else
                                                            <div class="whitespace-normal">{{ $item[$key] }}</div>
                                                        @endif
                                                    @break

                                                    @case('Float')
                                                        @if (is_null($item[$key]))
                                                            <div class="text-gray-500">-</div>
                                                        @else
                                                            <div>{{ number_format($item[$key], 2, ',', '.') }}</div>
                                                        @endif
                                                    @break

                                                    @case('SString')
                                                        <div>{{ $item[$key][$param['child']] }}</div>
                                                    @break

                                                    @case('Date')
                                                        <div>{{ date('j M Y', strtotime($item[$key])) }}</div>
                                                    @break

                                                    @case('State')
                                                        <div class="flex">
                                                            @if ($item[$key] == 'AKTIF')
                                                                <div
                                                                    class="px-2 inline-flex mx-auto text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                    {{ $item[$key] }}
                                                                </div>
                                                            @else
                                                                <div
                                                                    class="px-2 inline-flex mx-auto text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                    {{ $item[$key] }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @break

                                                    @case('Edit')
                                                        <a href="{{ Request::url() . '?id=' . $item['id'] }}"
                                                            class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                    @break

                                                    @case('Direct')
                                                        <a href="{{ $param->url . '/view' }}"
                                                            class="text-indigo-600 hover:text-indigo-900">View</a>
                                                    @break

                                                    @default
                                                        <div class="text-gray-900">{{ $item[$key] }}</div>
                                                        <small>{{ $param['type'] }}</small>
                                                    @break
                                                @endswitch
                                            @else
                                                @switch($key)
                                                    @case('total_pengajuan')
                                                        <div class="text-right">
                                                            {{ number_format($item->qty_pengajuan * $item->harga_pengajuan, 2, ',', '.') }}
                                                        </div>
                                                    @break

                                                    @case('total_pj')
                                                        <div class="text-right">
                                                            {{ number_format($item->qty_pj * $item->harga_pj, 2, ',', '.') }}
                                                        </div>
                                                    @break

                                                    @case('qty_evaluasi')
                                                        <div class="inline-flex">
                                                            <input type="number" hidden name="barang_id[]"
                                                                value="{{ $item->t_um_detail_id }}">
                                                            <input
                                                                v-on:input="onCount($event, 'total_evaluasi[{{ $index }}]'); onTotal('total_evaluasi', 'tot_eval')"
                                                                id="{{ $key }}[{{ $index }}]"
                                                                name="{{ $key }}[{{ $index }}]"
                                                                value="{{ $item->qty_evaluasi }}" placeholder="0" type="number"
                                                                class="rounded border w-24 px-2 py-1 focus:shadow-inner focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent transition" />
                                                        </div>
                                                    @break

                                                    @case('harga_evaluasi')
                                                        <div class="inline-flex">
                                                            <input
                                                                v-on:input="onCount($event, 'total_evaluasi[{{ $index }}]'); onTotal('total_evaluasi', 'tot_eval')"
                                                                id="{{ $key }}[{{ $index }}]"
                                                                name="{{ $key }}[{{ $index }}]"
                                                                value="{{ $item->harga_evaluasi }}" placeholder="0" type="number"
                                                                class="rounded border px-2 py-1 focus:shadow-inner focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent transition" />
                                                        </div>
                                                    @break

                                                    @case('total_evaluasi')
                                                        <div class="inline-flex">
                                                            <input readonly
                                                                from="{{ json_encode(['qty_evaluasi[' . $index . ']', 'harga_evaluasi[' . $index . ']']) }}"
                                                                @isset($error['data'][$key])
                                                        value="{{ $error['data'][$key] }}"
                                                    @endisset
                                                                id="{{ $key }}[{{ $index }}]"
                                                                name="{{ $key }}[{{ $index }}]"
                                                                value="{{ $item->harga_evaluasi * $item->qty_evaluasi }}"
                                                                class="bg-gray-100 rounded border px-2 py-1 focus:shadow-inner focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent transition" />
                                                        </div>
                                                    @break

                                                    @case('total_evaluasi2')
                                                        <div class="text-right pr-8">
                                                            {{ number_format($item->qty_evaluasi * $item->harga_evaluasi, 2, ',', '.') }}
                                                        </div>
                                                    @break

                                                    @case('revised')
                                                        <div class="inline-flex">
                                                            <a href="{{ url('persetujuan') . '?id=' . $data->id . '&iid=' . $item['id'] }}"
                                                                class="rounded-md bg-yellow-600 hover:bg-yellow-700 ml-2 p-1.5 my-auto cursor-pointer"><img
                                                                    src="assets/edit.svg"></a>
                                                        </div>
                                                    @break

                                                    @default
                                                        SLOT[{{ $key }}]
                                                @endswitch
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            @if (sizeof($data->item) > 0)
                                <th colspan="4" class="text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Total
                                </th>
                                <th class="px-2 py-3 text-xs font-medium text-gray-900 text-right">
                                    {{ number_format($data->nilai_pengajuan, 2, ',', '.') }}
                                </th>
                                <th colspan="2">

                                </th>
                                @if ($isVerify)
                                    <th class="px-4 text-xs font-medium text-gray-900 text-right">
                                        <input readonly id="tot_eval" name="tot_eval" value="{{ $data->nilai_disetujui }}"
                                            class="bg-gray-100 rounded border font-semibold mr-2 w-full px-2 py-1 focus:shadow-inner focus:outline-none focus:ring-1 focus:ring-blue-300 focus:border-transparent transition" />
                                    </th>
                                @elseif($data->status_um == 'Approved')
                                    <th class="px-2 py-3 text-xs font-medium text-gray-900 text-right pr-10">
                                        {{ number_format($data->nilai_disetujui, 2, ',', '.') }}
                                    </th>
                                @elseif($data->status_pjum == 'Proposed')
                                    <th class="px-2 py-3 text-xs font-medium text-gray-900 text-right pr-10">
                                        {{ number_format($data->nilai_ditanggung, 2, ',', '.') }}
                                    </th>
                                @endif
                                @else
                                    <tr>
                                        <td colspan="100%" height="50" class="text-center bg-gray-50 text-gray-400">
                                            <div class="inline-block  py-5">
                                                <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" width="32"
                                                    height="32" fill="currentColor" class="bi bi-inbox" viewBox="0 0 16 16">
                                                    <path
                                                        d="M4.98 4a.5.5 0 0 0-.39.188L1.54 8H6a.5.5 0 0 1 .5.5 1.5 1.5 0 1 0 3 0A.5.5 0 0 1 10 8h4.46l-3.05-3.812A.5.5 0 0 0 11.02 4H4.98zm9.954 5H10.45a2.5 2.5 0 0 1-4.9 0H1.066l.32 2.562a.5.5 0 0 0 .497.438h12.234a.5.5 0 0 0 .496-.438L14.933 9zM3.809 3.563A1.5 1.5 0 0 1 4.981 3h6.038a1.5 1.5 0 0 1 1.172.563l3.7 4.625a.5.5 0 0 1 .105.374l-.39 3.124A1.5 1.5 0 0 1 14.117 13H1.883a1.5 1.5 0 0 1-1.489-1.314l-.39-3.124a.5.5 0 0 1 .106-.374l3.7-4.625z" />
                                                </svg>
                                                <div>Tidak Ada Barang</div>
                                            </div>
                                        </td>
                                    </tr>
                            @endif
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="md:flex w-full ">
        <div class="flex-grow md:px-4">
            <div class="mt-6 mb-2 text-gray-500 font-semibold flex border-b">
                Deskripsi
            </div>
            <div class="mt-2 text-gray-700">
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
    </div>
@endsection
