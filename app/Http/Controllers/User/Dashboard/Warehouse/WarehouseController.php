<?php

namespace App\Http\Controllers\User\Dashboard\Warehouse;

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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Throwable;

class WarehouseController extends Controller {
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $company_id = Auth::guard('user')->user()->company->id;
        $data = Warehouse::whereHas('provider', function($q)use($company_id)    {
            $q->where('m_company_id', $company_id);
        })->paginate(10);
        return view('dashboard.warehouse.list', ['data' => $data->getCollection(), 'prop'=>Table::tableProp($data)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('dashboard.warehouse.add', ['select' => $this->getMySelect()]);
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
            'm_provider_id' => ['required', 'exists:t_provider_tab'],
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
            'm_wh_storage_methode' => ['required'],
            'day_open' => ['required']
        ]);
        $credentials['status'] = 1;
        if ($request->tdg_attachment && $request->hasFile('tdg_attachment.0')) {
            try {
                $user = Auth::guard('user')->user();
                $company = $user->company;
                $bfile = $request->tdg_attachment[0];
                $filename = $company->id . date("YmdHms") . '.' . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                $bfile->move(storage_path('file_tdg/'), $filename);
                $credentials['tdg_attachment'] = $filename;
            } catch (Throwable $th) {
                return back()->withErrors([
                    'add' => "Ada kegagalan dalam menunggah File Lampiran. : " . $th->getMessage()
                ]);
            }
        } else {
            return back()->withErrors([
                'add' => "Lampiran TDG wajib diupload."
            ]);
        }
        $wh = Warehouse::create($credentials);
        $wh->open_hour()->createMany($request->day_open);
        return redirect(route($this->baseRoute . '.show', $wh->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $provider = Warehouse::find($id);
        if ($provider)
            return view('dashboard.warehouse.show', ['data' => $provider, 'select' => $this->getMySelect()]);
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
                    $wh->update($credentials);
                } catch (Throwable $th) {
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
