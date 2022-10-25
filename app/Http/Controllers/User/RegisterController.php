<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helper\WeNoMana;
use App\Models\BusinessCategory;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class RegisterController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $select = [
            "business_category" => BusinessCategory::where('status', 1)->get()
        ];
        return view('landpage.register', ["select" => $select]);
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
        $request->validate([
            'comp_name' => ['required'],
            'comp_npwp' => ['required', 'unique:m_company_tab'],
            'comp_address_detail' => ['required'],
            'm_business_category_id' => ['required', 'exists:m_business_category_tab,id'],
            'username_name' => ['required'],
            'username_position' => ['required'],
            'username_mail' => ['required', 'email', 'unique:user_tab'],
            'username_phone' => ['required'],
            'password' => ['required'],
            'repassword' => ['required']
        ]);

        if ($request->password != $request->repassword)
            return back()->withErrors([
                'password' => 'Password dan konfirmasi password tidak sama!'
            ]);

        $request['password'] = Hash::make($request->password);
        $request['is_super_admin'] = 1;
        $request['status'] = 1;

        try {
            DB::beginTransaction();
            $company = Company::create($request->only(['comp_name', 'comp_npwp', 'm_business_category_id', 'status']));
            $company->address()->create($request->only(['comp_address_detail', 'status']));
            $request['status'] = 0;
            $user = $company->user()->create($request->only(['username_mail', 'password', 'username_position', 'username_name', 'username_phone', 'is_super_admin', 'status']));

            // SECTION : Untuk Kirim Email Aktivasi Email ke WeNoMana
            $data = [
                "name" => $request->username_name,
                "intro" => "Anda telah mendaftarkan akun Pasar Juragan anda dengan data sebagai berikut :",
                "table" => [
                    "Nama Perusahaan" => $request->comp_name,
                    "Kategori Bisnis" => $company->category->business_category,
                    "NPWP Perusahaan" => $request->comp_npwp,
                    "Alamat Perusahaan" => $request->comp_address_detail,
                    "Nama Pengguna" => $request->username_name,
                    "Jabatan Pengguna" => $request->username_position,
                    "No. Handphone" => $request->username_phone,
                ],
                "exclusive_link" => [
                    "note" => "Klik Disini untuk Aktivasi Akun Juragan anda.",
                    "link" => url('aktivasi/email') . '?id=' . Crypt::encryptString($user->id),
                ],
                "close" => "Jika ini bukan anda, silahkan abaikan email ini. Terimakasih.",
                "note" => "Email ini secara otomatis dikirim melalui sistem, kami harap anda tidak membalas email ini."
            ];
            WeNoMana::send_email($request->username_name, $request->username_mail, "Pasar Juragan : Aktivasi Akun", view('mail.mails', $data)->render());
            // END SECTION
            DB::commit();
        } catch (Throwable $th) {
            DB::rollBack();
            return back()->withErrors([
                'error' => $th->getMessage()
            ]);
        }
        return redirect(route('register'));
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
