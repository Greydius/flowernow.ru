@extends('layouts.site')

@php
  $spells = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Э', 'Ю', 'Я'];
  $host = $_SERVER['HTTP_HOST'];
    preg_match("/[^\.\/]+\.[^\.\/]+$/", $host, $matches);
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

    <div class="row">
        <div class="col-md-12">
            <!-- <h5><strong>Мы работаем в следующих городах:</strong></h5> -->
            <hr>
            <div class="row">
                @foreach($cities as $city)
                    <div class="col-md-3">
                        <div class="city-popular">
                            <p><a href="https://{{ $city->slug}}.{{ $matches[0] }}">{{ $city->name}}</a></p>
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

@section('head')
<style>
.spells-wrapper {
  /* margin-bottom: 60px; */
}
</style>
@endsection