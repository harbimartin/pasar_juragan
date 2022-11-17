<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\OrderTransport\OrderTransportDetail;
use App\Models\OrderTransport\OrderTransportVoucher;
use App\Models\OrderTransport\OrderTransportVoucherDetail;
use App\Models\OrderTransport\OrderTransportVoucherDetailRpt;
use Illuminate\Http\Request;

class PesananAngkutanMonitoringController extends Controller {
    protected $baseRoute = 'dashboard.order.transport.monitoring';
    public static function base_index($voucher) {
        $voucher = OrderTransportVoucher::find($voucher);
        if ($voucher) {
            $detail = true;
            $submenu = [
                ['key' => 'truck', 'name' => 'Detail']
            ];
            $select = [];
            return [$voucher, $select, $detail, $submenu];
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $order_id, $monitoring_id) {
        $data = OrderTransportDetail::find($monitoring_id);
        $truck = OrderTransportVoucherDetailRpt::where('t_truck_order_detail_id', $monitoring_id)->paginate(10);
        return view('dashboard.order.transport.monitoring.index', ['data' => $data, 'truck' => $truck->getCollection(), 'prop' => Table::tableProp($truck), 'select' => [], 'detail' => true]);
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
    public function show($order, $voucher, $id) {
        return redirect(route('dashboard.pesanan.juragan-angkutan.detail.monitoring.truck', [$order, $voucher, $id]));
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
