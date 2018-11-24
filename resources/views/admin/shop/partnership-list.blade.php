@extends('layouts.admin')

@section('content')

    <div class="m-portlet m-portlet--mobile" ng-controller="shopsList">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Партнерская программа
                    </h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <table class="table table-bordered">
                    <tr>
                        <th>Магазин</th>
                        <th>URL</th>
                        <th>Дата последней проверки</th>
                    </tr>
                @foreach($banners as $banner)
                    <tr class="{{ $banner->checked_on ? "bg-success" : "bg-danger"}}">
                        <td>
                            <a href="{{ route('shop.products', ['id' => $banner->shop->id]) }}">
                                {{ $banner->shop->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ $banner->url }}">
                                {{ $banner->url }}
                            </a>
                        </td>
                        <td>
                            {{ $banner->checked_on }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop