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
                                Системные настройки
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form ng-show="!code" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('admin.setting.store') }}">
                    {{ csrf_field() }}
                    <div class="m-portlet__body">

                        @foreach($settings as $setting)
                            <div class="m-form__group form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group m-form__group">
                                            <label for="{{ $setting->key }}">
                                                {{ $setting->name }}
                                            </label>
                                            <input type="text" class="form-control" name="setting[{{ $setting->key }}]" id="{{ $setting->key }}" value="{{ $setting->value }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">
                                Сохранить
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
@stop