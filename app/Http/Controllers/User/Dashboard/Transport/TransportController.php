<?php

namespace App\Http\Controllers\User\Dashboard\Transport;

use App\Http\Controllers\Controller;
use App\Models\GeoCity;
use App\Models\GeoProvince;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransportController extends Controller
{
    protected $baseRoute = 'dashboard.warehouse';
    public function getMySelect() {
        $company = Auth::guard('user')->user()->company;
        $days = [
            ['name' => 'Senin', 'id' => 1],
            ['name' => 'Selasa', 'id' => 2],
            ['name' => 'Rabu', 'id' => 3],
            ['name' => 'Kamis', 'id' => 4],
            ['name' => 'Jumat', 'id' => 5],
            ['name' => 'Sabtu', 'id' => 6],
            ['name' => 'Minggu', 'id' => 7],
        ];
        return [
            'provider' => Provider::where(['provider_type_id' => Provider::WAREHOUSE, 'm_company_id' => $company->id, 'status' => 'Approved'])->get(),
            'province' => GeoProvince::where('status', 1)->get(),
            'city' => GeoCity::where('status', 1)->get(),
            'days' => $days,
            'category' => WarehouseCategory::where('status', 1)->get(),
            'function' => WarehouseFunction::where('status', 1)->get(),
            'storage_methode' => WarehouseStorageMethod::where('status', 1)->get()
        ];
    }

    public function index()
    {
        $sel_filter = [
            'province' => ['name'=>'Provinsi', 'key'=>'province_name', 'option' => GeoProvince::get()],
            'city' => ['name'=>'Kota', 'key'=>'city_name', 'option' => GeoCity::get()],
            'function' => ['name'=>'Fungsi', 'key'=>'wh_function', 'option' => WarehouseFunction::get()],
            'category' => ['name'=>'Kategori', 'key'=>'wh_category', 'option' => WarehouseCategory::get()],
            'storage_methode' => ['name'=>'Metode Penyimpanan', 'key'=>'wh_storage_methode', 'option' => WarehouseStorageMethod::get()],
        ];
        $company_id = Auth::guard('user')->user()->company->id;
        $data = Warehouse::filter($request)->whereHas('provider', function($q)use($company_id)    {
            $q->where('m_company_id', $company_id);
        })->paginate(10);
        return view('dashboard.warehouse.list', ['data' => $data->getCollection(), 'prop'=>Table::tableProp($data), 'sel_filter'=>$sel_filter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.transport.add', ['select' => $this->getMySelect()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
