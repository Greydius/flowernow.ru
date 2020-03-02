@extends('layouts.site')

@section('content')

<div class="container">
  <table style="width:100%">
    <tr>
      <th>Название</th>
      <th>Логин</th>
      <th>Пароль</th>
      <th>Активен</th>
    </tr>
    @foreach($users as $user)
    <tr>
      <td>{{ $user->shops[0]->name }}</td>
      <td>{{ $user->phone }}</td>
      <td>{{ $user->shops[0]->city_id }}</td>
      <td><input class="shop-active" type="checkbox" id="{{ $user->shops[0]->id }}" name="{{ $user->shops[0]->id }}" {{ $user->shops[0]->active == 1 ? 'checked' : '' }} value="1" /><label for="{{ $user->shops[0]->id }}">Toggle</label></td>
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