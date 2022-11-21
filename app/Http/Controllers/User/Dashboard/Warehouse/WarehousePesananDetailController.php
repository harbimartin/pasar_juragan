<?php

namespace App\Http\Controllers\User\Dashboard\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\GenSerial;
use App\Models\OrderTransport\OrderTransport;
use App\Models\OrderTransport\OrderTransportVoucher;
use App\Models\OrderWarehouse\OrderWarehouseDetail;
use App\Models\Transport\Driver;
use App\Models\Transport\Truck;
use App\Models\Warehouse\WarehouseContractDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehousePesananDetailController  extends Controller {
    // protected $baseRoute = '';
    public function getMySelect($contract_id) {
        return [
            'warehouse' => WarehouseContractDetail::where('t_wh_contract_id', $contract_id)->get()
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $order) {
        [$data, $select, $detail, $submenu] = WarehousePesananController::base_index($order);
        if ($data){
            // $data = OrderWarehouseDetail::where('t_wh_data_id', $data->id)->paginate(10);
            return view('dashboard.order.warehouse.detail.index', [
                'data' => $data,
                'select' => array_merge($select, $this->getMySelect($data->t_wh_contract_id)),
                // 'data' => $data->getCollection(),
                // 'prop' => Table::tableProp($data),
                'detail' => $detail,
                'submenu' => $submenu
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
    public function store(Request $request, $order_id) {
        $credentials = $request->validate([
            'm_truck_id' => ['required'],
            'm_driver_id' => ['required'],
            'voucher_date' => ['required'],
            'voucher_close_date' => ['required'],
        ]);
        $my_company_id = Auth::guard('user')->user()->m_company_id;
        if (
            Truck::whereHas('provider', function ($q) use ($my_company_id) {
                $q->where('m_company_id', $my_company_id);
            })->first() &&
            Driver::whereHas('provider', function ($q) use ($my_company_id) {
                $q->where('m_company_id', $my_company_id);
            })->first()
        )
            return back()->withErrors(['add' => 'Truck atau Driver tidak valid!']);

        $order = OrderTransport::find($order_id);
        if ($order) {
            $credentials['status'] = 1;
            $credentials['voucher_code'] = GenSerial::generateCode('VC');
            $order->voucher()->create($credentials);
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
    public function show($contract, $id) {
        $data = OrderWarehouseDetail::find($id);
        return view('dashboard.order.warehouse.detail.edit', ['data' => $data, 'select' => [], 'detail' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($contract, $id) {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contract, $id) {
        // switch ($request->__type) {
        //     case 'toggle':
        //         OrderTransportDetail::find($id)->update(['status' => $request->toggle]);
        //         break;
        //     case 'update':
        //         $credentials = $request->validate([
        //             't_truck_contract_detail_id' => ['required', 'exists:t_truck_contract_detail_tab,id'],
        //             'picking_date' => ['required'],
        //             'due_date' => ['required'],
        //             'tonage' => ['required'],
        //         ]);
        //         OrderTransportDetail::find($id)->update($credentials);
        //         break;
        // }
        return back();
    }
}
