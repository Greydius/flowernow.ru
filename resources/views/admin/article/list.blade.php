@extends('layouts.admin')

@section('content')

<div>


    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Статьи
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
                            <th>Транскрипция</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->name }}</td>
                                <td>{{ $article->slug }}</td>
                                <td>
                                    <a href="{{ route('admin.article.edit', ['id' => $article->id]) }}" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only">
                                        <i class="fa fa-pencil"></i>
                                    </a>

                                    <a href="{{ route('admin.article.destroy', ['id' => $article->id]) }}" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only">
                                        <i class="fa fa-remove"></i>
                                    </a>

                                    <a href="{{ route('article.show', ['slug' => $article->slug]) }}" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only" target="_blank">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <a href="{{ route('admin.article.create') }}" class="btn btn-primary">
                    Добавить
                </a>
            </div>




        </div>
    </div>

</div>






@endsection

@section('footer')
@stop