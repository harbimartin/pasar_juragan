<?php

namespace App\Http\Controllers\API\utils;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\States;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use NunoMaduro\Collision\Adapters\Phpunit\State;

class UtilsApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_city(Request $request)
    {
        // $get_list_state = States::all();
        $array_city = array();
        // foreach ($get_list_state as $value) {
            $call_city_api = Http::post($request->url_postman, [
                'country' => 'Indonesia',
                'state' => 'Aceh'
                // 'state' => $value['province_name']
            ]);
// Maluku Island,
            foreach ($call_city_api['data'] as $item) {
                $data = [
                    'm_province_id' => 1,
                    'city_name' => $item,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
                array_push($array_city, $data);
            }
        // }

        // $state = City::insert($array_city);
        
        return response()->json($array_city);
    }

    public function store_province(Request $request)
    {
        // // All Country
        // // $call_province = Http::get($request->url_postman);
        // // $province = array();
        // // foreach ($call_province['data'] as $value) {
        // //     foreach ($call_province['data']['states'] as $item) {
        // //         $items = [
        // //             'province_code' => $item['name'],
        // //             'province_name' => $item['state_code'],
        // //             'iso2' => $call_province['data']['iso3'],
        // //             'status' => 1
        // //         ];
        // //         array_push($province, $items);
        // //     }
        // // }

        // // $state = States::create($province);
        // // return response()->json($province);
        // // -------------------------------------------------------------
        // // spesifik country
        $call_province = Http::post($request->url_postman, [
            "country" => $request->country
        ]);
        $province = array();
        foreach ($call_province['data']['states'] as $item) {
            $items = [
                'province_code' => $item['state_code'],
                'province_name' => $item['name'],
                'created_at' => now(),
                'updated_at' => now(),
                'status' => 1
            ];
            array_push($province, $items);
        }
        
        // $state = States::insert($province);
        
        
        return response()->json($state);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
