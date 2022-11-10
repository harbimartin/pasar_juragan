<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\Heavy\HeavyEquipmentType;
use Illuminate\Http\Request;
use Throwable;

class HeavyTypeController extends Controller {
    protected $baseRoute = 'admin.master.heavy-type';
    private function getMySelect() {
        return [];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $sel_filter = [];
        $data = HeavyEquipmentType::filter($request)->paginate(10);
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
            'heavy_equipment_type' => ['required'],
            'heavy_equipment_type_desc' => ['required']
        ]);
        $store['status'] = 0;
        HeavyEquipmentType::create($store);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = HeavyEquipmentType::find($id);
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
                HeavyEquipmentType::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $store = $request->validate([
                    'heavy_equipment_type' => ['required'],
                    'heavy_equipment_type_desc' => ['required']
                ]);
                try {
                    $heavy_equipment_type = HeavyEquipmentType::find($id);
                    $heavy_equipment_type->update($store);
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
