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

            body { font-family: DejaVu Sans, sans-serif; font-size: 11px }

            h1 {
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
                    <table class="table-border">
                        <tr>
                            <td rowspan="2" colspan="4" class="no-border-bottom">АО "ТИНЬКОФФ БАНК" Г. МОСКВА</td>
                            <td>БИК</td>
                            <td>044525974</td>
                        </tr>
                        <tr>
                            <td class="no-border-bottom">Сч. №</td>
                            <td class="no-border-bottom">30101810145250000974</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="no-border-top"><span style="font-size: 11px">Банк получателя</span></td>
                            <td class="no-border-top"></td>
                            <td class="no-border-top"></td>
                        </tr>
                        <tr>
                            <td>ИНН</td>
                            <td>7807189999</td>
                            <td>КПП</td>
                            <td>780701001</td>
                            <td class="no-border-bottom">Сч. №</td>
                            <td class="no-border-bottom">40702810410000256068</td>
                        </tr>

                        <tr>
                            <td colspan="4" class="no-border-bottom">ООО "ФЛН"</td>
                            <td class="no-border-top no-border-bottom"></td>
                            <td class="no-border-top no-border-bottom"></td>
                        </tr>
                        <tr>
                            <td class="no-border-top" colspan="4"><span style="font-size: 11px">Получатель</span></td>
                            <td class="no-border-top"></td>
                            <td class="no-border-top"></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <h1>{{$header}}</h1>
                </td>
            </tr>

            <tr>
                <td>
                    <table style="width: auto">
                        <tr>
                            <td>Поставщик:<br/>(Исполнитель)</td>
                            <td>ООО "ФЛН", ИНН 7807189999, КПП 780701001, 198206, Санкт-Петербург г, Адмирала Трибуца ул., дом 7, офис 66, тел.: 88129822383</td>
                        </tr>
                        <tr>
                            <td>Покупатель:<br />(Заказчик)</td>
                            <td>{{ $order->ur_name ? $order->ur_name : '' }}{{ $order->ur_inn ? ', ИНН '.$order->ur_inn : '' }}{{ $order->ur_kpp ? ', КПП '.$order->ur_kpp : '' }}{{ $order->ur_address ? ', '.$order->ur_address : '' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table class="table-border">
                        <tr>
                            <th>№</th>
                            <th>Товары (работы, услуги)</th>
                            <th>Кол-во</th>
                            <th>Ед.</th>
                            <th>Цена</th>
                            <th>Сумма</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Букет "{{ $order->orderLists[0]->product->name }}"</td>
                            <td align="right">{{ $order->orderLists[0]->qty }}</td>
                            <td align="center">шт</td>
                            <td align="right">{{ number_format($order->orderLists[0]->client_price / $order->orderLists[0]->qty, 2, '.', ' ') }}</td>
                            <td align="right">{{ number_format($order->amount, 2, '.', ' ') }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="no-border"></td>
                        </tr>

                        <tr>
                            <td colspan="5" class="no-border" align="right">
                                <b>Итого:</b>
                            </td>
                            <td class="no-border">
                                <b>{{ number_format($order->amount, 2, '.', ' ') }}</b>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="5" class="no-border" align="right">
                                Без налога (НДС)
                            </td>
                            <td class="no-border">
                                -
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" class="no-border" align="right">
                                <b>Всего к оплате:</b>
                            </td>
                            <td class="no-border">
                                <b>{{ number_format($order->amount, 2, '.', ' ') }}</b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="no-border"></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>Всего наименований 1, на сумму {{ number_format($order->amount, 2, '.', ' ') }}
                <br /><b>{{ \App\Helpers\AppHelper::num2str($order->amount) }}</b>
                </td>
            </tr>

            <tr>
                <td>
                    <p>Оплата данного счета означает согласие с условиями поставки товара.
Уведомление об оплате обязательно, в противном случае не гарантируется наличие товара на складе. Товар отпускается по факту прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и паспорта.
</p>
                </td>
            </tr>

            <tr>
                <td style=" padding: 0;"><hr/></td>
            </tr>

            <tr>
                <td><img src="https://floristum.ru/images/invoice_footer.png"></td>
            </tr>

        </table>

    </body>
</html>