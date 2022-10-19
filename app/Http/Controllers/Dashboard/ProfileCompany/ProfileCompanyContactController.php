<?php

namespace App\Http\Controllers\Dashboard\ProfileCompany;

use App\Http\Controllers\Controller;
use App\Models\CompanyContact;
use App\Models\ContactType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileCompanyContactController extends ProfileCompanyController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        [$data, $select] = parent::index();
        $select['contact_type'] = ContactType::where('status', 1)->get();

        return view('dashboard.profile_company.contact.index', ['data' => $data, 'select' => $select]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $select['contact_type'] = ContactType::where('status', 1)->get();
        return view('dashboard.profile_company.contact.edit', ['data' => CompanyContact::find($id), 'select' => $select]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $credentials = $request->validate([
            'm_contact_type_id' => ['required'],
            'comp_contact_name' => ['required'],
            'comp_contact_position' => ['required'],
            'comp_contact' => ['required']
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
            'm_contact_type_id' => ['required'],
            'comp_contact_name' => ['required'],
            'comp_contact_position' => ['required'],
            'comp_contact' => ['required']
        ]);
        CompanyContact::find($id)->update($credentials);
        return redirect(route('dashboard.company-profile.contact'));
    }
}
