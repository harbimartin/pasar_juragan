<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helper\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthApiController extends Controller {

    protected $helper;

    public function __construct(ApiResponse $helper){
        $this->helper = $helper;
    }


    public function api_login(Request $request) {
        // if($credentials = $this->helper->validasi($request->all(),[
            // 'username_mail' => ['required', 'email'],
            // 'password' => ['required'],
        // ]))
        //     return $credentials;
        $credential = $this->helper->credentialize($request,[
            'username_mail' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if ($token = Auth::guard('api')->attempt($credential)) {
            $user = Auth::guard('api')->user();

            if ($user->status == 0)
                return response()->json([
                    "error_code" => 1,
                    "message" => "Silahkan melakukan aktivasi melalui Email yang kami kirim."
                ]);

            return response()->json([
                "error_code" => 0,
                "message" => "Welcome back " . $user->username_name,
                "data" => $token
            ]);
        }

        return response()->json([
            "error_code" => 2,
            "message" => "Email dan Username anda tidak cocok."
        ]);
    }

    public function api_logout() {
        try {
            if (auth()->guard('api')->check()) {
                auth()->guard('api')->logout();
                return response()->json([
                    "error_code" => 0,
                    "message" => "Sampai berjumpa kembali " . Auth::guard('user')->user()->username_name
                ]);
            } else {
                return response()->json([
                    "error_code" => 1,
                    "message" => "Terjadi kesalahan pada jaringan atau server"
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                "error_code" => 1,
                "message" => "Failed to logout, please try again."
            ], 500);
        }
    }

    public function api_me() {
        try {
            if (auth()->guard('api')->check()) {
                return response()->json([
                    "error_code" => 0,
                    "message" => "berhasil",
                    "data" => auth()->guard('api')->user()
                ]);
            }
            //code...
        } catch (JWTException $e) {
            return response()->json([
                "error_code" => 1,
                "message" => "Failed to logout, please try again."
            ], 500);
        }
    }
}
