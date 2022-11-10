@extends('admin._index')
@section('content')
    @php
        $column = [
            'business_category' => ['name' => 'Nama Ketegori', 'type' => 'String', 'full' => true],
        ];
        $column = json_encode($column);
    @endphp

    <x-add unique="bussinescategory" :column="$column" title="Tambah Kategori Bisnis" :select="$select" idk="id">
    </x-add>

    <?php
    $table = json_encode([
        'index' => ['name' => 'No.', 'type' => 'Index'],
        'business_category' => ['name' => 'Nama Kategori Bisnis', 'type' => 'String'],
        'status' => ['name' => 'Status', 'type' => 'State'],
        'toggle' => ['by' => 'status', 'name' => 'Aktifkan', 'type' => 'Toggle', 'sort' => false, 'align' => 'center'],
        'act' => ['name' => 'Action', 'type' => 'Edit', 'align' => 'center', 'sort' => false],
    ]);
    ?>
    <x-table title="Daftar Kategori Bisnis" :column="$table" :datas="$data" :prop="$prop">
    </x-table>
@endsection
