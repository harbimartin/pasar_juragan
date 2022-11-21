<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthDriverController extends Controller {
    public function api_login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if ($token = Auth::guard('driver')->attempt($credentials)) {
            $user = Auth::guard('driver')->user();

            if ($user->status == 0)
                return response()->json([
                    "error_code" => 1,
                    "message" => "Silahkan melakukan aktivasi melalui Email yang kami kirim."
                ]);

            return response()->json([
                "error_code" => 0,
                "message" => "[Driver] Welcome back " . $user->driver_name,
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
            if (auth()->guard('driver')->check()) {
                auth()->guard('driver')->logout();
                return response()->json([
                    "error_code" => 0,
                    "message" => "Sampai berjumpa kembali " . Auth::guard('driver')->user()->username_name
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
            if (auth()->guard('driver')->check()) {
                return response()->json([
                    "error_code" => 0,
                    "message" => "berhasil",
                    "data" => auth()->guard('driver')->user()
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
