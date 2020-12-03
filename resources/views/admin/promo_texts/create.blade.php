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
                                    Стастья
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form ng-show="!code" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ empty($article) ? route('admin.promo_text.store') : route('admin.promo_text.update', ['id' => $article->id]) }}">
                        {{ csrf_field() }}
                        <div class="m-portlet__body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="flower_id">
                                            Цветок
                                        </label>
                                        <select class="form-control" id="flower_id" name="flower_id">
                                            @foreach($flowers as $flower)
                                                <option value="{{ $flower->id }}" {{ !empty($article) && $article->flower_id == $flower->id ? 'selected' : '' }}>{{ $flower->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group m-form__group">
                                        <label for="type">
                                            Тип
                                        </label>
                                        <select class="form-control" id="type" name="type">
                                            <option value="info" {{ !empty($article) && $article->type == 'info' ? 'selected' : '' }}>Инфо</option>
                                            <option value="info2" {{ !empty($article) && $article->type == 'info2' ? 'selected' : '' }}>Подбор</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group m-form__group">
                                <label for="feedback-text">
                                    Текст
                                </label>
                                <textarea class="form-control m-input summernote" id="feedback-text" name="text" rows="3" required>{{ !empty($article) ? $article->text : '' }}</textarea>
                            </div>

                        </div>
                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions">
                                <button type="submit" class="btn btn-primary">
                                    {{ !empty($article) ? 'Изменить' : 'Создать' }}
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
    <script src="{{ asset('assets/admin/demo/default/custom/components/forms/widgets/summernote.js') }}" type="text/javascript"></script>
@stop