<table class="table">
    <tr>
        <th>№ заказа</th>
        <th>Дата оплаты</th>
        <th>Цена полная</th>
        <th>Магазину</th>
        <th>Комиссия</th>
        <th>Комментрарий</th>
    </tr>
    <?
        $amountCommissionTotal = 0;
        $amountShopTotal = 0;
    ?>
    @foreach($orders as $order)
        <?
                $amount = $order->report_price != false ? $order->report_price : $order->amount();
                $amountShop = $order->amountShop();
                $commission = $order->payment == 'cash' ? $amountShop*(-1) : ($amount - $amountShop);
                $amountCommissionTotal += $commission;
                $amountShopTotal += $amountShop;
        ?>
        <tr>
            <td><a href="{{ route('admin.order.view', ['id' => $order->id]) }}" target="_blank">{{ $order->id }}</a></td>
            <td>{{ $order->payed_at }}</td>
            <td>{{ round($amount) }}</td>
            <td>{{ round($order->amountShop()) }}</td>
            <td>{{ round($commission) }}</td>
            <td>{{ $order->finance_comment }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3" class="font-weight-bold">Итого:</td>
        <td>{{ round($amountShopTotal) }}</td>
        <td>{{ round($amountCommissionTotal) }}</td>
        <td></td>
    </tr>
</table>
<!--  -->