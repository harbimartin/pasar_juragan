<?php

namespace App\Http\Controllers\User\Dashboard\Home;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\GeoCity;
use App\Models\GeoProvince;
use App\Models\Provider;
use App\Models\Warehouse\Warehouse;
use App\Models\Warehouse\WarehouseCategory;
use App\Models\Warehouse\WarehouseFunction;
use App\Models\Warehouse\WarehouseStorageMethod;
use Illuminate\Http\Request;

class HomeWarehouseController extends Controller {
    protected $baseRoute = 'dashboard.home.warehouse';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $sel_filter = [
            'provider' => ['name' => 'Provider', 'key' => 'provider_name', 'option' => Provider::whereHas('warehouse', function ($q) {
                $q->where('status', 1);
            })->where('status', 'Approved')->get()],
            'province' => ['name' => 'Provinsi', 'key' => 'province_name', 'option' => GeoProvince::where('status', 1)->get()],
            'city' => ['name' => 'Kota', 'key' => 'city_name', 'option' => GeoCity::where('status', 1)->get()],
            'function' => ['name' => 'Fungsi', 'key' => 'wh_function', 'option' => WarehouseFunction::where('status', 1)->get()],
            'category' => ['name' => 'Kategori', 'key' => 'wh_category', 'option' => WarehouseCategory::where('status', 1)->get()],
            'storage_methode' => ['name' => 'Metode Penyimpanan', 'key' => 'wh_storage_methode', 'option' => WarehouseStorageMethod::where('status', 1)->get()],
        ];
        $data = Warehouse::filter($request)->where('status', 1)->paginate(10);
        return view('dashboard.warehouse.catalog', ['target' => 'public', 'data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'sel_filter' => $sel_filter]);
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
        $provider = Warehouse::find($id);
        $select = [
            'days' => [
                ['name' => 'Senin', 'id' => 1],
                ['name' => 'Selasa', 'id' => 2],
                ['name' => 'Rabu', 'id' => 3],
                ['name' => 'Kamis', 'id' => 4],
                ['name' => 'Jumat', 'id' => 5],
                ['name' => 'Sabtu', 'id' => 6],
                ['name' => 'Minggu', 'id' => 7],
            ]
        ];
        if ($provider)
            return view('dashboard.warehouse.show', ['data' => $provider, 'select' => $select]);
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
        //
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
