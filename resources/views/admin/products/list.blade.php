@extends('layouts.admin')

@section('content')

    <div ng-controller="productsList" id="productsListContainer">

        <div class="row">


            <div class="col-sm-12">

                <form action="{{ route('admin.products.upload') }}" enctype="multipart/form-data" class="m-dropzone dropzone" id="myDropzone" style="min-height: auto">
                    {{ csrf_field() }}
                    <div class="m-dropzone__msg dz-message needsclick" style="    margin: 10px 0;">
                        <h3 class="m-dropzone__msg-title">
                            <div class="m-demo-icon__preview">
                                <i class="flaticon-add"></i>
                                <br>
                                Добавить новый товар
                            </div>
                        </h3>
                        <span class="m-dropzone__msg-desc">Нажмите сюда или перетащите картинку</span>
                    </div>
                </form>


            </div>

        </div>

        <br>

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
                                    <div class="products-btns" ng-show="product.shop">
                                        <a href ng-click="banProduct(product)" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Бан">
                                            <i class="fa flaticon-signs-2"></i>
                                        </a>

                                        <a href ng-click="approveProduct(product)" class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="Одобрить" ng-show="product.status != 1">
                                            <i class="fa flaticon-interface"></i>
                                        </a>
                                    </div>
                                    <a href ng-click="editItem($event, product)" style="display: block">
                                        <img ng-src="<% product.photoUrl %>" width="100%" />
                                    </a>
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
                                    <div style="    padding: 5px; font-size: 10px">
                                        <div class="m-widget4__ext text-danger" ng-show="product.status == 0">
                                            <a href class="text-danger" ng-click="editItem($event, product)">
                                                Не заполнены обязательные поля <span style="font-size: 20px">*</span>
                                            </a>

                                        </div>

                                        <div class="m-widget4__ext text-success" ng-show="product.status == 2">
                                            На проверке у администратора
                                        </div>

                                        <div class="m-widget4__ext text-success" ng-show="product.status == 1">
                                            Опубликовано
                                        </div>

                                        <div class="m-widget4__ext text-danger" ng-show="product.status == 3">
                                            <a href class="text-danger" ng-click="editItem($event, product)">
                                                Отклонено модератором
                                            </a>

                                            <span class="m-badge m-badge--danger" bs-tooltip data-toggle="tooltip" data-placement="top" data-original-title="<% product.status_comment %>" ng-show="product.status_comment">?</span>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions" style="padding: 5px;">
                                <button type="reset" class="btn btn-secondary btn-sm" ng-click="editItem($event, product)">
                                    <i class="flaticon-edit"></i> Редактировать
                                </button>
                                <button type="reset" class="btn btn-secondary btn-sm pull-right" ng-click="deleteItem(product)">
                                    <i class="flaticon-circle"></i> Удалить
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

            <div class="col-md-12" style="min-height: 30px;">

                <button ng-click="getProductsPage(prev_page)" title="Предыдущая страница" data-href="<% prev_page %>" type="button" class="btn m-btn--square  btn-outline-info btn-sm pull-left" ng-show="prev_page">
                    <i class="la la-angle-left"></i>
                </button>

                <button ng-click="getProductsPage(next_page)" title="Следующая страница" type="button" class="btn m-btn--square  btn-outline-info btn-sm pull-right" ng-show="next_page">
                    <i class="la la-angle-right"></i>
                </button>

            </div>

        </div>
    </div>


    <script type="text/ng-template" id="edit-item-modal.html">
        <div class="modal fade" id="m_modal_1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Редактирование
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>

                            <div class="form-group m-form__group">

                                <span style="font-size: 10px; padding-bottom: 10px; display: block;" ng-show="photos.length > 1">Для изменения очередности - переставте фото в нужном порядке</span>

                                <div class="row product-photos">
                                    <div class="col-md-2 product-photos-container" style="width: 80px; height: 80px" ng-repeat="photo in photos | orderBy:'priority'">
                                        <img ng-src="<% item.photoUrl %>" width="100%" style="margin-bottom: 10px" data-photo-id="<% photo.id %>">
                                        <button class="delete_photo close" data-id="<% photo.id %>" ng-show="photos.length > 1" ng-click="deletePhoto(photo)">×</button>
                                    </div>

                                    <div class="col-md-2" id="droparea">
                                        <button class="btn btn-outline-metal m-btn m-btn--icon m-btn--icon-only- btn-block upload-photo-btn" style="height: 50px; line-height: 28px; ">
                                            <i class="la la-plus"></i>
                                        </button>
                                    </div>

                                </div>

                            </div>

                            <input type="hidden" name="product_id" ng-model="item.id"  value="<% item.id %>">

                            <div class="form-group m-form__group">
                                <label for="edit-product-name">
                                    Название
                                </label>
                                <input type="text" class="form-control form-control-sm m-input" id="edit-product-name" ng-model="item.name" placeholder="Название">
                            </div>

                            <div class="form-group m-form__group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="edit-product-price">
                                            Цена
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
                                            Время изготовления
                                        </label>
                                        <select class="form-control form-control-sm" ng-model="item.make_time" ng-options="time.value as time.name for time in times"></select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group m-form__group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="edit-product-width">
                                            Ширина, см
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
                                            Высота, см
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
                                            Тип букета
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
                                                <select class="form-control form-control-sm input-sm m-select2 select2b" select2 ng-model="composition.flower_id" ng-options="flower.id as flower.name for flower in flowers">
                                                    <option value="">Название</option>
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
                                            Описание
                                        </label>
                                        <textarea class="form-control" ng-model="item.description" rows="6"></textarea>
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
                            Забанить товар?
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea  class="form-control" ng-model="item.status_comment" rows="6" placeholder="Укажите причину бана товара"></textarea>
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
    </style>
@stop

@section('footer')
    <script src="{{ asset('assets/plugins/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/products-list.js?v=2') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/ng/productsList.js?v=3') }}" type="text/javascript"></script>
    <script type="text/javascript">
        jsonData.productTypes = {!! $productTypes->toJson() !!};
        jsonData.colors = {!! $colors->toJson() !!};
        jsonData.flowers = {!! $flowers->toJson() !!};
        jsonData.times = {!! json_encode($times) !!};
        routes.productUpdate = '{{ route('admin.products.update')  }}';
    </script>
@stop