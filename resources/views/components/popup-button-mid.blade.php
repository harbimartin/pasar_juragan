@if ($show)
    <input v-on:click="onPopup = '{{ $key }}';"
        class="flex rounded border px-4 py-2 bg-{{$color}}-500 hover:bg-{{$color}}-600 cursor-pointer text-white font-semibold"
        type="button"
        value="{{ $name }}"
    />
@endif
