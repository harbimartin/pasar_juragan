<?php

namespace App\Http\Controllers\User\Dashboard\HeavyEquipment;

use App\Http\Controllers\Controller;
use App\Models\Contract\Commodity;
use App\Models\Contract\Destination;
use App\Models\Contract\Origin;
use App\Models\Contract\TariffType;
use App\Models\Transport\TruckType;
use App\Models\Heavy\HeavyEquipment;
use App\Models\Heavy\HeavyEquipmentContract;
use App\Models\Heavy\HeavyEquipmentContractDetail;
use Illuminate\Http\Request;

class KontrakHeavyEquipmentDetailController extends Controller {
    protected $baseRoute = 'dashboard.contract.warehouse.detail';
    public function getMySelect($data) {
        return [
            'warehouse' => HeavyEquipment::where(['m_provider_id' => $data, 'status' => 1])->get(),
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id) {
        [$data, $select, $detail, $submenu] = KontrakHeavyEquipmentController::base_index($id);
        if ($data)
            return view('dashboard.contract.warehouse.detail.index', [
                'data' => $data,
                'select' => array_merge($select, $this->getMySelect($data->juragan_gudang_id)),
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
    public function store(Request $request, $contract_id) {
        $credentials = $request->validate([
            'm_warehouse_id' => ['required', 'exists:m_warehouse_tab,id'],
            'price_per_meter_daily' => ['required'],
            'price_per_meter_monthly' => ['required'],
        ]);
        $contract = HeavyEquipmentContract::find($contract_id);
        if ($contract) {
            $credentials['status'] = 1;
            $contract->detail()->create($credentials);
            return back();
        } else
            return back()->withErrors(['add' => 'Contract tidak ditemukan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
    }

    /**d
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($contract, $id) {
        $data = HeavyEquipmentContractDetail::find($id);
        $wc = HeavyEquipmentContract::find($contract);
        return view($this->baseRoute . '.edit', ['data' => $data, 'select' => $this->getMySelect($wc->juragan_gudang_id)]);
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
                HeavyEquipmentContractDetail::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'm_warehouse_id' => ['required', 'exists:m_warehouse_tab,id'],
                    'price_per_meter_daily' => ['required'],
                    'price_per_meter_monthly' => ['required'],
                ]);
                HeavyEquipmentContractDetail::find($id)->update($credentials);
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
    public function destroy($id) {
        //
    }
}
