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

class TransportController extends Controller
{
    protected $baseRoute = 'dashboard.transport';
    public function getMySelect() {
        $company = Auth::guard('user')->user()->company;
        return [
            'provider' => Provider::where(['provider_type_id' => Provider::TRANSPORT, 'm_company_id' => $company->id, 'status' => 'Approved'])->get(),
            'truck_type' => TruckType::where('status', 1)->get()
        ];
    }

    public function index(Request $request)
    {
        $sel_filter = [
            'type' => ['name'=>'Type', 'key'=>'truck_type', 'option' => TruckType::get()],
        ];
        $company_id = Auth::guard('user')->user()->company->id;
        $data = Truck::filter($request)->whereHas('provider', function($q)use($company_id)    {
            $q->where('m_company_id', $company_id);
        })->paginate(10);
        return view('dashboard.transport.list', ['data' => $data->getCollection(), 'prop'=>Table::tableProp($data), 'sel_filter'=>$sel_filter]);
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
        // return $request->toArray();
        $credentials = $request->validate([
            'm_provider_id' => ['required', 'exists:t_provider_tab,id'],
            'plate_no' => ['required'],
            'm_truck_type_id' => ['required'],
            'stnk_no' => ['required'],
            'kir_no' => ['required'],
            'expired_stnk' => ['required'],
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
        $provider = Warehouse::find($id);
        if ($provider)
            return view('dashboard.transport.show', ['data' => $provider, 'select' => $this->getMySelect()]);
        return back();
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
        switch ($request->__type) {
            case 'toggle':
                Warehouse::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'm_provider_id' => ['required', 'exists:t_provider_tab,id'],
                    'wh_name' => ['required'],
                    'm_province_id' => ['required'],
                    'm_city_id' => ['required'],
                    'address_detail' => ['required'],
                    'longitude' => ['required'],
                    'latitude' => ['required'],
                    'wh_pic_email' => ['required'],
                    'wh_pic_telephone' => ['required'],
                    'wh_pic_fax' => ['required'],
                    'wh_pic_phone' => ['required'],
                    'tdg_no' => ['required'],
                    'tdg_date' => ['required'],
                    'tdg_expired_date' => ['required'],
                    'm_wh_category_id' => ['required'],
                    'm_wh_function_id' => ['required'],
                    'm_wh_storage_methode' => ['required']
                ]);
                try {
                    DB::beginTransaction();
                    $wh = Warehouse::find($id);
                    if ($request->file_logo && $request->has('file_logo.0')) {
                        try {
                            $bfile = $request->file_logo[0];
                            $filename = $wh->id . date("YmdHms") . '.' . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                            if ($wh->file_logo)
                                unlink(storage_path('file_provider/') . $wh->file_provider);
                            $bfile->move(storage_path('file_provider/'), $filename);
                            $credentials['provider_logo'] = $filename;
                        } catch (Throwable $th) {
                            back()->withErrors([
                                'update' => "Ada kegagalan dalam menunggah File Lampiran. : " . $th->getMessage()
                            ]);
                        }
                    }
                    // return $request->toArray();
                    $wh->update($credentials);
                    $day_open_add = array();
                    foreach($request->day_open as $day_open){
                        if (isset($day_open['id'])){
                            if (isset($day_open['open_day']))
                                WarehouseOpenHour::find($day_open['id'])->update($day_open);
                            else
                                WarehouseOpenHour::find($day_open['id'])->delete();
                        }else{
                            if (isset($day_open['open_day']))
                                $day_open_add[] = $day_open;
                        }
                    }
                    if (sizeof($day_open_add) > 0)
                        $wh->open_hour()->createMany($day_open_add);
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
    public function destroy($id)
    {
        //
    }
}
