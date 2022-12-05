<?php

namespace App\Http\Controllers\User\Dashboard\HeavyEquipment;

use App\Http\Controllers\Controller;
use App\Models\GenSerial;
use App\Models\OrderHeavy\OrderHeavyEquipment;
use App\Models\OrderHeavy\OrderHeavyEquipmentDetail;
use App\Models\Heavy\HeavyEquipmentContractDetail;
use App\Models\Heavy\HeavyEquipmentContractDetailRpt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananHeavyEquipmentDetailController extends Controller {
    protected $baseRoute = 'dashboard.order.heavy.detail';
    public function getMySelect($contract_id) {
        return [
            'heavy' => HeavyEquipmentContractDetailRpt::where('t_he_contract_id', $contract_id)->get(),
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $order) {
        [$data, $select, $detail, $submenu] = PesananHeavyEquipmentController::base_index($order);
        if ($data)
            return view($this->baseRoute . '.index', [
                'data' => $data,
                'select' => array_merge($select, $this->getMySelect($data->t_he_contract_id)),
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
            't_he_contract_detail_id' => ['required', 'exists:t_he_contract_detail_tab,id'],
            'start_project' => ['required'],
            'wh_large' => ['required'],
            'flag_daily_monthly' => ['required'],
            'long_used' => ['required'],
            'order_note' => ['nullable'],
        ]);
        $order = OrderHeavyEquipment::find($order_id);
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
        $data = OrderHeavyEquipmentDetail::find($id);
        return view('dashboard.order.heavy.detail.edit', ['data' => $data, 'select' => [], 'detail' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($order, $id) {
        $order = OrderHeavyEquipment::find($order);
        $detail = $order->status != 'Draft';
        $data = OrderHeavyEquipmentDetail::find($id);
        return view($this->baseRoute . '.edit', ['data' => $data, 'select' => $detail ? [] : $this->getMySelect($order->t_he_contract_id), 'detail' => $detail]);
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
                OrderHeavyEquipmentDetail::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    't_he_contract_detail_id' => ['required', 'exists:t_he_contract_detail_tab,id'],
                    'start_project' => ['required'],
                    'wh_large' => ['required'],
                    'flag_daily_monthly' => ['required'],
                    'long_used' => ['required'],
                    'order_note' => ['nullable'],
                ]);
                OrderHeavyEquipmentDetail::find($id)->update($credentials);
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
        $data = OrderHeavyEquipmentDetail::find($id);
        if ($data->order->status == 'Draft')
            $data->delete();
        return back();
    }
}
