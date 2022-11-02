<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\ProviderDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class FileApiController extends Controller {
    public function download(Request $request) {
        if ($request->id) {
            $file = null;
            switch ($request->f) {
                case 'file_provider':
                    $doc = ProviderDocument::find($request->id);
                    if ($doc->doc_attachment == $request->name)
                        $file = storage_path() . '/file_provider/' . $request->name;
                    break;
                case 'image_product':
                    $image = Image::find($request->id);
                    if ($image->image_desc == $request->name)
                        $file = storage_path() . '/product_image/' . $image->image_url;
                    break;
            }
            if ($file)
                return Response::download($file, $request->name . '.pdf');
            else
                return $this->resFailed(400, "Name mismatch!");
        }
    }
}
