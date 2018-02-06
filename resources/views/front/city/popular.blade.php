@extends('layouts.site')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h5><strong>Мы работаем в следующих городах:</strong></h5>
            <hr>
            <div class="row">
                @foreach($cities as $city)
                    <div class="col-md-3">
                        <div class="city-popular">
                            <p><a href="http://{{ $city->slug}}.floristum.ru">{{ $city->name}}</a></p>
                            <p class="text-muted"></p>
                        </div>
                    </div>
                @endforeach

            </div>
            <br class="hidden-lg hidden-md hidden-sm">
        </div>

    </div>

</div>
@endsection