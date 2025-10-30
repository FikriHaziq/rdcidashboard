<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PDF Form</title>
    <style>
        @page {
            margin: 70px; /* top margin leaves space for header */
        }

        body {
            font-family: sans-serif;
            font-size: 12px
        }

        /* 🟩 Fixed header */
        header {
            position: fixed;
            font-size: 13px;
            color: #969696;
            top: -40px; /* push it into top margin area */
            left: 0;
            right: 0;
            height: 60px;
            text-align: right;
        }

        footer {
            position: fixed;
            bottom: -40px;
            color: #969696;
            left: 0;
            right: 0;
            height: 30px;
            text-align: center;
            font-size: 13px;
        }

        .title {
            font-size: 13px;
            text-align: center;
        }

        .underline {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border-collapse: collapse;
            border: 1px solid #000 !important;
        }

        .table-title th {
            height: 30px;
        }

        table.main-table {
            margin-top: 20px;
        }

        .num-col {
            width: 30px;
        }

        .perkara-col {
            width: 120px;
        }

        .text-center {
            text-align: center;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        .bg-pink {
            background-color: #ffdddd;
        }

        .bg-blue {
            background-color: #d2ebf7;
        }

        .font-weight-normal {
            font-weight: normal;
        }

        .declaration {
            font-weight: normal;
            text-align: justify;
            padding: 10px;
        }

        .signature-table {
            margin-top: 30px;
            border: none;
        }

        .signature-table th, .signature-table td {
            border-collapse: collapse;
            border: none !important;
        }

        thead { display: table-header-group; }
        tfoot { display: table-footer-group; }
        tr { page-break-inside: avoid; }
    </style>
</head>
<body>
    <!-- 🟩 Header that appears on every page -->
    <header>
        <p>Lampiran A</p>
    </header>
    <footer>
        ***Ini adalah cetakan komputer dan tidak memerlukan tandatangan fizikal.***
    </footer>

    <!-- 🧾 Main content -->
    <main>
        <h3 class="title">MAKLUMAT KEWANGAN AGIHAN DANA UNIVERSITI PENYELIDIKAN</h3>
        <h3 class="title underline">BUTIRAN KEWANGAN TERPERINCI</h3>
        <table class="main-table">
            <tr class="table-title">
                <th class="num-col text-center">BIL</th>
                <th class="perkara-col text-center">PERKARA</th>
                <th class="text-center">KETERANGAN</th>
            </tr>
            <tr>
                <th class="num-col text-center">1. </th>
                <th class="perkara-col">PTJ Bertanggungjawab</th>
                <th>{{ $form->ptj }}</th>
            </tr>
            <tr>
                <th class="num-col text-center">2. </th>
                <th class="perkara-col">Program KPM</th>
                <th>{{ $form->mrun_desc }}</th>
            </tr>
            <tr>
                <th class="num-col text-center">3. </th>
                <th class="perkara-col">Projek/Program</th>
                <th>{{ $form->ddf_title }}</th>
            </tr>
            <tr>
                <th class="num-col text-center">4. </th>
                <th class="perkara-col">Pusat Kos / Chargeline</th>
                <th>
                    <table>
                        <tr class="bg-pink">
                            <th class="text-center">No. Chargeline</th>
                            <th class="text-center">Deskripsi</th>
                        </tr>
                        <tr>
                            <th class="text-center">{{ $chargeline }}</th>
                            <th class="text-center">{{ $form->ddf_title }}</th>
                        </tr>
                    </table>
                </th>
            </tr>
            <tr>
                <th class="num-col text-center">5. </th>
                <th class="perkara-col">Agihan Tahun {{ $form->plan_year }}</th>
                <th>
                    <table>
                        <tr class="bg-pink">
                            <th class="text-center">No. Ruj. Pindahan UTMFin</th>
                            <th class="text-center">Jumlah Pindahan</th>
                        </tr>
                        <tr>
                            <th class="text-center">{{ $form->plan_form_ref_no }}</th>
                            <th class="text-center">RM {{ number_format($form->plan_form_amount, 2, '.', ',') }}</th>
                        </tr>
                    </table>
                </th>
            </tr>
            <tr>
                <th class="num-col text-center">6. </th>
                <th class="perkara-col">Sasaran / Key Performance Indicators</th>
                <th>{!! $main_dist !!}</th>
            </tr>
            <tr>
                <th class="num-col text-center">7. </th>
                <th class="perkara-col">Nama Pegawai Bertanggungjawab</th>
                <th>
                    <table>
                        <tr class="bg-blue">
                            <th class="text-center" colspan="2">Butiran Pegawai Bertanggungjawab</th>
                        </tr>
                        <tr>
                            <th class="text-center">Ketua Program</th>
                            <th class="text-center">{{ $form->pic_name }}</th>
                        </tr>
                        <tr>
                            <th class="text-center">Pegawai	bertanggungjawab</th>
                            <th class="text-center">{!! $form->member_name !!}</th>
                        </tr>
                    </table>
                </th>
            </tr>
            <tr>
                <th class="num-col text-center">8. </th>
                <th class="perkara-col">Tugas dan Tanggungjawab Ketua PTJ</th>
                <th class="font-weight-normal">
                    <ol>
                        <li>Ketua PTJ hendaklah memastikan semua perbelanjaan dibuat secara berhemah dan mematuhi semua peraturan kewangan yang telah ditetapkan oleh universiti.</li>
                        <li>Ketua PTJ hendaklah sentiasa memantau prestasi penggunaan dana selaras dengan perancangan pelaksanaan program dalam tahun semasa.</li>
                        <li>Ketua PTJ hendaklah memastikan laporan penggunaan dana disediakan setiap TIGA bulan dan dihantar kepada pihak Urusetia RU UTM</li>
                        <li>Selaras dengan Prosedur Pemantauan Prestasi Projek/Program Di Bawah Dana RU Tahun 2019, Jabatan TNCPI berhak untuk menarik semula peruntukan program yang tidak mencapai prestasi perbelanjaan dan tahap kemajuan yang disasarkan.</li>
                    </ol>
                </th>
            </tr>
            <tr>
                <th class="num-col text-center">9. </th>
                <th class="perkara-col">Perakuan Penerimaan Agihan Tahun {{ $form->plan_year }}</th>
                <th class="declaration">
                    Saya dengan ini berjanji akan memastikan peruntukan yang diterima digunakan selaras dengan perancangan projek/program ini bagi mencapai sasaran KPI Tahun {{ $form->plan_year }}. Saya juga akan mematuhi semua syarat-syarat agihan yang ditetapkan oleh Urusetia dan juga memastikan perbelanjaan dilaksanakan dengan mematuhi semua peraturan kewangan yang ditetapkan.
                    <table class="signature-table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <th>{{ $form->pic_name }}</th>
                        </tr>
                        <tr>
                            <td>Tarikh</td>
                            <td>:</td>
                            <th>{{ $form->plan_form_declaration_date ? date('j/n/Y', strtotime($form->plan_form_declaration_date)): '' }}</th>
                        </tr>
                    </table>
                </th>
            </tr>
        </table>
    </main>
</body>
</html>