<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contract\Commodity;
use App\Models\Contract\Destination;
use App\Models\Contract\Origin;
use App\Models\Contract\TariffType;
use App\Models\Transport\TruckContract;
use App\Models\Transport\TruckContractDetail;
use App\Models\Transport\TruckType;
use Illuminate\Http\Request;

class KontrakBarangDetailController extends Controller {
    protected $baseRoute = 'dashboard.contract.item.detail';
    public function getMySelect() {
        return [
            'origin' => Origin::where('status', 1)->get(),
            'destination' => Destination::where('status', 1)->get(),
            'commodity' => Commodity::where('status', 1)->get(),
            'truck_type' => TruckType::where('status', 1)->get(),
            'tariff_type' => TariffType::where('status', 1)->get(),
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id) {
        [$data, $select, $detail, $submenu] = KontrakBarangController::base_index($id);
        return view($this->baseRoute . '.index', [
            'data' => $data,
            'select' => array_merge($select, $this->getMySelect()),
            'detail' => $detail,
            'submenu' => $submenu,
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
    public function store(Request $request, $contract_id) {
        $credentials = $request->validate([
            'm_origin_id' => ['required', 'exists:m_origin_tab,id'],
            'm_destination_id' => ['required', 'exists:m_destination_tab,id'],
            'm_commodity_id' => ['required', 'exists:m_commodity_tab,id'],
            'm_truck_type_id' => ['required', 'exists:m_truck_type_tab,id'],
            'price_per_ton' => ['required'],
            'price_per_rit' => ['required'],
            'minimum_ton' => ['required']
        ]);
        $contract = TruckContract::find($contract_id);
        if ($contract) {
            $credentials['status'] = 1;
            $contract->detail()->create($credentials);
            return back();
        } else
            return back()->withErrors('add', 'Contract tidak ditemukan!');
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
        $data = TruckContractDetail::find($id);
        return view($this->baseRoute . '.edit', ['data' => $data, 'select' => $this->getMySelect($data)]);
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
                TruckContractDetail::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'm_origin_id' => ['required', 'exists:m_origin_tab,id'],
                    'm_destination_id' => ['required', 'exists:m_destination_tab,id'],
                    'm_commodity_id' => ['required', 'exists:m_commodity_tab,id'],
                    'm_truck_type_id' => ['required', 'exists:m_truck_type_tab,id'],
                    'price_per_ton' => ['required'],
                    'price_per_rit' => ['required'],
                    'minimum_ton' => ['required']
                ]);
                TruckContractDetail::find($id)->update($credentials);
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
