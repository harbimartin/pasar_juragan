<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class AuthUserController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('landpage.login');
    }

    public function logout() {
        // Auth::guard('user')->logout();
        Session::forget('menu');
        return back(); // redirect(route('home'));
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
        // return $request->toArray();
        $credentials = $request->validate([
            'username_mail' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::guard('user')->attempt($credentials)) {
            $user = Auth::guard('user')->user();

            if ($user->status == 0) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Silahkan melakukan aktivasi melalui Email yang kami kirim.<br>Belum mendapatkan Email? <a href="" class="px-2 bg-red-700 hover:bg-red-800 bg-red text-white font-semibold rounded py-0.5 text-sm">Kirim Ulang Email Aktivasi</a>',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'Email dan Username anda tidak cocok.',
        ]);
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

    public function activation(Request $request) {
        $id = Crypt::decryptString($request->id);

        if ($user = User::find($id)) {
            if ($user->status == 0) {
                $user->update([
                    'status' => 1
                ]);
                return view('activation', ['success' => true]);
            }
            return $user;
        }
        return view('activation', ['success' => false]);
    }
}
