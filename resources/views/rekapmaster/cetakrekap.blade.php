<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Rekap Perkuliahan</title>

    <!-- Normalize or reset CSS with your favorite library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4
        }

        #title {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        .tabelpresensi {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .tabelpresensi tr th {
            border: 1px solid #131212;
            padding: 5px;
            background-color: #dbdbdb;
            font-size: 10px;
        }

        .tabelpresensi tr td {
            border: 1px solid #131212;
            padding: 5px;
            font-size: 12px;
        }
    </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 potrait">

    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet padding-10mm">

        <table style="width: 100%">
            <tr>
                <td style="width: 30px">
                    <img src="{{ asset('assets/img/unila.png') }}" width="80" height="80" alt="">
                </td>
                <td>
                    <span id="title">
                        LAPORAN PERKULIAHAN MAHASISWA<br>
                        UNIVERSITAS LAMPUNG<br>
                    </span>
                    <span>
                        <i>Jalan Prof. Dr Jl. Prof. Dr. Ir. Sumantri Brojonegoro No.1, Kota Bandar Lampung, Lampung
                            35141
                        </i>
                    </span>
                </td>
            </tr>
        </table>

        <table class="tabelpresensi">
            <thead>
                <tr>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Absensi</th>
                    <th>Kekatifan</th>
                    <th>Kuis</th>
                    <th>Tugas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswa as $d)
                    <tr>
                        <td>{{$d->npm}}</td>
                        <td>{{$d->name}}</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table width="100%" style="margin-top: 100px">
            <tr>
                <td></td>
                <td style="text-align: center;">Bandar Lampung, {{ date('d-m-Y') }}</td>
            </tr>
            <tr>
                <td style="text-align: center; vertical-align:bottom" height="100px">
                    <u>Pak Rio</u><br>
                    <i><b>Pembimbing 2</b></i>
                </td>
                <td style="text-align: center; vertical-align:bottom">
                    <u>Bu Yessi</u><br>
                    <i><b>Pembimbing 1</b></i>
                </td>
            </tr>
        </table>

    </section>

</body>

</html>
