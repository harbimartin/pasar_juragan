<style>
    td.th {
        text-align: left;
        min-width: 100px;
    }

    .linkbox {
        margin: 1rem 4rem;
        text-align: center;
        padding: .8rem 2rem;
        background: #E4F0FF;
        border-radius: 1rem
    }

    .linkbox:hover {
        background: #90C2FF;
    }

    .font-semibold {
        font-weight: 700;
    }
</style>
<h2 style="padding:2rem 0;">Pasar Juragan</h2>
<div style="max-width:720px; margin-left:auto; margin-right:auto;">
    Yang Terhormat,<br> <strong>{{ $name }}</strong>,
    <br>
    <p>{!! nl2br(e($intro)) !!}</p>
    @isset($table)
        <table style="margin-left:15%;">
            @foreach ($table as $key => $tab)
                <tr>
                    <td class="th">{{ $key }}</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td>{{ $tab }}</td>
                </tr>
            @endforeach
        </table>
    @endisset
    <br>
    @isset($exclusive_link)
        <a href="{{ $exclusive_link['link'] }}">
            <div class="linkbox">
                <span class="font-semibold">{{ $exclusive_link['note'] }}</span><br>
                <span>{{ substr($exclusive_link['link'], 0, 70) }}...</span>
            </div>
        </a>
    @endisset
    {{ $close }}<br>
    @isset($link)
        <a href="{{ $link }}">Klik disini untuk menuju Web Pasar Juragan</a>
    @endisset
    <div style="text-align:right">
        @isset($pemohon)
            <br>
            Pemohon,
            <br> <strong>{{ $pemohon }}</strong>
        @endisset
        <br>
        @isset($admin)
            <br>
            Admin,
            <br> <strong>{{ $admin }}</strong>
        @endisset
        @isset($penyetuju)
            <br>
            Penyetuju,
            <br> <strong>{{ $penyetuju }}</strong>
        @endisset
    </div>

    @isset($note)
        <div style="background:#eee; font-style: italic; padding:.6rem .5rem; font-size: 10pt;">
            {{ $note }}</div>
    @endisset
</div>
