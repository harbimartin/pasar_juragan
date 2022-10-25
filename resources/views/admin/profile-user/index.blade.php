@extends('admin._index')
@section('content')
    @php
        $column = [
            'username_name' => ['name' => 'Nama', 'type' => 'String', 'full' => true],
            'username_mail' => ['name' => 'Email', 'type' => 'String', 'full' => true, 'lock' => true],
            'username_position' => ['name' => 'Posisi', 'type' => 'String', 'full' => true],
            'username_phone' => ['name' => 'Phone', 'type' => 'String', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp
    <x-update unique="profile-user" :column="$column" title="Profil User" :data="$data" burl="none">
    </x-update>
@endsection
