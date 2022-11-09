<?php

namespace App\Http\Controllers\User\Dashboard\Transport;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\GeoCity;
use App\Models\GeoProvince;
use App\Models\Provider;
use App\Models\Transport\Truck;
use App\Models\Transport\TruckType;
use App\Models\Warehouse\Warehouse;
use App\Models\Warehouse\WarehouseCategory;
use App\Models\Warehouse\WarehouseFunction;
use App\Models\Warehouse\WarehouseOpenHour;
use App\Models\Warehouse\WarehouseStorageMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class TransportController extends Controller {
    protected $baseRoute = 'dashboard.transport';
    public function getMySelect() {
        $company = Auth::guard('user')->user()->company;
        return [
            'provider' => Provider::where(['provider_type_id' => Provider::TRANSPORT, 'm_company_id' => $company->id, 'status' => 'Approved'])->get(),
            'truck_type' => TruckType::where('status', 1)->get(),
        ];
    }

    public function index(Request $request) {
        $sel_filter = [
            'type' => ['name' => 'Type', 'key' => 'truck_type', 'option' => TruckType::get()],
        ];
        $company_id = Auth::guard('user')->user()->company->id;
        $data = Truck::filter($request)->whereHas('provider', function ($q) use ($company_id) {
            $q->where('m_company_id', $company_id);
        })->paginate(10);
        return view('dashboard.transport.list', ['data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'sel_filter' => $sel_filter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('dashboard.transport.add', ['select' => $this->getMySelect()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // return $request->toArray();
        $credentials = $request->validate([
            'm_provider_id' => ['required', 'exists:t_provider_tab,id'],
            'plate_no' => ['required'],
            'm_truck_type_id' => ['required'],
            'stnk_no' => ['required'],
            'kir_no' => ['required'],
            'expired_stnk' => ['required'],
            'expired_kir' => ['required'],
            'gps_imei' => ['required'],
            'gps_url' => ['required'],
            'gps_api_key' => ['required'],
        ]);
        $credentials['status'] = 1;

        $wh = Truck::create($credentials);
        return redirect(route($this->baseRoute . '.edit', $wh->id));
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
        $provider = Truck::find($id);
        if ($provider)
            return view('dashboard.transport.edit', ['data' => $provider, 'select' => $this->getMySelect()]);
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
                Truck::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'm_provider_id' => ['required', 'exists:t_provider_tab,id'],
                    'plate_no' => ['required'],
                    'm_truck_type_id' => ['required'],
                    'stnk_no' => ['required'],
                    'kir_no' => ['required'],
                    'gps_imei' => ['required'],
                    'gps_url' => ['required'],
                    'gps_api_key' => ['required'],
                ]);
                try {
                    DB::beginTransaction();
                    $truck = Truck::find($id);
                    if ($request->has('image')) {
                        try {
                            foreach ($request->image as $ind => $img_file) {
                                $bfile = $img_file;
                                $filename = 'TP' . $truck->id . date("YmdHms") . $ind . '.' . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                                $bfile->move(storage_path('product_image/'), $filename);
                                $truck->image()->create([
                                    'image_type' => Provider::TRANSPORT,
                                    'm_code_id' => $truck->id,
                                    'image_url' => $filename,
                                    'image_desc' => pathinfo($bfile->getClientOriginalName(), PATHINFO_FILENAME)
                                ]);
                            }
                        } catch (Throwable $th) {
                            back()->withErrors([
                                'update' => "Ada kegagalan dalam menunggah File Foto. : " . $th->getMessage()
                            ]);
                        }
                    }
                    $truck->update($credentials);
                    DB::commit();
                } catch (Throwable $th) {
                    DB::rollback();
                    return back()->withErrors([
                        'update' => $th->getMessage()
                    ]);
                }
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
