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
                <form ng-show="!code" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ empty($article) ? route('admin.article.store') : route('admin.article.update', ['id' => $article->id]) }}">
                    {{ csrf_field() }}
                    <div class="m-portlet__body">

                        <div class="form-group m-form__group">
                            <span class="m-switch m-switch--outline m-switch--success">
                                <label class="col-form-label">
                                    Публикация:
                                </label>
                                <br>
                                <label>
                                    <input type="checkbox" {{ empty($article) || $article->public ? 'checked="checked"' : null }} name="public" value="1">
                                    <span></span>
                                </label>
                            </span>
                        </div>

                        <div class="form-group m-form__group">
                            <label for="name">
                                Название
                            </label>
                            <input type="text" name="name" id="name" class="form-control" required value="{{ !empty($article) ? $article->name : '' }}">
                        </div>

                        <div class="form-group m-form__group">
                            <label for="slug">
                                Транскрипция
                            </label>
                            <input type="text" name="slug" id="slug" class="form-control" required value="{{ !empty($article) ? $article->slug : '' }}">
                        </div>

                        <div class="form-group m-form__group">
                            <label for="article_category_id">
                                Категория
                            </label>
                            <select name="article_category_id" id="article_category_id" class="form-control">
                                <option value="0">---</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ !empty($article) && $article->article_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group m-form__group">
                            <label for="feedback-text">
                                Текст статьи
                            </label>
                            <textarea class="form-control m-input summernote" id="feedback-text" name="article" rows="3" required>{{ !empty($article) ? $article->article : '' }}</textarea>
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