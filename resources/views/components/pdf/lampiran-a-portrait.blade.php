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

        .detail-table {
            margin-top: 30px;
            border: none;
        }

        .detail-table th, .detail-table td {
            border-collapse: collapse;
            border: none !important;
        }

        thead { display: table-header-group; }
        tfoot { display: table-footer-group; }
        tr { page-break-inside: avoid; }
    </style>
</head>
<body>
    <header>
        <p>Lampiran A</p>
    </header>
    <footer>
        ***Ini adalah cetakan komputer dan tidak memerlukan tandatangan fizikal.***
    </footer>
    <main>
        <h3 class="title">AGIHAN TABUNG DANA RU TAHUN {{ $form->plan_year }}</h3>
        <table class="detail-table">
            <tr>
                <th>NO. RUJ. UTMFIN</th>
                <th>:</th>
                <th>{{ $form->plan_form_ref_no }}</th>
            </tr>
            <tr>
                <th>PUSAT KOS</th>
                <th>:</th>
                <th>{{ $chargeline }} - {{ $form->ddf_title }}</th>
            </tr>
            <tr>
                <th>JUMLAH</th>
                <th>:</th>
                <th>RM {{ number_format($form->plan_form_amount, 2, '.', ',') }}</th>
            </tr>
            <tr>
                <th>PTJ PIC</th>
                <th>:</th>
                <th>{{ $form->ptj }}</th>
            </tr>
            <tr>
                <th>Tarikh</th>
                <th>:</th>
                <th>{{ $form->plan_form_declaration_date ? date('j/n/Y', strtotime($form->plan_form_declaration_date)): '' }}</th>
            </tr>
        </table>
    </main>
</body>
</html>