@extends('dashboard._index')
@section('content')
    @php
        $column = [
            'm_contact_type_id' => ['name' => 'Tipe Kontak', 'type' => 'Select', 'val' => ['contact_type'], 'api' => 'contact_type', 'full' => true],
            'provider_contact_name' => ['name' => 'Nama Kontak', 'type' => 'String', 'full' => true],
            'provider_contact_position' => ['name' => 'Posisi Kontak', 'type' => 'String', 'full' => true],
            'provider_contact' => ['name' => 'Kontak', 'type' => 'String', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="contact" :column="$column" title="Contact" :data="$data" :select="$select" idk="id">
    </x-update>
@endsection
