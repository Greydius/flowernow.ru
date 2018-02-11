@extends('layouts.admin')

@section('content')

    <div class="row" ng-controller="shopProfile" id="shopProfileContainer">
        <div class="col-lg-12 m-form ">

            <div class="m-portlet m-portlet--tab">
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
                            <div class="tab-content" id="profile-content">
                                <div class="tab-pane active" id="m_name" role="tabpanel">


                                    <div class="m-portlet__body">

                                        <div class="form-group m-form__group">
                                            <label for="shop_name">
                                                Название магазина <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control m-input" id="shop_name" value="{{ $shop->name }}" name="name">
                                        </div>

                                        <div class="form-group m-form__group">
                                            <label for="shop_about">
                                                Информация о магазине <span class="text-danger">*</span>
                                            </label>
                                            <textarea class="form-control m-input m-input--air" id="shop_about" rows="6" name="about">{{ $shop->about }}</textarea>
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
                                                                Загрузить
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
                                                                Загрузить
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

                                            <label for="" ng-show="$index == 0">
                                                Улица, дом, офис <span class="text-danger">*</span>
                                            </label>

                                            <div class="input-group input-group-sm ">
                                                <input type="hidden" name="address[<% $index %>][id]" value="<% item.id %>">
                                                <input type="text" class="form-control m-input" placeholder="Улица, дом, офис" value="<% item.name %>" name="address[<% $index %>][name]">
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
                                                Телефон <span class="text-danger">*</span>
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
                                                Email <span class="text-danger">*</span>
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

                                        <div class="form-group m-form__group row">
                                            <div class="col-form-label m-checkbox col-sm-12">
                                                <label class="m-checkbox">

                                                    <input type="checkbox" id="round-the-clock" name="shop_round_clock" {{ $shop->round_clock ? 'checked' : null }}>
                                                    Круглосуточно, без выходных
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div id="round-the-clock-container" style="{{ $shop->round_clock ? 'display: none;' : null }}">

                                            <div class="form-group m-form__group row datepair">
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="work-day" name="work_day[0]" {{ !empty($shop->workTime[0]) && !empty($shop->workTime[0]->is_work) ? 'checked' : null }}>
                                                        ПН
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <div class="input-daterange input-group">

                                                        <input type="text" class="time start form-control m-input" name="work_from[0]" value="{{ !empty($shop->workTime[0]) ? $shop->workTime[0]->work_from_format : null }}" {{ !empty($shop->workTime[0]) && !empty($shop->workTime[0]->round_clock) ? 'disabled' : null }}/>

                                                        <span class="input-group-addon">
                                                            <i class="fa fa-minus"></i>
                                                        </span>
                                                        <input type="text" class="time end form-control" name="work_to[0]" value="{{ !empty($shop->workTime[0]) ? $shop->workTime[0]->work_to_format : null }}" {{ !empty($shop->workTime[0]) && !empty($shop->workTime[0]->round_clock) ? 'disabled' : null }}/>
                                                    </div>
                                                </div>
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="round-the-clock" name="round_clock[0]" {{ !empty($shop->workTime[0]) && !empty($shop->workTime[0]->round_clock) ? 'checked' : null }}>
                                                        Круглосуточно
                                                        <span></span>
                                                    </label>
                                                </div>


                                                <div class="col-md-12">
                                                    <hr/>
                                                </div>

                                            </div>


                                            <div class="form-group m-form__group row datepair">
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="work-day" name="work_day[1]" {{ !empty($shop->workTime[1]) && !empty($shop->workTime[1]->is_work) ? 'checked' : null }}>
                                                        ВТ
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <div class="input-daterange input-group">

                                                        <input type="text" class="time start form-control m-input" name="work_from[1]" value="{{ !empty($shop->workTime[1]) ? $shop->workTime[1]->work_from_format : null }}" {{ !empty($shop->workTime[1]) && !empty($shop->workTime[1]->round_clock) ? 'disabled' : null }}/>

                                                        <span class="input-group-addon">
                                                            <i class="fa fa-minus"></i>
                                                        </span>
                                                        <input type="text" class="time end form-control" name="work_to[1]" value="{{ !empty($shop->workTime[1]) ? $shop->workTime[1]->work_to_format : null }}" {{ !empty($shop->workTime[1]) && !empty($shop->workTime[1]->round_clock) ? 'disabled' : null }}/>
                                                    </div>
                                                </div>
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="round-the-clock" name="round_clock[1]" {{ !empty($shop->workTime[1]) && !empty($shop->workTime[1]->round_clock) ? 'checked' : null }}>
                                                        Круглосуточно
                                                        <span></span>
                                                    </label>
                                                </div>


                                                <div class="col-md-12">
                                                    <hr/>
                                                </div>

                                            </div>

                                            <div class="form-group m-form__group row datepair">
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="work-day" name="work_day[2]" {{ !empty($shop->workTime[2]) && !empty($shop->workTime[2]->is_work) ? 'checked' : null }}>
                                                        СР
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <div class="input-daterange input-group">

                                                        <input type="text" class="time start form-control m-input" name="work_from[2]" value="{{ !empty($shop->workTime[2]) ? $shop->workTime[2]->work_from_format : null }}" {{ !empty($shop->workTime[2]) && !empty($shop->workTime[2]->round_clock) ? 'disabled' : null }}/>

                                                        <span class="input-group-addon">
                                                            <i class="fa fa-minus"></i>
                                                        </span>
                                                        <input type="text" class="time end form-control" name="work_to[2]" value="{{ !empty($shop->workTime[2]) ? $shop->workTime[2]->work_to_format : null }}" {{ !empty($shop->workTime[2]) && !empty($shop->workTime[2]->round_clock) ? 'disabled' : null }}/>
                                                    </div>
                                                </div>
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="round-the-clock" name="round_clock[2]" {{ !empty($shop->workTime[2]) && !empty($shop->workTime[2]->round_clock) ? 'checked' : null }}>
                                                        Круглосуточно
                                                        <span></span>
                                                    </label>
                                                </div>


                                                <div class="col-md-12">
                                                    <hr/>
                                                </div>

                                            </div>

                                            <div class="form-group m-form__group row datepair">
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="work-day" name="work_day[3]" {{ !empty($shop->workTime[3]) && !empty($shop->workTime[3]->is_work) ? 'checked' : null }}>
                                                        ЧТ
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <div class="input-daterange input-group">

                                                        <input type="text" class="time start form-control m-input" name="work_from[3]" value="{{ !empty($shop->workTime[3]) ? $shop->workTime[3]->work_from_format : null }}" {{ !empty($shop->workTime[3]) && !empty($shop->workTime[3]->round_clock) ? 'disabled' : null }}/>

                                                        <span class="input-group-addon">
                                                            <i class="fa fa-minus"></i>
                                                        </span>
                                                        <input type="text" class="time end form-control" name="work_to[3]" value="{{ !empty($shop->workTime[3]) ? $shop->workTime[3]->work_to_format : null }}" {{ !empty($shop->workTime[3]) && !empty($shop->workTime[3]->round_clock) ? 'disabled' : null }}/>
                                                    </div>
                                                </div>
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="round-the-clock" name="round_clock[3]" {{ !empty($shop->workTime[3]) && !empty($shop->workTime[3]->round_clock) ? 'checked' : null }}>
                                                        Круглосуточно
                                                        <span></span>
                                                    </label>
                                                </div>


                                                <div class="col-md-12">
                                                    <hr/>
                                                </div>

                                            </div>

                                            <div class="form-group m-form__group row datepair">
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="work-day" name="work_day[4]" {{ !empty($shop->workTime[4]) && !empty($shop->workTime[4]->is_work) ? 'checked' : null }}>
                                                        ПТ
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <div class="input-daterange input-group">

                                                        <input type="text" class="time start form-control m-input" name="work_from[4]" value="{{ !empty($shop->workTime[4]) ? $shop->workTime[4]->work_from_format : null }}" {{ !empty($shop->workTime[4]) && !empty($shop->workTime[4]->round_clock) ? 'disabled' : null }}/>

                                                        <span class="input-group-addon">
                                                            <i class="fa fa-minus"></i>
                                                        </span>
                                                        <input type="text" class="time end form-control" name="work_to[4]" value="{{ !empty($shop->workTime[4]) ? $shop->workTime[4]->work_to_format : null }}" {{ !empty($shop->workTime[4]) && !empty($shop->workTime[4]->round_clock) ? 'disabled' : null }}/>
                                                    </div>
                                                </div>
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="round-the-clock"  name="round_clock[4]" {{ !empty($shop->workTime[4]) && !empty($shop->workTime[4]->round_clock) ? 'checked' : null }}>
                                                        Круглосуточно
                                                        <span></span>
                                                    </label>
                                                </div>


                                                <div class="col-md-12">
                                                    <hr/>
                                                </div>

                                            </div>

                                            <div class="form-group m-form__group row datepair">
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox text-danger">

                                                        <input type="checkbox" class="work-day" name="work_day[5]" {{ !empty($shop->workTime[5]) && !empty($shop->workTime[5]->is_work) ? 'checked' : null }}>
                                                        СБ
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <div class="input-daterange input-group">

                                                        <input type="text" class="time start form-control m-input" name="work_from[5]" value="{{ !empty($shop->workTime[5]) ? $shop->workTime[5]->work_from_format : null }}" {{ !empty($shop->workTime[5]) && !empty($shop->workTime[5]->round_clock) ? 'disabled' : null }}/>

                                                        <span class="input-group-addon">
                                                            <i class="fa fa-minus"></i>
                                                        </span>
                                                        <input type="text" class="time end form-control" name="work_to[5]" value="{{ !empty($shop->workTime[5]) ? $shop->workTime[5]->work_to_format : null }}" {{ !empty($shop->workTime[5]) && !empty($shop->workTime[5]->round_clock) ? 'disabled' : null }}/>
                                                    </div>
                                                </div>
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="round-the-clock" name="round_clock[5]" {{ !empty($shop->workTime[5]) && !empty($shop->workTime[5]->round_clock) ? 'checked' : null }}>
                                                        Круглосуточно
                                                        <span></span>
                                                    </label>
                                                </div>


                                                <div class="col-md-12">
                                                    <hr/>
                                                </div>

                                            </div>

                                            <div class="form-group m-form__group row datepair">
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox text-danger">

                                                        <input type="checkbox" class="work-day" name="work_day[6]" {{ !empty($shop->workTime[6]) && !empty($shop->workTime[6]->is_work) ? 'checked' : null }}>
                                                        ВС
                                                        <span></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 col-md-9 col-sm-12">
                                                    <div class="input-daterange input-group" id="">

                                                        <input type="text" class="time start form-control m-input" name="work_from[6]" value="{{ !empty($shop->workTime[6]) ? $shop->workTime[6]->work_from_format : null }}" {{ !empty($shop->workTime[6]) && !empty($shop->workTime[6]->round_clock) ? 'disabled' : null }}/>

                                                        <span class="input-group-addon">
                                                            <i class="fa fa-minus"></i>
                                                        </span>
                                                        <input type="text" class="time end form-control" name="work_to[6]" value="{{ !empty($shop->workTime[6]) ? $shop->workTime[6]->work_to_format : null }}" {{ !empty($shop->workTime[6]) && !empty($shop->workTime[6]->round_clock) ? 'disabled' : null }}/>
                                                    </div>
                                                </div>
                                                <div class="col-form-label col-lg-1 col-sm-12 m-checkbox">
                                                    <label class="m-checkbox">

                                                        <input type="checkbox" class="round-the-clock" name="round_clock[6]" {{ !empty($shop->workTime[6]) && !empty($shop->workTime[6]->round_clock) ? 'checked' : null }}>
                                                        Круглосуточно
                                                        <span></span>
                                                    </label>
                                                </div>


                                                <div class="col-md-12">
                                                    <hr/>
                                                </div>

                                            </div>

                                        </div>

                                    </div>


                                </div>

                                <div class="tab-pane" id="shop_users" role="tabpanel">

                                    <div class="m-portlet__body">

                                        <h3 class="m-portlet__head-text">Руководители <span class="text-danger">*</span></h3>
                                        <span class="m-form__help">сотрудник принимающий решения по вопросам сотрудничества с floristum.ru</span>

                                        <div ng-repeat="item in usersDirector">

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    ФИО
                                                </label>
                                                <input type="text" class="form-control m-input" value="<% item.name %>" name="worker_director[<% $index %>][name]">
                                                <input type="hidden" name="worker_director[<% $index %>][id]" value="<% item.id %>">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    Телефон
                                                </label>
                                                <input type="text" class="form-control m-input phone" value="<% item.phone %>" phonemask name="worker_director[<% $index %>][phone]">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    Email
                                                </label>
                                                <input type="email" class="form-control m-input" value="<% item.email %>" name="worker_director[<% $index %>][email]">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label class="m-checkbox">

                                                    <input type="checkbox" value="1"  ng-checked="item.notify" name="worker_director[<% $index %>][notify]">
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


                                        <h3 class="m-portlet__head-text">Флористы-менеджеры <span class="text-danger">*</span></h3>
                                        <span class="m-form__help">исполнитель заказа</span>

                                        <div ng-repeat="item in usersFlorist">

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    ФИО
                                                </label>
                                                <input type="text" class="form-control m-input" value="<% item.name %>" name="worker_florist[<% $index %>][name]">
                                                <input type="hidden" name="worker_florist[<% $index %>][id]" value="<% item.id %>">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    Телефон
                                                </label>
                                                <input type="text" class="form-control m-input phone" value="<% item.phone %>" phonemask name="worker_florist[<% $index %>][phone]">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label for="">
                                                    Email
                                                </label>
                                                <input type="email" class="form-control m-input" value="<% item.email %>" name="worker_florist[<% $index %>][email]">
                                            </div>

                                            <div class="form-group m-form__group">
                                                <label class="m-checkbox">

                                                    <input type="checkbox" value="1"  ng-checked="item.notify" name="worker_florist[<% $index %>][notify]">
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
                                                                Стоимость доставки по городу, руб <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control m-input" value="{{ $shop->delivery_price }}" name="delivery_price">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group m-form__group datepair">
                                                            <label for="">
                                                                Время доставки, Часов:минут <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control m-input time" value="{{ $shop->delivery_time_format }}" name="delivery_time_format">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12" style="padding-top: 20px">
                                                <h3 class="m-portlet__head-text">Доставка загород &nbsp;&nbsp;<input data-switch="true" type="checkbox" {{ $shop->delivery_out ? 'checked="checked"' : null }} data-on-text="Да" data-off-text="Нет" data-on-color="success" id="delivery_out_city" name="delivery_out"></h3>


                                                <div class="row" id="delivery_out_city_container" style="{{ !$shop->delivery_out ? 'display: none;' : null }}">
                                                    <div class="col-md-6">
                                                        <div class="form-group m-form__group">
                                                            <label for="">
                                                                Максимально возможная удаленность, км <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control m-input" value="{{ $shop->delivery_out_max }}" name="delivery_out_max" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group m-form__group">
                                                            <label for="">
                                                                Стоимость доставки, руб/1 км <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control m-input" value="{{ $shop->delivery_out_price }}" name="delivery_out_price">
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
                                            <label for="org_name">
                                                Название
                                            </label>
                                            <input type="text" class="form-control m-input" id="org_name" value="{{ $shop->org_name }}" name="org_name">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="rs">
                                                Номер р/с
                                            </label>
                                            <input type="text" class="form-control m-input" id="rs" value="{{ $shop->rs }}" name="rs">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="bank">
                                                Банк
                                            </label>
                                            <input type="text" class="form-control m-input" id="bank" value="{{ $shop->bank }}" name="bank">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="bik">
                                                БИК
                                            </label>
                                            <input type="text" class="form-control m-input" id="bik" value="{{ $shop->bik }}" name="bik">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="ks">
                                                К/с
                                            </label>
                                            <input type="text" class="form-control m-input" id="ks" value="{{ $shop->ks }}" name="ks">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="inn">
                                                ИНН
                                            </label>
                                            <input type="text" class="form-control m-input" id="inn" value="{{ $shop->inn }}" name="inn">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="kpp">
                                                КПП
                                            </label>
                                            <input type="text" class="form-control m-input" id="kpp" value="{{ $shop->kpp }}" name="kpp">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="ogrn">
                                                ОГРН/ОГРНИП
                                            </label>
                                            <input type="text" class="form-control m-input" id="ogrn" value="{{ $shop->ogrn }}" name="ogrn">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="org_address">
                                                Юридический адрес
                                            </label>
                                            <input type="text" class="form-control m-input" id="org_address" value="{{ $shop->org_address }}" name="org_address">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="director">
                                                Директор или индивидуальный предприниматель
                                            </label>
                                            <input type="text" class="form-control m-input" id="director" value="{{ $shop->director }}" name="director">
                                        </div>
                                        <div class="form-group m-form__group">
                                            <label for="osnovanie">
                                                На основании
                                            </label>
                                            <select class="form-control m-input" id="osnovanie" name="osnovanie">
                                                <option value="устава" {{ $shop->osnovanie == 'устава' ? 'selected' : null}} >устава</option>
                                                <option value="свидетельства" {{ $shop->osnovanie == 'свидетельства' ? 'selected' : null}}>свидетельства</option>
                                            </select>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <span class="text-danger" style="font-size: 20px;">*</span> - поля обязательные к заполнению





                </div>

                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <button type="reset" class="btn btn-primary" id="save_profile" data-route="{{ route('admin.shop.update') }}">
                            Сохранить
                        </button>
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

    <script src="{{ asset('assets/admin/ng/shopProfile.js?v=1') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/shopProfile.js?v=1') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/plugins/jquery.timepicker/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datepair/datepair.js') }}"></script>
    <script src="{{ asset('assets/plugins/datepair/jquery.datepair.js') }}"></script>
    <script src="{{ asset('assets/admin/demo/default/custom/components/forms/widgets/bootstrap-switch.js') }}"></script>

    <script type="text/javascript">
        jsonData.address = {!! $shop->address->makeHidden(['created_at', 'updated_at', 'deleted_at'])->toJson() !!};
        jsonData.workerDirector = {!! $shop->workers()->where('position_id', 1)->get()->makeHidden(['created_at', 'updated_at', 'deleted_at'])->toJson() !!};
        jsonData.workerFlorist = {!! $shop->workers()->where('position_id', 2)->get()->makeHidden(['created_at', 'updated_at', 'deleted_at'])->toJson() !!};
    </script>
@stop