@switch($param->type)
    @case('Image')
        <div class="overflow-hidden flex" style="height:22vh;">
            @if (!is_countable($item[$key]))
                <img style="@isset($param->class) {{ $param->class }}@endisset"
                    src="{{ route('storage', [$param->module, $item[$key], $item['id']]) }}" alt="Logo">
            @elseif (sizeof($item[$key]) > 0)
                <img style="@isset($param->class) {{ $param->class }}@endisset"
                    src="{{ route('storage', [$param->module, $item[$key][0]['image_desc'], $item[$key][0]['id']]) }}"
                    alt="Logo">
            @else
                <img class="my-auto" src="https://tirtorahayu-kulonprogo.desa.id/desa/themes/natra_kp/images/noimage.png" />
            @endif
        </div>
    @break

    @case('Check')
        <input id="{{$key}}" form="{{$param->form}}" class="checkbox" type="checkbox" name="{{ $key }}[]" value="{{ $item[$param->key] }}" />
    @break

    @case('Multiply')
        <?php
        $total = 1;
        foreach ($param->from as $f) {
            $total *= $item[$f];
        }
        ?>
        <div class="{{ isset($param->align) ? 'text-' . $param->align : 'text-right mr-3' }}">
            @isset($param->format){{ $param->format }}@endisset{{ number_format($item[$key], $total ?? 0, ',', '.') }}
            </div>
        @break

        @case('Number')
            <div class="{{ isset($param->align) ? 'text-' . $param->align : 'text-right mr-3' }}">
                @isset($param->format){{ $param->format }}@endisset{{ number_format($item[$key], $param->decimal ?? 0, ',', '.') }}
                </div>
            @break

            @case('SString')
                <?php
                if (isset($param->by)) {
                    $pkey = $param->by;
                    $child = isset($param->child) ? $param->child : $key;
                } else {
                    $pkey = $key;
                    $child = $param->child;
                }
                $txt = '';
                if (is_array($child)) {
                    foreach ($child as $kk => $val) {
                        $str = $item[$pkey][$val];
                        // $str = isset($item[$pkey]) ? $item[$pkey][$val] : '';
                        if ($kk == 0) {
                            $txt = $txt . ($str == '' ? '(Blank)' : $str);
                        } else {
                            $txt = $txt . ' - ' . $str;
                        }
                    }
                } else {
                    $txt = $item[$pkey][$child];
                }
                ?>
                <div
                    class="@isset($param->class){{ $param->class }}@endisset @isset($param->wrap) whitespace-normal @endisset">
                    {{ $txt }}</div>
            @break

            {{--
                class : Class Attribute
                wrap : is Wrapping with min width is 200px
                subkey : the key not static string
                sub : the static key string
                --}}
            @case('CString')
                <?php
                $pkey = $key;
                if (isset($param->by)) {
                    $pkey = $param->by;
                    $child = isset($param->child) ? $param->child : null;
                } elseif (isset($param->child)) {
                    $child = $param->child;
                } else {
                    $child = null;
                }
                $txt = '';
                if (is_countable($child)) {
                    foreach ($child as $kk => $val) {
                        $str = $item[$pkey][$val];
                        if ($kk == 0) {
                            $txt = $txt . ($str == '' ? '(Blank)' : $str);
                        } else {
                            $txt = $txt . ' - ' . $str;
                        }
                    }
                } elseif ($child) {
                    $txt = $item[$pkey][$child];
                } else {
                    $txt = $item[$pkey];
                }
                ?>
                <div class="@isset($param->class){{ $param->class }}@endisset whitespace-normal pb-0.5 flex"
                    @isset($param->wrap)style="min-width:200px;"@endisset>
                    @isset($param->subkey)
                        <span
                            class="px-1 pb-0.5 rounded-xl  {{ $item[$param->subkey] ? 'bg-gray-100 text-gray-500' : 'bg-red-100 rounded-xl text-red-500' }} text-xs font-semibold">{{ $item[$param->subkey] ? $item[$param->subkey] : $param->sub }}</span>
                    @else
                        <span
                            class="px-1 pb-0.5 bg-gray-100 rounded-xl text-gray-500 text-xs font-semibold text-right @isset($param->sclass) {{ $param->sclass }} @endisset">{{ $param->sub }}</span>
                    @endisset
                    @if ($item[$pkey])
                        <span>{{ $txt }}</span>
                    @else
                        <span class="text-gray-400 font-normal">-</span>
                    @endif
                </div>
            @break

            @case('GString')
                @foreach ($item[$key] as $attribute)
                    <div class="@isset($param->class){{ $param->class }}@endisset whitespace-normal pb-0.5"
                        @isset($param->wrap)style="min-width:200px;"@endisset>
                        {{-- @isset($param->subkey)
                            <span
                                class="px-1 pb-0.5 rounded-xl  {{ $item[$param->subkey] ? 'bg-gray-100 text-gray-500' : 'bg-red-100 rounded-xl text-red-500' }} text-xs font-semibold">{{ $item[$param->subkey] ? $item[$param->subkey] : $param->sub }}</span>
                        @else --}}
                        <span
                            class="px-1 pb-0.5 bg-gray-100 rounded-xl text-gray-500 text-xs font-semibold">{{ $attribute[$param->key[0]][$param->key[1]] }}</span>
                        {{-- @endisset --}}
                        @if ($attribute[$param->total])
                            <span>{{ $attribute[$param->total] }}</span>
                        @else
                            <span class="text-gray-400 font-normal">-</span>
                        @endif
                    </div>
                @endforeach
            @break

            @case('Array')
                <?php
                $pkey = isset($param->by) ? $param->by : $key;
                $txt = '';
                $spr = isset($param->separator) ? $param->separator : '';
                if (sizeof($item[$pkey]) > 0) {
                    if (is_array($param->child)) {
                        foreach ($item[$pkey] as $it) {
                            foreach ($param->child as $kk => $val) {
                                $str = $it[$val];
                                if ($kk == 0) {
                                    $txt = $txt . ($str == '' ? '(Blank)' : $str);
                                } else {
                                    $txt = $txt . $spr . $str;
                                }
                            }
                        }
                    } else {
                        foreach ($item[$pkey] as $ii => $it) {
                            if ($ii == 0) {
                                $txt = $txt . $it[$param->child];
                            } else {
                                $txt = $txt . $spr . $it[$param->child];
                            }
                        }
                    }
                }
                ?>
                @if ($txt)
                    <div
                        class="@isset($param->class){{ $param->class }}@endisset @isset($param->wrap) whitespace-normal @endisset">
                        {{ $txt }}</div>
                @else
                    <div class="text-gray-400">
                        @isset($param->empty){{ $param->empty }}
                        @else
                            &nbsp;(Blank)
                    @endif
                    </div>
                    @endif
                @break

                @case('Static')
                    <div class="@isset($param->class){{ $param->class }}@endisset @isset($param->wrap) whitespace-normal @endisset"
                        @isset($param->wrap)style="min-width:200px;"@endisset>{!! $param->val !!}</div>
                @break

                @case('String')
                    <div class="@isset($param->class){{ $param->class }}@endisset @isset($param->wrap) whitespace-normal @endisset"
                        @isset($param->wrap)style="min-width:200px;"@endisset>{{ $item[$key] }}</div>
                @break

                @case('SLink')
                    <?php
                    if (isset($param->by)) {
                        $pkey = $param->by;
                        $child = isset($param->child) ? $param->child : $key;
                    } else {
                        $pkey = $key;
                        $child = $param->child;
                    }
                    $link = '';
                    if (is_array($child)) {
                        foreach ($child as $kk => $val) {
                            $str = $item[$pkey][$val];
                            if ($kk == 0) {
                                $link = $link . ($str == '' ? '(Blank)' : $str);
                            } else {
                                $link = $link . ' - ' . $str;
                            }
                        }
                    } else {
                        $link = $item[$pkey][$child];
                    }
                    $txt = $link;
                    ?>
                @case('Link')
                    @php
                        if (!isset($link)) {
                            $txt = $item[$key];
                            $link = $item[$key];
                        }
                    @endphp
                @case('Route')
                    @php
                        if (!isset($link)) {
                            if (isset($param->by)) {
                                $txt = $item[$param->by][$key];
                            } else {
                                $txt = $item[$key];
                            }
                            $link = route($param->name, $item[$param->key]);
                        }
                    @endphp
                    <a href="{{ $link }}" target="_blank"
                        class="text-blue-800 hover:text-blue-600 whitespace-normal flex @isset($param->class){{ $param->class }}@endisset">{{ $txt }}</a>
                @break

                @case('Location')
                    <a onclick="event.stopPropagation();"
                        href="http://maps.google.com/maps?z=12&t=m&q=loc:{{ $item[$param->lat] }}+{{ $item[$param->long] }}"
                        target="_blank"
                        class="text-blue-800 hover:text-blue-600 inline-flex py-0.5 @isset($param->class) {{ $param->class }} @endisset">
                        <svg class="mx-0.5 my-auto" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                            class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                        </svg>
                        <div class=" whitespace-nowrap">
                            Lihat Lokasi
                        </div>
                    </a>
                @break

                @case('STextArea')
                    @php
                        $pkey = isset($param->by) ? $param->by : $key;
                    @endphp
                    @if ($item[$pkey])
                        <p class="text-ellipsis whitespace-normal">{{ $item[$pkey][$param->child] }}</p>
                    @else
                        <p class="text-gray-400 text-ellipsis whitespace-normal" style="min-width:200px;">
                            @isset($param->empty) {{ $param->empty }}
                            @else
                            - @endisset
                        </p>
                    @endif
                @break

                @case('TextArea')
                    @if ($item[$key])
                        <p class="text-ellipsis whitespace-normal">{{ $item[$key] }}</p>
                    @else
                        <p class="text-gray-400 text-ellipsis whitespace-normal" style="min-width:200px;">
                            @isset($param->empty) {{ $param->empty }}
                            @else
                            - @endisset
                        </p>
                    @endif
                @break

                @case('DateNull')
                    @if ($item[$key] == null)
                        <div class="text-gray-400 font-semibold">(Belum)</div>
                    @else
                        <div class="text-gray-900">{{ date('j F, Y', strtotime($item[$key])) }}</div>
                    @endif
                @break

                @case('SDate')
                    @php
                        if (isset($param->child))
                            $txt = isset($param->by) ? $item[$param->by][$param->child] : $item[$key][$param->child];
                        else
                        if (isset($param->by))
                            $txt = $item[$param->by][$key];
                        else
                            $txt = $item[$key];
                    @endphp
                @case('Date')
                    @php
                        $txt = isset($txt) ? $txt : $item[$key];
                    @endphp
                    <div class="text-gray-900 @isset($param->class){{ $param->class }}@endisset">
                            {{ date('j F, Y', strtotime($txt)) }}
                    </div>
                @break

                @case('DateTime')
                    @isset($param->wrap)
                        <div class="whitespace-nowrap">{{ date('j F, Y H:i:s', strtotime($item[$key])) }}</div>
                    @else
                        @if ($item[$key])
                            <div class="text-gray-900">{{ date('j F, Y', strtotime($item[$key])) }}</div>
                            <div class="text-gray-900">{{ date('H:i:s', strtotime($item[$key])) }}</div>
                        @else
                            <div class="text-gray-900">-</div>
                        @endif
                    @endisset
                @break

                @case('Boolean')
                    <div class="flex">
                        <div
                            class="px-2 inline-flex mx-auto text-xs leading-5 font-semibold rounded-full {{ $item[$key] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $param->val[$item[$key]] }}
                        </div>
                    </div>
                @break

                @case('SState')
                    <?php
                    $data = $item[$key];
                    $col = isset($param->color->{$data}) ? $param->color->{$data} : 'gray';
                    $title = isset($param->title->{$data}) ? $param->title->{$data} : $data;
                    ?>
                    <small
                        class="px-2 inline-flex mx-auto leading-5 font-semibold rounded-full bg-{{ $col }}-100 text-{{ $col }}-800">
                        {{ $title }}
                    </small>
                @break

                @case('CState')
                    <?php
                    $data = $item[$key];
                    ?>
                    <small
                        class="px-2 inline-flex mx-auto leading-5 font-semibold rounded-full bg-{{ $data['color'] }}-100 text-{{ $data['color'] }}-800">
                        {{ $data[$param->child] }}
                    </small>
                @break

                @case('State')
                    {{-- <small class="flex"> --}}
                    @if ($item[$key])
                        <small class="px-2 inline-flex mx-auto leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            AKTIF
                        </small>
                    @else
                        <small class="px-2 inline-flex mx-auto leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                            NON-AKTIF
                        </small>
                    @endif
                    {{-- </div> --}}
                @break

                @case('Direct')
                <a href="{{ Routing::getRouteWithNextID($item[$idk], $param->sub) }}" class="text-indigo-600 hover:text-indigo-900">
                    {{$param->text}}
                </a>
                @break

                @case('Show')
                    <a href="{{ Routing::getShowWithNextID($item[$idk]) }}" class="text-indigo-600 hover:text-indigo-900">
                        View
                    </a>
                @break

                @case('Edit')
                    <a href="{{ Routing::getEditWithNextID($item[$idk]) }}" class="text-indigo-600 hover:text-indigo-900">
                        {{-- <a href="{{request()->url().'/'.$item['id'] . '/edit'}}" class="text-indigo-600 hover:text-indigo-900"> --}}
                        Edit
                    </a>
                @break

                @case('Delete')
                    <form action="{{ Request::url() . '/' . $item[isset($param->id) ? $param->id : 'id'] }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input hidden name="_last_" value="{{ request()->fullUrl() }}">
                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">Delete</button>
                    </form>
                @break

                @case('Post')
                    <form action="{{ (isset($param->header) ? url('/' . $param->header) : Request::url()) . '/' . $item['id'] }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <input hidden name="_last_" value="{{ request()->fullUrl() }}">
                        <button type="submit" name="type" value="{{ $param->for }}"
                            class="text-blue-600 hover:text-blue-900">{{ $param->then[0] }}</button>
                    </form>
                @break

                @case('Toggle')
                    <form action="{{ request()->url() . '/' . $item['id'] }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input hidden name="_last_" value="{{ request()->fullUrl() }}">
                        <input id="{{ $key }}" name="{{ $key }}" value="{{ $item[$param->by] ? 0 : 1 }}" hidden>
                        <button type="submit" name="__type" value="toggle"
                            class="text-indigo-600 hover:text-indigo-900">{{ $item[$param->by] ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                    </form>
                @break

                @case('No')
                    <div class="text-gray-900">{{ $iind + 1 }}</div>
                @break

                @case('Upload')
                    @php
                        $files = $item->{$key};
                        $exists = is_countable($files) ? sizeof($files) : $files;
                    @endphp
                    @if ($exists)
                        <ol class="mt-2 ml-4 list-decimal">
                            @if (is_countable($files))
                                @foreach ($files as $vkey => $vfile)
                                    <li class="w-full text-gray-600 group cursor-pointer hover:bg-blue-100 px-1"
                                        v-on:click="downloadFileOn({{ $vfile[$param->id] }}, '{{ $vfile[$param->name] }}', '{{ $param->folder }}')">
                                        <div class="mr-2 truncate flex">
                                            <div class="my-auto mr-3">{{ $vfile[$param->name] }}</div>
                                            <div class="text-blue-300 ml-auto group-hover:bg-blue-500 group-hover:text-white p-1 rounded">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li class="w-full text-gray-600 group cursor-pointer hover:bg-blue-100 px-1"
                                    v-on:click="downloadFileOn({{ $item->id }}, '{{ $files }}', '{{ $param->folder }}')">
                                    <div class="mr-2 truncate flex">
                                        <div class="my-auto mr-3">{{ $files }}</div>
                                        <div class="text-blue-300 ml-auto group-hover:bg-blue-500 group-hover:text-white p-1 rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                                            </svg>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ol>
                    @else
                        <div class="text-gray-400 ml-6 mt-1">(Tidak ada)</div>
                    @endif
                @break

                @case('Slot')
                    @switch($key)
                        @case('aging')
                            <div class="{{ isset($param->align) ? 'text-' . $param->align : 'text-right mr-3' }}">{{ $item[$key] }} Hari</div>
                        @break

                        @case('pjum')
                            @if (sizeof($item->pjum) > 0)
                                @php $pjum = $item->pjum[0]; @endphp
                                <a href="{{ url('/pjum/detail') . '?hid=' . $pjum->t_pjum_id }}"
                                    class="font-semibold font-gray-400 text-center hover:underline">{{ $pjum->t_pjum_id }}</a>
                                @switch($pjum->status_pjum)
                                    @case('Rejected')
                                    @case('Canceled')
                                        <div class="text-xs px-2 text-center leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $pjum->status_pjum }}</div>
                                    @break

                                    @default
                                        <div class="text-xs px-2 text-center leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $pjum->status_pjum }}</div>
                                    @break
                                @endswitch
                            @else
                                <div class="text-center">Tidak Ada</div>
                            @endif
                        @break

                    @endswitch
                @break

                @default
                @break

            @endswitch
