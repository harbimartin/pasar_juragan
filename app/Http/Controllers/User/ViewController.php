<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Provider;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller {
    public function base(){
        return redirect(route('home'));
    }
    //
    public function get_file(Request $request, $module, $name, $id) {
        // return json_encode([$request->toArray(), $module]);
        switch ($module) {
            case 'company':
                $filename = Auth::guard('user')->user()->company->comp_logo;
                return response()->download(storage_path('file_logo/') . $filename, $filename);
            case 'provider':
                $provider = Provider::find($id);
                return response()->download(storage_path('file_provider/') . $provider->provider_logo, $provider->provider_logo);
            case 'product_image':
                $image = Image::find($id);
                if ($image->image_desc == $name) {
                    return response()->download(storage_path('product_image/') . $image->image_url, $image->image_name);
                }
                abort(400, 'Image address is not valid');
        }
    }
}
