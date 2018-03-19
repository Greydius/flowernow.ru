@extends('layouts.admin')

@section('content')

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    Финансы
                </h3>
            </div>
            <div>
                <span class="m-subheader__daterange" id="m_dashboard_daterangepicker">
                    <span class="m-subheader__daterange-label">
                        <span class="m-subheader__daterange-title">Сегодня:</span>
                        <span class="m-subheader__daterange-date m--font-brand">{{ date('d.m.Y') }}</span>
                    </span>
                </span>
            </div>
        </div>
    </div>

    <div class="m-content">

        <!--Begin::Main Portlet-->
        <div class="m-portlet">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-xl-6">
                        <!--begin:: Widgets/Stats2-1 -->
                        <div class="m-widget1">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            Баланс
                                        </h3>
                                        <span class="m-widget1__desc">
                                            Общиий баланс
                                        </span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand">
                                            {{ number_format($user->getShop()->balance, 2) }} руб.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title">
                                            Доступно
                                        </h3>
                                        <span class="m-widget1__desc">
                                            Сумма, которую можно вывести
                                        </span>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-success">
                                            {{ number_format($outputAvailable, 2) }} руб.
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @if($outputAvailable)

                                <div class="m-widget1__item">
                                    <div class="row m-row--no-padding align-items-center">

                                        <button class="btn btn-outline-info"  data-toggle="modal" data-target="#request_modal" id="request_modal_btn"> <i class="fa fa-money m-r-5"></i> <span>Вывести</span></button>

                                    </div>
                                </div>

                            @endif
                        </div>
                        <!--end:: Widgets/Stats2-1 -->
                    </div>

                    <div class="col-xl-6 m-portlet m-portlet--full-height">

                        <div class="m-widget6 m-portlet__body">
                            <h3 style="    font-size: 1.2rem;   font-weight: 500;   margin-bottom: 10px;">
                                История запросов
                            </h3>
                            <div class="m-widget6__head">
                                <div class="m-widget6__item">
                                    <span class="m-widget6__caption">
                                        Дата
                                    </span>
                                    <span class="m-widget6__caption">
                                        Сумма
                                    </span>
                                    <span class="m-widget6__caption m--align-right">
                                        Статус
                                    </span>
                                </div>
                            </div>
                            <div class="m-widget6__body">
                                <div class="m-widget6__item">
                                    @foreach($invoices as $invoice)
                                        <span class="m-widget6__text">
                                            {{ $invoice->created_at }}
                                        </span>
                                        <span class="m-widget6__text">
                                            {{ $invoice->amount }}
                                        </span>
                                        <span class="m-widget6__text m--align-right m--font-boldest m--font-brand">
                                            @if($invoice->status)
                                                <span class="m-badge m-badge--success m-badge--wide">
                                                    Выполнен
                                                </span>
                                            @else
                                                <span class="m-badge m-badge--warning m-badge--wide">
                                                    Новый
                                                </span>
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End::Main Portlet-->

    </div>

    @if($outputAvailable)

        <!--begin::Modal-->
        <div class="modal fade" id="request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Создать запрос на вывод
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="m-form " method="post" action="{{ route('admin.finance.request') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="amount" class="form-control-label">
                                    Сумма:
                                </label>
                                <input type="text" class="form-control" id="amount" name="amount" required>
                                <span class="m-form__help">
                                    Максимальная сумма {{ number_format($outputAvailable, 2) }} руб.
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Закрыть
                        </button>
                        <button type="button" class="btn btn-primary" id="create_request">
                            Создать запрос
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Modal-->

    @endif

@endsection

@section('footer')
    <script src="{{ asset('assets/admin/js/finance.js') }}" type="text/javascript"></script>
@stop