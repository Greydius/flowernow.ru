@extends('layouts.admin')

@section('content')

    <div ng-controller="productsList" id="productsListContainer">

        @if($user->admin && isset($deletedProducts))
        <div class="row">
            <div class="col-sm-12">
                Кол-во удаленных-ранее одобренных букетов: {{ $deletedProducts }}
            </div>
        </div>
        @endif

        @if($user->admin)
            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ route('products.copy') }}">Копирование продуктов</a>
                </div>
            </div>
        @endif

        @if(
            true
            // $user->admin
            )
        <div class="row">


            <div class="col-sm-12">

                <form action="{{ route('admin.products.upload') }}" enctype="multipart/form-data" class="m-dropzone dropzone" id="myDropzone" style="min-height: auto">
                    {{ csrf_field() }}
                    <input type="hidden" id="isDop" name="isDop" value="<?=(int)$isDop?>">
                    <div class="m-dropzone__msg dz-message needsclick" style="    margin: 10px 0;">
                        <h3 class="m-dropzone__msg-title">
                            <div class="m-demo-icon__preview">
                                <i class="flaticon-add"></i>
                                <br>
                                Добавить новый <?=$isDop ? 'дополнительный' : ''?> товар
                            </div>
                        </h3>
                        <span class="m-dropzone__msg-desc">Нажмите сюда или перетащите картинку</span>
                    </div>
                </form>


            </div>

        </div>
        @endif

        <br>

        <div class="row">
            <div class="col-xl-12 order-2 order-xl-1">
                <div class="form-group m-form__group row align-items-center">
                    <div class="col-md-3">
                        <div class="m-input-icon m-input-icon--left">
                            <input type="text" class="form-control m-input m-input--solid" placeholder="Поиск..." id="m_form_search" ng-keypress="search($event)" value="" ng-model="search_str">
                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                <span>
                                    <i class="la la-search"></i>
                                </span>
                            </span>
                        </div>
                    </div>

                    @if(!$isDop)

                        <div class="col-md-3">
                            @if(
                                true
                            // $user->admin
                            )
                                <label class="m-checkbox m-checkbox--bold">
                                    <input type="checkbox" id="m_form_status" ng-change="changeStatusFilter()" ng-model="search_not_public">
                                    Не опубликованные
                                    <span></span>
                                </label>
                            @endif
                        </div>

                        @if(
                        true
                        // $user->admin
                        )
                        <div class="col-md-3">
                            <button type="button" class="btn btn-outline-warning m-btn m-btn--icon pull-right" data-toggle="modal" data-target="#m_modal_5">
                                <span>
                                    <i class="la la-arrows-v"></i>
                                    <span>
                                        Изменить все цены на...
                                    </span>
                                </span>
                            </button>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="row" ng-cloak>

            <div class="col-xl-3" ng-repeat="product in products" >

                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head" style="height: 40px; padding: 0 5px">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    <% product.name %>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <form class="m-form m-form--fit">

                        <div class="m-portlet__body" style="padding-top: 0; padding-bottom: 0;">
                            <div class="row">
                                <div class="col-xl-12 products-img-wraper">

                                    @if($user->isSupervisor())

                                    @endif
                                    @if($user->admin)
                                    <div class="products-btns" ng-show="product.shop">
                                        <a href ng-click="banProduct(product)" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Отклонить">
                                            <i class="fa flaticon-signs-2"></i>
                                        </a>

                                        <a href ng-click="approveProduct(product)" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Одобрить" ng-show="product.status != 1">
                                            <i class="fa flaticon-interface"></i>
                                        </a>

                                        @if(!$isDop)
                                            <a href ng-click="toDopProduct(product)" class="btn btn-outline-warning m-btn m-btn--icon m-btn--icon-only" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="В доп. товар">
                                                <i class="flaticon-background"></i>
                                            </a>
                                        @else
                                            <a href ng-click="toDopProduct(product)" class="btn btn-outline-warning m-btn m-btn--icon m-btn--icon-only" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="В основные товар">
                                                <i class="flaticon-background"></i>
                                            </a>
                                        @endif
                                    </div>
                                    @endif

                                    @if($user->isSupervisor())
                                        <a href  class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only" ng-click="starItem(0, product)"  bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="В топ" style="position: absolute; margin: 5px;" ng-show="product.star">
                                            <i class="la la-star"></i>
                                        </a>
                                        <a href  class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only" ng-click="starItem(1, product)"  bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="В топ" style="position: absolute; margin: 5px;" ng-show="!product.star">
                                            <i class="la la-star-o"></i>
                                        </a>

                                        <a href ng-click="banProduct(product)" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Отклонить" style="position: absolute; margin: 5px; top: 35px;">
                                            <i class="fa flaticon-signs-2"></i>
                                        </a>

                                        <a href ng-click="changeBlock(product)" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Изменить блок вывода" style="position: absolute; margin: 5px; top: 70px;">
                                            <i class="fa flaticon-signs-2"></i>
                                        </a>
                                        <a href ng-click="approveProduct(product)" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Одобрить" ng-show="product.status != 1"  style="position: absolute; margin: 5px; top: 105px;">
                                            <i class="fa flaticon-interface"></i>
                                        </a>
                                    @endif

                                    <span class="m-menu__link-badge product-id-badge">
                                        <span class="m-badge m-badge--accent m-badge--wide">
                                            id: <% product.id %>
                                        </span>
                                    </span>

                                        @if($user->admin)
                                            <span class="m-menu__link-badge product-spec-badge" ng-show="product.special_offer_id">
                                                <span class="m-badge m-badge--warning m-badge--wide">
                                                    Спец. предложение
                                                </span>
                                            </span>
                                        @endif

                                    <!--
                                    <a href ng-click="editItem($event, product)" style="display: block">
                                        <img ng-src="<% product.photoUrl %>" width="100%" />
                                    </a>
                                    -->
                                        <img ng-src="<% product.photoUrl %>" width="100%" />
                                </div>
                            </div>

                            <div class="row" ng-show="product.shop">
                                <div class="col-xl-12">
                                    <div style="    padding: 5px;">
                                        <div class="m-widget4__ext">
                                            <a href="#" class="m-widget4__icon m--font-brand">
                                                <i class="flaticon-interface-4"></i>
                                            </a>

                                            <% product.shop.name %>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row" style="min-height: 40px;">
                                <div class="col-xl-12">
                                    <div style="    padding: 5px; font-size: 12px">
                                        <div class="m-widget4__ext text-danger" ng-show="product.status == 0 && product.pause == 0">
                                            <!--
                                            <a href class="text-danger" ng-click="editItem($event, product)">
                                                Не заполнены обязательные поля <span style="font-size: 20px">*</span>
                                            </a>
                                            -->
                                            Не заполнены обязательные поля <span style="font-size: 20px">*</span>

                                        </div>

                                        <div class="m-widget4__ext text-success" ng-show="product.status == 2 && product.pause == 0">
                                            На проверке у администратора
                                        </div>

                                        <div class="m-widget4__ext text-success" ng-show="product.status == 1 && product.pause == 0">
                                            Опубликовано
                                        </div>

                                        <div class="m-widget4__ext text-danger" ng-show="product.status == 3 && product.pause == 0">
                                            <!--
                                            <a href class="text-danger" ng-click="editItem($event, product)" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="<% product.status_comment %>">
                                                Отклонено модератором <span class="m-badge m-badge--danger">i</span>
                                            </a>
                                            -->
                                            Отклонено модератором <span class="m-badge m-badge--danger">i</span>
                                        </div>

                                        <div class="m-widget4__ext text-warning" ng-show="product.pause == 1">
                                            На паузе
                                        </div>
                                        <div class="admin-product-price"><% product.fullPrice %><span class="admin-product-price__currency">₽</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions" style="padding: 5px;">
                                @if($user->admin
                                    || $user->created_at > '2019-08-03'
                                    || $user->isSupervisor()
                                )
                                    <a href  class="btn btn-outline-info m-btn m-btn--icon m-btn--icon-only" ng-click="editItem($event, product)"  bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Редактировать">
                                        <i class="la la-pencil"></i>
                                    </a>
                                    @if($user->admin)
                                        <a href  class="btn btn-outline-info m-btn m-btn--icon m-btn--icon-only" ng-click="editImages($event, product)"  bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Редактировать">
                                            <i class="la la-pencil"></i>
                                        </a>
                                    @endif

                                    <a href  class="btn btn-outline-warning m-btn m-btn--icon m-btn--icon-only"  ng-click="pauseItem(1, product)" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Пауза (временно убрать с продажи)" ng-show="!product.pause">
                                        <i class="la la-pause"></i>
                                    </a>
                                    <a href  class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only" ng-click="pauseItem(0, product)"  bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Возобновить продажу" ng-show="product.pause">
                                        <i class="la la-play"></i>
                                    </a>
                                    <a href  class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only pull-right" ng-click="deleteItem(product)"  bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Удалить">
                                        <i class="la la-times-circle-o"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                    </form>

                </div>

            </div>


        </div>

        <div class="m-datatable--default m-datatable" ng-cloak>
            <div class="m-datatable__pager m-datatable--paging-loaded clearfix" style="margin-top: 0">

                <ul class="m-datatable__pager-nav">
                    <li ng-show="currentPage > 1"><a ng-click="getProductsPage(currentPage-1)" title="Previous" class="m-datatable__pager-link m-datatable__pager-link--prev" data-page="5"><i class="la la-angle-left"></i></a></li>
                    <li ng-repeat="n in ranges(1,totalPages)">
                        <a ng-click="getProductsPage(n)" class="m-datatable__pager-link m-datatable__pager-link-number <% currentPage == n ? 'm-datatable__pager-link--active' : '' %>" data-page="<% n %>"><% n %></a>
                    </li>
                    <li ng-show="currentPage < totalPages"><a ng-click="getProductsPage(currentPage+1)" title="Next" class="m-datatable__pager-link m-datatable__pager-link--next" data-page="7"><i class="la la-angle-right"></i></a></li>
                </ul>

            </div>
        </div>
    </div>


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

                            <div class="form-group m-form__group" style="position: relative">

                                <span style="font-size: 10px; padding-bottom: 10px; display: block;" ng-show="photos.length > 1">Для изменения очередности - переставте фото в нужном порядке</span>

                                <div class="row product-photos">
                                    <div class="photo-preloader"><div></div></div>
                                    <div class="col-md-2 product-photos-container" style="width: 80px; height: 80px" ng-repeat="photo in photos | orderBy:'priority'">
                                        <img ng-src="<% product.photoUrl %>" width="100%" style="margin-bottom: 10px" data-photo-id="<% photo.id %>">
                                        <button class="delete_photo close" data-id="<% photo.id %>" ng-show="photos.length > 1" ng-click="deletePhoto(photo)">×</button>
                                    </div>

                                    @if(!$isDop)
                                        <div class="col-md-2" id="droparea">
                                            <button class="btn btn-outline-metal m-btn m-btn--icon m-btn--icon-only- btn-block upload-photo-btn" style="height: 50px; line-height: 28px; ">
                                                <i class="la la-plus"></i>
                                            </button>
                                        </div>
                                    @endif

                                </div>

                            </div>

                            <input type="hidden" name="product_id" ng-model="item.id"  value="<% item.id %>">

                            <div class="form-group m-form__group">
                                <label for="edit-product-name">
                                    Название <span class="text-danger must-have">*</span>
                                </label>
                                <input type="text" class="form-control form-control-sm m-input" id="edit-product-name" ng-model="item.name" placeholder="Название">
                            </div>

                            <div class="form-group m-form__group">
                                <div class="row">
                                    <div class="col-md-{{ !$isDop ? '6' : '12' }}">
                                        <label for="edit-product-price">
                                            Цена (<span class="red-bold-text">включая коммисию {{ config('settings.product_commission') }}%</span>) <span class="text-danger must-have">*</span>
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control form-control-sm m-input" ng-model="item.price" placeholder="Цена букета без доставки, ₽" id="edit-product-price">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="fa fa-rub"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <div>
                                          <div>
                                          +<% item.shop.delivery_price %> ₽ доставка 
                                          @if($user->admin)
                                            (<a href="/admin/shop/<% item.shop.id %>#delivery">изменить</a>)
                                          @else
                                            (<a href="/admin/shop#delivery">изменить</a>)
                                          @endif
                                          </div>
                                          <div ng-show="item.price" style="padding-left: 15px;">Покупатель оплатит:</div>
                                          <div ng-show="item.price"><b style="font-weight: 600;">= <% getTotal(item) %>₽</b> (<span class="red-bold-text">включая коммисию {{ config('settings.product_commission') }}% : (<% getTotalPercent(item, {{ config('settings.product_commission') }}) %> ₽)</span>)</div>
                                        </div>
                                    </div>

                                    @if(!$isDop)

                                        <div class="col-md-6">
                                            <label for="edit-product-make-time">
                                                Время изготовления <span class="text-danger must-have">*</span>
                                            </label>
                                            <select class="form-control form-control-sm" ng-model="item.make_time" ng-options="time.value as time.name for time in times"></select>
                                        </div>

                                    @endif
                                </div>

                            </div>

                            @if(!$isDop)

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

                                <div class="form-group form-group-sm m-form__group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="edit-product-price">
                                                Состав
                                            </label>

                                            <div class="row  m--margin-bottom-5" ng-repeat="composition in item.compositions">
                                                <div class="col-md-8">
                                                    <div class="input-group input-group-sm">
                                                        <select class="form-control form-control-sm input-sm " data--maximum-selection-length="1"  ng-model="composition.flower_id" ng-options="flower.id as flower.name for flower in flowers">
                                                            <option value="">Выбрать состав</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">

                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control m-input" ng-model="composition.qty" placeholder="Кол-во">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-danger" type="button" ng-click="deleteComposition(composition)">
                                                                <i class="fa fa-close"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <a class="btn btn-outline-success btn-sm 	m-btn m-btn--icon" ng-click="addComposition()">
                                                <span>
                                                    <i class="la la-plus"></i>
                                                    <span>
                                                        Добавить в состав
                                                    </span>
                                                </span>
                                            </a>
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

                                @if($user->admin)
                                    <div class="form-group m-form__group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="edit-product-height">
                                                    Участвует в спец. предложении
                                                </label>
                                                <div class="m-checkbox-list">
                                                    <div ng-repeat="specialOffer in specialOffers">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" name="specialOffer[]" ng-checked="itemSpecialOffers.indexOf(specialOffer.id.toString()) >= 0" value="<% specialOffer.id %>">
                                                            <% specialOffer.name %>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                @endif

                            @endif

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



    <script type="text/ng-template" id="delete-item-modal.html">
        <div class="modal fade" id="m_modal_1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Внимание
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Вы действительно хотите удалить данный товар?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Закрыть
                        </button>
                        <button type="button" class="btn btn-danger" ng-click="save(item)">
                            Удалить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </script>

    <script type="text/ng-template" id="ban-item-modal.html">
        <div class="modal fade" id="m_modal_1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Отклонить товар?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea  class="form-control" ng-model="item.status_comment" rows="6" placeholder="Укажите причину отклонения товара"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Закрыть
                        </button>
                        <button type="button" class="btn btn-danger" ng-click="save(item)">
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </script>

    @if($user->isSupervisor())
    <script type="text/ng-template" id="block-item-modal.html">
        <div class="modal fade" id="m_modal_1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Блок на главной
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select class="form-control form-control-sm input-sm " data--maximum-selection-length="1"  ng-model="item.block_id" ng-options="block.id as block.name for block in blocks">
                            <option value="">Выбрать блок на главной</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Закрыть
                        </button>
                        <button type="button" class="btn btn-danger" ng-click="save(item)">
                            Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </script>
    @endif

    <!--begin::Modal-->
    <div class="modal fade" id="m_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Изменение цены
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">
                            &times;
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('admin.products.changePrice') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="input-group m-input-group m-input-group--square">
                                <input type="text" class="form-control m-input" placeholder="" name="percent">
                                <span class="input-group-addon" id="basic-addon1">
                                    %
                                </span>
                            </div>
                            <span class="m-form__help">
                                Если значение со знаком минус - цена товаров уменьшится
                            </span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="button" class="btn btn-primary" id="change_price">
                        Изменить
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->

    <script type="text/ng-template" id="edit-images-modal.html">
        <div class="modal fade" id="m_modal_1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">
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

                            <div class="form-group m-form__group" style="position: relative">

                                <div class="row product-photos">
                                    <div class="photo-preloader"><div></div></div>
                                    <div class="col-md-12" ng-repeat="photo in photos | orderBy:'priority'">
                                        <a href  class="btn btn-outline-info m-btn m-btn--icon m-btn--icon-only" ng-click="rotatePhoto(photo, item)"  bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Перевернуть">
                                            <i class="fa fa-undo"></i>
                                        </a>
                                        <img ng-src="<% product.photoUrl %>" width="100%" style="margin-bottom: 10px" data-photo-id="<% photo.id %>">
                                    </div>

                                </div>

                            </div>

                            <input type="hidden" name="product_id" ng-model="item.id"  value="<% item.id %>">

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Закрыть
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </script>


@endsection

@section('head')
    <style>
        .highlight {
            border: 1px dashed #ebedf2;
            font-weight: bold;
            font-size: 45px;
            background-color: #eaeaea;
            height: 50px;
            width: 50px;
            margin-right: 15px;
            margin-left: 15px;
        }

        .delete_photo {
                position: absolute;
                top: -5px;
                right: 0;
                cursor: pointer;
        }

        .admin-product-price {
            text-align: right;
            padding-right: 15px;
            font-size: 24px;
            font-weight: 600;
        }

        .admin-product-price__currency {
          font-size: 14px;
          vertical-align: bottom;
        }

        .red-bold-text {
          color: #f4516c;
          font-weight: 600;
          vertical-align: middle;
          font-size: 8.5px;
        }
    </style>
@stop

@section('footer')
    <script src="{{ asset('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/products-list.js?v='.rand(1, 9999)) }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/ng/productsList.js?v='.rand(1, 9999)) }}" type="text/javascript"></script>
    <script type="text/javascript">
            jsonData.productTypes = {!! $productTypes->toJson() !!};
            jsonData.colors = {!! $colors->toJson() !!};
            jsonData.flowers = {!! $flowers->toJson() !!};
            jsonData.blocks = {!! !empty($blocks) ? $blocks->toJson() : '[]' !!};
            jsonData.times = {!! json_encode($times) !!};
            jsonData.specialOffers = {!! json_encode($specialOffers) !!};
            routes.productUpdate = '{{ route('admin.products.update')  }}';
            jsonData.searchStr = {!! json_encode(app('request')->input('s')) !!};
    </script>
@stop