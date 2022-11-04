<div class="pt-10">
    @foreach ($timelines as $timekey => $timeline)
        <div class="md:grid md:grid-cols-{{ sizeof($timeline) }} md:px-6 mt-5 md:mt-5">
            @foreach ($timeline as $timek => $timel)
                <?php
                $notfirst = false;
                $on_next = null;
                ?>
                <div class="px-1 md:px-5 md:mt-3 mt-5">
                    <div class="border-b text-base md:text-xl md:pb-2 border-gray-200 md:mb-3">
                        {{ $timel['title'] }}
                    </div>
                    @if ($data->{'log_' . $timek})
                        <div class="grid grid-cols-12 text-gray-50">
                            @foreach ($data->{'log_' . $timek} as $appr)
                                <div class="contents">
                                    <?php
                                    $bg_col = $on_next;
                                    switch ($appr['status']) {
                                        case 'Pending':
                                            $on_next = 'indigo-800';
                                            $bg_col = 'indigo-500';
                                            $ico = 'M5.5 3.5A1.5 1.5 0 0 1 7 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5zm5 0A1.5 1.5 0 0 1 12 5v6a1.5 1.5 0 0 1-3 0V5a1.5 1.5 0 0 1 1.5-1.5z';
                                            break;
                                        case 'Proposed':
                                            $bg_col = 'indigo-500';
                                            $ico = 'M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z';
                                            break;
                                        case 'Draft':
                                            $on_next = 'gray-400';
                                            $bg_col = 'gray-500';
                                            $ico = 'M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702s.18.149.5.149.5-.15.5-.15v-.7c0-.701.478-1.236 1.011-1.492A3.5 3.5 0 0 0 11.5 3V2h-7z';
                                            break;
                                        case 'Verified':
                                        case 'Approved':
                                        case 'Ready':
                                        case 'Received From':
                                            $bg_col = 'blue-500';
                                            $ico = 'M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z';
                                            break;
                                        case 'Rejected':
                                        case 'Cancelled':
                                            $on_next = 'gray-500';
                                            $bg_col = 'red-600';
                                            $ico = 'M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z';
                                            break;
                                        default:
                                            if (!$on_next) {
                                                $bg_col = 'yellow-600';
                                                $on_next = 'yellow-800';
                                                $ico = 'M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5zm2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702s.18.149.5.149.5-.15.5-.15v-.7c0-.701.478-1.236 1.011-1.492A3.5 3.5 0 0 0 11.5 3V2h-7z';
                                            }
                                    }
                                    ?>
                                    <div class="col-end-2 mx-auto relative">
                                        <div class="h-full w-6 flex items-center justify-center">
                                            {{-- @if ($notfirst) --}}
                                            <div
                                                class="{{ $notfirst ? ($loop->last ? 'mb-auto h-1/2' : 'h-full') : ($loop->last ? 'hidden' : 'mt-auto h-1/2') }} bg-{{ $bg_col }} w-1 pointer-events-none">
                                            </div>
                                            {{-- @endif --}}
                                        </div>
                                        <div
                                            class="w-6 md:w-8 h-6 md:h-8 absolute top-1/2 -mt-4 md:-ml-1 rounded-full bg-{{ $bg_col }} shadow text-center p-1 md:p-1.5">
                                            <svg class="mx-auto" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 16 16">
                                                <path d="{{ $ico }}" />
                                            </svg>
                                        </div>
                                    </div>
                                    <?php $notfirst = true; ?>
                                    <div
                                        class="col-start-2 col-end-13 px-4 mx-2 my-1 py-2 md:py-3 rounded-xl mr-auto shadow-md w-full border border-gray-100">
                                        <div
                                            class="text-gray-800 border-b-2 border-{{ $bg_col }} border-opacity-50">
                                            <h3 class="font-semibold mb-1 truncate">
                                                {{ $appr['user']['username_position'] }}
                                                -
                                                {{ $appr['user']['username_name'] }}</h3>
                                        </div>
                                        <div class="text-gray-700 text-xs md:text-sm font-semibold">
                                            {{ $appr['user']['company']['comp_name'] }}
                                        </div>
                                        <div class="flex text-xs md:text-sm text-gray-600 mt-1">
                                            <p>
                                                {{ $appr['created_at'] }}
                                            </p>
                                            <p class="ml-auto">
                                                {{ $appr['updated_at'] ? $timel['name'] : 'Waiting' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="bg-gray-400 px-2 md:px-4 py-1.5 md:py-3 rounded-xl my-1 mr-auto shadow w-full text-center text-white">
                            {{ $module }} ini belum di {{ $timel['name'] }} oleh pihak {{ $timel['by'] }}
                        </div>
                    @endisset
            </div>
        @endforeach
    </div>
@endforeach
</div>
