@yield('index')
{{-- @isset($graph)
    <script src="https://www.gstatic.com/charts/loader.js"></script>
@endisset --}}
<script>
    // @isset($graph)
    //     google.charts.load('current', {
    //         'packages': ['bar', 'corechart'],
    //         'language': 'id'
    //     });
    //     google.charts.setOnLoadCallback(drawChart);

    //     function drawChart() {
    //         @if (isset($graph['bar']))
    //             var data_bar = google.visualization.arrayToDataTable({!! json_encode($graph['bar']['data']) !!});
    //             var options_bar = {!! json_encode($graph['bar']['option']) !!};
    //             // var bar_chart = new google.charts.Bar(document.getElementById('barchart'));
    //             // bar_chart.draw(data_bar, google.charts.Bar.convertOptions(options_bar));
    //             var bar_chart = new google.visualization.ComboChart(document.getElementById('barchart'));
    //             bar_chart.draw(data_bar, options_bar);
    //         @endisset
    //         @isset($graph['pie'])
    //             var data_pie = google.visualization.arrayToDataTable({!! json_encode($graph['pie']['data']) !!});

    //             var options_pie = {!! json_encode($graph['pie']['option']) !!};
    //             // var chart = new google.charts.Bar(document.getElementById('barchart'));
    //             var pie_chart = new google.visualization.PieChart(document.getElementById('piechart'));
    //             pie_chart.draw(data_pie, options_pie);
    //         @endisset
    //         @if (isset($graph['bar2']))
    //             var data_bar2 = google.visualization.arrayToDataTable({!! json_encode($graph['bar2']['data']) !!});
    //             var options_bar2 = {!! json_encode($graph['bar2']['option']) !!};

    //             var bar_chart2 = new google.visualization.ComboChart(document.getElementById('barchart2'));
    //             bar_chart2.draw(data_bar2, options_bar2);
    //         @endisset
    //         @isset($graph['pie2'])
    //             var data_pie = google.visualization.arrayToDataTable({!! json_encode($graph['pie2']['data']) !!});

    //             var options_pie = {!! json_encode($graph['pie2']['option']) !!};
    //             // var chart = new google.charts.Bar(document.getElementById('barchart'));
    //             var pie_chart = new google.visualization.PieChart(document.getElementById('piechart2'));
    //             pie_chart.draw(data_pie, options_pie);
    //         @endisset
    //     }
    // @endisset
    Vue.config.productionTip = false

    var vueMenu = new Vue({
        el: "#vue-menu",
        created() {
            @php
                echo 'this.tmenu = undefined;';
                $current_route = Routing::getCurrentRouteName();
                foreach ($menus as $ind => $menu) {
                    if (consoling($menu, 'this.tmenu', $ind, $current_route)) {
                        "this.tmenu = '" . $menu['key'] . "';";
                    }
                }
                function consoling($menu, $curr, $ind, $sel_tab)
                {
                    if (isset($menu['children'])) {
                        echo $curr . '_' . $ind . ' = undefined;';
                        foreach ($menu['children'] as $i => $mm) {
                            if (consoling($mm, $curr . '_' . $ind, $i, $sel_tab)) {
                                echo $curr . " = '" . $menu['key'] . "';";
                                return true;
                            }
                        }
                        return false;
                    } else {
                        return str_starts_with($sel_tab, $menu['key']);
                    }
                }
            @endphp
        },
        methods : {
            showTab(id, menu) {
                const el = document.getElementById(menu);
                if (this[id]) {
                    if (this[id] == menu) {
                        this[id] = undefined;
                        el.classList.remove('block');
                        return;
                    }
                    const elb = document.getElementById(this[id]);
                    elb.classList.remove('block');
                }
                this[id] = menu;
                el.classList.add('block');
                console.log(id, this);
            },
        }
    });


    var vue = new Vue({
        el: "#vue-app",
        data: {
            onPopup: undefined,
            files: {
                @foreach (VueControl::Mono()->pool as $key => $files)
                    {{$key}} : [
                        @foreach ($files as $file)
                            {
                                id: "{{ $file->id }}",
                                name: "{{ $file->file_desc }}",
                                oname: "{{ $file->file_desc }}",
                                change: false,
                                delete: false,
                                file: undefined
                            },
                        @endforeach
                    ],
                @endforeach
            }
        },
        created() {
        },
        methods: {
            updateParamArray(array, remove = undefined) {
                var url = new URL(window.location.href);
                var search_params = url.searchParams;
                let set = false;
                array.forEach((x) => {
                    if (search_params.get(x.k) != x.v)
                        set = true;
                });
                if (set)
                    array.forEach((x) => {
                        search_params.set(x.k, x.v);
                    });
                else
                    array.forEach((x) => {
                        search_params.delete(x.k);
                    });
                if (remove)
                    search_params.delete(remove);
                url.search = search_params.toString();
                var new_url = url.toString();
                location = new_url;
            },
            updateParam(key, value, remove = undefined) {
                var url = new URL(window.location.href);
                var search_params = url.searchParams;
                if (value == 'all')
                    search_params.delete(key);
                else
                    search_params.set(key, value);
                if (remove)
                    search_params.delete(remove);
                url.search = search_params.toString();
                var new_url = url.toString();
                location = new_url;
            },
            setParam(key, value) {
                var url = new URL(window.location.href);
                url.search = `?${key}=${value}`;
                var new_url = url.toString();
                location = new_url;
            },
            updateParamById(key, id) {
                var url = new URL(window.location.href);
                var search_params = url.searchParams;
                const el = document.getElementById(id);
                if (!el)
                    return;
                search_params.set(key, el.value);
                url.search = search_params.toString();
                var new_url = url.toString();
                location = new_url;
            },
            downloadFileOn(id, name, key) {
                const requestOptions = {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                };
                const downloadFile = (blob, fileName) => {
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = fileName;
                    document.body.append(link);
                    link.click();
                    link.remove();
                    setTimeout(() => URL.revokeObjectURL(link.href), 7000);
                };
                fetch("{!! url('/api/downloadson') !!}" + "?id=" + id + "&f=" + key, requestOptions).then(
                    response => {
                        if (response.status == 200)
                            return response.blob();
                        return '';
                    }
                ).then(function(text) {
                    if (text.size > 0)
                        downloadFile(text, name + '.pdf');
                });
            },
            downloadFile(id, name) {
                const requestOptions = {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                };
                const downloadFile = (blob, fileName) => {
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = fileName;
                    document.body.append(link);
                    link.click();
                    link.remove();
                    setTimeout(() => URL.revokeObjectURL(link.href), 7000);
                };
                fetch("{!! url('/api/downloads') !!}" + "?id=" + id, requestOptions).then(
                    response => {
                        if (response.status == 200)
                            return response.blob();
                        return '';
                    }
                ).then(function(text) {
                    if (text.size > 0)
                        downloadFile(text, name);
                });
            },
            exportExcels(url, fullurl = '') {
                const params = url + '/exporte' + (url != fullurl ? fullurl.substr(fullurl.indexOf('?')) : '');
                var fileName;
                const requestOptions = {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json"
                    },
                };
                const downloadFile = (blob, fileName) => {
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    console.log(link.href);
                    link.download = fileName;
                    document.body.append(link);
                    link.click();
                    link.remove();
                    // in case the Blob uses a lot of memory
                    setTimeout(() => URL.revokeObjectURL(link.href), 7000);
                };
                fetch(params, requestOptions).then(
                    response => {
                        if (response.status == 200) {
                            const header = response.headers.get('Content-Disposition');
                            const parts = header.split(';');
                            fileName = filename = parts[1].split('=')[1];
                            return response.blob();
                        }
                        return '';
                    }
                ).then(function(text) {
                    console.log(text);
                    if (text.size > 0)
                        downloadFile(text, fileName);
                });
            },
            printBudget(id, name, url = '/print_file') {
                const requestOptions = {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json"
                    },
                };
                const downloadFile = (blob, fileName) => {
                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    console.log(link.href);
                    link.download = fileName;
                    document.body.append(link);
                    link.click();
                    link.remove();
                    // in case the Blob uses a lot of memory
                    setTimeout(() => URL.revokeObjectURL(link.href), 7000);
                };
                // window.open("{!! url('/api/print_view') !!}"+"?id="+id);
                fetch("{!! url('/api') !!}" + url + "?id=" + id, requestOptions).then(
                    response => {
                        if (response.status == 200)
                            return response.blob();
                        return '';
                    }
                ).then(function(text) {
                    if (text && text.size > 0)
                        downloadFile(text, name + ".pdf");
                });
            },
            inputSetUp(key, $value, share, datalistName = null) {
                const hiddenInput = document.getElementById(key);
                const val = $value.target.value;
                if (!datalistName)
                    datalistName = key;
                let selected;
                if (val.indexOf('\'') > -1) {
                    selected = document.querySelector(`#datalist_${datalistName} option[value="${val}"]`);
                } else
                    selected = document.querySelector(`#datalist_${datalistName} option[value='${val}']`);
                console.log(selected);
                selected.dataset.value
                if (selected)
                    hiddenInput.value = selected.dataset.value;
                else
                    hiddenInput.value = '';
                if (share) {
                    const copycat = document.querySelectorAll('input[value-from=' + key +
                        '],textarea[value-from=' + key + ']');
                    if (selected) {
                        const data = JSON.parse(selected.getAttribute('data-item'));
                        for (var i = 0; i < copycat.length; i++) {
                            // console.log(copycat[i], copycat[i].getAttribute("based"), selected);
                            copycat[i].value = data[copycat[i].getAttribute("based")].replace(/!q/g, '"');;
                        }
                    } else {
                        for (var i = 0; i < copycat.length; i++) {
                            copycat[i].value = '';
                        }
                    }
                }
            },
            inputSetIf(share, $event) {
                const copycat = document.querySelectorAll('div[if]');
                for (var i = 0; i < copycat.length; i++) {
                    var data = JSON.parse(copycat[i].getAttribute("if"));
                    var hidden = false,
                        found = false;
                    for (var iif = 0; iif < data.length; iif += 3) {
                        // console.log('before found', data[iif], share);
                        if (data[iif] == share) {
                            // console.log('found!', copycat[i]);
                            hidden = ((data[iif + 1] == $event.target.value) != data[iif + 2]);
                            found = true;
                        }
                        if (hidden) {
                            copycat[i].classList.add('hidden');
                            found = false;
                            break;
                        }
                    }
                    if (found) {
                        for (var iif = 0; iif < data.length; iif += 3) {
                            if (data[iif] != share) {
                                const el = document.getElementById(data[iif]);
                                // console.log('found : check', copycat[i], el);
                                // console.log('next ', data[iif], data[iif+1], data[iif+2], el);
                                hidden = ((data[iif + 1] == el.value) != data[iif + 2]);
                                if (hidden) {
                                    copycat[i].classList.add('hidden');
                                    break;
                                }
                            }
                        }
                        if (!hidden)
                            copycat[i].classList.remove('hidden');
                    }
                }
            },
            inputDirect(share, $event) {
                const copycat = document.querySelectorAll('div[if]');
                for (var i = 0; i < copycat.length; i++) {
                    var data = JSON.parse(copycat[i].getAttribute("if"));
                    for (var iif = 0; iif < data.length; iif += 3) {
                        console.log('try to check', copycat[i], 'with_data=_', data[iif], '_and key = ', share)
                        if (data[iif] == share) {
                            console.log('check if ' + data[iif + 2] + ', ' + data[iif + 1] + " == " + $event
                                .target.value)
                            if ((data[iif + 1] == $event.target.value) == data[iif + 2])
                                copycat[i].classList.remove('hidden');
                            else
                                copycat[i].classList.add('hidden');
                        }
                    }
                }
            },

            // Upload Feature
            deleteFile(key, index) {
                console.log("deleteFile", key, index);
                const file = this.files[key][index];
                if (file.id > 0) {
                    file.delete = !file.delete;
                } else {
                    this.files[key].splice(index, 1);
                }
                this.$forceUpdate();
                console.log(index);
            },
            uploadRefresh(id) {
                let fileSize = 0;
                Object.entries(this.files).forEach(y => {
                    const [key, value] = y;
                    const file = document.getElementById(key);
                    if (file) {
                        const dt = new DataTransfer();
                        value.forEach(x => {
                            console.log(x);
                            if (x.file) {
                                fileSize += x.file.size;
                                dt.items.add(new File([x.file], x.name + x.ext, {
                                    type: x.file.type
                                }));
                            }
                        });
                        file.files = dt.files;
                    }
                })
                if (fileSize > 41000000)
                    alert(
                        `Mohon maaf, File yang ingin anda upload sekitar ${parseInt(fileSize/1048576)}MB lebih besar dari batas server (>40MB). Harap upload file secara satu persatu. Terimakasih`
                    );
                else
                    document.getElementById(id).click();
            },
            uploadChange(key, $event, multiple = true) {
                if ($event.target.files) {
                    for (let index = 0; index < $event.target.files.length; index++) {
                        const element = $event.target.files[index];
                        const name = element.name.replace(/\.[^/.]+$/, "");
                        const ext = element.name.match(/\.[^/.]+$/)[0];
                        console.log(multiple);
                        if (multiple)
                            this.files[key].push({
                                id: 0,
                                name: name,
                                oname: name,
                                ext : ext,
                                delete: false,
                                file: element
                            })
                        else
                            this.files[key] = [{
                                id: 0,
                                name: name,
                                oname: name,
                                ext : ext,
                                delete: false,
                                file: element
                            }];
                    }
                    this.$forceUpdate();
                }
            },
            onlyDate($event) {
                console.log($event.target.value);
            },
            onCount($event, key) {
                const output = document.getElementById(key);
                const xs = JSON.parse(output.getAttribute('from'))
                var value = 1.0;
                xs.forEach(x => {
                    const element = document.getElementById(x);
                    if (element.value == '') {
                        value = 0;
                    } else if (element)
                        value = value * parseFloat(element.value);
                });
                output.value = value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            },
            onTotal(array_key, base) {
                const output = document.getElementById(base);
                console.log(`[id^="${array_key}"]`);
                const xs = document.querySelectorAll('[id^="' + array_key + '"]')
                var value = 0;
                xs.forEach(x => {
                    if (x.value != '')
                        value = value + parseFloat(x.value.replaceAll(',', ''));
                });
                output.value = value.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            },
            refMax($event, id, max) {
                const el = document.getElementById(id);
                if (el) {
                    const L = $event.target.value.length;
                    el.innerHTML = L + '/' + max;
                    if (L < max)
                        el.classList.remove('text-red-500');
                    else
                        el.classList.add('text-red-500');
                }
            },
            @isset($chatAble)
                toChat($id) {
                        if (this.canScroll) {
                            console.log('scrolling!');
                            this.canScroll = false;
                            const chat = document.getElementById("chat_" + $id);
                            if (chat) {
                                chat.scrollIntoView({
                                    behavior: "smooth",
                                    block: "center",
                                    inline: "nearest"
                                });
                                chat.classList.add("highlight");
                                setTimeout(() => {
                                    chat.classList.remove("highlight");
                                    this.canScroll = true;
                                }, 750);
                            }
                        }
                    },
                    tryReply(chat) {
                        this.replyTo = chat;
                        Object.keys(this.cuser).forEach((key) => this.cuser[key].off = true);
                        chat.stat.forEach((x) => {
                            x.user.off = false;
                        });
                        setTimeout(() => {
                            this.clickToOne();
                            window.document.getElementById("reply").scrollIntoView({
                                behavior: "smooth",
                                block: "end",
                                inline: "nearest"
                            });
                            setTimeout(() => {
                                window.document.getElementById("reply_box").focus();
                            }, 750);
                        }, 50);
                    },
                    refreshSendAble() {
                        this.ableSend = this.userSize > 0 && this.textSize > 0;
                    },
                    clickToOne() {
                        let now = true;
                        this.userSize = 0;
                        window.document.querySelectorAll('input.toclass').forEach((x) => {
                            now = (now && x.checked);
                            if (x.checked)
                                this.userSize++;
                        });
                        this.refreshSendAble();
                        window.document.getElementById('to_all').checked = now;
                    },
                    clickToAll($event) {
                        const check = $event.target;
                        const to = window.document.querySelectorAll('input.toclass');
                        this.userSize = to.length;
                        if (to.length > 0) {
                            if (check.checked)
                                to.forEach((x) => x.checked = true);
                            else {
                                to.forEach((x) => x.checked = false);
                            }
                        } else {
                            check.checked = true;
                        }
                    },
                    async sendChat() {
                            if (this.sendingChat || !this.ableSend)
                                return;
                            this.sendingChat = true;
                            this.chatError = '';
                            const reply_box = window.document.getElementById('reply_box');
                            const to = window.document.querySelectorAll('input.toclass');
                            let sendTo = [{
                                position_user_id: this.cuser[{{ $_SESSION['ebudget_id'] }}].posid,
                                user_id: {{ $_SESSION['ebudget_id'] }}
                            }];
                            let chatStat = [];
                            to.forEach((x) => {
                                if (x.checked) {
                                    sendTo.push({
                                        position_user_id: this.cuser[x._value].posid,
                                        user_id: x._value
                                    });
                                    chatStat.push({
                                        user: this.cuser[x._value],
                                        tgl_read: undefined
                                    })
                                }
                            })
                            const requestOptions = {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    id: {{ $data->id }},
                                    message: reply_box.value,
                                    reference_id: this.replyTo?.id,
                                    sendto: sendTo
                                }),
                                credentials: "same-origin"
                            };
                            const response = await fetch("{!! url('/api/send_message') !!}", requestOptions);
                            const data = await response.json();
                            console.log(response, data);
                            this.sendingChat = false;
                            if (response.status == 200) {
                                this.chats.push({
                                    id: data.data.id,
                                    user: this.cuser[{{ $_SESSION['ebudget_id'] }}],
                                    msg: reply_box.value,
                                    date: data.data.tgl_chat,
                                    refs: this.replyTo,
                                    stat: chatStat,
                                });
                                this.replyCancel();
                                reply_box.value = '';
                            } else {
                                this.chatError = data;
                            }
                        },
                        changeReply($event) {
                            this.textSize = $event.target.value.length;
                            this.refreshSendAble();
                        },
                        replyCancel() {
                            this.replyTo = undefined;
                            this.clickToOne();
                            Object.keys(this.cuser).forEach((key) => this.cuser[key].off = false);
                        }
            @endisset
        }
    });
</script>
