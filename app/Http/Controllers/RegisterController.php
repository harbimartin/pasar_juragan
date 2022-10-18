<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class RegisterController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('register');
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
        $credentials = $request->validate([
            'comp_name' => ['required'],
            'comp_npwp' => ['required'],
            'comp_address_detail' => ['required'],
            'username_name' => ['required'],
            'username_position' => ['required'],
            'username_mail' => ['required', 'email'],
            'username_phone' => ['required'],
            'password' => ['required'],
            'repassword' => ['required']
        ]);

        if ($request->password != $request->repassword)
            return back()->withErrors([
                'password' => 'Password is not match!'
            ]);
        // TODO : Check NPWP dan Email tidak boleh sama

        $request['password'] = Hash::make($request->password);
        $request['is_super_admin'] = 1;
        $request['status'] = 1;
        try {
            $company = Company::create($request->only(['comp_name', 'comp_npwp', 'status']));
            $company->address()->create($request->only(['comp_address_detail', 'status']));
            $request['status'] = 0;
            $company->user()->create($request->only(['username_mail', 'password', 'username_position', 'username_name', 'username_phone', 'is_super_admin', 'status']));
        } catch (Throwable $th) {
            return back()->withErrors([
                'error' => $th->getMessage()
            ]);
        }
        // TODO : Ngirim Email
        // TODO : Message berhasil, dan minta konfirmasi untuk ngecek email
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
