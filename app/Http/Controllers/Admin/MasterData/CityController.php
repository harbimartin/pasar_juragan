<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\GeoCity;
use App\Models\GeoProvince;
use Illuminate\Http\Request;
use Throwable;

class CityController extends Controller {
    protected $baseRoute = 'admin.master.city';
    private function getMySelect() {
        return [
            'province' => GeoProvince::where('status', 1)->get()
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $sel_filter = [
            'province' => ['name' => 'Provinsi', 'key' => 'province', 'option' => GeoProvince::get()],
        ];
        $data = GeoCity::filter($request)->paginate(10);
        return view($this->baseRoute . '.index', ['data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'select' => $this->getMySelect(), 'sel_filter' => $sel_filter]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $store = $request->validate([
            'city_name' => ['required'],
            'm_province_id' => ['required', 'exists:m_province_tab,id']
        ]);
        $store['status'] = 0;
        GeoCity::create($store);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = GeoCity::find($id);
        if ($data)
            return view($this->baseRoute . '.edit', ['data' => $data, 'select' => $this->getMySelect()]);
        return back();
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
            case 'toggle':
                GeoCity::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $store = $request->validate([
                    'city_name' => ['required'],
                    'm_province_id' => ['required', 'exists:m_province_tab,id']
                ]);
                try {
                    $city = GeoCity::find($id);
                    $city->update($store);
                } catch (Throwable $th) {
                    return back()->withErrors([
                        'update' => $th->getMessage()
                    ]);
                }
                break;
        }
        return back();
    }
}
