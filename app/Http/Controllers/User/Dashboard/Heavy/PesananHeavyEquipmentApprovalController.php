<?php

namespace App\Http\Controllers\User\Dashboard\HeavyEquipment;

use App\Http\Controllers\Controller;
use App\Http\Helper\Routing;
use App\Http\Helper\Table;
use App\Models\OrderHeavy\OrderHeavyEquipment;
use App\Models\OrderHeavy\OrderHeavyEquipmentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananHeavyEquipmentApprovalController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $company_id = Auth::guard('user')->user()->company->id;
        $data = OrderHeavyEquipment::whereHas('contract', function ($q) use ($company_id) {
            $q->whereHas('juragan_gudang', function ($qq) use ($company_id) {
                $qq->where('m_company_id', $company_id);
            });
        })->where('status', 'Proposed')->paginate(10);
        return view('dashboard.order.heavy.approval.index', ['data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'module' => 'Gudang']);
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
        $order = OrderHeavyEquipment::find($id);
        if ($order && $order->status == "Proposed")
            return view('dashboard.order.heavy.approval.show', ['data' => $order]);
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
                $order = OrderHeavyEquipment::find($id);
                DB::beginTransaction();
                $order->update([
                    'status' => 'Approved'
                ]);
                $order->log()->create([
                    'user_type' => OrderHeavyEquipmentLog::JURAGAN_ALATBERAT,
                    'user_id' => Auth::guard('user')->user()->id,
                    'status' => "Approved"
                ]);
                DB::commit();
                break;
            case 'pending':
                $order = OrderHeavyEquipment::find($id);
                DB::beginTransaction();
                $order->update([
                    'status' => 'Pending'
                ]);
                $order->log()->create([
                    'user_type' => OrderHeavyEquipmentLog::JURAGAN_ALATBERAT,
                    'user_id' => Auth::guard('user')->user()->id,
                    'status' => "Pending",
                    'status_note' => $request->reason
                ]);
                DB::commit();
                break;
            case 'reject':
                $order = OrderHeavyEquipment::find($id);
                DB::beginTransaction();
                $order->update([
                    'status' => 'Rejected'
                ]);
                $order->log()->create([
                    'user_type' => OrderHeavyEquipmentLog::JURAGAN_ALATBERAT,
                    'user_id' => Auth::guard('user')->user()->id,
                    'status' => "Rejected",
                    'status_note' => $request->reason
                ]);
                DB::commit();
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
