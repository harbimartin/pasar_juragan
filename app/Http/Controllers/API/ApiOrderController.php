<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiResponse;
use App\Models\OrderDetailForMobile;
use App\Models\OrderForMobile;
use App\Models\OrderTransport\OrderTransportVoucher;
use App\Models\OrderTransport\OrderTransportVoucherLog;
use App\Models\OrderTransport\OrderTransportVoucherStatus;
use App\Models\VoucherTabFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiOrderController extends Controller {

    protected $helper;

    public function __construct(ApiResponse $helper) {
        $this->helper = $helper;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    public function indexStatus() {
        $statused = OrderTransportVoucherStatus::all();
        return $this->helper->respon_success($statused);
    }

    public function updateStatus(Request $request) {
        $statused = OrderTransportVoucher::where('id', $request->id)->first();
        $statused->update([
            "status_id" => $request->status_id,
        ]);
        OrderTransportVoucherLog::create([
            't_truck_order_voucher_id' => $statused->id,
            'status' => $request->status_id,
            // 'status_note' => $request-,
            'driver_id' => Auth::guard('driver')->user()->id
        ]);
        $now_status = OrderTransportVoucherStatus::where('id', $statused->status_id)->first();
        return $this->helper->respon_success($now_status);
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
        if ($validasi = $this->helper->validasi($request->all(), [
            "id" => 'required',
            'isactive' => "required",
        ]))
            return $validasi;

        $orders = OrderForMobile::where('m_driver_id', $request->id)->where('isactive', $request->isactive)->get();
        return $this->helper->respon_success($orders);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request) {
        if ($validasi = $this->helper->validasi($request->all(), [
            "id" => 'required',
        ]))
            return $validasi;


        $orders = OrderDetailForMobile::where('header_id', $request->id)
            ->with(['foto'])->first();
        return $this->helper->respon_success($orders);
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
    public function upload(Request $request) {
        if ($validasi = $this->helper->validasi($request->all(), [
            "file" => 'required',
        ]))
            return $validasi;

        $orders = [];

        foreach ($request->file as $key => $file) {
            if ($request->hasFile('file.' . $key)) {
                $file = $request->file('file.' . $key);
                $filename = 'epod_' . $key . '_' . $request->id . '.' . $file['file_name']->getClientOriginalExtension();
                $file['file_name']->move(storage_path('foto_epod/'), $filename);
                $data = [
                    "status" => 1,
                    "file_name" => "",
                    "file_url" => $filename,
                    "t_truck_order_voucher_id" => $request->id,
                    "created_at" => now(),
                    "updated_at" => now(),
                ];
                array_push($orders, $data);
            } else return $this->resFailed("3", $key . " file not emitted!");
        }

        $upload = VoucherTabFile::insert($orders);
        return $this->helper->respon_success($upload);
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
