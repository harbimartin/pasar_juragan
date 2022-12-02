<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Helper\Table;
use App\Models\ContactType;
use Illuminate\Http\Request;
use Throwable;

class ContactTypeController extends Controller {
    protected $baseRoute = 'admin.master.contact-type';
    private function getMySelect() {
        return [];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $sel_filter = [];
        $data = ContactType::filter($request)->paginate(10);
        return view('admin.master.contact-type.index', ['data' => $data->getCollection(), 'prop' => Table::tableProp($data), 'select' => $this->getMySelect(), 'sel_filter' => $sel_filter]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $store = $request->validate([
            'contact_type' => ['required']
        ]);
        $store['status'] = 0;
        ContactType::create($store);
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $data = ContactType::find($id);
        if ($data)
            return view('admin.master.contact-type.edit', ['data' => $data, 'select' => $this->getMySelect()]);
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
                ContactType::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $store = $request->validate([
                    'contact_type' => ['required'],
                ]);
                try {
                    $contact_type = ContactType::find($id);
                    $contact_type->update($store);
                } catch (Throwable $th) {
                    return back()->withErrors([
                        'contact_type' => $th->getMessage()
                    ]);
                }
                break;
        }
        return back();
    }
}
