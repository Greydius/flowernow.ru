@extends('layouts.site')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
            {!! $article->article !!}
            <br class="hidden-lg hidden-md hidden-sm">
        </div>

    </div>

</div>
@endsection