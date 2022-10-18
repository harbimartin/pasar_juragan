@if ($errors->any())
    {!! implode('', $errors->all('<div class="px-3 py-1 rounded-md w-full text-red-800 bg-red-100">:message</div>')) !!}
@endif
