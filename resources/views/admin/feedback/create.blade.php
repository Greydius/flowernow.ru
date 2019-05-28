@extends('layouts.admin')

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Отзыв
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form ng-show="!code" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ empty($feedback) ? route('admin.feedback.store') : route('admin.feedback.update', ['id' => $feedback->id]) }}">
                    {{ csrf_field() }}
                    <div class="m-portlet__body">



                        <div class="form-group m-form__group">
                            <label class="m-checkbox">
                                <input type="checkbox" value="1" name="approved" {{ !empty($feedback) && $feedback->approved ? "checked" : "" }}>
                                Одобрен
                                <span></span>
                            </label>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="shop_id">
                                            Магазин
                                    </label>
                                    <select class="form-control" name="shop_id" id="shop_id">
                                        @foreach($shops as $shop)
                                            <option value="{{ $shop->id }}" {{ !empty($feedback) && $feedback->shop_id == $shop->id ? 'selected' : '' }}>{{ $shop->name . '(' .$shop->id. ')'. ' - '. $shop->city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group m-form__group">
                                    <label for="product_id">
                                            Товар
                                    </label>
                                    <select class="form-control" name="product_id" id="product_id">

                                    </select>
                                    @if(!empty($feedback))
                                        <input type="hidden" id="old_product_id" value="{{ $feedback->product_id }}">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="m-form__group form-group">
                            <label for="">
                                Оценка
                            </label>
                            <div class="m-radio-inline">
                                <label class="m-radio">
                                    <input type="radio" name="rating" value="1" {{ !empty($feedback) && $feedback->rating == 1 ? 'checked' : '' }}>
                                    1
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="rating" value="2" {{ !empty($feedback) && $feedback->rating == 2 ? 'checked' : '' }}>
                                    2
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="rating" value="3" {{ !empty($feedback) && $feedback->rating == 3 ? 'checked' : '' }}>
                                    3
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="rating" value="4" {{ !empty($feedback) && $feedback->rating == 4 ? 'checked' : '' }}>
                                    4
                                    <span></span>
                                </label>
                                <label class="m-radio">
                                    <input type="radio" name="rating" value="5" {{ empty($feedback) || $feedback->rating == 5 ? 'checked' : '' }}>
                                    5
                                    <span></span>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group m-form__group">
                                    <label for="name">
                                        Имя
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control" required value="{{ !empty($feedback) ? $feedback->name : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group m-form__group">
                                    <label for="feedback_date">
                                        Дата
                                    </label>
                                    <input type="text" name="feedback_date" id="feedback_date" class="form-control" required value="{{ !empty($feedback) ? $feedback->feedback_date : Carbon::now()->format('Y-m-d') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-form__group">
                            <label for="feedback-text">
                                Отзыв
                            </label>
                            <textarea class="form-control m-input" id="feedback-text" name="feedback_text" rows="3" required>{{ !empty($feedback) ? $feedback->feedback : '' }}</textarea>
                        </div>

                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">
                                {{ !empty($feedback) ? 'Изменить' : 'Создать' }}
                            </button>
                        </div>
                    </div>
                </form>
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
    <script src="{{ asset('assets/admin/js/feedback.js?v=1') }}" type="text/javascript"></script>
@stop