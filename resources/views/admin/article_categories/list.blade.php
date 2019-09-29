@extends('layouts.admin')

@section('content')

    <div>


        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Категории Статьи
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">

                <div class="table-responsive" ng-cloak>
                    <table class="table table-bordered table-hover" style="min-width: 972px;">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($articleCategories as $articleCategory)
                            <tr>
                                <td>{{ $articleCategory->name }}</td>
                                <td>
                                    <a href="{{ route('admin.article-category.edit', ['id' => $articleCategory->id]) }}" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <a href="{{ route('admin.article-category.destroy', ['id' => $articleCategory->id]) }}" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only">
                                        <i class="fa fa-remove"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('admin.article-category.create') }}" class="btn btn-primary">
                        Добавить
                    </a>
                </div>




            </div>
        </div>

    </div>






@endsection

@section('footer')
@stop