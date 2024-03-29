@extends('layouts.admin')

@section('content')

<div ng-controller="ordersList" id="ordersListContainer">


    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Отзывы
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">

            <div class="table-responsive" ng-cloak>
                <table class="table table-bordered table-hover" style="min-width: 972px;">
                    <thead>
                        <tr>
                            <th>Магазин</th>
                            <th>Товар</th>
                            <th>Дата отзыва</th>
                            <th>Имя</th>
                            <th>Текст</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $city_id = ''; ?>

                        @foreach($feedbacks as $feedback)
                            @if($city_id != $feedback->shop->city_id)
                                <?php $city_id = $feedback->shop->city_id; ?>
                                <tr><td colspan="6" style="text-align: center; font-weight: bold">{{ $feedback->shop->city->name }}</td></tr>
                            @endif
                            <tr>
                                <td>{{ $feedback->shop->name }}</td>
                                <td>{!!  !empty($feedback->order) && !empty($feedback->order->orderLists[0]->product) ? '<img src="'. $feedback->order->orderLists[0]->product->photoUrl .'" width="50px" alt=""><br><a href="/flowers/'.$feedback->order->orderLists[0]->product->slug.'" target="_blank">'.$feedback->order->orderLists[0]->product->name.'</a>' : '' !!}</td>
                                <td>{{ Carbon::parse($feedback->feedback_date)->format('Y-m-d') }}</td>
                                <td>{{ $feedback->name }}</td>
                                <td>{!! nl2br($feedback->feedback) !!}</td>
                                <td>
                                    <a href="{{ route('admin.feedback.edit', ['id' => $feedback->id]) }}" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <a href="{{ route('admin.feedback.destroy', ['id' => $feedback->id]) }}" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only">
                                        <i class="fa fa-remove"></i>
                                    </a>

                                    @if($feedback->approved == 1)
                                        <a href="{{ route('admin.feedback.unapprove', ['id' => $feedback->id]) }}" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only" title="Блокировать">
                                            <i class="fa fa-power-off"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('admin.feedback.approve', ['id' => $feedback->id]) }}" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only" title="Подтвердить">
                                            <i class="fa fa-check"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <a href="{{ route('admin.feedback.create') }}" class="btn btn-primary">
                    Добавить
                </a>
            </div>




        </div>
    </div>

</div>






@endsection

@section('head')
    <style>
        table {     table-layout: fixed;     width:100% } td {     word-wrap:break-word; }
    </style>
@stop

@section('footer')
@stop