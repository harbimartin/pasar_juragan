<?php

namespace App\Http\Controllers\Dashboard\JuraganGudang;

use App\Models\Provider;
use App\Models\ProviderLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class JuraganGudangAddressController extends JuraganGudangController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        [$data, $select] = $this->base_index();

        return view('dashboard.juragan-gudang.address.index', ['data' => $data, 'select' => $select]);
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
    public function store(Request $request) {
        // return $request->toArray();
        $credentials = $request->validate([
            'm_business_category_id' => ['required'],
            'provider_name' => ['required'],
            'provider_npwp' => ['required'],
            'provider_website' => ['required']
        ]);
        try {
            DB::beginTransaction();
            $user = Auth::guard('user')->user();
            $company = $user->company;
            if ($request->file_logo && $request->has('file_logo.0')) {
                try {
                    $bfile = $request->file_logo[0];
                    $filename = $company->id . '.' . date("YmdHms") . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                    if ($company->file_logo)
                        unlink(storage_path('file_logo\\') . $company->file_logo);
                    $bfile->move(storage_path('file_logo\\'), $filename);
                    $credentials['provider_logo'] = $filename;
                } catch (Throwable $th) {
                    back()->withErrors([
                        'add' => "Ada kegagalan dalam menunggah File Lampiran. : " . $th->getMessage()
                    ]);
                }
            } else {
                $credentials['provider_logo'] = $request->comp_logo;
            }
            $credentials['status'] = 'Draft';
            $credentials['provider_type_id'] = Provider::WAREHOUSE;

            $wh = $company->warehouse_provider()->create($credentials);
            $wh->log()->create([
                'user_id' => $user->id,
                'user_type' => ProviderLog::PROVIDER,
                'status' => 'Draft'
            ]);

            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            back()->withErrors([
                'add' => $th->getMessage()
            ]);
        }
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
    public function edit($id) {
        //
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
                $credentials = $request->validate([
                    'm_business_category_id' => ['required'],
                    'provider_name' => ['required'],
                    'provider_npwp' => ['required'],
                    'provider_website' => ['required']
                ]);
                try {
                    $company = Provider::find($id);
                    if ($request->file_logo && $request->has('file_logo.0')) {
                        try {
                            $bfile = $request->file_logo[0];
                            $filename = $company->id . '.' . date("YmdHms") . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                            if ($company->file_logo)
                                unlink(storage_path('file_logo\\') . $company->file_logo);
                            $bfile->move(storage_path('file_logo\\'), $filename);
                            $credentials['provider_logo'] = $filename;
                        } catch (Throwable $th) {
                            back()->withErrors([
                                'update' => "Ada kegagalan dalam menunggah File Lampiran. : " . $th->getMessage()
                            ]);
                        }
                    }
                    $company->update($credentials);
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
