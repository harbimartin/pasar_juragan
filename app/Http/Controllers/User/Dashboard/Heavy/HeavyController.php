<?php

namespace App\Http\Controllers\User\Dashboard\Heavy;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\GeoCity;
use App\Models\GeoProvince;
use App\Models\Heavy\HeavyEquipment;
use App\Models\Heavy\HeavyEquipmentType;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class HeavyController extends Controller {
    protected $baseRoute = 'dashboard.heavy';
    public function getMySelect() {
        $company = Auth::guard('user')->user()->company;
        return [
            'provider' => Provider::where(['provider_type_id' => Provider::HEAVY_EQUIPMENT, 'm_company_id' => $company->id, 'status' => 'Approved'])->get(),
            'heavy_type' => HeavyEquipmentType::where('status', 1)->get(),
            'province' => ['name' => 'Provinsi', 'key' => 'province_name', 'option' => GeoProvince::where('status', 1)->get()],
            'city' => ['name' => 'Kota', 'key' => 'city_name', 'option' => GeoCity::where('status', 1)->get()],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $sel_filter = [
            'type' => ['name' => 'Type', 'key' => 'heavy_equipment_type', 'option' => HeavyEquipmentType::get()],
        ];
        $company_id = Auth::guard('user')->user()->company->id;
        $data = HeavyEquipment::filter($request)->whereHas('provider', function ($q) use ($company_id) {
            $q->where('m_company_id', $company_id);
        })->paginate(10);
        return view('dashboard.heavy.list', ['data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'sel_filter' => $sel_filter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('dashboard.heavy.add', ['select' => $this->getMySelect()]);
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
            'm_heavy_equipment_type_id' => ['required'],
            'equipment_code' => ['required'],
            'equipment_brand' => ['required'],
            'equipment_desc' => ['required'],
            'operational_weight' => ['required'],
        ]);
        $credentials['status'] = 1;
        if ($request->equipment_attachment && $request->hasFile('equipment_attachment.0')) {
            try {
                $user = Auth::guard('user')->user();
                $company = $user->company;
                $bfile = $request->equipment_attachment[0];
                $filename = $company->id . date("YmdHms") . '.' . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                $bfile->move(storage_path('file_tdg/'), $filename);
                $credentials['equipment_attachment'] = $filename;
            } catch (Throwable $th) {
                return back()->withErrors([
                    'add' => "Ada kegagalan dalam menunggah File Lampiran. : " . $th->getMessage()
                ]);
            }
        } else {
            return back()->withErrors([
                'add' => "Lampiran Attachment wajib diupload."
            ]);
        }

        $heavy = HeavyEquipment::create($credentials);
        return redirect(route($this->baseRoute . '.edit', $heavy->id));
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
        $provider = HeavyEquipment::find($id);
        if ($provider)
            return view('dashboard.heavy.edit', ['data' => $provider, 'select' => $this->getMySelect()]);
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
                HeavyEquipment::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'm_provider_id' => ['required', 'exists:t_provider_tab,id'],
                    'm_heavy_equipment_type_id' => ['required'],
                    'equipment_code' => ['required'],
                    'equipment_brand' => ['required'],
                    'equipment_desc' => ['required'],
                    'operational_weight' => ['required'],
                ]);
                try {
                    DB::beginTransaction();
                    $heavy = HeavyEquipment::find($id);
                    if ($request->equipment_attachment && $request->has('equipment_attachment.0')) {
                        try {
                            $bfile = $request->equipment_attachment[0];
                            $filename = $heavy->id . date("YmdHms") . '.' . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                            if ($heavy->equipment_attachment)
                                unlink(storage_path('file_tdg/') . $heavy->equipment_attachment);
                            $bfile->move(storage_path('file_tdg/'), $filename);
                            $credentials['equipment_attachment'] = $filename;
                        } catch (Throwable $th) {
                            back()->withErrors([
                                'update' => "Ada kegagalan dalam menunggah File Lampiran. : " . $th->getMessage()
                            ]);
                        }
                    }

                    if ($request->has('image')) {
                        try {
                            foreach ($request->image as $ind => $img_file) {
                                $bfile = $img_file;
                                $filename = 'HV' . $heavy->id . date("YmdHms") . $ind . '.' . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                                $bfile->move(storage_path('product_image/'), $filename);
                                $heavy->image()->create([
                                    'image_type' => Provider::HEAVY_EQUIPMENT,
                                    'm_code_id' => $heavy->id,
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
                    $heavy->update($credentials);
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
