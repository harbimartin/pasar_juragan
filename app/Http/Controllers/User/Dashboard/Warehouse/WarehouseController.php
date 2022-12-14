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
use App\Models\Warehouse\WarehouseOpenHour;
use App\Models\Warehouse\WarehouseStorageMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
    public function index(Request $request) {
        $sel_filter = [
            'province' => ['name' => 'Provinsi', 'key' => 'province_name', 'option' => GeoProvince::get()],
            'city' => ['name' => 'Kota', 'key' => 'city_name', 'option' => GeoCity::get()],
            'function' => ['name' => 'Fungsi', 'key' => 'wh_function', 'option' => WarehouseFunction::get()],
            'category' => ['name' => 'Kategori', 'key' => 'wh_category', 'option' => WarehouseCategory::get()],
            'storage_methode' => ['name' => 'Metode Penyimpanan', 'key' => 'wh_storage_methode', 'option' => WarehouseStorageMethod::get()],
        ];
        $company_id = Auth::guard('user')->user()->company->id;
        $data = Warehouse::filter($request)->whereHas('provider', function ($q) use ($company_id) {
            $q->where('m_company_id', $company_id);
        })->paginate(10);
        return view('dashboard.warehouse.list', ['target' => 'provider', 'data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'sel_filter' => $sel_filter]);
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
            'm_wh_storage_methode' => ['required'],
            'wh_large' => ['required'],
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
        return redirect(route($this->baseRoute . '.edit', $wh->id));
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
            return view('dashboard.warehouse.edit', ['data' => $provider, 'select' => $this->getMySelect()]);
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
                return $request->toArray();
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
                    'm_wh_storage_methode' => ['required'],
                    'wh_large' => ['required']
                ]);
                try {
                    DB::beginTransaction();
                    $wh = Warehouse::find($id);
                    if ($request->has('image')) {
                        try {
                            foreach ($request->image as $ind => $img_file) {
                                $bfile = $img_file;
                                $filename = 'WH' . $wh->id . date("YmdHms") . $ind . '.' . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                                $bfile->move(storage_path('product_image/'), $filename);
                                $wh->image()->create([
                                    'image_type' => Provider::WAREHOUSE,
                                    'm_code_id' => $wh->id,
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
                    // return $request->toArray();
                    $wh->update($credentials);
                    $day_open_add = array();
                    foreach ($request->day_open as $day_open) {
                        if (isset($day_open['id'])) {
                            if (isset($day_open['open_day']))
                                WarehouseOpenHour::find($day_open['id'])->update($day_open);
                            else
                                WarehouseOpenHour::find($day_open['id'])->delete();
                        } else {
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
    public function destroy($id) {
        //
    }
}
