<?php

namespace App\Http\Controllers\User\Dashboard\Home;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\GeoCity;
use App\Models\GeoProvince;
use App\Models\Heavy\HeavyEquipmentType;
use App\Models\Provider;
use App\Models\Heavy\TruckType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeHeavyController extends Controller {
    protected $baseRoute = 'dashboard.home.heavy';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $sel_filter = [
            'province' => ['name' => 'Provinsi', 'key' => 'province_name', 'option' => GeoProvince::where('status', 1)->get()],
            'city' => ['name' => 'Kota', 'key' => 'city_name', 'option' => GeoCity::where('status', 1)->get()],
        ];
        $filter = array();
        foreach (HeavyEquipmentType::where('status', 1)->get() as $type) {
            $filter[] = ['name' => $type->heavy_equipment_type, 'key' => 'heavy_type', 'type' => $type->id, 'col' => 'blue'];
        }
        $data = Provider::filter($request)->where('provider_type_id', Provider::HEAVY_EQUIPMENT)->whereHas('heavy', function ($q) {
            $q->where('status', 1);
        })->with(['heavy' => function ($q) {
            $q->select('m_provider_id', DB::raw('COUNT(m_heavy_equipment_tab.id) as total'), 'm_heavy_equipment_type_id')->groupBy('m_provider_id', 'm_heavy_equipment_type_id')->with('type');
        }])->paginate(10);
        return view('dashboard.heavy.catalog', ['target' => 'public', 'data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'filter' => $filter, 'sel_filter' => $sel_filter]);
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
    public function show($provider) {
        return redirect(route('dashboard.home.juragan-angkutan.service', $provider));
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
