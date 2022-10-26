@extends('admin._index')
@section('content')
    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'status' => Provider::status_attr(),
        'provider_code' => ['name' => 'Kode', 'type' => 'String'],
        'provider_name' => ['name' => 'Nama', 'type' => 'String'],
        'provider_npwp' => ['name' => 'NPWP', 'type' => 'String'],
        'provider_website' => ['name' => 'Website', 'type' => 'String'],
        'act' => ['name' => 'Action', 'type' => 'Show', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Registrasi Juragan {{$module}}" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
