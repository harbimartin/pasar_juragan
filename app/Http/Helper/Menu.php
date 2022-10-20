<?php

namespace App\Http\Helper;

use Illuminate\Support\Facades\Session;

class Menu {
    public static function getMenu() {
        $menu = Session::get('menu');

        if ($menu)
            return Session::get('menu');

        $menu = [
            ['name' => 'Profile User', 'key' => 'dashboard.user-profile', 'icon' => 2],
            ['name' => 'Profile Perusahaan', 'key' => 'dashboard.company-profile.', 'icon' => 2],
            // ['name' => 'Juragan Barang', 'key' => 'dashboard.juragan-barang', 'icon' => 1, 'children' => [
            //     ['name' => 'Registrasi Juragan', 'key' => 'dashboard.juragan-barang.regist', 'icon' => 2]
            // ]],
            ['name' => 'Juragan Gudang', 'key' => 'dashboard.juragan-gudang', 'icon' => 1, 'children' => [
                ['name' => 'Registrasi Juragan', 'key' => 'dashboard.juragan-gudang.regist', 'icon' => 3],
                ['name' => 'Daftar Gudang', 'key' => 'dashboard.juragan-gudang.list', 'icon' => 2]
            ]],
            ['name' => 'Juragan Angkutan', 'key' => 'dashboard.juragan-angkutan', 'icon' => 1, 'children' => [
                ['name' => 'Registrasi Juragan Angkutan', 'key' => 'dashboard.juragan-angkutan.regist', 'icon' => 3],
                ['name' => 'Daftar Angkutan', 'key' => 'dashboard.juragan-angkutan.list', 'icon' => 2]
            ]],
            // ['name' => 'Juragan Angkutan', 'key' => 'dashboard.juragan-angkutan', 'icon' => 2],
            ['name' => 'Juragan Alat Berat', 'key' => 'dashboard.juragan-alatberat', 'icon' => 2]
        ];

        Session::put('menu', $menu);
        return $menu;
    }
}
