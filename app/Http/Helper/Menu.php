<?php

namespace App\Http\Helper;

use Illuminate\Support\Facades\Session;

class Menu {
    const ICON_NOTIFICATION = 0;
    const ICON_PARENT = 1;
    const ICON_CONTENT = 2;
    const ICON_ADD = 3;
    public static function getMenu() {
        $menu = Session::get('menu');

        if ($menu)
            return Session::get('menu');

        $menu = [
            ['name' => 'Profile User', 'key' => 'dashboard.profile-user', 'icon' => self::ICON_CONTENT],
            ['name' => 'Profile Perusahaan', 'key' => 'dashboard.profile-company', 'icon' => self::ICON_CONTENT],
            // ['name' => 'Juragan Barang', 'key' => 'dashboard.juragan-barang', 'icon' => 1, 'children' => [
            //     ['name' => 'Registrasi Juragan', 'key' => 'dashboard.juragan-barang.regist', 'icon' => 2]
            // ]],
            ['name' => 'Juragan Gudang', 'key' => 'mk01', 'icon' => self::ICON_PARENT, 'children' => [
                ['name' => 'Registrasi Juragan', 'key' => 'dashboard.create.juragan-gudang', 'icon' => self::ICON_ADD],
                ['name' => 'Daftar Juragan', 'key' => 'dashboard.juragan-gudang', 'icon' => self::ICON_CONTENT],
                ['name' => 'Kelola Gudang', 'key' => 'mk02', 'icon' => self::ICON_PARENT, 'children' => [
                    ['name' => 'Tambah Gudang', 'key' => 'dashboard.create.warehouse', 'icon' => self::ICON_CONTENT],
                    ['name' => 'List Gudang', 'key' => 'dashboard.warehouse', 'icon' => self::ICON_CONTENT]
                ]]
            ]],
            ['name' => 'Juragan Angkutan', 'key' => 'mk03', 'icon' => self::ICON_PARENT, 'children' => [
                ['name' => 'Registrasi Juragan', 'key' => 'dashboard.create.juragan-angkutan', 'icon' => self::ICON_CONTENT],
                ['name' => 'Daftar Angkutan', 'key' => 'dashboard.juragan-angkutan', 'icon' => self::ICON_CONTENT],
            ]],
            ['name' => 'Juragan Alat Berat', 'key' => 'mk04', 'icon' => self::ICON_PARENT, 'children' => [
                ['name' => 'Registrasi Juragan', 'key' => 'dashboard.create.juragan-alatberat', 'icon' => self::ICON_CONTENT],
                ['name' => 'Daftar Alat Berat', 'key' => 'dashboard.juragan-alatberat', 'icon' => self::ICON_CONTENT]
            ]],
            ['name' => 'Juragan Truck', 'key' => 'mk04', 'icon' => self::ICON_PARENT, 'children' => [
                ['name' => 'Registrasi Truck', 'key' => 'dashboard.create.juragan-truck', 'icon' => self::ICON_CONTENT],
                ['name' => 'Daftar Truck', 'key' => 'dashboard.juragan-truck', 'icon' => self::ICON_CONTENT]
            ]],
        ];

        Session::put('menu', $menu);
        return $menu;
    }
}
