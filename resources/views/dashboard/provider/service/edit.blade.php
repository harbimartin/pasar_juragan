@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'service_title' => ['name' => 'Judul Service', 'type' => 'String', 'rows' => 4, 'full' => true],
            'service_desc' => ['name' => 'Deskripsi Service', 'type' => 'TextArea', 'full' => true],
            'service_reference' => ['name' => 'Referensi Service', 'type' => 'String', 'full' => true, 'placeholder'=>"Contoh : Domain Website, Akun Sosial Media dan lain-lain."],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="service" :column="$column" title="Service Gudang" :data="$data" idk="id">
    </x-update>
@endsection
