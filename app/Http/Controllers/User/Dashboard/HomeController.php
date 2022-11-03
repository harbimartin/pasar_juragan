<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Heavy\HeavyEquipment;
use App\Models\Provider;
use App\Models\Warehouse\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Mail\Transport\Transport;

class HomeController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $total = [
            'warehouse' =>  Warehouse::where('status', 1)->count(),
            'transport' =>  Provider::where('provider_type_id', Provider::TRANSPORT)->whereHas('truck', function($q){
                $q->where('status', 1);
            })->count(),
            'equipment' =>  Provider::where('provider_type_id', Provider::HEAVY_EQUIPMENT)->whereHas('heavy', function($q){
                $q->where('status', 1);
            })->count(),
        ];
        return view('dashboard.home.index', ['total' => $total]);
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
        //
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
