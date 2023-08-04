<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Excel To HTML using codebeautify.org</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo_iain_metro.jpg') }}">

</head>

<body>
    <b>
        <u>Code Akun</u> : {{ $header->pagu_id }}
        <br>
        <u>Nama Kegiatan</u> :- {{ $namaKegiatan->nama_kegiatan }}
        <br>
        <u>Sumber Anggaran</u> :- {{ $header->sumber_anggaran }}
    </b>
    <hr>
    <table cellspacing=0 border=1>
        <tr>
            <td style=min-width:50px>Nama Barang</td>
            <td style=min-width:50px>Volume</td>
            <td style=min-width:50px>Harga Satuan</td>
            <td style=min-width:50px>Satuan Total</td>
            <td style=min-width:50px>Subtotal</td>
        </tr>
        @foreach ($cetakListRincian as $cl)
            <tr>
                <td style=min-width:50px>{{ $cl->nama_barang }}</td>
                <td style=min-width:50px>{{ $cl->volume }}</td>
                <td style=min-width:50px>{{ 'Rp.' . number_format($cl->harga_satuan, 0, ',', '.') }}</td>
                <td style=min-width:50px>{{ $cl->satuan }}</td>
                <td style=min-width:50px>{{ 'Rp.' . number_format($cl->total, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <br>
        <tr>
            <td style=min-width:50px>Total Anggaran</td>
            <td style=min-width:50px>{{ 'Rp.' . number_format($sumRincian, 0, ',', '.') }}</td>
        </tr>
    </table>
    <hr>
</body>

</html>
