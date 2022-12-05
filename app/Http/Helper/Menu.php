<?php

namespace App\Http\Helper;

use App\Models\OrderTransport\OrderTransport;
use App\Models\OrderWarehouse\OrderWarehouse;
use App\Models\Transport\TruckContract;
use App\Models\Warehouse\WarehouseContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Menu {
    const ICON_NOTIFICATION = 0;
    const ICON_PARENT = 1;
    const ICON_CONTENT = 2;
    const ICON_ADD = 3;
    public static function getMenu() {
        $company_id = Auth::guard('user')->user()->company->id;
        Session::put('notif_dashboard.approval.item.contract', TruckContract::where(['status' => 'Proposed'])->whereHas('juragan_barang', function ($q) use ($company_id) {
            $q->where('id', $company_id);
        })->count());
        Session::put('notif_dashboard.approval.warehouse.contract', WarehouseContract::where(['status' => 'Proposed'])->whereHas('juragan_barang', function ($q) use ($company_id) {
            $q->where('id', $company_id);
        })->count());
        Session::put('notif_dashboard.approval.transport.order', OrderTransport::whereHas('contract', function ($q) use ($company_id) {
            $q->whereHas('juragan_angkutan', function ($qq) use ($company_id) {
                $qq->where('m_company_id', $company_id);
            });
        })->where('status', 'Proposed')->count());
        Session::put('notif_dashboard.approval.warehouse.order', OrderWarehouse::whereHas('contract', function ($q) use ($company_id) {
            $q->whereHas('juragan_gudang', function ($qq) use ($company_id) {
                $qq->where('m_company_id', $company_id);
            });
        })->where('status', 'Proposed')->count());
        $menu = Session::get('menu');

        if ($menu)
            return $menu;

        $menu = [
            ['name' => 'Profile User', 'key' => 'dashboard.profile-user', 'icon' => self::ICON_CONTENT],
            ['name' => 'Profile Perusahaan', 'key' => 'dashboard.profile-company', 'icon' => self::ICON_CONTENT],
            ['name' => 'Kontrak Angkutan', 'key' => 'dashboard.approval.item.contract', 'icon' => self::ICON_NOTIFICATION],
            ['name' => 'Kontrak Gudang', 'key' => 'dashboard.approval.warehouse.contract', 'icon' => self::ICON_NOTIFICATION],
            ['name' => 'Kontrak Alat Berat', 'key' => 'dashboard.approval.heavy.contract', 'icon' => self::ICON_NOTIFICATION],
            ['name' => 'Pesanan Angkutan', 'key' => 'dashboard.approval.transport.order', 'icon' => self::ICON_NOTIFICATION],
            ['name' => 'Pesanan Gudang', 'key' => 'dashboard.approval.warehouse.order', 'icon' => self::ICON_NOTIFICATION],
            ['name' => 'Pesanan Alat Berat', 'key' => 'dashboard.approval.heavy.order', 'icon' => self::ICON_NOTIFICATION],
            // ['name' => 'Juragan Barang', 'key' => 'mk01', 'icon' => self::ICON_PARENT, 'children' => [
            //     ['name' => 'Registrasi Juragan', 'key' => 'dashboard.create.juragan-barang', 'icon' => self::ICON_ADD],
            //     ['name' => 'Daftar Juragan', 'key' => 'dashboard.juragan-barang', 'icon' => self::ICON_CONTENT]
            // ]],
            ['name' => 'Juragan Barang', 'key' => 'mk00', 'icon' => self::ICON_PARENT, 'children' => [
                ['name' => 'Pesan Angkutan', 'key' => 'dashboard.create.pesanan-angkutan', 'icon' => self::ICON_ADD],
                ['name' => 'Daftar Pesanan', 'key' => 'dashboard.pesanan-angkutan', 'icon' => self::ICON_CONTENT],
                ['name' => 'Pesan Gudang', 'key' => 'dashboard.create.pesanan-gudang', 'icon' => self::ICON_ADD],
                ['name' => 'Daftar Pesanan', 'key' => 'dashboard.pesanan-gudang', 'icon' => self::ICON_CONTENT]
            ]],
            ['name' => 'Juragan Gudang', 'key' => 'mk01', 'icon' => self::ICON_PARENT, 'children' => [
                ['name' => 'Registrasi Juragan', 'key' => 'dashboard.create.juragan-gudang', 'icon' => self::ICON_ADD],
                ['name' => 'Daftar Juragan', 'key' => 'dashboard.juragan-gudang', 'icon' => self::ICON_CONTENT],
                ['name' => 'Kelola Gudang', 'key' => 'mk02', 'icon' => self::ICON_PARENT, 'children' => [
                    ['name' => 'Tambah Gudang', 'key' => 'dashboard.create.warehouse', 'icon' => self::ICON_CONTENT],
                    ['name' => 'List Gudang', 'key' => 'dashboard.warehouse', 'icon' => self::ICON_CONTENT]
                ]],
                ['name' => 'Tambah Kontrak', 'key' => 'dashboard.create.kontrak-gudang', 'icon' => self::ICON_ADD],
                ['name' => 'Daftar Kontrak', 'key' => 'dashboard.kontrak-gudang', 'icon' => self::ICON_CONTENT],
                ['name' => 'Daftar Pesanan', 'key' => 'dashboard.pesanan.juragan-gudang', 'icon' => self::ICON_CONTENT],
            ]],
            ['name' => 'Juragan Angkutan', 'key' => 'mk03', 'icon' => self::ICON_PARENT, 'children' => [
                ['name' => 'Registrasi Juragan', 'key' => 'dashboard.create.juragan-angkutan', 'icon' => self::ICON_ADD],
                ['name' => 'Daftar Angkutan', 'key' => 'dashboard.juragan-angkutan', 'icon' => self::ICON_CONTENT],
                ['name' => 'Kelola Angkutan', 'key' => 'mk04', 'icon' => self::ICON_PARENT, 'children' => [
                    ['name' => 'Tambah Angkutan', 'key' => 'dashboard.create.transport', 'icon' => self::ICON_CONTENT],
                    ['name' => 'List Angkutan', 'key' => 'dashboard.transport', 'icon' => self::ICON_CONTENT]
                ]],
                ['name' => 'Kelola Sopir', 'key' => 'mk05', 'icon' => self::ICON_PARENT, 'children' => [
                    ['name' => 'Tambah Sopir', 'key' => 'dashboard.create.driver', 'icon' => self::ICON_CONTENT],
                    ['name' => 'List Sopir', 'key' => 'dashboard.driver', 'icon' => self::ICON_CONTENT]
                ]],
                ['name' => 'Tambah Kontrak', 'key' => 'dashboard.create.kontrak-barang', 'icon' => self::ICON_ADD],
                ['name' => 'Daftar Kontrak', 'key' => 'dashboard.kontrak-barang', 'icon' => self::ICON_CONTENT],
                ['name' => 'Daftar Pesanan', 'key' => 'dashboard.pesanan.juragan-angkutan', 'icon' => self::ICON_CONTENT],
            ]],
            ['name' => 'Juragan Alat Berat', 'key' => 'mk06', 'icon' => self::ICON_PARENT, 'children' => [
                ['name' => 'Registrasi Juragan', 'key' => 'dashboard.create.juragan-alatberat', 'icon' => self::ICON_CONTENT],
                ['name' => 'Daftar Alat Berat', 'key' => 'dashboard.juragan-alatberat', 'icon' => self::ICON_CONTENT],
                ['name' => 'Kelola Alat Berat', 'key' => 'mk07', 'icon' => self::ICON_PARENT, 'children' => [
                    ['name' => 'Tambah Alat Berat', 'key' => 'dashboard.create.heavy', 'icon' => self::ICON_CONTENT],
                    ['name' => 'List Alat Berat', 'key' => 'dashboard.heavy', 'icon' => self::ICON_CONTENT]
                ]],
                ['name' => 'Tambah Kontrak', 'key' => 'dashboard.create.kontrak-alatberat', 'icon' => self::ICON_ADD],
                ['name' => 'Daftar Kontrak', 'key' => 'dashboard.kontrak-alatberat', 'icon' => self::ICON_CONTENT],
                ['name' => 'Daftar Pesanan', 'key' => 'dashboard.pesanan.juragan-alatberat', 'icon' => self::ICON_CONTENT],
            ]],
        ];

        Session::put('menu', $menu);
        return $menu;
    }
}
