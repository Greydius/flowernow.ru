@extends('layouts.site')

@section('content')

    <div class="container" ng-controller="order">
















        <br>
				<h1 class="h2 margin-top-null"><strong>Оформление заказа</strong></h1>

				<div class="row">
					<div class="col-md-8">
						<div class="bg-white order-form">
							<form>
								<div class="">
									<label>
										<span class="h4"><strong>Пожелание</strong> <small class="text-muted">Бесплатно</small></span>
									</label>
								</div>
								<div class="form-group">
									<textarea class="form-control" rows="3" placeholder="Напишите текст открытки. По желанию - подпишитесь."></textarea>
								</div>
								<br>
								<p class="h4"><strong>Получатель</strong></p>
								<div class="checkbox">
									<label>
										<input type="checkbox"> Я сам получу цветы
									</label>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" placeholder="Имя">
								</div>
								<div class="form-group">
									<input type="text" class="form-control phone" placeholder="Телефон">
								</div>

								<div class="row">
									<div class="col-sm-8">
                                        <label>
                                            г. {{ $product->shop->city->name }}
                                        </label>
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Адрес доставки (улица и дом)">
										</div>
									</div>
									<div class="col-sm-4">
                                        <label>&nbsp;</label>
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Квартира / Офис">
										</div>
									</div>
								</div>
								<div class="">
									<label>
										Дополнительная информаця
									</label>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Подьезд, домофон, злая собака - что угодно..."></textarea>
                                    </div>
								</div>

								<p class="h4"><strong>Когда доставить</strong></p>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Дата доставки">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<select class="form-control">
												<option>Время доставки</option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
												<option>5</option>
											</select>
										</div>
									</div>
								</div>
								<br><br>
								<p class="h4"><strong>Ваши данные</strong></p>
								<div class="form-group">
									<div class="checkbox">
										<label>
											<input type="checkbox"> Отправить цветы анонимно
										</label>
									</div>
									<input type="text" class="form-control" placeholder="Имя">
								</div>
								<div class="form-group">
									<input type="text" class="form-control phone" required placeholder="Телефон">
								</div>
								<div class="form-group">
									<input type="email" class="form-control" placeholder="Эл. почта">
								</div>

								<br>
								<p class="h4"><strong>Выберите способ оплаты</strong></p>
								<div class="order-tabs">
									<ul class="nav nav-tabs" role="tablist">
										<li role="presentation" class="active"><a href="#oplata1" aria-controls="oplata1" role="tab" data-toggle="tab"><figure><img height="40" src="{{ asset('assets/front/img/karta.png') }}" alt="..."></figure>Банковская карта</a></li>
										<li role="presentation"><a href="#oplata2" aria-controls="profile" role="oplata2" data-toggle="tab"><figure><img  height="40" src="{{ asset('assets/front/img/nal.png') }}" alt="..."></figure>Наличные</a></li>
										<li role="presentation"><a href="#oplata3" aria-controls="oplata3" role="tab" data-toggle="tab"><figure><img  height="40" src="{{ asset('assets/front/img/beznal.png') }}" alt="..."></figure>Безнал для юр.</a></li>
									</ul>

									<br>

									<div class="tab-content">
										<div role="tabpanel" class="tab-pane active" id="oplata1">
											<div class="row">
												<div class="col-sm-6">
													<div class="media">
														<div class="media-left">
															<img class="media-object" src="{{ asset('assets/front/img/lock.png') }}" alt="...">
														</div>
														<div class="media-body">
															<p><strong>Безопасная оплата картой</strong></p>
															<p class="text-muted">Данные защищены по стандарту PCI DSS</p>
														</div>
													</div>
												</div>
												<div class="col-sm-6">
													<ul class="list-inline">
														<li><img src="{{ asset('assets/front/img/comodo.png') }}" alt="..."></li>
														<li><img src="{{ asset('assets/front/img/visa.png') }}" alt="..."></li>
														<li><img src="{{ asset('assets/front/img/master.png') }}" alt="..."></li>
														<li><img src="{{ asset('assets/front/img/pci.png') }}" alt="..."></li>
													</ul>
												</div>
											</div>
											<br>
											<p>Введите данные карты для оплаты:</p>
											<div class="carta-block-box">
												<div class="carta-block-first">
													<figure class="text-right">
														<img src="{{ asset('assets/front/img/sprite-cloud.png') }}" alt="...">
													</figure>
													<div class="form-group">
														<label for="nomerKarty">Номер карты <button type="button" class="btn btn-inf" data-toggle="tooltip" data-placement="top" title="" data-original-title="Номер карты напечатан на лицевой стороне карты и состоит из 16 или 18 цифр"><span class="glyphicon glyphicon-question-sign text-muted" aria-hidden="true"></span></button></label>
														<input type="text" class="form-control" id="nomerKarty" placeholder="0000 0000 0000 0000">
													</div>
													<div class="form-group">
														<label for="dateFinishCard">Действует до <button type="button" class="btn btn-inf" data-toggle="tooltip" data-placement="top" title="" data-original-title="Срок действия указан на лицевой стороне карты в виде 4 цифры: месяц / год"><span class="glyphicon glyphicon-question-sign text-muted" aria-hidden="true"></span></button></label>
														<div class="row">
															<div class="col-sm-3 col-xs-4">
																<input type="text" class="form-control" id="dateFinishCard" placeholder="12">
															</div>
															<div class="col-sm-3 col-xs-4">
																<input type="text" class="form-control" placeholder="22">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label for="nameCardholder">Имя владельца <button type="button" class="btn btn-inf" data-toggle="tooltip" data-placement="top" title="" data-original-title="Латиницей, как на карте"><span class="glyphicon glyphicon-question-sign text-muted" aria-hidden="true"></span></button></label>
														<input type="text" class="form-control" id="nameCardholder" placeholder="ALEXANDER PUSHKIN">
													</div>
												</div>
												<div class="carta-block-second">
													<div class="card-line"></div>
													<div class="row">
														<div class="col-sm-4 col-sm-offset-8 col-xs-6 col-xs-offset-6">
															<div class="form-group">
																<label for="nomerKarty">Код CVV</label>
																<input type="text" class="form-control" id="nomerKarty" placeholder="000">
																<p class="text-muted">Три цифры с обратной стороны карты</p>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="checkbox">
												<label>
													<input type="checkbox">Сохранить как основной способ оплаты для следующих покупок <br><small class="text-muted"> Следующая покупка в один клик </small>
												</label>
											</div>
											<hr>
											<div class="text-center" ng-cloak>
												<button type="button" class="btn btn-warning">Оплатить <% total() %> <i class="fa fa-rub"></i></button>
											</div>
											<p class="h6 text-center">Нажимая на кнопку, вы подтверждаете свою дееспособность, а также согласие с <a class="text-muted" href="#">политикой конфиденциальности</a> и <a class="text-muted" href="#">соглашением об обработке персональных данных</a></p>
										</div>
										<div role="tabpanel" class="tab-pane" id="oplata2">
											<br>
											<p class="text-center">Оплата наличными курьеру при доставке</p>
											<div class="text-center" ng-cloak>
												<button type="button" class="btn btn-warning">Оплатить <% total() %> <i class="fa fa-rub"></i></button>
											</div>
											<p class="h6 text-center">Нажимая на кнопку, вы подтверждаете свою дееспособность, а также согласие с <a class="text-muted" href="#">политикой конфиденциальности</a> и <a class="text-muted" href="#">соглашением об обработке персональных данных</a></p>
										</div>
										<div role="tabpanel" class="tab-pane" id="oplata3">
											<br><br>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Название юр. лица">
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="ИНН">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="КПП">
													</div>
												</div>
											</div>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Юридический адрес">
											</div>
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Название банка">
													</div>
												</div>
												<div class="col-sm-6">
													<div class="form-group">
														<input type="text" class="form-control" placeholder="Ваш Email">
													</div>
												</div>
											</div>
											<div class="text-center">
												<button type="button" class="btn btn-warning">Выставить счёт 108.78 $</button>
											</div>
											<p class="h6 text-center">Нажимая на кнопку, вы подтверждаете свою дееспособность, а также согласие с <a class="text-muted" href="#">политикой конфиденциальности</a> и <a class="text-muted" href="#">соглашением об обработке персональных данных</a></p>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="col-md-4">
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
				</div>
				<br><br><br>













    </div>

@endsection

@section('head')

@stop

@section('footer')

    <script type="text/javascript">
        jsonData.product = {!! $product->makeHidden('price')->toJson() !!};
    </script>

    <script src="{{ asset('assets/front/ng/order.js') }}" type="text/javascript"></script>

@stop