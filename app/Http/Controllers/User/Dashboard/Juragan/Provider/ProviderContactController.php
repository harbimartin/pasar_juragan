<?php

namespace App\Http\Controllers\User\Dashboard\Juragan\Provider;

use App\Http\Controllers\Controller;
use App\Models\ContactType;
use App\Models\Provider;
use App\Models\ProviderContact;
use Illuminate\Http\Request;

class ProviderContactController extends Controller {
    const baseRoute = 'dashboard.provider.contact';
    public function getMySelect() {
        return [
            'contact_type' => ContactType::where('status', 1)->get()
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($provider) {
        [$data, $select, $detail, $submenu] = ProviderController::base_index($provider);
        return view(self::baseRoute . '.index', [
            'data' => $data,
            'select' => array_merge($select, $this->getMySelect()),
            'detail' => $detail,
            'submenu' => $submenu
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
            'm_contact_type_id' => ['required'],
            'provider_contact_name' => ['required'],
            'provider_contact_position' => ['required'],
            'provider_contact' => ['required']
        ]);
        $provider = Provider::find($provider);
        $credentials['status'] = 1;
        $provider->contact()->create($credentials);
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
        return view(self::baseRoute . '.edit', ['data' => ProviderContact::find($id), 'select' => $this->getMySelect()]);
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
                ProviderContact::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'm_contact_type_id' => ['required'],
                    'provider_contact_name' => ['required'],
                    'provider_contact_position' => ['required'],
                    'provider_contact' => ['required']
                ]);
                ProviderContact::find($id)->update($credentials);
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
