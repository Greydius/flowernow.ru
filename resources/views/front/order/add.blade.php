@section('pageTitle', $pageTitle)
@section('pageDescription', $pageDescription)
@section('pageKeywords', $pageKeywords)

@extends('layouts.site')

@section('content')

    <div class="container" ng-controller="order">
















        <br>
				<h1 class="h2 margin-top-null"><strong>Оформление заказа на доставку</strong></h1>

				<div class="row">

					<div class="col-md-4 col-md-push-8">
						<div class="media order-total-cost">
							<div class="media-left">
								<img class="media-object img-circle" width="80" height="80" src="{{ asset('/uploads/products/632x632/'.$product->shop->id.'/'.$product->photo) }}" alt="...">
							</div>
							<div class="media-body">
								<div class="row">
									<div class="col-xs-6">{{ $product->name }}</div>
									<div class="col-xs-6">
										<div class="row">
											<div class="col-xs-6">
												<ul class="list-inline text-center">
													<li><span class="glyphicon glyphicon-menu-left text-muted order-arrow"  ng-click="downQty()" aria-hidden="true"></span></li>
													<li ng-cloak><% qty %></li>
													<input type="hidden" name="qty" value="<% qty %>">
													<li><span class="glyphicon glyphicon-menu-right text-muted order-arrow" ng-click="upQty()" aria-hidden="true"></span></li>
												</ul>
											</div>
											<div class="col-xs-6 text-right" ng-cloak>
												<% product.clientPrice %> <i class="fa fa-rub"></i>
											</div>
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col-xs-6"><strong>Итого</strong></div>
									<div class="col-xs-6 text-right" ng-cloak><strong><% total() %> <i class="fa fa-rub"></i></strong></div>
								</div>
							</div>
						</div>

					</div>

					<div class="col-md-8 col-md-pull-4">
						<div class="bg-white order-form">
							<form id="order-frm" method="post" action="{{ route('order.create') }}">
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
										<input type="text" class="form-control" placeholder="Ваше имя" name="name">
									</div>
									<div class="form-group">
										<input type="tel" class="form-control phone_input customer_phone" data-placeholder="Ваш телефон" name="phone">
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
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control datepicker" placeholder="Дата доставки" name="receiving_date" readonly>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<select class="form-control" name="receiving_time">
												<option value="" selected="">Время доставки</option>
												<option value="Время согласовать">Согласовать</option>
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
											</select>
										</div>
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
										<input type="text" class="form-control" placeholder="Имя" name="name">
									</div>
									<div class="form-group">
										<input type="tel" class="form-control phone_input customer_phone" required data-placeholder="Телефон">
									</div>
									<div class="form-group">
										<input type="email" class="form-control" placeholder="Эл. почта" name="email">
									</div>

								</div>

								<br>
								<p class="h4"><strong>Выберите способ оплаты</strong></p>
								<input type="hidden" name="order_id" value="">
								<input type="hidden" name="phone" value="">
								<input type="hidden" name="payment" value="card">
								<input type="hidden" name="products[]" value="{{ $product->id }}">
								<div class="order-tabs">
									<ul class="nav nav-tabs" role="tablist" id="payment_methods_list">
										<li role="presentation" class="active"><a href="#oplata1" aria-controls="oplata1" role="tab" data-toggle="tab" data-payment="card"><figure><img height="40" src="{{ asset('assets/front/img/karta.png') }}" alt="..."></figure>Банковская карта</a></li>
										<li role="presentation"><a href="#oplata3" aria-controls="oplata3" role="tab" data-toggle="tab" data-payment="rs"><figure><img  height="40" src="{{ asset('assets/front/img/beznal.png') }}" alt="..."></figure>Безнал для юр.</a></li>
									</ul>

									<br>

									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="oplata1">
											<hr>
											<div class="text-center" ng-cloak>
												<button type="button" class="btn btn-warning create-order">Оплатить <% total() %> <i class="fa fa-rub"></i></button>
											</div>
											<p class="h6 text-center">Нажимая на кнопку, вы подтверждаете свою дееспособность, а также согласие с <a class="text-muted" href="{{ route('front.privacy') }}">политикой конфиденциальности</a> и <a class="text-muted" href="{{ route('front.personldata') }}">соглашением об обработке персональных данных</a></p>
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
												<div class="col-sm-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Название банка" name="ur_bank">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Ваш Email" name="ur_email">
													</div>
												</div>
											</div>
											<hr>
											<div class="text-center" ng-cloak>
												<button type="button" class="btn btn-warning create-order-ur">Выставить счёт <% total() %> <i class="fa fa-rub"></i></button>
											</div>
											<p class="h6 text-center">Нажимая на кнопку, вы подтверждаете свою дееспособность, а также согласие с <a class="text-muted" href="{{ route('front.privacy') }}">политикой конфиденциальности</a> и <a class="text-muted" href="{{ route('front.personldata') }}">соглашением об обработке персональных данных</a></p>
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
											<figcaption>Пожалуйста, оставте отзыв о доставке цветов</figcaption>
										</figure>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>








<br><br><br>








    </div>

@endsection

@section('head')
<link href="{{ asset('assets/plugins/intl-tel-input-12.1.0/css/intlTelInput.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
@stop

@section('footer')

    <script type="text/javascript">
        jsonData.product = {!! $product->makeHidden('price')->toJson() !!};
    </script>

	<script src="https://widget.cloudpayments.ru/bundles/cloudpayments" type="text/javascript"></script>
	<script src="{{ asset('assets/plugins/intl-tel-input-12.1.0/js/intlTelInput.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/plugins/notifyjs/notify.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('assets/plugins/moment/moment.min.js') }}" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/locales/bootstrap-datepicker.ru.min.js" type="text/javascript"></script>
    <script src="{{ asset('assets/front/ng/order.js?v='.rand(1, 9999)) }}" type="text/javascript"></script>

@stop