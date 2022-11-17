<?php

namespace App\Http\Controllers\User\Dashboard\Transport;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\GenSerial;
use App\Models\OrderTransport\OrderTransportDetail;
use App\Models\OrderTransport\OrderTransportDetailRpt;
use App\Models\OrderTransport\OrderTransportVoucher;
use App\Models\OrderTransport\OrderTransportVoucherDetail;
use App\Models\OrderTransport\OrderTransportVoucherDetailRpt;
use App\Models\OrderTransport\OrderTransportVoucherRpt;
use Illuminate\Http\Request;

class TransportPesananVoucherDetailController extends Controller {
    protected $baseRoute = 'dashboard.order.transport.voucher-detail';
    public function getMySelect($order_id, $detail) {
        if ($detail)
            return [];
        else
            return [
                'order' => OrderTransportDetailRpt::where(['t_truck_order_id' => $order_id, 'status' => 1])->get(),
                // 'unloading' => UnloadingAddress::where('status', 1)->get()
            ];
    }
    public function getDetail($order_id, $voucher_id) {
        $voucher = OrderTransportVoucher::where(['id' => $voucher_id, 't_truck_order_id' => $order_id])->first();
        if ($voucher)
            return !$voucher->status->editable;
        else
            return true;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $order_id, $voucher_id) {
        [$voucher, $select, $detail, $submenu] = TransportPesananVoucherController::base_index($voucher_id);
        // $voucher = OrderTransportVoucher::where('t_truck_order_id', $order_id)->get();
        // if ($request->has('vid')) {
        //     $default_voucher = $request->vid;
        // } else {
        //     $default_voucher = $voucher[0]->id;
        // }
        $detail = $this->getDetail($order_id, $voucher_id);
        $data = OrderTransportVoucherDetail::where('t_truck_order_voucher_id', $voucher_id)->paginate(10);
        return view($this->baseRoute . '.index', [
            'data' => $voucher,
            'select' => array_merge($select, $this->getMySelect($order_id, $detail)),
            'detail' => $detail,
            'submenu' => $submenu,
            // 'voucher' => $voucher,
            // 'default_voucher' => $default_voucher,
            'list' => $data->getCollection(),
            'prop' => Table::tableProp($data),
            'detail' => $detail
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $order_id, $voucher_id) {
        $credentials = $request->validate([
            't_truck_order_detail_id' => ['required'],
            'origin_name' => ['required'],
            'destination_name' => ['required'],
            'tonage' => ['required'],
            'cargo_code' => ['required'],
            'tonnage' => ['required'],
            'pcs' => ['required'],
            'notes' => ['nullable'],
        ]);
        $order = OrderTransportVoucher::find($voucher_id);
        if (
            !OrderTransportVoucher::where(['t_truck_order_id' => $order_id, 'id' => $voucher_id])->first() ||
            !OrderTransportDetail::where(['t_truck_order_id' => $order_id, 'id' => $request->t_truck_order_detail_id])->first()
        )
            return back()->withErrors(['add' => 'Pesanan Rincian atau Angkutan tidak valid!']);
        if ($order) {
            $order->detail()->create($credentials);
            return back();
        } else
            return back()->withErrors(['add' => 'Pesanan tidak ditemukan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_id, $voucher_id,  $id) {
        $data = OrderTransportVoucherDetail::find($id);
        return view($this->baseRoute . '.edit', ['data' => $data, 'select' => [], 'detail' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($order_id, $voucher_id, $id) {
        $data = OrderTransportVoucherDetail::find($id);
        $detail = $this->getDetail($order_id, $voucher_id);
        return view($this->baseRoute . '.edit', ['data' => $data, 'select' => $this->getMySelect($order_id, $detail), 'detail' => $detail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order_id, $voucher_id, $id) {
        switch ($request->__type) {
            case 'toggle':
                OrderTransportVoucherDetail::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    't_truck_order_detail_id' => ['required'],
                    'origin_name' => ['required'],
                    'destination_name' => ['required'],
                    'tonage' => ['required'],
                    'cargo_code' => ['required'],
                    'tonnage' => ['required'],
                    'pcs' => ['required'],
                    'notes' => ['nullable'],
                ]);
                $voucher_detail = OrderTransportVoucherDetail::find($voucher_id);
                if (
                    !OrderTransportVoucher::where(['t_truck_order_id' => $order_id, 'id' => $voucher_id])->first() ||
                    !OrderTransportDetail::where(['t_truck_order_id' => $order_id, 'id' => $request->t_truck_order_detail_id])->first()
                )
                    return back()->withErrors(['add' => 'Pesanan Rincian atau Angkutan tidak valid!']);
                $voucher_detail->update($credentials);
                break;
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order_id, $voucher, $id) {
        OrderTransportVoucherDetail::find($id)->delete();
        return back();
        //
    }
}
