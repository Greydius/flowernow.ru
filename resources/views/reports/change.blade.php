@extends('layouts.admin')

@section('content')
<!-- <div id="change-report-app">
<table>
  <tr>
    <td>№ п/п</td>
    <td>Дата заказа</td>
    <td>Номер заказа</td>
    <td>Получена плата за товар от покупателей, ₽</td>
    <td>Сумма вознаграждения Агента, ₽</td>
    <td>Сумма к перечислению Продавцу, ₽</td>
    <td>Новая сумма, ₽</td>
  </tr>
  <tr v-for="(order, index) of orders" :key="order.id">
    <td v-html="index+1"></td>
    <td v-html="order.payment == 'cash' ? order.created_at : order.payed_at"></td>
    <td v-html="order.id"></td>
    <td v-html="order.amount.toFixed(2) + (order.payment == 'cash' ? ' оплачено наличными Продавцу' : '')"></td>
    <td v-html="order.payment != 'cash' ? (order.amount - order.amountShop).toFixed(2) : ((-1)*order.amountShop).toFixed(2)"></td>
    <td v-html="order.amountShop.toFixed(2)"></td>
    <td><input type="number" v-model="order.report_price"></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td v-html="total"></td>
    <td v-html="totalCommission"></td>
    <td v-html="totalShop"></td>
    <td v-html="totalReport"></td>
  </tr>
</table> -->

<!-- <form action="" method="POST">
{{ csrf_field() }}
<input v-for="order of orders" :key="order.id" type="hidden" :name="'report_price[' + order.id+ ']'" :value="order.report_price">
<button>Сохранить</button>
</form> -->
<h3>Загрузить файл</h3>
<form action="{{ route('admin.uploadReport', ['id' => $id]) }}" method="POST" enctype='multipart/form-data'>
{{ csrf_field() }}
<input type="file" name="report">
<button>Сохранить</button>
<br>
</form>
<br><br>
@if($file != false)
<h3>Очистить файл</h3>
<form action="{{ route('admin.clearReport', ['id' => $id]) }}" method="POST" enctype='multipart/form-data'>
{{ csrf_field() }}
<button>Очистить</button>
<br>
</form>
<br><br>
@endif
@if($file != false)
<h3>Скачать файл</h3>
<a href="/storage/{{ $id }}.docx">Скачать</a>
@endif
</div>

@endsection

@section('head')
<style>
</style>
@stop

@section('footer')
<!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

<script type="text/javascript">
const orders = @json($orders);
const app = new Vue({
  el: '#change-report-app',
  data: {
    orders: orders
  },

  computed: {
    total() {
      let totalPrice = 0;
      orders.forEach((order) => {
        totalPrice += order.amount;
      });

      return totalPrice;
    },

    totalShop() {
      let totalPrice = 0;
      orders.forEach((order) => {
        totalPrice += order.amountShop;
      });

      return totalPrice.toFixed(2);
    },

    totalShop() {
      let totalPrice = 0;
      orders.forEach((order) => {
        totalPrice += order.amountShop;
      });

      return totalPrice.toFixed(2);
    },

    totalReport() {
      let totalPrice = 0;
      orders.forEach((order) => {
        totalPrice += Number(order.report_price);
      });

      return totalPrice.toFixed(2);
    },

    totalCommission() {
      let totalPrice = 0;
      orders.forEach((order) => {
        totalPrice += order.payment != 'cash' ? (order.amount - order.amountShop) : ((-1)*order.amountShop);
      });

      return totalPrice.toFixed(2);
    }
  }
})
</script> -->
@stop