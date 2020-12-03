@extends('layouts.site')

@section('content')

    <div class="container">
        <br><br><br><br><br><br><br><br><br><br><br>
        <h1 class="h2 text-center">Спасибо за покупку.</h1>
        <p class="text-center text-muted">На Ваш телефон {{ !empty($order->email) ? 'и email' : ''}} отправлены сообщения со ссылками для отслеживания выполнения доставки и контактами. Если у флориста или курьера возникнут вопросы — с Вами обязательно свяжутся</p>
        <br><br><br><br><br><br><br><br><br><br><br>
    </div>

@endsection

@section('footer')

    <script type="text/javascript">
        /*
        setTimeout(function () {
                window.location = '/';
        }, 3000);
        */
    </script>
@stop