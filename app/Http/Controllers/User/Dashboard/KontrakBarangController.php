<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\Company;
use App\Models\Provider;
use App\Models\Transport\TruckContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class KontrakBarangController extends Controller {
    protected $baseRoute = 'dashboard.kontrak-barang';
    public static function base_index($id) {
        $contract = TruckContract::find($id);
        if ($contract) {
            $detail = $contract->status != 'Draft';
            // if ($detail) {
            $submenu = [
                ['key' => 'detail', 'name' => 'Detail'],
            ];
            $select = self::getMySelect();
            // } else {
            // }
            return [$contract, $select, $detail, $submenu];
        } else {
            return back();
        }
    }

    public static function getMySelect() {
        $company_id = Auth::guard('user')->user()->company->id;
        return [
            'angkutan' => Provider::where(['m_company_id' => $company_id, 'provider_type_id' => Provider::TRANSPORT, 'status' => 'Approved'])->get(),
            'barang' => Company::where(['status' => 1])->get()
            // 'barang' => Provider::where(['provider_type_id' => Provider::ITEM, 'status' => 'Approved'])->get()
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $company_id = Auth::guard('user')->user()->company->id;
        $data = TruckContract::whereHas('juragan_angkutan', function ($q) use ($company_id) {
            $q->where('m_company_id', $company_id);
        })->paginate(10);

        return view('dashboard.contract.item.index', ['data' => $data, 'prop' => Table::tableProp($data)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('dashboard.contract.item.regist', ['select' => $this->getMySelect()]);
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
            'juragan_angkutan_id' => ['required', 'exists:t_contract_tab,id'],
            'juragan_barang_id' => ['required', 'exists:m_company_tab,id'],
            // 'juragan_angkutan_id' => ['required', 'exists:t_contract_tab,id'],
            'contract_no' => ['required'],
            'contract_date' => ['required'],
            'contract_expired' => ['required']
        ]);
        $credentials['status'] = 1;
        $contract_angkutan = Provider::find($request->juragan_angkutan_id);
        $contract_barang = Company::find($request->juragan_barang_id);
        if (
            !$contract_barang || !$contract_angkutan
            // || $contract_barang->contract_type_id != Provider::ITEM
            || $contract_angkutan->contract_type_id != Provider::TRANSPORT
        ) {
            return back()->withErrors([
                'add' => "Provider pilihan anda tidak sesuai."
            ]);
        }
        DB::beginTransaction();
        $contract = TruckContract::create($credentials);
        if ($request->has('file')) {
            try {
                foreach ($request->file as $ind => $file) {
                    $filename = 'CO' . $contract->id . date("YmdHms") . $ind . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                    $file->move(storage_path('file_contract/'), $filename);
                    $contract->doc()->create([
                        'doc_name' => $filename,
                        'doc_attachment' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                        'status' => 1
                    ]);
                }
            } catch (Throwable $th) {
                DB::rollBack();
                return back()->withErrors([
                    'update' => "Ada kegagalan dalam menunggah File Foto. : " . $th->getMessage()
                ]);
            }
        }
        DB::commit();
        return redirect(route($this->baseRoute . '.show', $contract->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect(route('dashboard.kontrak-barang.detail', $id));
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
                $contract = TruckContract::find($id);
                if ($contract->status == 'Draft') {
                    $contract->update([
                        'status' => 'Proposed'
                    ]);
                    $contract->log()->create([
                        'user_type' => 0,
                        'user_id' => Auth::guard('user')->user()->id,
                        'status' => 'Proposed',
                        'status_note' => ''
                    ]);
                } else
                    return back()->withErrors('proposed', "Mohon maaf, status Kontrak ini bukan berbentuk Draft");
                break;
            case 'update':
                $credentials = $request->validate([
                    'm_business_category_id' => ['required'],
                    'contract_name' => ['required'],
                    'contract_npwp' => ['required'],
                    'contract_website' => ['required']
                ]);
                try {
                    $contract = TruckContract::find($id);
                    foreach ($request->file as $ind => $file) {
                        $filename = 'CO' . $contract->id . date("YmdHms") . $ind . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                        $file->move(storage_path('file_contract/'), $filename);
                        $contract->doc()->create([
                            'doc_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                            'doc_attachment' => $filename,
                            'status' => 1
                        ]);
                    }
                    $contract->update($credentials);
                } catch (Throwable $th) {
                    return back()->withErrors([
                        'update' => $th->getMessage()
                    ]);
                }
                break;
        }
        return back();
    }
}