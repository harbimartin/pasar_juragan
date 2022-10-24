<?php

namespace App\Http\Controllers\User\Dashboard\Juragan\Provider;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\ProviderAddress;
use Illuminate\Http\Request;

class ProviderAddressController extends Controller {
    const baseRoute = 'dashboard.provider.address';
    public function getMySelect() {
        return [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($provider) {
        [$data, $select] = ProviderController::base_index($provider);

        return view(self::baseRoute . '.index', [
            'data' => $data,
            'select' => array_merge($select, $this->getMySelect())
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
            'provider_address_detail' => ['required'],
            'provider_city' => ['required'],
            'provider_province' => ['required'],
            'provider_country' => ['required'],
        ]);
        $provider = Provider::find($provider);
        $credentials['status'] = 1;
        $provider->address()->create($credentials);
        return back();
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
    public function edit($provider, $id) {
        return view(self::baseRoute . '.edit', ['data' => ProviderAddress::find($id), 'select' => $this->getMySelect()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $provider, $id) {
        switch ($request->__type) {
            case 'toggle':
                ProviderAddress::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'provider_address_detail' => ['required'],
                    'provider_city' => ['required'],
                    'provider_province' => ['required'],
                    'provider_country' => ['required'],
                ]);
                ProviderAddress::find($id)->update($credentials);
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
