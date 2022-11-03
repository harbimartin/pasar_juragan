<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Helper\Routing;
use App\Http\Helper\Table;
use App\Models\Provider;
use App\Models\Transport\TruckContract;
use App\Models\Transport\TruckContractLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrakBarangApprovalController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = TruckContract::where(['status' => 'Proposed'])->paginate(10);
        return view('dashboard.contract.item.approval.index', ['data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'module' => 'Gudang']);
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
        $contract = TruckContract::find($id);
        if ($contract && $contract->status == "Proposed")
            return view('dashboard.contract.item.approval.show', ['data' => $contract]);
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
                $provider = TruckContract::find($id);
                $provider->update([
                    'status' => 'Approved'
                ]);
                $provider->log()->create([
                    'user_type' => TruckContractLog::JURAGAN_BARANG,
                    'user_id' => Auth::guard('user')->user()->id,
                    'status' => "Approved"
                ]);
                break;
            case 'pending':
                $provider = TruckContract::find($id);
                $provider->update([
                    'status' => 'Pending'
                ]);
                $provider->log()->create([
                    'user_type' => TruckContractLog::JURAGAN_BARANG,
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
