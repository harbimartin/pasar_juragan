<?php

namespace App\Http\Controllers\User\Dashboard\Juragan\Provider;

use App\Http\Controllers\Controller;
use App\Models\GeoCity;
use App\Models\GeoProvince;
use App\Models\Provider;
use App\Models\Transport\Truck;
use App\Models\Transport\TruckType;
use Illuminate\Http\Request;

class ProviderTransportController extends Controller {
    const baseRoute = 'dashboard.provider.transport';
    public function getMySelect() {
        return [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $provider) {
        [$data, $select, $detail, $submenu] = ProviderController::base_index($provider);

        $sel_filter = [
            'type' => ['name' => 'Tipe', 'key' => 'truck_type', 'option' => TruckType::where('status', 1)->get()],
        ];
        $transports = Truck::filter($request)->where('m_provider_id', $data->id)->paginate(10);
        return view(self::baseRoute . '.index', [
            'data' => $data,
            'transports' => $transports,
            'select' => array_merge($select, $this->getMySelect()),
            'detail' => $detail,
            'submenu' => $submenu,
            'target' => 'public',
            'sel_filter' => $sel_filter
        ]);
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
    public function store(Request $request, $provider) {
        $credentials = $request->validate([
            'service_title' => ['required'],
            'service_desc' => ['required'],
            'service_reference' => ['required']
        ]);
        $provider = Provider::find($provider);
        $credentials['status'] = 1;
        $provider->service()->create($credentials);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($provider, $id) {
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
        return view(self::baseRoute . '.show', ['data' => Truck::find($id), 'select' => $select]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($provider, $id) {
        return view(self::baseRoute . '.edit', ['data' => Truck::find($id), 'select' => $this->getMySelect()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $juragan, $id) {
        switch ($request->__type) {
            case 'toggle':
                Truck::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'service_title' => ['required'],
                    'service_desc' => ['required'],
                    'service_reference' => ['required']
                ]);
                Truck::find($id)->update($credentials);
                break;
        }
        return back();
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
