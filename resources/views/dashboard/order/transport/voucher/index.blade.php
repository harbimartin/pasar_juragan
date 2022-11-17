@extends('dashboard.order.transport.show', ['tab' => 'voucher'])
@section('tab-content')
    @if (!$voucher_detail)
        @php
            $column_detail = [
                'voucher_date' => ['name' => 'Tanggal Mulai', 'type' => 'Date'],
                'voucher_close_date' => ['name' => 'Tanggal Selesai', 'type' => 'Date'],
                'm_truck_id' => ['name' => 'Truk', 'type' => 'TextSel', 'val' => ['plate_no'], 'desc' => [], 'api' => 'truck'],
                'm_driver_id' => ['name' => 'Sopir', 'type' => 'TextSel', 'val' => ['driver_name'], 'desc' => ['license_no'], 'api' => 'driver'],
                'notes' => ['name' => 'Catatan', 'type' => 'TextArea', 'full' => true],
            ];
            $column_detail = json_encode($column_detail);
        @endphp

        <x-add unique="provider" :column="$column_detail" title="Tambah Pesanan Truk" :data="$data" :select="$select" idk="id">
        </x-add>
    @endif

    <?php
    $table_detail = json_encode([
        'select' => ['name' => 'Select', 'type' => 'Check', 'key' => 'id', 'align' => 'center', 'form'=>'njika', 'sort' => false],
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'voucher_date' => ['name' => 'Tanggal Mulai', 'type' => 'Date', 'full' => true],
        'voucher_close_date' => ['name' => 'Tanggal Selesai', 'type' => 'Date', 'full' => true],
        'truck' => ['name' => 'Truk', 'type' => 'SString', 'child' => 'plate_no'],
        'driver' => ['name' => 'Sopir', 'type' => 'SString', 'child' => 'driver_name'],
        'notes' => ['name' => 'Catatan', 'type' => 'TextArea', 'empty' => 'Tidak ada Catatan', 'full' => true],
        'status' => ['name' => 'Status', 'type' => 'CState', 'child' => 'status_desc', 'align' => 'center', 'sort' => false],
        'act' => $voucher_detail ? null : ['name' => 'Action', 'type' => 'Show', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table :lim="false" :column="$table_detail" :datas="$data->voucher">
        @if(sizeof($data->voucher) > 0)
        <div class="flex">
            <input
                v-on:click="selectCheck('select')"
                id="unselect"
                class="text-xs md:text-sm rounded-full border px-4 py-1 bg-blue-500 hover:bg-blue-600 cursor-pointer text-white font-semibold mt-auto mb-1 md:my-auto mr-2 md:mr-4"
                type="button"
                value="Select All"
            />
            <form id="njika" action="{{ request()->url() . '/' . $data->voucher[0]->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="md:inline-flex mx-auto">
                    <div class="flex mt-2 md:mt-0 gap-2">
                        <x-popup-button-mid key="update_status" color="yellow" name="Ubah Status" :show="true">
                        </x-popup-button-mid>
                    </div>
                </div>
                <x-popup-header>
                    <x-slot name="content">
                        <x-popup-content name="Ubah Status" key="update_status" color="yellow">
                            Apa anda yakin ingin melakukan Perubahan Status pada Angkutan yang anda pilih?
                            <div class="my-2 text-sm text-gray-500 font-semibold">Status Baru : </div>
                            <select class="border rounded shadow w-full text-sm px-2 py-1" name="new_status_id"
                                id="new_status_id">
                                @foreach ($select['status'] as $status)
                                    <option value="{{ $status->id }}">{{ $status->status_desc }}</option>
                                @endforeach
                            </select>
                            <div class="my-2 text-sm text-gray-500 font-semibold">Alasan Perubahan Status : </div>
                            <textarea id="reason" name="reason" class="border rounded shadow w-full text-sm px-2 py-1"
                                placeholder="Tulis alasan anda menunda Pengajuan ini"></textarea>
                        </x-popup-content>
                    </x-slot>
                    <x-slot name="submit">
                        <x-popup-submit name="Ubah Status" key="update_status" color="yellow">
                        </x-popup-submit>
                    </x-slot>
                </x-popup-header>
            </form>
        </div>
        @endif
    </x-table>
@endsection
