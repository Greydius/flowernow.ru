@extends('layouts.admin')

@section('content')

    <div class="m-portlet m-portlet--mobile" ng-controller="shopsList">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title" style="width: 100%">
                    <h3 class="m-portlet__head-text">
                        Преимущественное размещение товаров ({!! !empty($banner) && $banner->checked_on ? '<span class="text-success text-right">Активировано</span>' : '<span class="text-danger text-right">Не активировано</span>' !!})
                    </h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <h4>Ваши букеты могут показываться на Floristum.ru выше конкурентов!</h4>
            <p><strong>Что нужно, чтобы получить преимущество?</strong></p>
            <p>Нужно просто разместить кнопку (кнопка ссылается на витрину Вашего магазина) на страницах Вашего сайта и ввести адрес страницы на которой размещен код кнопки. После этого, товары Вашего магазина будут выдаваться выше букетов других магазинов.</p>

            <p>1. Разместить кнопку (кнопка ссылается на витрину Вашего магазина)</p>
            <table class="table table-bordered">
                <tr>
                    <th>Вид кнопки</th>
                    <th>Код для размещения на странице Вашего сайта</th>
                </tr>
                <tr>
                    <td>
                        {!! $bannerCode !!}
                    </td>
                    <td><xmp>{!! $bannerCode !!}</xmp></td>
                </tr>
            </table>

            <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('shops.partnership.add') }}">
                {{ csrf_field() }}


                <p>2. Введите адрес страницы на которой размещен код кнопки</p>

                <p>
                    <input type="text" class="form-control" value="{{ !empty($banner) ? $banner->url : '' }}" name="url">
                </p>

                @if(!empty($banner))
                    <p>
                        Дата последней провекри: {{$banner->checked_on ? $banner->checked_on.' (Кнопка найдена, преимущество активировано)' : 'Не проверялась'}}
                    </p>
                @endif

                <p>
                    <input type="submit" value="Сохранить" class="btn btn-success">
                </p>
            </form>
        </div>

    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop