@section('pageTitle', $pageTitle)
@section('pageDescription', $pageDescription)
@section('pageKeywords', $pageKeywords)

@extends('layouts.site')

@section('content')

    <div class="container" ng-controller="order" id="order-container">


        <br>
        <h1 class="h2 margin-top-null"><strong>Оформление заказа на доставку</strong></h1>

        <div class="row">

            <div class="col-md-4 col-md-push-8">
                <div class="media order-total-cost">
                    <div class="media-left">
                        @if(empty($product->single))
                            @if($product->copy_id !== null || $product->shop_id === 350)
                              <img class="media-object img-circle" width="80" height="80" src="{{ asset('/uploads/products/632x632/350/'.$product->photo) }}" alt="...">
                            @else
                              <img class="media-object img-circle" width="80" height="80" src="{{ asset('/uploads/products/632x632/'.$product->shop->id.'/'.$product->photo) }}" alt="...">
                            @endif
                        @else
                            <img class="media-object img-circle" width="80" height="80" ng-src="<% product.photoUrl %>" src="{{ asset('/uploads/single/'.$product->photo) }}" alt="...">
                        @endif
                    </div>
                    <div class="media-body">
                        <div class="row">
                            <div class="col-xs-6">{{ empty($product->single) ? $product->name : $product->singleProduct->parent->name }}</div>
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <ul class="list-inline text-center">
                                            <li><span class="glyphicon glyphicon-menu-left text-muted order-arrow" ng-click="downQty()" aria-hidden="true"></span></li>
                                            <li ng-cloak><% qty %></li>
                                            <li><span class="glyphicon glyphicon-menu-right text-muted order-arrow" ng-click="upQty()" aria-hidden="true"></span></li>
                                        </ul>
                                    </div>
                                    <div class="col-xs-6 text-right" ng-cloak>
                                        <% product.clientPrice %> <i class="fa fa-rub"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" ng-cloak ng-repeat="dopProduct in selectedDopProducts">
                            <div class="col-xs-6"><% dopProduct.name %></div>
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <ul class="list-inline text-center">
                                            <li><span class="glyphicon glyphicon-menu-left text-muted order-arrow" ng-click="downQtyDop(dopProduct)" aria-hidden="true"></span></li>
                                            <li ng-cloak><% dopProduct.qty %></li>
                                            <li><span class="glyphicon glyphicon-menu-right text-muted order-arrow" ng-click="upQtyDop(dopProduct)" aria-hidden="true"></span></li>
                                        </ul>
                                    </div>
                                    <div class="col-xs-6 text-right" ng-cloak>
                                        <% dopProduct.clientPrice %> <i class="fa fa-rub"></i>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-xs-6"><strong>Итого</strong></div>
                            <div class="col-xs-6 text-right" ng-cloak>
                                <span ng-show="product.fullPrice != product.clientPrice" class="text-danger"><strong><del><% totalFull() %></del> <i class="fa fa-rub"></i></strong><br/></span>
                                <strong><% total() %> <i class="fa fa-rub"></i></strong>
                                <p ng-show="promo" style="font-size: 8pt; color: grey;">Скидка <% promo.text %></p>
                            </div>
                        </div>
                    </div>
                </div>


                <br><br>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Промо код" style="height: auto" ng-model="promo_code" name="promo_code">
                    <span class="input-group-btn">
								<button class="btn btn-warning" type="button" ng-disabled="!promo_code" ng-click="getPromoCodeinfo($event)">
									Применить
								</button>
							</span>
                </div>


            </div>

            <div class="col-md-8 col-md-pull-4">
                <div class="bg-white order-form">

                    @if(!empty($user) && $user->admin)

                        <section id="dop-products-container">
                            <div class="row">
                                <div class="large-12 columns col-md-12">
                                    <div class="owl-carousel owl-theme">
                                        <div class="item" title="<% dopProduct.name %>" ng-cloak ng-repeat="dopProduct in allDopProducts">
                                            <div class="media-item-dop">
                                                <figure>
                                                    <img class="img-responsive" ng-src="/uploads/products/632x632/<% dopProduct.shop_id %>/<% dopProduct.photo %>" alt="...">

                                                </figure>

                                                <div class="dop-name">
                                                    <% dopProduct.name %>
                                                </div>

                                                <div class="text-center">
                                                    <button class="btn btn-<% btnDopClass(dopProduct) %> btn-xs" ng-click="addDopProduct(dopProduct)"><% dopProduct.clientPrice %> ₽</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>



<!--
                        <section id="dop-products-container">
                            <div class="row">
                                <div class="large-12 columns">
                                    <div class="owl-carousel owl-theme">
                                        @foreach($dopProducts as $item)
                                            <div class="item" title="{{ $item->name }}">
                                                <div class="media-item-dop">
                                                    <figure>
                                                        <img class="img-responsive" src="{{ $item->photoUrl }}" alt="...">

                                                    </figure>

                                                    <div class="dop-name">
                                                        {{ $item->name }}
                                                    </div>

                                                    <div class="text-center">
                                                        <button class="btn btn-<% btnDopClass({{ $item->id }}) %> btn-xs" ng-click="addDopProduct({{ $item->id }})">{{ $item->clientPrice }} ₽</button>
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
-->
                    @endif

                    <form id="order-frm" method="post" action="{{ route('order.create') }}">
                        <input type="hidden" name="qty" value="<% qty %>">
                        {{ csrf_field() }}
                        <div class="">
                            <label>
                                <span class="h4"><strong>Пожелание</strong> <small class="text-muted">Бесплатно</small></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="text" placeholder="Напишите текст открытки. По желанию - подпишитесь."></textarea>
                        </div>
                        <br>
                        <p class="h4"><strong>Получатель</strong></p>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="recipient_self" id="recipient_self"> Я сам получу цветы
                            </label>
                        </div>
                        <div class="form1">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Имя получателя" name="recipient_name">
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control phone_input" data-placeholder="Телефон получателя" id="recipient_phone">
                                <input type="hidden" name="recipient_phone" value="">
                            </div>
                        </div>

                        <div class="form2">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Ваше имя" name="name[]">
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control phone_input customer_phone" data-placeholder="Ваш телефон" ng-model="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control order-email" placeholder="Эл. почта">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>
                                    г. {{ $product->shop->city->name }}
                                </label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Адрес доставки (улица, дом, квартира/офис)" name="recipient_address">
                                </div>
                            </div>
                            @if($product->shop->delivery_out && $product->shop->delivery_out_price)
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="delivery_out"> Доставка за город
                                            </label>
                                        </div>
                                        <div id="delivery_out_container" style="display: none">

                                            <input type="text" class="form-control" placeholder="Км. от границы города" name="delivery_out_distance" ng-model="delivery_out_distance">
                                            <p class="text-muted">{{ $product->shop->delivery_out_price }} руб/1 км</p>
                                            @if($product->shop->delivery_out_max)
                                                <p class="text-muted">Максимум {{ $product->shop->delivery_out_max }} км</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                        @endif
                        <!--
									<div class="col-sm-4">
                                        <label>&nbsp;</label>
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Квартира / Офис" name="recipient_flat">
										</div>
									</div>
									-->
                        </div>
                        <div class="">
                            <label>
                                Дополнительная информаця
                            </label>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" placeholder="Подьезд, домофон, злая собака - что угодно..." name="recipient_info"></textarea>
                            </div>
                        </div>

                        <p class="h4"><strong>Когда доставить</strong></p>
                        <div class="row delivery-wrapper">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control datepicker delivery-date" placeholder="Дата доставки" name="receiving_date" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6 delivery-default-timepicker">
                                <div class="form-group">
                                    <select class="form-control" name="receiving_time">
                                        <option value="" selected="">Время доставки</option>
                                        <option data-time-start="00:00" data-time-end="23:59" value="Время согласовать">Согласовать</option>
                                        <option data-time-start="00:00" data-time-end="00:00" value="с 00:00 до 02:00">с 00:00 до 02:00</option>
                                        <option data-time-start="00:00" data-time-end="01:59" value="с 02:00 до 04:00">с 02:00 до 04:00</option>
                                        <option data-time-start="02:00" data-time-end="03:59" value="с 04:00 до 06:00">с 04:00 до 06:00</option>
                                        <option data-time-start="04:00" data-time-end="05:59" value="с 06:00 до 08:00">с 06:00 до 08:00</option>
                                        <option data-time-start="06:00" data-time-end="07:59" value="с 08:00 до 10:00">с 08:00 до 10:00</option>
                                        <option data-time-start="08:00" data-time-end="09:59" value="с 10:00 до 12:00">с 10:00 до 12:00</option>
                                        <option data-time-start="10:00" data-time-end="11:59" value="с 12:00 до 14:00">с 12:00 до 14:00</option>
                                        <option data-time-start="12:00" data-time-end="13:59" value="с 14:00 до 16:00">с 14:00 до 16:00</option>
                                        <option data-time-start="14:00" data-time-end="15:59" value="с 16:00 до 18:00">с 16:00 до 18:00</option>
                                        <option data-time-start="16:00" data-time-end="17:59" value="с 18:00 до 20:00">с 18:00 до 20:00</option>
                                        <option data-time-start="18:00" data-time-end="19:59" value="с 20:00 до 22:00">с 20:00 до 22:00</option>
                                        <option data-time-start="20:00" data-time-end="21:59" value="с 22:00 до 24:00">с 22:00 до 24:00</option>
                                        <option data-time-start="00:00" data-time-end="23:59" style="display: none" value="в течении дня">в течении дня</option>
                                        <!--
                                        <option value="с 08:00 до 09:00">с 08:00 до 09:00</option>
                                        <option value="с 09:00 до 10:00">с 09:00 до 10:00</option>
                                        <option value="с 10:00 до 11:00">с 10:00 до 11:00</option>
                                        <option value="с 11:00 до 12:00">с 11:00 до 12:00</option>
                                        <option value="с 12:00 до 13:00">с 12:00 до 13:00</option>
                                        <option value="с 13:00 до 14:00">с 13:00 до 14:00</option>
                                        <option value="с 14:00 до 15:00">с 14:00 до 15:00</option>
                                        <option value="с 15:00 до 16:00">с 15:00 до 16:00</option>
                                        <option value="с 16:00 до 17:00">с 16:00 до 17:00</option>
                                        <option value="с 17:00 до 18:00">с 17:00 до 18:00</option>
                                        <option value="с 18:00 до 19:00">с 18:00 до 19:00</option>
                                        <option value="с 19:00 до 20:00">с 19:00 до 20:00</option>
                                        <option value="с 20:00 до 21:00">с 20:00 до 21:00</option>
                                        <option value="с 21:00 до 22:00">с 21:00 до 22:00</option>
                                        <option value="с 22:00 до 23:00">с 22:00 до 23:00</option>
                                        <option value="с 23:00 до 24:00">с 23:00 до 24:00</option>
                                        -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 delivery-love-days-timepicker">
                                <div class="form-group">
                                    <select class="form-control" name="receiving_time">
                                        <option value="" selected="">Время доставки</option>
                                        <option value="Время согласовать">Согласовать</option>
                                        <option value="с 08:00 до 11:00">с 08:00 до 11:00</option>
                                        <option value="с 11:00 до 14:00">с 11:00 до 14:00</option>
                                        <option value="с 14:00 до 17:00">с 14:00 до 17:00</option>
                                        <option value="с 17:00 до 20:00">с 17:00 до 20:00</option>
                                        <option value="с 20:00 до 23:00">с 20:00 до 23:00</option>
                                        <!--
                                          
                                        <option value="с 08:00 до 09:00">с 08:00 до 09:00</option>
                                        <option value="с 09:00 до 10:00">с 09:00 до 10:00</option>
                                        <option value="с 10:00 до 11:00">с 10:00 до 11:00</option>
                                        <option value="с 11:00 до 12:00">с 11:00 до 12:00</option>
                                        <option value="с 12:00 до 13:00">с 12:00 до 13:00</option>
                                        <option value="с 13:00 до 14:00">с 13:00 до 14:00</option>
                                        <option value="с 14:00 до 15:00">с 14:00 до 15:00</option>
                                        <option value="с 15:00 до 16:00">с 15:00 до 16:00</option>
                                        <option value="с 16:00 до 17:00">с 16:00 до 17:00</option>
                                        <option value="с 17:00 до 18:00">с 17:00 до 18:00</option>
                                        <option value="с 18:00 до 19:00">с 18:00 до 19:00</option>
                                        <option value="с 19:00 до 20:00">с 19:00 до 20:00</option>
                                        <option value="с 20:00 до 21:00">с 20:00 до 21:00</option>
                                        <option value="с 21:00 до 22:00">с 21:00 до 22:00</option>
                                        <option value="с 22:00 до 23:00">с 22:00 до 23:00</option>
                                        <option value="с 23:00 до 24:00">с 23:00 до 24:00</option>
                                        -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 delivery-woman-days-hint">
                                <div>Доставка 7-8 марта осуществляется <b>в течение дня до 22:00 по предварительному звонку</b>, при этом <span class="dashed-text" title="Получатель не узнаёт о том, что предмет доставки - цветы.">эффект сюрприза</span> сохраняется.</div>
                            </div>
                        </div>
                        <div class="form1">

                            <br><br>
                            <p class="h4"><strong>Ваши данные</strong></p>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="anonymous"> Отправить цветы анонимно
                                    </label>
                                </div>
                                <input type="text" class="form-control" placeholder="Имя" name="name[]">
                            </div>
                            <div class="form-group">
                                <input type="tel" class="form-control phone_input customer_phone" required data-placeholder="Телефон">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control order-email" placeholder="Эл. почта">
                            </div>

                        </div>
                        <br>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="recipient_photo" id="recipient_photo"> Сделать фотографию получателя
                            </label>
                        </div>

                        <br>
                        <p class="h4"><strong>Выберите способ оплаты</strong></p>
                        <input type="hidden" name="order_id" value="">
                        <input type="hidden" name="phone" value="">
                        <input type="hidden" name="email" value="">
                        <input type="hidden" name="payment" value="card">
                        <input type="hidden" name="products[]" value="<% product.id %>">
                        <div class="order-tabs">
                            <ul class="nav nav-tabs" role="tablist" id="payment_methods_list">
                                <li role="presentation" class="active payment-type"><a href="#oplata1" aria-controls="oplata1" role="tab" data-toggle="tab" data-payment="card">
                                        <figure><img height="40" src="{{ asset('assets/front/img/karta.png') }}" alt="..."></figure>
                                        Банковская карта</a>
                                </li>

                                <!-- <li role="presentation" class="payment-type">
                                    <a href="#oplata2" aria-controls="profile" role="oplata2" data-toggle="tab" data-payment="cash">
                                        <figure><img  height="40" src="{{ asset('assets/front/img/nal.png') }}" alt="..."></figure>
                                        Наличные
                                    </a>
                                </li> -->

                                <li role="presentation" class="payment-type entity">
                                  <a href="#oplata3" aria-controls="oplata3" role="tab" data-toggle="tab" data-payment="rs">
                                        <figure><img height="40" src="{{ asset('assets/front/img/beznal.png') }}" alt="..."></figure>
                                        Безнал для юр.
                                  </a>
                                </li>
                            </ul>

                            <br>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="oplata1">
                                    <hr>
                                    <div class="text-center" ng-cloak>
                                        <button type="button" class="btn btn-warning create-order">Оплатить <% total() %> <i class="fa fa-rub"></i></button>
                                    </div>
                                    <p class="h6 text-center">Нажимая на кнопку, вы подтверждаете свою дееспособность, а также согласие с <a class="text-muted" href="{{ route('front.privacy') }}" target="_blank">Политикой конфиденциальности</a>, <a class="text-muted" href="{{ route('front.personldata') }}" target="_blank">Соглашением о персональных данных</a> и <a class="text-muted" href="{{ route('front.agreement') }}" target="_blank">Публичной офертой</a></p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="oplata2">
                                    <br>
                                    <p class="text-center">Оплата наличными курьеру при доставке</p>
                                    <div ng-if="!sms_send">
                                        <p class="h6 text-center">На Ваш телефон <b><% phone %></b> будет выслано SMS с кодом подтверждения заказа</p>
                                        <br>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-warning create-order">Заказать за <% total() %> <i class="fa fa-rub"></i></button>
                                        </div>
                                        <p class="h6 text-center">Нажимая на кнопку, вы подтверждаете свою дееспособность, а также согласие с <a class="text-muted" href="{{ route('front.privacy') }}" target="_blank">Политикой конфиденциальности</a>, <a class="text-muted" href="{{ route('front.personldata') }}" target="_blank">Соглашением о персональных данных</a> и <a class="text-muted" href="{{ route('front.agreement') }}" target="_blank">Публичной данных</a></p>
                                    </div>
                                    <div ng-show="sms_send">
                                        <p class="text-center">Чтобы завершить заказ, введите код-подтверждение, который вам придёт по SMS</p>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Введите код" id="sms_code" ng-model="sms_code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-md-offset-4">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-warning btn-block" ng-click="confirmSmsCode()">Подтвердить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="oplata3">
                                    <br><br>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Название юр. лица" name="ur_name">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="ИНН" name="ur_inn">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="КПП" name="ur_kpp">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Юридический адрес" name="ur_address">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Название банка" name="ur_bank">
                                            </div>
                                        </div>
                                        <!--
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Ваш Email" name="ur_email">
                                            </div>
                                        </div>
                                        -->
                                    </div>
                                    <hr>
                                    <div class="text-center" ng-cloak>
                                        <button type="button" class="btn btn-warning create-order-ur">Выставить счёт <% total() %> <i class="fa fa-rub"></i></button>
                                    </div>
                                    <p class="h6 text-center">Нажимая на кнопку, вы подтверждаете свою дееспособность, а также согласие с <a class="text-muted" href="{{ route('front.privacy') }}" target="_blank">Политикой конфиденциальности</a>, <a class="text-muted" href="{{ route('front.personldata') }}" target="_blank">Соглашением о персональных данных</a> и <a class="text-muted" href="{{ route('front.agreement') }}" target="_blank">Публичной данных</a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="row media-item-opened">

                    <div class="col-md-12">

                        <p class="h3" id="chto-posle"><strong>Что после оплаты заказа?</strong></p>
                        <br>
                        <div class="row">
                            <div class="col-xs-6 col-sm-3">
                                <figure class="after-ord-icn">
                                    <span class="digital one">1</span>
                                    <figcaption>Флорист отправит Вам подтверждение заказа</figcaption>
                                </figure>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <figure class="after-ord-icn">
                                    <span class="digital two">2</span>
                                    <figcaption>Соберёт букет из свежих цветов</figcaption>
                                </figure>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <figure class="after-ord-icn">
                                    <span class="digital three">3</span>
                                    <figcaption>Доставка цветов получателю</figcaption>
                                </figure>
                            </div>
                            <div class="col-xs-6 col-sm-3">
                                <figure class="after-ord-icn">
                                    <span class="digital four">4</span>
                                    <figcaption>Пожалуйста, оставьте отзыв о доставке цветов</figcaption>
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <br><br><br>


    </div>
    <div class="clock-wrapper-outer">
      <div class="clock-wrapper">
        <div class="clock"></div>
        <div class="clock"></div>
      </div>
    </div>

@endsection

@section('head')
    <link href="{{ asset('assets/plugins/intl-tel-input-12.1.0/css/intlTelInput.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/owl.carousel/owl.carousel.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/owl.carousel/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css"/>
    <style>
      .dashed-text {
        border-bottom: 1px dashed #555C69;
        cursor: pointer;
      }
      .clock-wrapper-outer {
        display: none;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        position: fixed;
        background-color: rgba(0, 0, 0, 0.1);
        z-index: 999999999999;
        top: 0;
        left: 0;
      }
      .clock-wrapper-outer.active {
        display: flex;
      }
      .clock-wrapper {
        position: releative;
        width: 50px;
        height: 100px;
        -webkit-transform-origin: center center;
                transform-origin: center center;
        -webkit-animation: rotate 3s .75s ease-in-out infinite;
                animation: rotate 3s .75s ease-in-out infinite;
      }
      .clock-wrapper:before, .clock-wrapper:after {
        z-index: -1;
        content: "";
        border: solid 4px rgba(0, 0, 0, 0.2);
        border-bottom: none;
        border-left: none;
        border-right: none;
        border-radius: 50%;
        -webkit-clip-path: inset(0 60% 0 0);
                clip-path: inset(0 60% 0 0);
        width: 100%;
        height: 50%;
        -webkit-animation: shadow 3s .75s linear infinite;
                animation: shadow 3s .75s linear infinite;
        opacity: 0;
      }
      .clock-wrapper:after {
        position: absolute;
        top: -1px;
        left: -18px;
      }
      .clock-wrapper:before {
        position: absolute;
        bottom: -1px;
        right: -18px;
        -webkit-transform: rotate(180deg);
                transform: rotate(180deg);
      }

      .clock {
        position: relative;
        width: 0;
        height: 0;
        border-top: solid 50px #df291e;
        border-bottom: solid 25px transparent;
        border-left: solid 25px transparent;
        border-right: solid 25px transparent;
      }
      .clock:before, .clock:after {
        content: "";
        position: absolute;
        left: -20px;
        top: -47px;
        width: 0;
        height: 0;
        border-top: solid 44px #f3f3f3;
        border-bottom: solid 20px transparent;
        border-left: solid 20px transparent;
        border-right: solid 20px transparent;
      }
      .clock:after {
        border-top: solid 44px #df291e;
        will-change: transform;
        -webkit-animation: clock1 3s linear infinite;
                animation: clock1 3s linear infinite;
      }
      .clock:last-child {
        -webkit-transform: rotate(180deg) translateY(50px);
                transform: rotate(180deg) translateY(50px);
      }
      .clock:last-child:after {
        -webkit-transform: scale(0);
                transform: scale(0);
        -webkit-animation: clock2 3s linear infinite;
                animation: clock2 3s linear infinite;
      }

      @-webkit-keyframes clock1 {
        20%, 50% {
          -webkit-transform: scale(0);
                  transform: scale(0);
        }
        70%, 100% {
          -webkit-transform: scale(1);
                  transform: scale(1);
        }
      }

      @keyframes clock1 {
        20%, 50% {
          -webkit-transform: scale(0);
                  transform: scale(0);
        }
        70%, 100% {
          -webkit-transform: scale(1);
                  transform: scale(1);
        }
      }
      @-webkit-keyframes clock2 {
        20%, 50% {
          -webkit-transform: scale(1);
                  transform: scale(1);
        }
        70%,100% {
          -webkit-transform: scale(0);
                  transform: scale(0);
        }
      }
      @keyframes clock2 {
        20%, 50% {
          -webkit-transform: scale(1);
                  transform: scale(1);
        }
        70%,100% {
          -webkit-transform: scale(0);
                  transform: scale(0);
        }
      }
      @-webkit-keyframes shadow {
        10% {
          opacity: 1;
        }
        20%, 50% {
          opacity: 0;
        }
        60% {
          opacity: 1;
        }
        70%,100% {
          opacity: 0;
        }
      }
      @keyframes shadow {
        10% {
          opacity: 1;
        }
        20%, 50% {
          opacity: 0;
        }
        60% {
          opacity: 1;
        }
        70%,100% {
          opacity: 0;
        }
      }
      @-webkit-keyframes rotate {
        20%, 50% {
          -webkit-transform: rotate(180deg);
                  transform: rotate(180deg);
        }
        70%, 100% {
          -webkit-transform: rotate(360deg);
                  transform: rotate(360deg);
        }
      }
      @keyframes rotate {
        20%, 50% {
          -webkit-transform: rotate(180deg);
                  transform: rotate(180deg);
        }
        70%, 100% {
          -webkit-transform: rotate(360deg);
                  transform: rotate(360deg);
        }
      }

    </style>
@stop

@section('footer')

    <script type="text/javascript">
            jsonData.product = {!! $product->makeHidden('price')->toJson() !!};
            jsonData.dopProducts = {!! $dopProducts !!};
            jsonData.qty = {!! $qty !!};
    </script>

    <script src="https://widget.cloudpayments.ru/bundles/cloudpayments" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/intl-tel-input-12.1.0/js/intlTelInput.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/notifyjs/notify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}" type="text/javascript"></script>
    <script src="https://momentjs.com/downloads/moment-timezone-with-data-10-year-range.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/owl.carousel/owl.carousel.min.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.ru.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets/front/ng/order.js?v='.rand(1, 9999)) }}" type="text/javascript"></script>
    <script>
      moment.tz.setDefault("Europe/Moscow");
      $(".dashed-text").tooltip();
      $(".delivery-date").change(function(){
        var date = $(this).val();
        var dateWithoutYear = moment(date, "DD.MM.YYYY").format("DD.MM");

        var isLoveDay = dateWithoutYear === '14.02';
        var isWomanDays = dateWithoutYear === '07.03' || dateWithoutYear === '08.03';

        var defaultTimepicker = $(".delivery-default-timepicker");
        var loveDayTimepicker = $(".delivery-love-days-timepicker");
        var womanDaysHint = $(".delivery-woman-days-hint");

        function toDefault() {
          defaultTimepicker.find('select').val('');
          defaultTimepicker.find("select").attr("name", 'receiving_time');
          defaultTimepicker.show();

          loveDayTimepicker.find("select").attr("name", 'receiving_time2');
          loveDayTimepicker.hide();
          womanDaysHint.hide();
        }

        // if(isWomanDays){
        if(false){
         toDefault();
         defaultTimepicker.hide();
         defaultTimepicker.find('select').val('в течении дня');
         womanDaysHint.show();
        }else if(isLoveDay) {
          toDefault();
          defaultTimepicker.find("select").attr("name", 'receiving_time2');
          defaultTimepicker.hide();

          loveDayTimepicker.find("select").attr("name", 'receiving_time');
          loveDayTimepicker.show();
        }else {
          toDefault();
        }

        // If is same date - check time
        const select = $('.delivery-default-timepicker select');
        const options = select.find('option');
        const currentDateTime = moment();

        if(moment(date, 'DD.MM.YYYY').isSame(currentDateTime, 'day')) {
          options.each(function(i, el){
            const startTime = $(el).attr('data-time-end');
            const dateString = `${date} ${startTime}`;
            const checkDate = moment(dateString, 'DD.MM.YYYY hh:mm');
            const nextDateTime = currentDateTime;
            console.log(nextDateTime, checkDate)
            if(nextDateTime.isAfter(checkDate)) {
              $(el).attr('disabled', true);
            }
          });
        }else {
          options.each(function(i, el) {
            $(el).attr('disabled', false);
          });
        }
      })
    </script>

@stop