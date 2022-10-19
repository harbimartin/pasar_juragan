<?php

namespace App\Http\Helper;

use Illuminate\Support\Facades\Session;

class MenuAdmin {
    public static function getMenu() {
        $menu = Session::get('menu_admin');

        if ($menu)
            return Session::get('menu_admin');

        $menu = [
            ['name' => 'Profile User', 'key' => 'admin.user-profile', 'icon' => 2],
            ['name' => 'Registrasi Juragan Gudang', 'key' => 'admin.gudang.regist', 'icon' => 0],
            ['name' => 'Registrasi Angkutan Barang', 'key' => 'admin.angkutan.regist', 'icon' => 0],
            ['name' => 'Registrasi Juragan Alat Berat', 'key' => 'admin.alat-berat.regist', 'icon' => 0],
            ['name' => 'Daftar Juragan Gudang', 'key' => 'admin.gudang.list', 'icon' => 2],
            ['name' => 'Daftar Juragan Angkutan', 'key' => 'admin.angkutan.list', 'icon' => 2],
            ['name' => 'Daftar Juragan Alat Berat', 'key' => 'admin.alat-berat.list', 'icon' => 2]
        ];

        Session::put('menu_admin', $menu);
        return $menu;
    }
}
