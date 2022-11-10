<?php

namespace App\Http\Helper;

use App\Models\Provider;
use Illuminate\Support\Facades\Session;

class MenuAdmin extends Menu {
    public static function getMenu() {
        Session::put('notif_admin.gudang.regist', Provider::where(['status' => 'Proposed', 'provider_type_id' => Provider::WAREHOUSE])->count());
        Session::put('notif_admin.angkutan.regist', Provider::where(['status' => 'Proposed', 'provider_type_id' => Provider::TRANSPORT])->count());
        Session::put('notif_admin.alat-berat.regist', Provider::where(['status' => 'Proposed', 'provider_type_id' => Provider::HEAVY_EQUIPMENT])->count());
        $menu = Session::get('menu_admin');

        if ($menu) {
            return $menu;
        }

        $menu = [
            ['name' => 'Profile User', 'key' => 'admin.profile-user', 'icon' => 2],
            [
                'name' => 'Master Data', 'key' => 'mpar', 'icon' => SELF::ICON_PARENT, 'children' => [
                    ['name' => 'Kota', 'key' => 'admin.master.city', 'icon' => SELF::ICON_CONTENT],
                    ['name' => 'Provinsi', 'key' => 'admin.master.province', 'icon' => SELF::ICON_CONTENT],
                    [
                        'name' => 'Juragan', 'key' => 'prov', 'icon' => SELF::ICON_PARENT, 'children' => [
                            ['name' => 'Kategori Bisnis', 'key' => 'admin.master.business-category', 'icon' => SELF::ICON_CONTENT],
                            ['name' => 'Tipe Kontak', 'key' => 'admin.master.contact-type', 'icon' => SELF::ICON_CONTENT],
                            ['name' => 'Dokumen Juragan', 'key' => 'admin.master.doc', 'icon' => SELF::ICON_CONTENT]
                        ]
                    ],
                    [
                        'name' => 'Gudang', 'key' => 'mwh', 'icon' => SELF::ICON_PARENT,
                        'children' => [
                            ['name' => 'Fungsi Gudang', 'key' => 'admin.master.wh-function', 'icon' => SELF::ICON_CONTENT],
                            ['name' => 'Kategori Gudang', 'key' => 'admin.master.wh-category', 'icon' => SELF::ICON_CONTENT],
                            ['name' => 'Metode Penyimpanan', 'key' => 'admin.master.wh-storage', 'icon' => SELF::ICON_CONTENT]
                        ]
                    ],
                    [
                        'name' => 'Angkutan', 'key' => 'trs', 'icon' => SELF::ICON_PARENT,
                        'children' => [
                            ['name' => 'Tipe Truk', 'key' => 'admin.master.truck-type', 'icon' => SELF::ICON_CONTENT],
                            ['name' => 'Asal', 'key' => 'admin.master.origin', 'icon' => SELF::ICON_CONTENT],
                            ['name' => 'Tujuan', 'key' => 'admin.master.destination', 'icon' => SELF::ICON_CONTENT]
                        ],
                    ],
                    ['name' => 'Tipe Alat Berat', 'key' => 'admin.master.heavy-type', 'icon' => SELF::ICON_CONTENT],
                ]
            ],
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
