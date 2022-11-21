<?php

namespace App\Http\Controllers\User\Dashboard\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Helper\Routing;
use App\Http\Helper\Table;
use App\Models\OrderWarehouse\OrderWarehouse;
use App\Models\Warehouse\WarehouseContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WarehousePesananController extends Controller {
    protected $baseRoute = 'dashboard.order.warehouse';
    public static function base_index($id) {
        $order = OrderWarehouse::find($id);
        if ($order) {
            $detail = $order->status != 'Draft';
            $submenu = [
                ['key' => 'detail', 'name' => 'Rincian Pesanan'],
                // ['key' => 'voucher', 'name' => 'Angkutan'],
                // ['key' => 'voucher-detail', 'name' => 'Barang'],
            ];
            $select = $order->status == 'Draft' ? self::getMySelect() : [];
            return [$order, $select, $detail, $submenu];
        }
        return null;
    }
    public static function getMySelect() {
        $company_id = Auth::guard('user')->user()->company->id;
        return [
            'contract' => WarehouseContract::where(['status' => 'Approved'])->whereHas('juragan_barang', function ($q) use ($company_id) {
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
        $data = OrderWarehouse::whereHas('contract', function ($q) use ($company_id) {
            $q->whereHas('juragan_gudang', function ($qq) use ($company_id) {
                $qq->where('m_company_id', $company_id);
            });
        })->where('status', '!=', 'Draft')->paginate(10);
        return view('dashboard.order.warehouse.index', ['data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'module' => 'Gudang']);
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
        return redirect(route('dashboard.pesanan.juragan-gudang.detail', $order));
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
