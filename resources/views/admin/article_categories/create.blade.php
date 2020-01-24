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
                                    Категория Стастей
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form ng-show="!code" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ empty($articleCategory) ? route('admin.article-category.store') : route('admin.article-category.update', ['id' => $articleCategory->id]) }}">
                        {{ csrf_field() }}
                        <div class="m-portlet__body">

                            <div class="form-group m-form__group">
                                <label for="name">
                                    Название
                                </label>
                                <input type="text" name="name" id="name" class="form-control" required value="{{ !empty($articleCategory) ? $articleCategory->name : '' }}">
                            </div>

                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="submit" class="btn btn-primary">
                                    {{ !empty($articleCategory) ? 'Изменить' : 'Создать' }}
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