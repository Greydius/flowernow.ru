@extends('layouts.site')

@section('content')

    <div class="container">
        <br>

        <h1 class="h2 margin-top-null m-b-1"><strong>Страница не найдена.</strong></h1>

        <p class="text-center"><img src="{{ asset('assets/front/img/404.png') }}" ></p>

        <div class="row  m-b-4" style="font-size: 18px;">
            <div class="col-md-12">
                <p>Возможно Вы неправильно набрали адрес или страница больше не существует.</p>
                <p>Если Вам нужна помощь в выборе цветов, составлении букета, а также по любым другим вопросам по сервису доставки Floristum.ru— смело обращайтесь в нашу службу поддержки.</p>
            </div>
        </div>

        <br><br><br>


    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop