@extends('layouts.site')

@section('content')

    <div class="container">
        <div class="logo-container-wraper hidden-lg hidden-md hidden-xs" style="position: relative; display: none">
            <a class="logo-container" href="/"></a>
            @if(!empty($holiday_icon))
                <img src="{{ asset('assets/front/images/holiday_icons/'.$holiday_icon[0].'.png') }}" class="holiday-img">
            @endif
        </div>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-4">
                <h1 class="h2 sm-h2">Доставка цветов<br>в {{ $current_city->name_prepositional }}</h1>
                <span id="filtr" name="filtr"></span>
                <a class="planshet-logo" href="/"><img src="{{ asset('assets/front/img/logo_floristum_160x34.png') }}"></a>
            </div>
            <div class="col-md-8 hidden-xs hidden-sm">
                @include('front.product-types')

            </div>
        </div>
        <br>
    </div>

    @if(count($popularProducts) || count($singleProducts) || count($blocks))

        <div class="container" ng-controller="mainPage">

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
                                                        Цена <span class="text-danger must-have">*</span>
                                                    </label>
                                                    <div class="m-input-icon m-input-icon--right">
                                                        <input type="text" class="form-control form-control-sm m-input" ng-model="item.price" placeholder="Цена, руб." id="edit-product-price">
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
                        <span>Звонок бесплатный</b> <br><br><br></span>
                    </div>

                    @if(!empty($popularProducts) || !empty($blocks))

                        @foreach($blocks as $block)
                            <div data-ng-hide="isFiltered">
                                <div class="hidden-lg hidden-md hidden-xs">
                                    <br><br>
                                </div>
                                <h2 class="margin-top-null">{{ $block->name }}</h2>
                                <p>{{ $block->description }}</p>
                                <br class="hidden-lg hidden-md">

                                <div class="row">
                                    @if(!empty($block->products))
                                        @foreach($block->products as $key => $_item)
                                            @include('front.product.list-item', ['col' => 3])
                                        @endforeach

                                        <br clear="all">
                                        @if(!empty($block->slug))
                                            <div class="col-md-6 col-md-offset-3 bottom30">
                                                <a href="/catalog/{{ $block->slug }}/vse-cvety" class="btn btn-block btn-more">Показать все</a>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        @foreach($popularProducts as $item)
                            @if(!empty($item['productType']) && $item['productType']->id == 2 && $item['popularProductCount'] >= 3)
                                <div data-ng-hide="isFiltered">
                                    <div class="hidden-lg hidden-md hidden-xs">
                                        <br><br>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h2 class="margin-top-null">{{ mb_strpos($item['productType']->alt_name, '{city}') === false ? $item['productType']->alt_name.' с доставкой в '.$current_city->name_prepositional : str_replace('{city}', $current_city->name, $item['productType']->alt_name) }}</h2>
                                        </div>
                                    </div>
                                    <br class="hidden-lg hidden-md">

                                    <div class="row">
                                        @foreach($item['popularProduct'] as $key => $_item)
                                            @if($key < 3 || $item['popularProductCount'] == 8)

                                                @include('front.product.list-item', ['col' => 3])

                                            @endif
                                        @endforeach

                                        <br clear="all">
                                        @if($item['popularProduct']->total() > 8)
                                            <div class="col-md-6 col-md-offset-3 bottom30">
                                                <a href="/catalog/{{ $item['productType']->slug }}/vse-cvety" class="btn btn-block btn-more">Показать все</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                        @endforeach
                    @endif

                        @if(count($singleProducts))
                            <div data-ng-hide="isFiltered">
                                <div class="hidden-lg hidden-md hidden-xs">
                                    <br><br>
                                </div>

                                <h2 class="margin-top-null">Букеты цветов поштучно</h2>
                                <br class="hidden-lg hidden-md">

                                <div class="row">
                                    @foreach($singleProducts as $_item)
                                        @include('front.product.list-item', ['col' => 3])
                                    @endforeach
                                </div>

                                <br clear="all">
                                <div class="col-md-6 col-md-offset-3 bottom30">
                                    <a href="/catalog/single" class="btn btn-block btn-more">Смотреть все букеты поштучно</a>
                                </div>

                                <br clear="all">
                            </div>
                        @endif

                        @if(!empty($lowPriceProducts) && count($lowPriceProducts))
                            <div data-ng-hide="isFiltered">
                                <div class="hidden-lg hidden-md hidden-xs">
                                    <br><br>
                                </div>
                                <h2 class="margin-top-null">Самые низкие цены</h2>
                                <br class="hidden-lg hidden-md">

                                <div class="row">
                                    @foreach($lowPriceProducts as $_item)
                                        @include('front.product.list-item', ['col' => 3])
                                    @endforeach
                                </div>

                                <br clear="all">
                                <div class="col-md-6 col-md-offset-3 bottom30">
                                    <a href="/catalog/?order=price" class="btn btn-block btn-more">Смотреть все букеты с низкими ценами</a>
                                </div>

                                <br clear="all">
                            </div>
                        @endif

                


                        @if(!empty($specialOffers) && !empty($specialOfferProducts))
                            @foreach($specialOffers as $specialOffer)
                                <div data-ng-hide="isFiltered">
                                    <div class="hidden-lg hidden-md hidden-xs">
                                        <br><br>
                                    </div>
                                    <h2 class="margin-top-null specialOffer">{{ $specialOffer->name }}</h2>
                                    <br class="hidden-lg hidden-md">

                                    <div class="row">
                                        @foreach($specialOfferProducts[$specialOffer->id] as $_item)
                                            @include('front.product.list-item', ['col' => 3])
                                        @endforeach
                                    </div>

                                    <br clear="all">
                                    <div class="col-md-6 col-md-offset-3 bottom30">
                                        <a href="/catalog/" class="btn btn-block btn-more">Перейти в каталог букетов</a>
                                    </div>
                                    <br clear="all">
                                </div>
                            @endforeach
                        @endif


                        @include('front.product.search', ['col' => 3])

                        @if(!empty($popularProducts))
                            @foreach($popularProducts as $item)
                                @if(!empty($item['productType']) && $item['productType']->id != 2 && $item['popularProductCount'] >= 3)
                                    <div data-ng-hide="isFiltered">
                                        <div class="hidden-lg hidden-md hidden-xs">
                                            <br><br>
                                        </div>
                                        <h2 class="margin-top-null">{{ $item['productType']->alt_name }}</h2>
                                        <br class="hidden-lg hidden-md">

                                        <div class="row">
                                            @foreach($item['popularProduct'] as $key => $_item)
                                                @if($key < 3 || $item['popularProductCount'] == 8)

                                                    @include('front.product.list-item', ['col' => 3])

                                                @endif
                                            @endforeach

                                            <br clear="all">
                                            @if($item['popularProduct']->total() > 6)
                                                <div class="col-md-6 col-md-offset-3 bottom30">
                                                    <a href="/catalog/{{ $item['productType']->slug }}/vse-cvety" class="btn btn-block btn-more">Показать все {{ mb_strtolower($item['productType']->alt_name) }}</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        @if(!empty($popularProduct))
                            @foreach($popularProduct as $_item)

                                <div class="col-sm-3">
                                    <div class="media-item">
                                        <a href="/flowers/{{ $_item['slug'] }}">
                                            <figure>
                                                <img class="img-responsive" src="{{ $_item['photoUrl'] }}" alt="...">
                                                <figcaption>
                                                    <ul class="list-inline text-center">
                                                        <li>Ширина {{ $_item['width'] }} см</li>
                                                        <li>Высота {{ $_item['height'] }} см</li>
                                                    </ul>
                                                </figcaption>
                                            </figure>
                                        </a>

                                        <div class="description-media-item">
                                            <div class="row">
                                                <div class="col-xs-11">
                                                    <p><strong class="price-media-item">{{ $_item['clientPrice'] }} руб.</strong> <a href="/flowers/{{ $_item['slug'] }}" class="name">{{ $_item['name'] }}</a></p>
                                                    <p>{{ $_item['shop_name'] }}> &nbsp;<img src="{{ asset('assets/front/img/ico/deliverycar.svg') }}" alt="Скорость доставки цветов"> 2 ч 20 мин</p>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

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
        <img src="{{ asset('images/dostavka_tsvetov_v_ofis1.png') }}" alt="Доставка цветов и букетов" align="left"
             vspace="20" hspace="25"><h2 class="text-left">Доставка букетов цветов в {{ $current_city->name_prepositional }}</h2>

        <p>Флористум – это федеральная сеть доставки цветов в {{ $current_city->name_prepositional }}. Юбилей,
день рождения, корпоративное мероприятие, семейное торжество, День св.
Валентина, 23 февраля, 8 марта и т.д. - на нашем сайте вы сможете заказать
букеты с доставкой в офис, на дом или по другому, указанному адресату.  </br> </br>  Живые цветы созданы для того, чтобы подчеркнуть значимость момента,
создать нужное настроение и… оказать мягкое психологическое воздействие
на вашего визави. Не верите? К примеру, первое свидание. Вот как вы
думаете, к какому парню у девушки сразу возникнет интерес – к тому,
который пришел без цветов, или к тому, который не забыл купить букет для
любимой.
</br></br>
В столице работает много компаний предоставляющих такую услугу,
как доставка букетов в {{ $current_city->name_prepositional }}. В чем же преимущество нашей сети
Floristum?</br></br>
Цена букета, по соотношению деньги/свежесть, одна из самых
оптимальных в регионе. Есть интернет, и вы всегда можете сравнить
стоимость наших услуг с предложениями конкурентов.</br></br>
<h3>Доставка цветов {{ $current_city->name }}</h3>
Доставка букетов цветов в {{ $current_city->name_prepositional }} с Floristum.ru – это всегда быстро,
свежо, креативно и недорого. Работаем круглосуточно – для нас нет
праздничных и выходных дней. Симпатичный и улыбчивый курьер доставит
и вручит букет цветов, озвучит поздравление, а также сфотографирует этот
трогательный момент. Оформить у нас флористическую композицию с
подвозом домой или в офис – это гарантированный сюрприз для вашего адресата.
</br></br>Кстати об оформлении. В компании Флористум цветочные композиции
создают профессионалы высочайшего класса. Каждый созданный ими букет
можно смело называть оригинальным. Заказчик имеет возможность оставить
отзыв на сайте и выставить рейтинг флористу. Эти оценки позволяют нам
корректировать работу в сторону повышения качества оказываемых услуг.
Чтобы поднять человеку настроение, достаточно преподнести живые цветы,
оформленные в виде оригинального букета или корзины.
</br></br>
Мы предлагаем оценить подарочную тему шире, чем просто «сопровождающий элемент» ухаживания или «гарнир» подарка на день рождения. Современные флористические композиции активно используются для украшения интерьера. Живыми цветами можно оформить банкетный зал, офис, сопроводить свадебную церемонию, украсить яхту или автомобиль, создать фруктово-конфетно-цветочные корзины на детском празднике и т.д.
</br></br>
Оплатить доставку вы можете по безналичному расчету. Клиент можете рассчитаться картами VISA, MasterCard, VisaElectron, Maestro, МИР, а кроме того, картами международных платежных систем - это VisaInternational, MasterCardInternational, DinersClubInternational, AmericanExpress.
</p>
        
           <p> <br><br> <img src="{{ asset('images/dostavka_tsvetov_po_beznalu1.png') }}" alt="Доставка цветов по безналу" align="right"  vspace="15" hspace="25"> <h4>Мы работаем и с юридическими лицами по безналичному расчету</h4>


        <p>Для юридических лиц существует возможность заказать авторский букет с доставкой и о�