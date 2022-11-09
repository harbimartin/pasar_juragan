<?php

namespace App\Http\Controllers\User\Dashboard\Transport;

use App\Http\Controllers\Controller;
use App\Http\Helper\Routing;
use App\Http\Helper\Table;
use App\Models\OrderTransport\OrderTransport;
use App\Models\OrderTransport\OrderTransportLog;
use App\Models\Transport\TruckContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransportPesananController extends Controller {
    protected $baseRoute = 'dashboard.order.transport';
    public static function base_index($id) {
        $order = OrderTransport::find($id);
        if ($order) {
            $detail = $order->status != 'Draft';
            $submenu = [
                ['key' => 'detail', 'name' => 'Rincian Pesanan'],
                ['key' => 'voucher', 'name' => 'Angkutan'],
                // ['key' => 'voucher-detail', 'name' => 'Barang'],
            ];
            $select = $order->status == 'Draft' ? self::getMySelect() : [];
            return [$order, $select, $detail, $submenu];
        } else {
            return back();
        }
    }
    public static function getMySelect() {
        $company_id = Auth::guard('user')->user()->company->id;
        return [
            'contract' => TruckContract::where(['status' => 'Approved'])->whereHas('juragan_barang', function ($q) use ($company_id) {
                $q->where('id', $company_id);
            })->get()
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $company_id = Auth::guard('user')->user()->company->id;
        $data = OrderTransport::whereHas('contract', function ($q) use ($company_id) {
            $q->whereHas('juragan_angkutan', function ($qq) use ($company_id) {
                $qq->where('m_company_id', $company_id);
            });
        })->where('status', '!=', 'Draft')->paginate(10);
        return view('dashboard.order.transport.index', ['data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'module' => 'Gudang']);
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
    public function show($order) {
        return redirect(route('dashboard.pesanan.juragan-angkutan.detail', $order));
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
}
