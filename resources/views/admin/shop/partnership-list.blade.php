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
            <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('shops.partnership.add') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="" name="shop_id" placeholder="ID магазина">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="" name="url" placeholder="URL">
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="Сохранить" class="btn btn-success">
                    </div>
                </div>
                <br>
                <br>
            </form>

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