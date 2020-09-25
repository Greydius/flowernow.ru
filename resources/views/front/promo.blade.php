@extends('layouts.site')

@php
  $spells = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Э', 'Ю', 'Я'];
@endphp

@section('content')

<div class="container">
  <div class="spells">
    <h2>Города: </h2>
    <div class="spells-wrapper">
      @foreach($spells as $spell)
        @if(request()->spell !== $spell)
          <a href="?spell={{$spell}}">{{ $spell }}</a>
        @else
          <span>{{ $spell }}</span>
        @endif
      @endforeach
    </div>
    
  </div>
  <table style="width:100%">
    <tr>
      <th>Название</th>
      <th>Товаров сегодня</th>
      <th>Товаров сейчас</th>
      <th>Логин</th>
      <th>Активен</th>
    </tr>
    @foreach($shops as $shop)
    <tr>
      <td>{{ $shop->name }}</td>
      <td>{{ $shop->city->todayCountProducts->count }}</td>
      <td>{{ $shop->city->total_products }}</td>
      <td>{{ $shop->users[0]->phone }}</td>
      <td><input class="shop-active" type="checkbox" id="{{ $shop->id }}" name="{{ $shop->id }}" {{ $shop->active == 1 ? 'checked' : '' }} value="1" /><label for="{{ $shop->id }}">Toggle</label></td>
    </tr>
    @endforeach
  </table>
</div>

@endsection

@section('head')
<style>
input[type=checkbox]{
	height: 0;
	width: 0;
	visibility: hidden;
}

label {
	cursor: pointer;
	text-indent: -9999px;
	width: 50px;
	height: 25px;
	background: grey;
	display: block;
	border-radius: 25px;
	position: relative;
}

label:after {
	content: '';
	position: absolute;
	top: 1.25px;
	left: 1.25px;
	width: 22.5px;
	height: 22.5px;
	background: #fff;
	border-radius: 22.5px;
	transition: 0.3s;
}

input:checked + label {
	background: #bada55;
}

input:checked + label:after {
	left: calc(100% - 1.25px);
	transform: translateX(-100%);
}

label:active:after {
	width: 32.5px;
}

.spells-wrapper {
  margin-bottom: 60px;
}
</style>
@stop

@section('footer')
<script>
$('.shop-active').change(function(){
  var id = $(this).attr('name');
  $.ajax({
    method: 'POST',
    url: "/api/tests/updateShop/" + id
  }).done(function() {
    console.log('success');
  });
})

</script>
@stop