<?php

namespace App\Http\Controllers\User\Dashboard\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\GeoCity;
use App\Models\GeoProvince;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WarehouseController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // $company = Auth::guard('user')->user()->company;
        $data = [
            "id" => "1"
        ];
        // $data = $data->paginate(10);
        return view('dashboard.warehouse.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $call_province = GeoProvince::all();
        $call_city = GeoCity::all();
        $days = [
            ['name' => 'Senin', 'id' => 1],
            ['name' => 'Selasa', 'id' => 2],
            ['name' => 'Rabu', 'id' => 3],
            ['name' => 'Kamis', 'id' => 4],
            ['name' => 'Jumat', 'id' => 5],
            ['name' => 'Sabtu', 'id' => 6],
            ['name' => 'Minggu', 'id' => 7],
        ];
        $warehouse_type = [
            ['nama' => 'Terbuka', 'id' => 1],
            ['nama' => 'Tertutup', 'id' => 2],
        ];
        $warehouse_func = [
            ['nama' => 'TPS', 'id' => 1],
            ['nama' => 'PLB', 'id' => 2],
            ['nama' => 'tulisan tidak terbaca', 'id' => 3],
        ];
        $select = [
            'province' => $call_province,
            'city' => $call_city,
            'days' => $days,
            'warehouse_type' => $warehouse_type,
            'warehouse_func' => $warehouse_func
        ];
        // return $select;
        return view('dashboard.warehouse.add', ['select' => $select]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return $request->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
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

        return $request->toArray();
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
