<?php

namespace App\Http\Controllers\User\Dashboard\Transport;

use App\Http\Controllers\Controller;
use App\Models\GenSerial;
use App\Models\OrderTransport\OrderTransport;
use App\Models\OrderTransport\OrderTransportVoucher;
use App\Models\Transport\Driver;
use App\Models\Transport\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransportPesananVoucherController extends Controller {
    protected $baseRoute = 'dashboard.order.transport.voucher';
    public static function base_index($voucher) {
        $voucher = OrderTransportVoucher::find($voucher);
        if ($voucher) {
            $detail = $voucher->order->status != 'Approved';
            $submenu = [
                ['key' => 'detail', 'name' => 'Detail']
            ];
            $select = $voucher->order->status == 'Approved' ? self::getMySelect($voucher) : [];
            return [$voucher, $select, $detail, $submenu];
        } else {
            return back();
        }
    }
    public static function getMySelect($voucher_id) {
        $my_company_id = Auth::guard('user')->user()->m_company_id;
        return [
            'truck' => Truck::where('status', 1)->whereHas('provider', function ($q) use ($my_company_id) {
                $q->where('m_company_id', $my_company_id);
            })->get(),
            'driver' => Driver::where('status', 1)->whereHas('provider', function ($q) use ($my_company_id) {
                $q->where('m_company_id', $my_company_id);
            })->get(),
            // 'unloading' => UnloadingAddress::where('status', 1)->get()
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $order) {
        [$data, $select, $detail, $submenu] = TransportPesananController::base_index($order);
        if ($data->status != 'Draft')
            return view($this->baseRoute . '.index', [
                'data' => $data,
                'select' => array_merge($select, self::getMySelect($data->t_truck_contract_id)),
                'detail' => $detail,
                'submenu' => $submenu,
                'voucher_detail' => $data->status != 'Approved'
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
            'm_truck_id' => ['required'],
            'm_driver_id' => ['required'],
            'voucher_date' => ['required'],
            'voucher_close_date' => ['required'],
            'notes' => ['nullable']
        ]);
        $my_company_id = Auth::guard('user')->user()->m_company_id;
        if (
            !Truck::whereHas('provider', function ($q) use ($my_company_id) {
                $q->where('m_company_id', $my_company_id);
            })->first() ||
            !Driver::whereHas('provider', function ($q) use ($my_company_id) {
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
    public function show($contract, $voucher) {
        return redirect(route('dashboard.pesanan.juragan-angkutan.voucher-detail', [$contract, $voucher]));
        // $data = OrderTransportVoucher::find($id);
        // return view($this->baseRoute . '-detail.index', [
        //     'data' => $data,
        //     'select' => $this->getMySelect($contract),
        //     'voucher_detail' => $data->order->status != 'Draft'
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($contract, $id) {
        $data = OrderTransportVoucher::find($id);
        return view($this->baseRoute . '.edit', [
            'data' => $data,
            'select' => self::getMySelect($contract),
            'voucher_detail' => $data->order->status != 'Draft'
        ]);
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
                OrderTransportVoucher::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'm_truck_id' => ['required'],
                    'm_driver_id' => ['required'],
                    'voucher_date' => ['required'],
                    'voucher_close_date' => ['required'],
                    'notes' => ['nullable']
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

                // return $credentials;
                OrderTransportVoucher::find($id)->update($credentials);
                break;
        }
        return back();
    }
}
