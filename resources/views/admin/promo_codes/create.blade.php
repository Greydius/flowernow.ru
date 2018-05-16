@extends('layouts.admin')

@section('content')

<div ng-controller="promo-create">
    <div class="row">
        <div class="col-md-6">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Промо код
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form ng-show="!code" class="m-form m-form--fit m-form--label-align-right" ng-submit="create($event)" method="post" action="{{ route('admin.promoCodes.store') }}">
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <select class="form-control" name="code_type" id="promo-code-type" ng-model="promo.code_type" ng-init="promo.code_type='percent'">
                                <option value="percent" selected>
                                    %
                                </option>
                                <option value="sum">
                                    Сумма
                                </option>
                            </select>
                        </div>
                        <div class="form-group m-form__group">
                            <label for="promo-value">
                                Скидка
                            </label>
                            <input type="text" name="value" id="promo-value" class="form-control" ng-model="promo.value" required>
                        </div>
                        <div class="form-group m-form__group">
                            <label class="m-checkbox">
                                <input type="checkbox" ng-model="promo.reusable">
                                Постоянный
                                <span></span>
                            </label>
                        </div>
                        <div class="form-group m-form__group">
                            <label class="m-checkbox">
                                <input type="checkbox" ng-model="promo.send">
                                Отправить на телефон
                                <span></span>
                            </label>
                        </div>

                        <div ng-show="promo.send" ng-cloak="">
                            <div class="form-group m-form__group">
                                <label for="sms-phone">
                                    Телефон
                                </label>
                                <input type="text" class="form-control phone" id="sms-phone" ng-model="promo.phone">
                            </div>
                            <div class="form-group m-form__group">
                                <label for="sms-message">
                                    Сообщение
                                </label>
                                <textarea class="form-control m-input" id="sms-message" rows="3" ng-model="promo.msg" ng-init="promo.msg='[promo]'"></textarea>
                                <span class="m-form__help">Для динамической вставки кода - введите [promo]</span>
                            </div>
                        </div>

                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">
                                Создать
                            </button>
                        </div>
                    </div>
                </form>
                <div class="m-portlet__body text-center" ng-show="code" ng-cloak="">
                    <h1 class="display-1"><% code %></h1>
                </div>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>

        <div class="col-md-6">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Постоянные промо коды
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->

                    <div class="m-portlet__body">
                        @foreach($promoCodes as $item)
                            <div>
                                {{ $item->code }} - {{ $item->value . ($item->code_type == 'percent' ? '%' : 'руб.')}}
                                <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('admin.promoCodes.delete', ['id' => $item->id]) }}" style="float: right;">
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                    {{ csrf_field() }}
                                </form>
                                <br>
                                <br clear="all">
                            </div>
                        @endforeach
                    </div>

                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>




@endsection

@section('head')
@stop

@section('footer')
    <script src="{{ asset('assets/admin/ng/promo-code-create.js?v=1') }}" type="text/javascript"></script>
    <script type="text/javascript">
    </script>
@stop