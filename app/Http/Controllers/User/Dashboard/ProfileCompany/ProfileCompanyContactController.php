<?php

namespace App\Http\Controllers\User\Dashboard\ProfileCompany;

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
        [$data, $select] = $this->base_index();
        $select['contact_type'] = ContactType::where('status', 1)->get();

        return view('dashboard.profile-company.contact.index', ['data' => $data, 'select' => $select]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $select['contact_type'] = ContactType::where('status', 1)->get();
        return view('dashboard.profile-company.contact.edit', ['data' => CompanyContact::find($id), 'select' => $select]);
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
        $user = Auth::guard('user')->user();
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
        switch ($request->__type) {
            case 'toggle':
                CompanyContact::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'm_contact_type_id' => ['required'],
                    'comp_contact_name' => ['required'],
                    'comp_contact_position' => ['required'],
                    'comp_contact' => ['required']
                ]);
                CompanyContact::find($id)->update($credentials);
                break;
        }
        return back();
        // return redirect(route('dashboard.profile-company.contact'));
    }
}
