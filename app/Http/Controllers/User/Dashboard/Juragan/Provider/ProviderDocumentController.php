<?php

namespace App\Http\Controllers\User\Dashboard\Juragan\Provider;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Provider;
use App\Models\ProviderDocument;
use Illuminate\Http\Request;
use Throwable;

class ProviderDocumentController extends Controller {
    const baseRoute = 'dashboard.provider.document';
    public function getMySelect($provider) {
        $provider_id = $provider->provider_type_id;
        return [
            'document' => Document::where('status', 1)->where(function ($q) use ($provider_id) {
                $q->where('m_provider_type_id', 0)->orWhere('m_provider_type_id', $provider_id);
            })->get()
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($provider) {
        [$data, $select, $detail, $submenu] = ProviderController::base_index($provider);

        // GET REQUIRE DOCUMENT
        $provider_id = $data->id;
        $provider_type_id = $data->provider_type_id;
        $require = Document::whereDoesntHave('provider', function ($qq) use ($provider_id) {
            $qq->where('t_provider_id', $provider_id)->where('status', '=', 1);
        })->where(function ($q) use ($provider_type_id) {
            $q->where('m_provider_type_id', $provider_type_id)->orWhere('m_provider_type_id', 0);
        })->where('status', 1)->get();

        return view(self::baseRoute . '.index', [
            'data' => $data,
            'select' => array_merge($select, $this->getMySelect($data)),
            'require' => $require,
            'detail' => $detail,
            'submenu' => $submenu
        ]);
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
    public function store(Request $request, $provider) {
        $credentials = $request->validate([
            'm_doc_id' => ['required'],
            'doc_no' => ['required'],
            'doc_date' => ['required'],
            'doc_expired' => ['required']
        ]);
        $provider = Provider::find($provider);
        if ($request->doc_attachment && $request->has('doc_attachment.0')) {
            try {
                $bfile = $request->doc_attachment[0];
                $filename = 'DOC_' . $provider->id . '_' . date("YmdHms") . '.' . pathinfo($bfile->getClientOriginalName(), PATHINFO_EXTENSION);
                $bfile->move(storage_path('file_provider/'), $filename);
                $credentials['doc_attachment'] = $filename;
            } catch (Throwable $th) {
                back()->withErrors([
                    'update' => "Ada kegagalan dalam menunggah Lampiran Dokumen. : " . $th->getMessage()
                ]);
            }
        }
        // return $request->toArray();
        // if ($request->_delfile_) {
        //     $company->update(['lampiran_company' => null]);
        // }
        // if ($request->fname) {
        //     back()->withErrors([
        //         'update' => "Mohon maaf, sistem saat ini belum dapat mengubah nama File."
        //     ]);
        // }
        // if ($request->__type == 'update')
        //     $company->update($request->toArray());
        // else
        //     $company->update(['comp_logo' => $filename]);
        $credentials['status'] = 1;
        $provider->document()->create($credentials);
        return back();
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
    public function edit($provider, $id) {
        $data = ProviderDocument::find($id);
        return view(self::baseRoute . '.edit', ['data' => $data, 'select' => $this->getMySelect($data)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $juragan, $id) {
        switch ($request->__type) {
            case 'toggle':
                ProviderDocument::find($id)->update(['status' => $request->toggle]);
                break;
            case 'update':
                $credentials = $request->validate([
                    'm_doc_id' => ['required'],
                    'doc_no' => ['required'],
                    'doc_date' => ['required'],
                    'doc_expired' => ['required'],
                    'doc_attachment' => ['required']
                ]);
                ProviderDocument::find($id)->update($credentials);
                break;
        }
        return back();
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
