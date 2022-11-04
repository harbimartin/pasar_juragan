<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\GenSerial;
use App\Models\OrderTransport\OrderTransport;
use App\Models\OrderTransport\OrderTransportLog;
use App\Models\Transport\TruckContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class PesananAngkutanController extends Controller {
    protected $baseRoute = 'dashboard.pesanan-angkutan';
    public static function base_index($id) {
        $order = OrderTransport::find($id);
        if ($order) {
            $detail = $order->status != 'Draft';
            $submenu = [
                ['key' => 'detail', 'name' => 'Detail'],
            ];
            $select = self::getMySelect();
            return [$order, $select, $detail, $submenu];
        } else {
            return back();
        }
    }

    public static function getMySelect() {
        $company_id = Auth::guard('user')->user()->company->id;
        return [
            'contract' => TruckContract::where(['status' => 'Approved'])->whereHas('juragan_barang', function ($q) use ($company_id) {
                $q->where('id', $company_id);
            })->get()
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $company_id = Auth::guard('user')->user()->company->id;
        $data = OrderTransport::whereHas('contract', function ($q) use ($company_id) {
            $q->where('juragan_barang_id', $company_id);
        })->paginate(10);
        return view('dashboard.order.transport.index', ['data' => $data, 'prop' => Table::tableProp($data)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('dashboard.order.transport.regist', ['select' => $this->getMySelect()]);
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
            'to_desc' => ['required'],
            't_truck_contract_id' => ['required']
        ]);
        DB::beginTransaction();
        $credentials['to_no'] = GenSerial::generateCode('DO');
        $credentials['to_date'] = now();
        $credentials['status'] = 'Draft';
        $company_id = Auth::guard('user')->user()->company->id;
        $contract = TruckContract::find($request->t_truck_contract_id);
        if (
            !$contract || $contract->juragan_barang_id != $company_id
        ) {
            return back()->withErrors([
                'add' => "Provider pilihan anda tidak sesuai."
            ]);
        }
        $order = OrderTransport::create($credentials);
        DB::commit();
        return redirect(route($this->baseRoute . '.show', $order->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect(route('dashboard.pesanan-angkutan.detail', $id));
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
                $order = OrderTransport::find($id);
                if ($order->status == 'Draft') {
                    $order->update([
                        'status' => 'Proposed'
                    ]);
                    $order->log()->create([
                        'user_type' => OrderTransportLog::JURAGAN_BARANG,
                        'user_id' => Auth::guard('user')->user()->id,
                        'status' => 'Proposed',
                        'status_note' => ''
                    ]);
                } else
                    return back()->withErrors('proposed', "Mohon maaf, status Kontrak ini bukan berbentuk Draft");
                break;
            case 'update':
                $credentials = $request->validate([
                    'juragan_angkutan_id' => ['required', 'exists:t_provider_tab,id'],
                    'juragan_barang_id' => ['required', 'exists:m_company_tab,id'],
                    'order_no' => ['required'],
                    'order_desc' => ['required'],
                    'order_date' => ['required'],
                    'order_expired' => ['required']
                ]);
                try {
                    $order = TruckContract::find($id);
                    if ($request->has('file')) {
                        foreach ($request->file as $ind => $file) {
                            $filename = 'CO' . $order->id . date("YmdHms") . $ind . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                            $file->move(storage_path('file_order/'), $filename);
                            $order->doc()->create([
                                'doc_name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                                'doc_attachment' => $filename,
                                'status' => 1
                            ]);
                        }
                    }
                    $order->update($credentials);
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
