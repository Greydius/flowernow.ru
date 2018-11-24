<table class="table">
    <tr>
        <th>№ заказа</th>
        <th>Дата оплаты</th>
        <th>Цена полная</th>
        <th>Магазину</th>
        <th>Комиссия</th>
    </tr>
    <?
        $amountCommissionTotal = 0;
        $amountShopTotal = 0;
    ?>
    @foreach($orders as $order)
        <?
                $amount = $order->amount();
                $amountShop = $order->amountShop();
                $commission = $order->payment == 'cash' ? $amountShop*(-1) : ($amount - $amountShop);
                $amountCommissionTotal += $commission;
                $amountShopTotal += $amountShop;
        ?>
        <tr>
            <td><a href="{{ route('admin.order.view', ['id' => $order->id]) }}" target="_blank">{{ $order->id }}</a></td>
            <td>{{ $order->payed_at }}</td>
            <td>{{ $order->amount() }}</td>
            <td>{{ $order->amountShop() }}</td>
            <td>{{ $commission }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3" class="font-weight-bold">Итого:</td>
        <td>{{ $amountShopTotal }}</td>
        <td>{{ $amountCommissionTotal }}</td>
    </tr>
</table>