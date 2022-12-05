<?php

namespace App\Http\Controllers\User\Dashboard\HeavyEquipment;

use App\Http\Controllers\Controller;
use App\Http\Helper\Routing;
use App\Http\Helper\Table;
use App\Models\Provider;
use App\Models\Heavy\HeavyEquipmentContract;
use App\Models\Heavy\HeavyEquipmentContractLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrakHeavyEquipmentApprovalController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $company_id = Auth::guard('user')->user()->company->id;
        $data = HeavyEquipmentContract::where(['juragan_barang_id' => $company_id, 'status' => 'Proposed'])->paginate(10);
        return view('dashboard.contract.warehouse.approval.index', ['data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'module' => 'Gudang']);
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
    public function show($id) {
        $contract = HeavyEquipmentContract::find($id);
        if ($contract && $contract->status == "Proposed")
            return view('dashboard.contract.warehouse.approval.show', ['data' => $contract]);
        return back();
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
        switch ($request->__type) {
            case 'approve':
                $provider = HeavyEquipmentContract::find($id);
                $provider->update([
                    'status' => 'Approved'
                ]);
                $provider->log()->create([
                    'user_type' => HeavyEquipmentContractLog::JURAGAN_BARANG,
                    'user_id' => Auth::guard('user')->user()->id,
                    'status' => "Approved"
                ]);
                break;
            case 'pending':
                $provider = HeavyEquipmentContract::find($id);
                $provider->update([
                    'status' => 'Pending'
                ]);
                $provider->log()->create([
                    'user_type' => HeavyEquipmentContractLog::JURAGAN_BARANG,
                    'user_id' => Auth::guard('user')->user()->id,
                    'status' => "Pending",
                    'status_note' => $request->reason
                ]);
                break;
        }
        return redirect(route(str_replace('.update', '', Routing::getCurrentRouteName())));
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
