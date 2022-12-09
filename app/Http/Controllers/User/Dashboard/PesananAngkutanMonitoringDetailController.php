<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\Dashboard\Transport\TransportPesananVoucherController;
use App\Http\Helper\Table;
use App\Models\OrderTransport\OrderTransport;
use App\Models\OrderTransport\OrderTransportDetail;
use App\Models\OrderTransport\OrderTransportVoucherDetail;
use Illuminate\Http\Request;

class PesananAngkutanMonitoringDetailController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $order_id, $detail_id, $voucher_id) {
        [$voucher, $select, $detail, $submenu] = PesananAngkutanMonitoringController::base_index($voucher_id);
        if ($voucher) {
            $data = OrderTransportVoucherDetail::where('t_truck_order_voucher_id', $voucher_id)->paginate(10);
            // return $voucher;
            $order = OrderTransportDetail::find($detail_id);
            $voucher['loading'] = $order->loading;
            $voucher['unloading'] = $order->unloading;
            return view('dashboard.order.transport.monitoring.voucher-detail.index', [
                'data' => $voucher,
                'select' => [],
                'submenu' => $submenu,
                'list' => $data->getCollection(),
                'prop' => Table::tableProp($data),
                'detail' => true
            ]);
        } else
            return back();
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
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_id, $voucher_id,  $id) {
        $data = OrderTransportVoucherDetail::find($id);
        return view('dashboard.order.transport.monitoring.voucher-detail.edit', ['data' => $data, 'select' => [], 'detail' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
