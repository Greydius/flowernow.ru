@extends('layouts.site')

@section('pageImage', (!empty($meta) && !empty($meta['image']) ? $meta['image'] : null))
@section('pageTitle', (!empty($meta) && !empty($meta['title']) ? $meta['title'] : null))
@section('pageDescription', (!empty($meta) && !empty($meta['description']) ? $meta['description'] : null))
@section('pageKeywords', (!empty($meta) && !empty($meta['keywords']) ? $meta['keywords'] : null))

@section('content')

<div class="container" ng-controller="mainPage">

    <br class="hidden-xs- hidden-sm-">

    <div class="row list-products" ng-hide="isFiltered">

        <div class="col-md-5">
            <h1 class="margin-top-null h2 sm-h2">{!!  !empty($title) ? $title : 'Популярные букеты' !!}</h1>
        </div>
        <div class="col-md-7 hidden-xs hidden-sm">
            @include('front.product-types')
        </div>
    </div>

    <br class="hidden-xs hidden-sm">

    <div class="row" id="products-container">



        <div class="col-md-12 main-products-container">

            <div class="free_phone hidden-xs">
                <b>+7 965 092-00-71</b>
                <span>Или напишите на <b>service@floristum.ru</b></span>
            </div>

            @include('front.product.search')

            @if(count($popularProduct))

                @if(count($popularProduct))
                    <div class="row">
                        
                        @foreach($popularProduct as $key => $_item)

                            @include('front.product.list-item', ['col' => 3, 'class' => ($key < count($popularProduct)-3 ? 'pull-right' : ''), 'user' => $user])

                        @endforeach
                    </div>
                    {{ $popularProduct->appends(request()->query())->links() }}
                @endif


                @if(count($popularProduct) <= 30)
                        <h3 class="margin-top-null top30"><strong>Вам также может понравится:</strong></h3>
                        <div class="row">
                            @foreach($randProducts as $_item)

                                @include('front.product.list-item', ['col' => 3])

                            @endforeach
                        </div>

                        {{ $randProducts->withPath('/catalog?order=price')->links() }}
                @endif

            @else

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="md-mt-30 md-mb-50 text-center">К сожалению нет букетов выбранной категории.</h4>

                        @if(count($randProducts))
                            <h3 class="margin-top-null top30"><strong>Вам также может понравится</strong></h3>
                            <div class="row">
                                @foreach($randProducts as $_item)

                                    @include('front.product.list-item', ['col' => 3])

                                @endforeach
                            </div>

                            {{ $randProducts->withPath('/catalog?order=price')->links() }}
                        @endif
                    </div>
                </div>

            @endif

            @if(!empty($promoText))
                <div class="row">
                    <div class="col-md-12">
                        {!! $promoText->text !!}
                    </div>
                </div>
            @endif

        </div>


    </div>


    <br class="hidden-xs hidden-sm">

</div>

    @if(!empty($user) && $user->isSupervisor($current_city->id))
        <script type="text/ng-template" id="edit-item-modal.html">
            <div class="modal fade" id="m_modal_1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Редактирование — <% item.id %>
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>

                                <input type="hidden" name="product_id" ng-model="item.id"  value="<% item.id %>">

                                <div class="form-group m-form__group">
                                    <label for="edit-product-name">
                                        Название <span class="text-danger must-have">*</span>
                                    </label>
                                    <input type="text" class="form-control form-control-sm m-input" id="edit-product-name" ng-model="item.name" placeholder="Название">
                                </div>

                                <div class="form-group m-form__group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="edit-product-price">
                                                Цена - <span class="text-danger must-have">*</span>
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <input type="text" class="form-control form-control-sm m-input" ng-model="item.price" placeholder="Цена, ₽" id="edit-product-price">
                                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="fa fa-rub"></i>
                                                </span>
                                            </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="edit-product-make-time">
                                                Время изготовления <span class="text-danger must-have">*</span>
                                            </label>
                                            <select class="form-control form-control-sm" ng-model="item.make_time" ng-options="time.value as time.name for time in times"></select>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group m-form__group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="edit-product-width">
                                                Ширина, см <span class="text-danger must-have">*</span>
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <input type="text" class="form-control form-control-sm m-input" ng-model="item.width" placeholder="см." id="edit-product-width">
                                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="fa fa-arrows-h"></i>
                                                </span>
                                            </span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="edit-product-height">
                                                Высота, см <span class="text-danger must-have">*</span>
                                            </label>
                                            <div class="m-input-icon m-input-icon--right">
                                                <input type="text" class="form-control form-control-sm m-input" ng-model="item.height" placeholder="см." id="edit-product-height">
                                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="fa fa-arrows-v"></i>
                                                </span>
                                            </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group m-form__group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="edit-product-height">
                                                Тип букета <span class="text-danger must-have">*</span>
                                            </label>
                                            <select class="form-control form-control-sm" ng-model="item.product_type_id" ng-options="productType.id as productType.name for productType in productTypes">
                                                <option value="">Укажите тип</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="edit-product-height">
                                                Цвет
                                            </label>
                                            <select class="form-control form-control-sm" ng-model="item.color_id" ng-options="color.id as color.name for color in colors"></select>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group m-form__group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="edit-product-height">
                                                Описание <span class="text-danger must-have">*</span>
                                            </label>
                                            <textarea class="form-control" ng-model="item.description" rows="6"></textarea>
                                        </div>

                                    </div>

                                </div>

                                <div class="form-group m-form__group">
                                    <div class="row">
                                        <div class="col-md-12 text-danger">
                                            <span class="must-have">*</span> - поля обязательные к заполнению
                                        </div>

                                    </div>

                                </div>


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Закрыть
                            </button>
                            <button type="button" class="btn btn-primary" ng-click="save(item)">
                                Сохранить
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </script>
    @endif


@endsection

@section('head')
<link rel="stylesheet" href="{{ asset('assets/front/js/typeahead.js/typeaheadjs.css') }}">
@stop

@section('footer')
    <script type="text/javascript">


        routes.products = '{!! route('api.products.popular') !!}';
        @if(!empty($user) && $user->isSupervisor($current_city->id))
            jsonData.colors = {!! App\Model\Color::all()->toJson() !!};
            jsonData.prices = {!! App\Model\Price::all()->toJson() !!};
            jsonData.productTypes = {!! App\Model\ProductType::where('show_on_main', '1')->get()->toJson() !!};
            jsonData.times = {!! json_encode(\App\Helpers\Data::times()) !!};
        @endif
    </script>

    <script src="{{ asset('assets/front/js/typeahead.js/bloodhound.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/typeahead.js/typeahead.jquery.js') }}"></script>
    <script src="{{ asset('assets/front/js/index.js?v=3_0') }}"></script>
@stop