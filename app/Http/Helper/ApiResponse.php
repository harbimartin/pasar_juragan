<?php

namespace App\Http\Helper;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;

class ApiResponse {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function credentialize($request,$items){
        $credential = $request->validate($items);
        return $credential;
    }

    public function validasi($request,$items){
        $validate = Validator::make($request,$items);
        if ($validate->fails()) {
            return $this->respon_failure($validate->errors()->all());
        }else
            return null;
    }

    public function respon_success($data,$message=null){
        return response()->json([
            'code' => 0,
            'message' => $message ?? 'success',
            'data' => $data
        ]);
    }

    public function respon_failure($message=null){
        return response()->json([
            'code' => 1,
            'message' => $message ?? 'Request anda gagal !',
            'data' => null
        ]);
    }
}

