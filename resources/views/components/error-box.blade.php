@if ($errors->any())
    <div class="flex flex-col gap-y-1 mb-2 col-span-2">
        {!! implode('', $errors->all('<div class="px-3 py-1.5 rounded-md text-red-800 bg-red-100">:message</div>')) !!}
    </div>
@endif
