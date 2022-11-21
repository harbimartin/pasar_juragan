<?php

namespace App\Http\Controllers\User\Dashboard\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\GenSerial;
use App\Models\OrderWarehouse\OrderWarehouse;
use App\Models\OrderWarehouse\OrderWarehouseDetail;
use App\Models\Warehouse\WarehouseContractDetail;
use App\Models\Warehouse\WarehouseContractDetailRpt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananWarehouseDetailController extends Controller {
    protected $baseRoute = 'dashboard.order.warehouse.detail';
    public function getMySelect($contract_id) {
        return [
            'warehouse' => WarehouseContractDetailRpt::where('t_wh_contract_id', $contract_id)->get(),
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $order) {
        [$data, $select, $detail, $submenu] = PesananWarehouseController::base_index($order);
        if ($data)
            return view($this->baseRoute . '.index', [
                'data' => $data,
                'select' => array_merge($select, $this->getMySelect($data->t_wh_contract_id)),
                'detail' => $detail,
                'submenu' => $submenu,
            ]);
        else
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
            't_wh_contract_detail_id' => ['required', 'exists:t_wh_contract_detail_tab,id'],
            'start_project' => ['required'],
            'wh_large' => ['required'],
            'flag_daily_monthly' => ['required'],
            'long_used' => ['required'],
            'order_note' => ['nullable'],
        ]);
        $order = OrderWarehouse::find($order_id);
        if ($order) {
            $credentials['status'] = 1;
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
    public function show($id) {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($order, $id) {
        $order = OrderWarehouse::find($order);
        $detail = $order->status != 'Draft';
        $data = OrderWarehouseDetail::find($id);
        return view($this->baseRoute . '.edit', ['data' => $data, 'select' => $detail ? [] : $this->getMySelect($order->t_wh_contract_id), 'detail' => $detail]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $contract, $id) {
        switch ($request->__type) {
            case 'toggle':
                OrderWarehouseDetail::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    't_wh_contract_detail_id' => ['required', 'exists:t_wh_contract_detail_tab,id'],
                    'start_project' => ['required'],
                    'wh_large' => ['required'],
                    'flag_daily_monthly' => ['required'],
                    'long_used' => ['required'],
                    'order_note' => ['nullable'],
                ]);
                OrderWarehouseDetail::find($id)->update($credentials);
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
    public function destroy($order, $id) {
        $data = OrderWarehouseDetail::find($id);
        if ($data->order->status == 'Draft')
            $data->delete();
        return back();
    }
}
