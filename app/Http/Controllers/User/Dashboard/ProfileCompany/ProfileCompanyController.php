<?php

namespace App\Http\Controllers\User\Dashboard\ProfileCompany;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\CompanyContact;
use App\Models\ContactType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ProfileCompanyController extends Controller {
    public function base_index() {
        $data = Auth::guard('user')->user()->company;
        $select = [
            'business_category' => BusinessCategory::where('status', 1)->get()
        ];
        return [$data, $select];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return redirect(route('dashboard.profile-company.address'));
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
            case 'update':
                try {
                    if (Auth::guard('user')->user()->m_company_id != $id)
                        return back()->withErrors([
                            'update' => "Anda tidak punya otoritas untuk melakukan update pada Perusahaan ini."
                        ]);
                    $company = Company::find($id);
                    if ($request->file_logo && $request->has('file_logo.0')) {
                        try {
                            $bfile = $request->file_logo[0];
                            $filename = $company->id . '.' . date("YmdHms") . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                            if ($company->file_logo)
                                unlink(storage_path('file_logo\\') . $company->file_logo);
                            $bfile->move(storage_path('file_logo\\'), $filename);
                            $request['comp_logo'] = $filename;
                        } catch (Throwable $th) {
                            back()->withErrors([
                                'update' => "Ada kegagalan dalam menunggah File Lampiran. : " . $th->getMessage()
                            ]);
                        }
                    }
                    // return $request->toArray();
                    if ($request->_delfile_) {
                        $company->update(['lampiran_company' => null]);
                    }
                    if ($request->fname) {
                        back()->withErrors([
                            'update' => "Mohon maaf, sistem saat ini belum dapat mengubah nama File."
                        ]);
                    }
                    if ($request->__type == 'update')
                        $company->update($request->toArray());
                    else
                        $company->update(['comp_logo' => $filename]);
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
