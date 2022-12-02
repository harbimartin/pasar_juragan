<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Item\LoadingAddress;
use App\Models\Item\UnloadingAddress;
use App\Models\OrderTransport\OrderTransport;
use App\Models\OrderTransport\OrderTransportDetail;
use App\Models\Transport\TruckContractDetailRpt;
use Illuminate\Http\Request;

class PesananAngkutanDetailController extends Controller {
    public function getMySelect($contract_id) {
        return [
            'tariff' => TruckContractDetailRpt::where('t_truck_contract_id', $contract_id)->get(),
            'loading' => LoadingAddress::where('status', 1)->get(),
            'unloading' => UnloadingAddress::where('status', 1)->get()
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $order) {
        [$data, $select, $detail, $submenu] = PesananAngkutanController::base_index($order);
        if ($data)
            return view('dashboard.order.transport.detail.index', [
                'data' => $data,
                'select' => array_merge($select, $this->getMySelect($data->t_truck_contract_id)),
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
            't_truck_contract_detail_id' => ['required', 'exists:t_truck_contract_detail_tab,id'],
            'picking_date' => ['required'],
            'm_loading_address_id' => ['required'],
            'due_date' => ['required'],
            'm_unloading_address_id' => ['required'],
            'tonage' => ['required'],
            'estimate_truck_required' => ['required'],
            'order_note' => ['nullable'],
        ]);
        $order = OrderTransport::find($order_id);
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
    public function edit($contract, $id) {
        $data = OrderTransportDetail::find($id);
        return view($this->baseRoute . '.edit', ['data' => $data, 'select' => $this->getMySelect($contract)]);
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
                OrderTransportDetail::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    't_truck_contract_detail_id' => ['required', 'exists:t_truck_contract_detail_tab,id'],
                    'picking_date' => ['required'],
                    'due_date' => ['required'],
                    'tonage' => ['required'],
                ]);
                OrderTransportDetail::find($id)->update($credentials);
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
        $data = OrderTransportDetail::find($id);
        if ($data->order->status == 'Draft')
            $data->delete();
        return back();
    }
}
