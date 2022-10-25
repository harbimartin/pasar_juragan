<?php

namespace App\Http\Controllers\User\Dashboard\Juragan\Provider;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\BusinessCategory;
use App\Models\Document;
use App\Models\Provider;
use App\Models\ProviderLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Throwable;

class ProviderController extends Controller {
    protected $providerType = '';
    protected $baseRoute = '';

    public static function base_index($gudang) {
        $data = Provider::find($gudang);
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
        $company = Auth::guard('user')->user()->company;
        $data = Provider::where(['m_company_id' => $company->id, 'provider_type_id' => $this->providerType])->paginate(10);

        return view('dashboard.provider.list', ['data' => $data, 'prop' => Table::tableProp($data)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $data = Auth::guard('user')->user()->company;
        $select = [
            'business_category' => BusinessCategory::where('status', 1)->get()
        ];

        return view('dashboard.provider.regist', ['data' => $data, 'select' => $select]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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
                        unlink(storage_path('file_logo/') . $company->file_logo);
                    $bfile->move(storage_path('file_logo/'), $filename);
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
            $credentials['provider_type_id'] = $this->providerType;

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
        return redirect(route($this->baseRoute . '.show', $wh->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect(route($this->baseRoute . '.address', [$id]));
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
            case 'propose':
                $provider = Provider::find($id);
                $provider_id = $provider->id;
                $require = Document::whereDoesntHave('provider', function ($qq) use ($provider_id) {
                    $qq->where('t_provider_id', $provider_id)->where('status', '=', 1);
                })->where(['m_provider_type_id' => $provider->provider_type_id, 'status' => 1])->get();
                if (sizeof($require) > 0) {
                    return back()->withErrors([
                        'update' => 'Gagal melakukan propose! Pastikan anda telah mengisi semua persayaratan dokumen yang harus diunggah. (Pilih Tab Dokumen untuk informasi lebih rinci).'
                    ]);
                }
                return $require;
                $provider->update([
                    'status' => 'Proposed'
                ]);
                $provider->log()->create([
                    'user_type' => 0,
                    'user_id' => Auth::guard('user')->user()->id,
                    'status' => 'Proposed',
                    'status_note' => ''
                ]);
                break;
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
                            $filename = $company->id . date("YmdHms") . '.' . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                            if ($company->file_logo)
                                unlink(storage_path('file_provider/') . $company->file_provider);
                            $bfile->move(storage_path('file_provider/'), $filename);
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
