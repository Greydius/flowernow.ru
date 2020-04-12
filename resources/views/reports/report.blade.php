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

        body { font-family:  'Times New Roman', DejaVu Sans, sans-serif; font-size: 14px }

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

<table border="0">
    <tr>
        <td>
            <center>
                Отчет агента за <strong>{{ \App\Helpers\AppHelper::ruMonth($date->format('m'), 2) }} {{ $date->format('Y') }}г.</strong>
                <br>
                по агентскому договору от {{ $firstOrder->created_at->format('d.m.Y') }}г.
            </center>
        </td>
    </tr>
</table>

<table border="0">
    <tr>
        <td style="float: left;" width="50%">
            "{{ $date->endOfMonth()->format('d') }}" {{ \App\Helpers\AppHelper::ruMonth($date->format('m')) }} {{ $date->format('Y') }} г.
        </td>
        <td style="float: right; text-align: right" width="50%">
            г. Санкт-Петербург
        </td>
    </tr>
</table>

<table border="0">
    <tr>
        <td>
            Продавец, {{ $shop->org_name }}, поручил, а Агент,
            ООО "ФЛН", в лице генерального директора Степановой Л.Ю.,
            за период c "{{ $date->startOfMonth()->format('d') }}" {{ \App\Helpers\AppHelper::ruMonth($date->format('m')) }} {{ $date->format('Y') }} г. по "{{ $date->endOfMonth()->format('d') }}" {{ \App\Helpers\AppHelper::ruMonth($date->format('m')) }} {{ $date->format('Y') }} г.
            заключил следующие сделки с покупателями:
        </td>
    </tr>
</table>


<table class="table-border">
    <tr>
        <th>№<br>п/п</th>
        <th>Дата<br>заказа</th>
        <th>Номер заказа</th>
        <th>Получена плата<br>за товар от<br>покупателей, ₽</th>
        <th>Сумма<br>вознаграждения<br>Агента, ₽</th>
        <th>Сумма к<br>перечислению<br>Продавцу, ₽</th>
    </tr>
    @php
        $total1 = 0;
        $total2 = 0;
        $total3 = 0;
    @endphp
    @foreach($orders as $indexKey => $order)

        <tr>
            <td>{{ $indexKey + 1 }}</td>
            <td>{{ $order->payment == 'cash' ? $order->created_at : $order->payed_at }}</td>
            <td>{{ $order->id }}{{ !empty($order->finance_comment) ? '' : '' }}</td>
            <td>{{ number_format($order->amount, 2, '.', ' ') }} {{ $order->payment == 'cash' ? 'оплачено наличными Продавцу' : '' }}</td>
            <td>{{ number_format($order->payment != 'cash' ? $order->amount - $order->amountShop : (-1)*$order->amountShop, 2, '.', ' ') }}</td>
            <td>{{ number_format($order->amountShop, 2, '.', ' ') }}</td>
        </tr>
        @php
            $total1 += $order->payment != 'cash' ? $order->amount : 0;
            $total2 += $order->payment != 'cash' ? ($order->amount - $order->amountShop) : ((-1)*$order->amountShop);
            $total3 += $order->payment != 'cash' ? $order->amountShop : $order->amountShop;
        @endphp
    @endforeach

    <tr>
        <td colspan="3" align="right">
            <b>Итого:</b>
        </td>
        <td>
            <b>{{ number_format($total1, 2, '.', ' ') }}</b>
        </td>
        <td>
            <b>{{ number_format($total2, 2, '.', ' ') }}</b>
        </td>
        <td>
            <b>{{ number_format($total3, 2, '.', ' ') }}</b>
        </td>
    </tr>
</table>

<p>Сумма заключенных сделок с покупателями за вычетом агентского вознаграждения составила {{ $total3 }} {{ \App\Helpers\AppHelper::num2str($total3, true) }}. НДС не облагается</p>
<p>Вознаграждение Агента составило {{ $total2 }} {{ \App\Helpers\AppHelper::num2str($total2, true) }}. НДС не облагается</p>

<p>Настоящий Отчет является актом оказанных услуг.</p>

<table border="0">
    <tr>
        <td width="50%">
            <p>Отчет сдал:</p>

            @if(true)
                <img src="https://floristum.ru/images/pechat.png">
            @else

                <p>ООО "ФЛН"</p>

                ИНН/ КПП 7807189999/ 780701001
                <br>
                Юр. адрес: 198206, г. Санкт-Петербург,
                <br>
                ул. Адмирала Трибуца, д.7, кв.66
                <br>
                Расчетный счет: 40702810410000256068 в
                <br>
                АО "ТИНЬКОФФ БАНК"
                <br>
                БИК Банка: 044525974
                <br>
                Корр. счет: 30101810145250000974
                <br>
                Генеральный директор
                <br><br>
                ________________/Степанова Л.Ю./
                <br><br>

                М.П.


            @endif

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