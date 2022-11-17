<?php

namespace App\Http\Controllers\User\Dashboard\Driver;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\Provider;
use App\Models\Transport\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class DriverController extends Controller {
    protected $baseRoute = 'dashboard.driver';
    public function getMySelect() {
        $company = Auth::guard('user')->user()->company;
        return [
            'provider' => Provider::where(['provider_type_id' => Provider::TRANSPORT, 'm_company_id' => $company->id, 'status' => 'Approved'])->get(),
        ];
    }

    public function index(Request $request) {
        $sel_filter = [];
        $company_id = Auth::guard('user')->user()->company->id;
        $data = Driver::filter($request)->whereHas('provider', function ($q) use ($company_id) {
            $q->where('m_company_id', $company_id);
        })->paginate(10);
        return view('dashboard.driver.list', ['data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'sel_filter' => $sel_filter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('dashboard.driver.add', ['select' => $this->getMySelect()]);
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
            'driver_name' => ['required'],
            'license_no' => ['required'],
            'expired_license' => ['required']
        ]);
        $credentials['status'] = 1;

        $wh = Driver::create($credentials);
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
        $provider = Driver::find($id);
        if ($provider)
            return view('dashboard.driver.edit', ['data' => $provider, 'select' => $this->getMySelect()]);
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
                Driver::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'm_provider_id' => ['required', 'exists:t_provider_tab,id'],
                    'driver_name' => ['required'],
                    'license_no' => ['required'],
                    'expired_license' => ['required'],
                    'phone' => ['required'],
                    'email' => ['required', 'email']
                ]);
                try {
                    DB::beginTransaction();
                    $truck = Driver::find($id);
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
