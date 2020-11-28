<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <style>
        @font-face {
            font-family: "fontbold";
            src: url("Roboto-Regular.ttf");
        }

        body { font-family:  'Times New Roman', DejaVu Sans, sans-serif !important; font-size: 14px }

        h1, h2, h3, h4 {
            text-align: center;
        }

        hr {
            border: none;
            height: 2px;
            color: #333;
            background-color: #333;
        }

        table {
            width: 100%;
        }

        table td {
            vertical-align: top;
            padding: 5px;
        }

        .table-border {
            border-collapse: collapse;
        }

        .table-border td, .table-border th {
            border: 1px solid black;
        }

        .table-border-top {
            border-top: 1px solid black;
        }

        .table-border-right {
            border-right: 1px solid black;
        }

        .table-border-bottom {
            border-bottom: 1px solid black;
        }

        .table-border-left {
            border-left: 1px solid black;
        }

        .no-border {
            border: 0px !important;
        }

        .no-border-top {
            border-top: 0px !important;
        }

        .no-border-right {
            border-right: 0px !important;
        }

        .no-border-bottom {
            border-bottom: 0px !important;
        }

        .no-border-left {
            border-left: 0px !important;
        }

    </style>
</head>
<body style="width: 708px;">
{!! $html !!}
<table border="0">
    <tr>
        <td width="50%">
            <p>Отчет сдал:</p>
                  <img src="https://floristum.ru/images/pechat.png">
        </td>
        <td width="50%">
            <p>Отчет принял:</p>
            <br><br>

            {{ $shop->org_name }}
            <br>
            Юр. адрес: {{ $shop->org_address }}
            <br>
            Расчетный счет: {{ $shop->rs }} в
            <br>
            {{ $shop->bank }}
            <br>
            БИК Банка: {{ $shop->bik }}
            <br>
            Корр. счет: {{ $shop->ks }}
            <br>
            ИНН: {{ $shop->inn }}
            <br>
            КПП: {{ $shop->kpp }}
            <br><br>
            __________________________________
            <br><br>
            ________________/________________/

        </td>
    </tr>
</table>

<br><br><br>
<table class="table-border">
    <tr>
        <td>
            Акт считается подтвержденным, если в адрес ООО "ФЛН" не направлен Протокол разногласий к данному акту до {{ $date->addMonthsNoOverflow(1)->endOfMonth()->format('d.m.Y') }}

        </td>
    </tr>
</table>
<br><br><br>


</body>
</html>