@extends('dashboard._index')
@section('content')
    <div class="w-full px-4 py-2">
        <div class="bg-gray-400 mb-2 text-center font-extrabold text-4xl flex justify-center align-middle"
            style="height:360px;">
            <div>
                Sliding Banner
            </div>
        </div>
        <div class="flex justify-center">
            <div class="rounded-full bg-gray-400 w-3 h-3 mx-2 cursor-pointer"></div>
            <div class="rounded-full bg-gray-400 w-3 h-3 mx-2 cursor-pointer"></div>
            <div class="rounded-full bg-gray-400 w-3 h-3 mx-2 cursor-pointer"></div>
        </div>
    </div>
@endsection
