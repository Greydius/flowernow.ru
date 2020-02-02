@extends('layouts.site')

@section('content')
  <div class="container" ng-controller="mainPage" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="row" id="products-container">
      <div class="col-md-12" style="background-color: #fff; padding-top: 10px;"  >
        <div class="free_phone hidden-xs">
          <b>8 800 600-54-97</b>
            <span>Звонок бесплатный</b> <br><br><br></span>
        </div>
          <div data-ng-hide="isFiltered">
            <div class="hidden-lg hidden-md hidden-xs">
              <br><br>
            </div>
            <h1 class="favorites-title margin-top-null" style="margin-bottom: 30px;">Избранные букеты:</h1>
            <br class="hidden-lg hidden-md">
            <div class="row" style="padding: 60px; padding-top: 0;">
              @if(!empty($products))
                @foreach($products as $key => $_item)
                  @include('front.product.list-item', ['col' => 3])
                @endforeach
              @else
                <h2>Здесь пусто...</h2>
                <a href="/" style="display: block; font-size: 16px;">Вернуться на главную</a>
              @endif
            </div>
          </div>
      </div>
    </div>
  </div>
  <style>
  .favorites-title {
    margin-bottom: 30px;
  }
  @media all and (max-width: 767px) {
    .favorites-title {
      font-size: 30px;
      padding: 30px 0 0;
      margin-bottom: 0;
    }
  }
  </style>
@endsection