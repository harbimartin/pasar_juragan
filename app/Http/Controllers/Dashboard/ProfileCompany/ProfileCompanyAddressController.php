<?php

namespace App\Http\Controllers\Dashboard\ProfileCompany;

use App\Http\Controllers\Controller;
use App\Models\CompanyAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCompanyAddressController extends ProfileCompanyController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        [$data, $select] = parent::index();

        return view('dashboard.profile_company.address.index', ['data' => $data, 'select' => $select]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        return view('dashboard.profile_company.address.edit', ['data' => CompanyAddress::find($id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $credentials = $request->validate([
            'comp_address_detail' => ['required'],
            'comp_city' => ['required'],
            'comp_province' => ['required'],
            'comp_country' => ['required'],
        ]);
        $user = Auth::user();
        $credentials['status'] = 1;
        $user->company->contact()->create($credentials);
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
        $credentials = $request->validate([
            'comp_address_detail' => ['required'],
            'comp_city' => ['required'],
            'comp_province' => ['required'],
            'comp_country' => ['required'],
        ]);
        CompanyAddress::find($id)->update($credentials);
        return redirect(route('dashboard.company-profile.contact'));
    }
}
