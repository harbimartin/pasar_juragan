<?php

namespace App\Http\Controllers\Admin\Angkutan;

use App\Http\Controllers\Controller;
use App\Http\Helper\Routing;
use App\Http\Helper\Table;
use App\Models\Provider;
use Illuminate\Http\Request;

class AngkutanRegistController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = Provider::where(['status' => 'Proposed', 'provider_type_id'=>Provider::TRANSPORT])->paginate();
        return view('admin.provider.index', ['data' => $data->getCollection(), 'prop' => Table::tableProp($data)]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $provider = Provider::find($id);
        if ($provider && $provider->status == "Proposed")
            return view('admin.provider.show', ['data'=>$provider]);
        return back();
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
        Provider::find($id)->update([
            'status' => 'Approved'
        ]);
        return redirect(route(str_replace('.update', '', Routing::getCurrentRouteName())));
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
