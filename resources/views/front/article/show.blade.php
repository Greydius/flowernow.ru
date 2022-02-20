@extends('layouts.site')

@section('pageTitle', $pageTitle)

@section('content')

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="h3">{{ $article->category->name }}</h1></br>

 <h2 class="h2 sm-h2">{{ $article->name }}</h2></br></br>
            {!! $article->article !!}
            <br class="hidden-lg hidden-md hidden-sm">

            @if(!empty($nextArticle))
                <br class="hidden-lg hidden-md hidden-sm">
             <b>К следующей странице -></b>  <a href="{{ route('article.show', ['slug' => $nextArticle->slug]) }}">{{ $nextArticle->name }}</a>
               <br> <br><b> Выбор страницы:</b> <br>
            @endif

            @if(!empty($articles))

                <ul class="pagination">

                    @foreach($articles as $key => $_article)
                        <li class="{{ $_article->id == $article->id ? 'active' : '' }}">
                            @if($_article->id == $article->id)
                                <li class="active"><span>{{ $key+1 }}</span></li>
                            @else
                                <a href="{{ route('article.show', ['slug' => $_article->slug]) }}">{{ $key+1 }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

    </div>
 <br> <br> <br> <br>
    @if(!empty($popularProducts))
        <div class="row">
            @foreach($popularProducts as $_item)
                    @include('front.product.list-item', ['col' => 3])
            @endforeach
        </div>
    @endif


    <br><br><br>

</div>
@endsection