@extends('layouts.site')

@section('content')

    <div class="container">
        <div class="logo-container-wraper hidden-lg hidden-md hidden-xs" style="position: relative; display: none">
            <a class="logo-container" href="/"></a>
            @if(!empty($holiday_icon))
                <img loading="lazy" src="{{ asset('assets/front/images/holiday_icons/'.$holiday_icon[0].'.png') }}" class="holiday-img">
            @endif
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-4">
                <h1 class="h2 sm-h2">Доставка цветов<br>в {{ $current_city->name_prepositional }}</h1>
                <span id="filtr" name="filtr"></span>
                <a class="planshet-logo" href="/"><img loading="lazy" src="{{ asset('assets/front/img/logo_floristum_160x34.png') }}"></a>
            </div>
            <div class="col-md-8 hidden-xs hidden-sm">
                @include('front.product-types')

            </div>
        </div>
        <br>
    </div>


    @if(count($popularProducts))

        <div class="container" ng-controller="mainPage">

            @if(!empty($user) && ($user->isSupervisor($current_city->id) || $user->admin))
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

            @if(empty($popularProducts))
                <div class="row hidden-xs hidden-sm">
                    <div class="col-md-5">
                        <h2 class="margin-top-null">{{ !empty($currentType) ? $currentType->alt_name : null }}</h2>
                    </div>
                    <div class="col-md-7">
                       
                    </div>
                </div>

                <br class="hidden-xs hidden-sm">

            @endif

            <div class="row" id="products-container">


                <div class="col-md-12" style="background-color: #fff; padding-top: 10px;"  >
                    <div class="free_phone hidden-xs">
                      <b>8 800 600-54-97</b>
                       <!-- <span>Или напишите на <b>service@floristum.ru</b> <br>--><br><br></span>
                    </div>

                    @if(!empty($popularProducts))

                        @foreach($popularProducts as $item)
                            @if($item->id == 2 && count($item->product) >= 3)
                                <div data-ng-hide="isFiltered">
                                    <div class="hidden-lg hidden-md hidden-xs">
                                        <br><br>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h2 class="margin-top-null">{{ mb_strpos($item->alt_name, '{city}') === false ? $item->alt_name.' с доставкой в '.$current_city->name_prepositional : str_replace('{city}', $current_city->name, $item->alt_name) }}</h2>
                                        </div>
                                    </div>
                                    <br class="hidden-lg hidden-md">

                                    <div class="row">
                                        @foreach($item->product as $key => $_item)
                                            @if($key < 3 || count($item->product) == 8)

                                                @include('front.product.list-item', ['col' => 3])

                                            @endif
                                        @endforeach

                                        <br clear="all">
                                            <div class="col-md-6 col-md-offset-3 bottom30">
                                                <a href="/catalog/{{ $item->slug }}/vse-cvety" class="btn btn-block btn-more">Показать все</a>
                                            </div>
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    @endif

                        @include('front.product.search', ['col' => 3])

                        @if(!empty($popularProducts))
                            @foreach($popularProducts as $item)
                                @if($item->id != 2)
                                    <div data-ng-hide="isFiltered">
                                        <div class="hidden-lg hidden-md hidden-xs">
                                            <br><br>
                                        </div>
                                        <h2 class="margin-top-null">{{ $item->alt_name }}</h2>
                                        <br class="hidden-lg hidden-md">

                                        <div class="row">
                                            @foreach($item->product as $key => $_item)
                                                    @include('front.product.list-item', ['col' => 3])
                                            @endforeach

                                            <br clear="all">
                                                <div class="col-md-6 col-md-offset-3 bottom30">
                                                    <a href="/catalog/{{ $item->slug }}/vse-cvety" class="btn btn-block btn-more">Показать все {{ mb_strtolower($item->alt_name) }}</a>
                                                </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                </div>


            </div>




        </div>



    @else

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="md-mt-30 md-mb-50 text-left"><strong>В ближайшее время сервис доставки букетов Флористум (floristum.ru) заработает и в {{ $current_city->name_prepositional }}.</strong></h4>

                    <h2 class="text-left"><strong>Вы представитель магазина?</strong></h2>

                    <h4 class="md-mb-40">Если Вы — представитель магазина цветов, а {{ $current_city->name }} — территория работы Вашей службы доставки, то <a href="{{ route('register') }}">регистрируйтесь</a> прямо сейчас и получайте заказы уже завтра!</h4>
                </div>
            </div>
        </div>

    @endif


   

    <br class="hidden-xs hidden-sm">





    <div class="container">
        <br><br>
     <img loading="lazy" src="{{ asset('images/dostavka_tsvetov_v_ofis1.png') }}" alt="Доставка цветов и букетов" align="left"
             vspace="20" hspace="25"><h3 class="text-left">Доставка букетов цветов в {{ $current_city->name_prepositional }} с Floristum.ru</h3>

        <p><b>Флористум — сервис заказа доставки цветов в {{ $current_city->name_prepositional }} и по всей России</b>.  </br> </br>  На Флористум.ру вы можете заказать букеты c доставкой в офис или на дом в {{ $current_city->name_prepositional }} от федеральной сети цветочных магазинов с оптимальным соотношением цена — качество. 
Помните, что дешево не всегда сочетается с красотой и свежестью. Но наши цены букеты цветов, которые вам доставят, вас порадуют.
Сравните предложения с аналогичными композициями флористов и магазинов, представленных на Флористум в {{ $current_city->name_prepositional }} или другом городе, по Вашему выбору. 
</br></br>
Заказав букет с доставкой в {{ $current_city->name_prepositional }} на дом или в офис — Вы, или человек, которому хотите сделать сюрприз, гарантировано получите свежую и профессионально оформленную цветочную композицию по указанному адресу и в указанный промежуток времени. 
</br></br>
Курьер вручит букет с улыбкой, озвучит поздравление, если Вы пожелаете, имя отправителя, а также сделает фото момента вручения, с позволения получателя, конечно. Услуга доставки цветов доступна круглосуточно и в любом городе страны! 
</br></br>
Управляющие директора наших цветочных магазинов и опытные сотрудники-флористы заинтересованы, чтобы Вы, как покупатель и Ваш адресат были довольны, оставили положительный отзыв и высоко оценили выполненную работу на страницах сайта системы. Оценки клиентов влияют на рейтинг магазинов и отдельных флористов, что определяет частоту заказов цветов у флористов. </br></br>
Каждый заказ цветов в {{ $current_city->name_prepositional }} защищен системой качества Флористум с гарантией мгновенного возврата оплаченной суммы покупателю в форс-мажорных случаях. Мы внимательно следим за работой магазинов, поэтому при возникновении спорной ситуации, просто напишите в нашу службу по адресу, указанному на сайте.</p>
        <p> При оплате на сайте по банковской карте средства не списываются с Вашего счета, а замораживаются на балансе, это позволяет нам гарантированно оперативно возвращать всю или часть суммы заказа без комиссий и временных потерь в случае непредвиденных обстоятельств при выполнении взятых на себя обязательств даже 14 февраля и 8 марта. Вы можете обратиться с претензией в течении 3-х суток.</p>
           <p> <br><br> <img loading="lazy" src="{{ asset('images/dostavka_tsvetov_po_beznalu1.png') }}" alt="Доставка цветов по безналу" align="right"  vspace="15" hspace="25"> <h3>Мы работаем и с юридическими лицами по безналичному расчету</h3>


        <p>Букеты с оплатой по безналу юридическим лицам, для сотрудников организаций, их клиентов с доставкой в офисы и на дом — одно из главных направлений нашей работы. Заказать авторский букет с доставкой в Москве можно у нас прямо сейчас, а оплатить с расчетного счета юр лица! 
<br><br>
Мы предоставляем полный пакет закрывающих документов на товар, приобретенный у нас. Подробнее читайте в разделе <a href="{{ route('front.corporate') }}">доставка букетов цветов по безналу</a> в  {{ $current_city->name_prepositional }}
</p>



        <br><br>	

    </div>	
    @if(Route::currentRouteName() != 'favorites.show')	
      <a href="{{ route('favorites.show') }}" class="favorites-heart"></a>	
    @endif	

@endsection	

@section('head')	
    <link rel="stylesheet" href="{{ asset('assets/plugins/OwlCarousel2-2.3.4/assets/owl.carousel.min.css') }}" />	
    <link rel="stylesheet" href="{{ asset('assets/plugins/OwlCarousel2-2.3.4/assets/owl.theme.default.min.css') }}" />	
    <link rel="stylesheet" href="{{ asset('assets/front/js/typeahead.js/typeaheadjs.css') }}" />	
@stop	

@section('footer')	

    <script src="{{ asset('assets/plugins/OwlCarousel2-2.3.4/owl.carousel.min.js') }}"></script>	
    <script src="{{ asset('assets/front/js/typeahead.js/bloodhound.min.js') }}"></script>	
    <script src="{{ asset('assets/front/js/typeahead.js/typeahead.jquery.js') }}"></script>	
    <script src="{{ asset('assets/front/js/index.js?v=2_3') }}"></script>	

    <script type="text/javascript">	
            routes.products = '{!! route('api.products.popular') !!}';	
            $('.owl-carousel').owlCarousel({	
                    nav:true,	
            })	
    </script>	
@stop