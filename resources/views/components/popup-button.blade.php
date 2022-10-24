@if ($show)
    <input v-on:click="onPopup = '{{ $key }}';"
        class="float-right rounded border px-5 py-2 mr-1 md:mr-4 bg-{{ $color }}-500 hover:bg-{{ $color }}-600 cursor-pointer text-white font-semibold"
        type="button" value="{{ $name }}" />
@endif
