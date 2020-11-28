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
                                    Партнер в городе {{ $city->name }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('admin.agent.update', ['city_id' => $city->id]) }}">
                        {{ csrf_field() }}
                        <div class="m-portlet__body">

                            <div class="form-group m-form__group">
                                <label for="shop_id">
                                    Магазин
                                </label>
                                <select name="shop_id" id="shop_id" class="form-control m-input">
                                    <option value=""></option>
                                    @foreach($shops as $shop)
                                        <option value="{{ $shop->id }}" {{ !empty($agent) && $agent->shop_id == $shop->id ? 'selected' : ''}}>{{ $shop->name }} (id: {{ $shop->id }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="webmaster">
                                    Webmaster
                                </label>
                                <textarea class="form-control m-input summernote" id="webmaster" name="webmaster" rows="6">{{ !empty($agent) && $agent->webmaster ? $agent->webmaster : ''}}</textarea>
                            </div>

                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="submit" class="btn btn-primary">
                                    Изменить
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
