<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller {
    //
    public function get_file(Request $request, $module) {
        // return json_encode([$request->toArray(), $module]);
        switch ($module) {
            case 'company':
                $filename = Auth::guard('user')->user()->company->comp_logo;
                return response()->download(storage_path('file_logo/') . $filename, $filename);
                break;
        }
    }
}
