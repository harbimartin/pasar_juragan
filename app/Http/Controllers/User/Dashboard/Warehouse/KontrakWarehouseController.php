<?php

namespace App\Http\Controllers\User\Dashboard\Warehouse;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\Company;
use App\Models\Provider;
use App\Models\Warehouse\WarehouseContract;
use App\Models\Warehouse\WarehouseContractLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class KontrakWarehouseController extends Controller {
    protected $baseRoute = 'dashboard.kontrak-gudang';
    public static function base_index($id) {
        $contract = WarehouseContract::find($id);
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
        }
        return null;
    }

    public static function getMySelect() {
        $company_id = Auth::guard('user')->user()->company->id;
        return [
            'gudang' => Provider::where(['m_company_id' => $company_id, 'provider_type_id' => Provider::WAREHOUSE, 'status' => 'Approved'])->get(),
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
        $data = WarehouseContract::whereHas('juragan_gudang', function ($q) use ($company_id) {
            $q->where('m_company_id', $company_id);
        })->paginate(10);

        return view('dashboard.contract.warehouse.index', ['data' => $data, 'prop' => Table::tableProp($data)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('dashboard.contract.warehouse.regist', ['select' => $this->getMySelect()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $credentials = $request->validate([
            'juragan_gudang_id' => ['required', 'exists:t_provider_tab,id'],
            'juragan_barang_id' => ['required', 'exists:m_company_tab,id'],
            // 'juragan_gudang_id' => ['required', 'exists:t_contract_tab,id'],
            'contract_no' => ['required'],
            'contract_desc' => ['required'],
            'contract_date' => ['required'],
            'contract_expired' => ['required']
        ]);
        $credentials['status'] = 'Draft';
        $contract_gudang = Provider::find($request->juragan_gudang_id);
        $contract_barang = Company::find($request->juragan_barang_id);
        if (
            !$contract_barang || !$contract_gudang
            // || $contract_barang->contract_type_id != Provider::ITEM
            || $contract_gudang->provider_type_id != Provider::WAREHOUSE
        ) {
            return back()->withErrors([
                'add' => "Provider pilihan anda tidak sesuai."
            ]);
        }
        DB::beginTransaction();
        $contract = WarehouseContract::create($credentials);
        if ($request->has('file')) {
            try {
                foreach ($request->file as $ind => $file) {
                    $filename = 'CW' . $contract->id . date("YmdHms") . $ind . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
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
        return redirect(route('dashboard.kontrak-gudang.detail', $id));
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
                $contract = WarehouseContract::find($id);
                if ($contract->status == 'Draft') {
                    $contract->update([
                        'status' => 'Proposed'
                    ]);
                    $contract->log()->create([
                        'user_type' => WarehouseContractLog::JURAGAN_GUDANG,
                        'user_id' => Auth::guard('user')->user()->id,
                        'status' => 'Proposed',
                        'status_note' => ''
                    ]);
                } else
                    return back()->withErrors(['proposed' => "Mohon maaf, status Kontrak ini bukan berbentuk Draft"]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'juragan_gudang_id' => ['required', 'exists:t_provider_tab,id'],
                    'juragan_barang_id' => ['required', 'exists:m_company_tab,id'],
                    'contract_no' => ['required'],
                    'contract_desc' => ['required'],
                    'contract_date' => ['required'],
                    'contract_expired' => ['required']
                ]);
                try {
                    $contract = WarehouseContract::find($id);
                    if ($request->has('file')) {
                        foreach ($request->file as $ind => $file) {
                            $filename = 'CW' . $contract->id . date("YmdHms") . $ind . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                            $file->move(storage_path('file_contract/'), $filename);
                            $contract->doc()->create([
                                'doc_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                                'doc_attachment' => $filename,
                                'status' => 1
                            ]);
                        }
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
