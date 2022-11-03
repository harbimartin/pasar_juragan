<?php

namespace App\Http\Helper;

use App\Models\Transport\TruckContract;
use Illuminate\Support\Facades\Session;

class Menu {
    const ICON_NOTIFICATION = 0;
    const ICON_PARENT = 1;
    const ICON_CONTENT = 2;
    const ICON_ADD = 3;
    public static function getMenu() {
        Session::put('notif_dashboard.approval', TruckContract::where(['status' => 'Proposed'])->count());
        $menu = Session::get('menu');

        if ($menu)
            return Session::get('menu');

        $menu = [
            ['name' => 'Profile User', 'key' => 'dashboard.profile-user', 'icon' => self::ICON_CONTENT],
            ['name' => 'Profile Perusahaan', 'key' => 'dashboard.profile-company', 'icon' => self::ICON_CONTENT],
            ['name' => 'Notifikasi Kontrak', 'key' => 'dashboard.approval', 'icon' => self::ICON_NOTIFICATION],
            // ['name' => 'Juragan Barang', 'key' => 'mk01', 'icon' => self::ICON_PARENT, 'children' => [
            //     ['name' => 'Registrasi Juragan', 'key' => 'dashboard.create.juragan-barang', 'icon' => self::ICON_ADD],
            //     ['name' => 'Daftar Juragan', 'key' => 'dashboard.juragan-barang', 'icon' => self::ICON_CONTENT]
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
                ['name' => 'Registrasi Juragan', 'key' => 'dashboard.create.juragan-angkutan', 'icon' => self::ICON_ADD],
                ['name' => 'Daftar Angkutan', 'key' => 'dashboard.juragan-angkutan', 'icon' => self::ICON_CONTENT],
                ['name' => 'Kelola Angkutan', 'key' => 'mk04', 'icon' => self::ICON_PARENT, 'children' => [
                    ['name' => 'Tambah Angkutan', 'key' => 'dashboard.create.transport', 'icon' => self::ICON_CONTENT],
                    ['name' => 'List Angkutan', 'key' => 'dashboard.transport', 'icon' => self::ICON_CONTENT]
                ]],
                ['name' => 'Tambah Kontrak', 'key' => 'dashboard.create.kontrak-barang', 'icon' => self::ICON_ADD],
                ['name' => 'Daftar Kontrak', 'key' => 'dashboard.kontrak-barang', 'icon' => self::ICON_CONTENT],
            ]],
            ['name' => 'Juragan Alat Berat', 'key' => 'mk05', 'icon' => self::ICON_PARENT, 'children' => [
                ['name' => 'Registrasi Juragan', 'key' => 'dashboard.create.juragan-alatberat', 'icon' => self::ICON_CONTENT],
                ['name' => 'Daftar Alat Berat', 'key' => 'dashboard.juragan-alatberat', 'icon' => self::ICON_CONTENT],
                ['name' => 'Kelola Alat Berat', 'key' => 'mk06', 'icon' => self::ICON_PARENT, 'children' => [
                    ['name' => 'Tambah Alat Berat', 'key' => 'dashboard.create.heavy', 'icon' => self::ICON_CONTENT],
                    ['name' => 'List Alat Berat', 'key' => 'dashboard.heavy', 'icon' => self::ICON_CONTENT]
                ]]
            ]],
        ];

        Session::put('menu', $menu);
        return $menu;
    }
}
