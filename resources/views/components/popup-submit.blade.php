    <button v-if="onPopup == '{{ $key }}'" type="submit" name="__type" value="{{ $key }}"
        class="bg-{{ $color }}-600 w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white hover:bg-{{ $color }}-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ $color }}-500 sm:ml-3 sm:w-auto sm:text-sm">
        {{ $name }}
    </button>
