@extends('layouts.admin')

@section('content')

    <div class="row" ng-controller="shopProfile" id="shopProfileContainer">
        <div class="col-lg-12">

            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Профиль
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                        <div class="tab-pane active" id="m_tabs_1" role="tabpanel">

                            <ul class="nav nav-tabs  m-tabs-line m-tabs-line--brand" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_name" role="tab">
                                        <i class="flaticon-interface-4"></i>
                                        Название
                                    </a>
                                </li>
                                <li class="nav-item dropdown m-tabs__item">
                                    <a class="nav-link m-tabs__link" href="#m_address" role="tab" data-toggle="tab">
                                        <i class="flaticon-placeholder-2"></i>
                                        Адрес
                                    </a>
                                </li>
                                <li class="nav-item dropdown m-tabs__item">
                                    <a class="nav-link m-tabs__link" href="#m_contacts" role="tab" data-toggle="tab">
                                        <i class="la la-clipboard"></i>
                                        Контакты
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#work_time" role="tab">
                                        <i class="la la-clock-o"></i>
                                        График работы
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#shop_users" role="tab">
                                        <i class="la la-users"></i>
                                        Сотрудники
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#delivery" role="tab">
                                        <i class="la la-truck"></i>
                                        Доставка
                                    </a>
                                </li>

                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#rekvizit" role="tab">
                                        <i class="la la-barcode"></i>
                                        Реквизиты
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="m_name" role="tabpanel">


                                    <div class="m-portlet__body">

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Название
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="{{ $shop->name }}" disabled>
                                        </div>

                                        <div class="form-group m-form__group">
                                            <label for="shop_about">
                                                Информация о магазине
                                            </label>
                                            <textarea class="form-control m-input m-input--air" id="shop_about" rows="6">{{ $shop->about }}</textarea>
                                            <span class="m-form__help">
                                                Всё что вы считаете нужным написать о своем магазине. Информация будет показана посетителям.
                                            </span>
                                        </div>

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Логотип
                                            </label>

                                            <div class="row">

                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <img ng-src="<% shop.logo %>" ng-if="shop.logo" style="width: 250px">
                                                </div>

                                                <div class="col-lg-4 col-md-9 col-sm-12">

                                                    <form action="{{ route('admin.shop.uploadLogo') }}" enctype="multipart/form-data" class="m-dropzone dropzone" id="myDropzone">
                                                        {{ csrf_field() }}
                                                        <div class="m-dropzone__msg dz-message needsclick">
                                                            <h3 class="m-dropzone__msg-title">
                                                                Заменить
                                                            </h3>
                                                            <span class="m-dropzone__msg-desc">
                                                                Нажмите сюда или перетащите картинку
                                                            </span>
                                                        </div>
                                                    </form>


                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Фото магазина
                                            </label>

                                            <div class="row">

                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <img ng-src="<% shop.photo %>" ng-if="shop.photo" style="width: 250px">
                                                </div>

                                                <div class="col-lg-4 col-md-9 col-sm-12">

                                                    <form action="{{ route('admin.shop.uploadPhoto') }}" enctype="multipart/form-data" class="m-dropzone dropzone" id="myDropzone2">
                                                        {{ csrf_field() }}
                                                        <div class="m-dropzone__msg dz-message needsclick">
                                                            <h3 class="m-dropzone__msg-title">
                                                                Заменить
                                                            </h3>
                                                            <span class="m-dropzone__msg-desc">
                                                                Нажмите сюда или перетащите картинку
                                                            </span>
                                                        </div>
                                                    </form>


                                                </div>

                                            </div>

                                        </div>

                                    </div>


                                </div>
                                <div class="tab-pane" id="m_address" role="tabpanel">

                                    <div class="m-portlet__body">

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Город
                                            </label>
                                            <input type="text" class="form-control m-input" value="{{ $shop->city->name }}" disabled>
                                        </div>

                                        <div class="form-group m-form__group" ng-repeat="item in address">

                                            <div class="input-group input-group-sm ">
                                                <input type="text" class="form-control m-input" placeholder="Улица, дом, офис" value="<% item.name %>" name="address[<% item.id %>]">
                                                <span class="input-group-btn" ng-show="$index > 0">
                                                    <button class="btn btn-danger" type="button" ng-click="deleteAddress(item)">
                                                        <i class="la la-close"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>

                                        <button class="btn btn-secondary m-btn m-btn--icon btn-sm" ng-click="addNewAddress()">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>
                                                    Добавить адрес
                                                </span>
                                            </span>
                                        </button>


                                    </div>

                                </div>
                                <div class="tab-pane" id="m_contacts" role="tabpanel">

                                    <div class="m-portlet__body">

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Телефон
                                            </label>
                                            <div class="m-input-icon m-input-icon--left input-group-sm">
                                                <input type="text" class="form-control m-input phone"  value="{{ $shop->contact_phone }}" name="contact_phone">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                    <span>
                                                        <i class="la la-phone"></i>
                                                    </span>
                                                </span>
                                            </div>
                                            <span class="m-form__help">будет отправляться клиентам как контактный при оплате Вашего товара</span>
                                        </div>

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Email
                                            </label>
                                            <div class="m-input-icon m-input-icon--left input-group-sm">
                                                <input type="text" class="form-control m-input" value="{{ $shop->email }}" name="email">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                    <span>
                                                        <i class="la la-at"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Ваш сайт
                                            </label>
                                            <div class="m-input-icon m-input-icon--left input-group-sm">
                                                <input type="text" class="form-control m-input" value="{{ $shop->site }}" name="site">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                    <span>
                                                        <i class="la la-globe"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">Вконтакте</label>
                                            <div class="m-input-icon m-input-icon--left input-group-sm">
                                                <input type="text" class="form-control m-input" value="{{ $shop->vk }}" name="vk">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                    <span>
                                                        <i class="la la-vk"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">Одноклассники</label>
                                            <div class="m-input-icon m-input-icon--left input-group-sm">
                                                <input type="text" class="form-control m-input" value="{{ $shop->ok }}" name="ok">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                    <span>
                                                        <i class="la la-odnoklassniki"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Facebook
                                            </label>
                                            <div class="m-input-icon m-input-icon--left input-group-sm">
                                                <input type="text" class="form-control m-input" value="{{ $shop->fb }}" name="fb">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                    <span>
                                                        <i class="la la-facebook"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Instagram
                                            </label>
                                            <div class="m-input-icon m-input-icon--left input-group-sm">
                                                <input type="text" class="form-control m-input" value="{{ $shop->instagram }}" name="instagram">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                    <span>
                                                        <i class="la la-instagram"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                YouTube
                                            </label>
                                            <div class="m-input-icon m-input-icon--left input-group-sm">
                                                <input type="text" class="form-control m-input" value="{{ $shop->youtube }}" name="youtube">
                                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                                    <span>
                                                        <i class="la la-youtube"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>



                                    </div>

                                </div>


                                <div class="tab-pane" id="work_time" role="tabpanel">

                                    <div class="m-portlet__body">

                                        <div class="form-group m-form__group row datepair">
                                            <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                <label class="m-checkbox">

                                                    <input type="checkbox">
                                                    ПН
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="input-daterange input-group" id="m_datepicker_5">

                                                    <input type="text" class="time start form-control m-input"/>

                                                    <span class="input-group-addon">
                                            <i class="fa fa-minus"></i>
                                        </span>
                                                    <input type="text" class="time end form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group row datepair">
                                            <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                <label class="m-checkbox">

                                                    <input type="checkbox">
                                                    ВТ
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="input-daterange input-group" id="m_datepicker_5">

                                                    <input type="text" class="time start form-control m-input"/>

                                                    <span class="input-group-addon">
                                                    <i class="fa fa-minus"></i>
                                                </span>
                                                    <input type="text" class="time end form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group row datepair">
                                            <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                <label class="m-checkbox">

                                                    <input type="checkbox">
                                                    СР
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="input-daterange input-group" id="m_datepicker_5">

                                                    <input type="text" class="time start form-control m-input"/>

                                                    <span class="input-group-addon">
                                                    <i class="fa fa-minus"></i>
                                                </span>
                                                    <input type="text" class="time end form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group row datepair">
                                            <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                <label class="m-checkbox">

                                                    <input type="checkbox">
                                                    ЧТ
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="input-daterange input-group" id="m_datepicker_5">

                                                    <input type="text" class="time start form-control m-input"/>

                                                    <span class="input-group-addon">
                                                    <i class="fa fa-minus"></i>
                                                </span>
                                                    <input type="text" class="time end form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group row datepair">
                                            <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                <label class="m-checkbox">

                                                    <input type="checkbox">
                                                    ПТ
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="input-daterange input-group" id="m_datepicker_5">

                                                    <input type="text" class="time start form-control m-input"/>

                                                    <span class="input-group-addon">
                                                    <i class="fa fa-minus"></i>
                                                </span>
                                                    <input type="text" class="time end form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group row datepair">
                                            <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                <label class="m-checkbox text-danger">

                                                    <input type="checkbox">
                                                    СБ
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="input-daterange input-group" id="m_datepicker_5">

                                                    <input type="text" class="time start form-control m-input"/>

                                                    <span class="input-group-addon">
                                                    <i class="fa fa-minus"></i>
                                                </span>
                                                    <input type="text" class="time end form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group m-form__group row datepair">
                                            <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                <label class="m-checkbox text-danger">

                                                    <input type="checkbox">
                                                    ВC
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-lg-4 col-md-9 col-sm-12">
                                                <div class="input-daterange input-group" id="m_datepicker_5">

                                                    <input type="text" class="time start form-control m-input"/>

                                                    <span class="input-group-addon">
                                                    <i class="fa fa-minus"></i>
                                                </span>
                                                    <input type="text" class="time end form-control"/>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                                <div class="tab-pane" id="shop_users" role="tabpanel">

                                    <div class="m-portlet__body">

                                        <h3 class="m-portlet__head-text">Руководители</h3>
                                        <span class="m-form__help">сотрудник принимающий решения по вопросам сотрудничества с floristum.ru</span>

                                        <div ng-repeat="item in usersDirector">

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    ФИО
                                                </label>
                                                <input type="text" class="form-control m-input" value="<% item.name %>">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    Телефон
                                                </label>
                                                <input type="text" class="form-control m-input phone" value="<% item.phone %>">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    Email
                                                </label>
                                                <input type="email" class="form-control m-input" value="<% item.email %>">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label class="m-checkbox">

                                                    <input type="checkbox">
                                                    Отправлять смс и email о заказах
                                                    <span></span>
                                                </label>
                                            </div>

                                            <button class="btn btn-danger m-btn m-btn--icon btn-sm" ng-click="deleteDirector(item)">
                                            <span>
                                                <i class="la la-minus"></i>
                                                <span>
                                                    Удалить
                                                </span>
                                            </span>
                                            </button>

                                            <hr/>
                                        </div>

                                        <br>

                                        <button class="btn btn-secondary m-btn m-btn--icon btn-sm" ng-click="addNewDirector()">
                                        <span>
                                            <i class="la la-plus"></i>
                                            <span>
                                                Добавить руководителя
                                            </span>
                                        </span>
                                        </button>
                                        <br><br><br>


                                        <h3 class="m-portlet__head-text">Флористы-менеджеры</h3>
                                        <span class="m-form__help">исполнитель заказа</span>

                                        <div ng-repeat="item in usersFlorist">

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    ФИО
                                                </label>
                                                <input type="text" class="form-control m-input" value="<% item.name %>">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    Телефон
                                                </label>
                                                <input type="text" class="form-control m-input phone" value="<% item.phone %>">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    Email
                                                </label>
                                                <input type="email" class="form-control m-input" value="<% item.email %>">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label class="m-checkbox">

                                                    <input type="checkbox">
                                                    Отправлять смс и email о заказах
                                                    <span></span>
                                                </label>
                                            </div>

                                            <button class="btn btn-danger m-btn m-btn--icon btn-sm" ng-click="deleteFlorist(item)">
                                            <span>
                                                <i class="la la-minus"></i>
                                                <span>
                                                    Удалить
                                                </span>
                                            </span>
                                            </button>

                                            <hr/>
                                        </div>

                                        <br>

                                        <button class="btn btn-secondary m-btn m-btn--icon btn-sm" ng-click="addNewFlorist()">
                                        <span>
                                            <i class="la la-plus"></i>
                                            <span>
                                                Добавить флориста
                                            </span>
                                        </span>
                                        </button>

                                    </div>

                                </div>

                                <div class="tab-pane" id="delivery" role="tabpanel">

                                    <div class="m-portlet__body">

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="m-portlet__head-text">Доставка по городу {{ $shop->city->name }}</h3>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group m-form__group">
                                                            <label for="">
                                                                Стоимость доставки по городу, руб
                                                            </label>
                                                            <input type="text" class="form-control m-input" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group m-form__group datepair">
                                                            <label for="">
                                                                Время доставки, Часов:минут
                                                            </label>
                                                            <input type="text" class="form-control m-input time" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <h3 class="m-portlet__head-text">Доставка загород</h3>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group m-form__group">
                                                            <label for="">
                                                                Максимально возможная удаленность, км
                                                            </label>
                                                            <input type="text" class="form-control m-input" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group m-form__group">
                                                            <label for="">
                                                                Стоимость доставки, руб/1 км
                                                            </label>
                                                            <input type="text" class="form-control m-input" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                                <div class="tab-pane" id="rekvizit" role="tabpanel">

                                    <div class="m-portlet__body">

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Название
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Номер р/с
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Банк
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                БИК
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                К/с
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                ИНН
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                КПП
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                ОГРН/ОГРНИП
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Юридический адрес
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Директор или индивидуальный предприниматель
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Устава или свидетельства
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="">
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>





                </div>
            </div>

        </div>
    </div>


@endsection

@section('head')
<link rel="stylesheet" href="{{ asset('assets/plugins/jquery.timepicker/jquery.timepicker.min.css') }}">
@stop

@section('footer')

    <script src="{{ asset('assets/admin/ng/shopProfile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/shopProfile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery.timepicker/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datepair/datepair.js') }}"></script>
    <script src="{{ asset('assets/plugins/datepair/jquery.datepair.js') }}"></script>

    <script type="text/javascript">
        jsonData.address = {!! $shop->address->makeHidden(['created_at', 'updated_at', 'deleted_at'])->toJson() !!};
    </script>
@stop