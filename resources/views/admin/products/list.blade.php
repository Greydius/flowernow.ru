@extends('layouts.admin')

@section('footer')
    <script src="{{ asset('assets/admin/js/products-list.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/ng/productsList.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        jsonData.productTypes = {!! $productTypes->toJson() !!};
        jsonData.colors = {!! $colors->toJson() !!};
        jsonData.flowers = {!! $flowers->toJson() !!};
        jsonData.times = {!! json_encode($times) !!};
        routes.productUpdate = '{{ route('admin.products.update')  }}';
    </script>
@stop

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

                        <div class="m-portlet__body" style="padding-top: 0;">
                            <div class="row">
                                <div class="col-xl-12">
                                    <img ng-src="/uploads/products/632x632/<% product.shop_id %>/<% product.photo %>" width="100%" />
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
                        </div>

                        <div class="m-portlet__foot m-portlet__foot--fit">
                            <div class="m-form__actions" style="    padding: 5px;">
                                <button type="reset" class="btn btn-secondary btn-sm" ng-click="editItem($event, product)">
                                    <i class="flaticon-edit"></i> Редактировать
                                </button>
                                <button type="reset" class="btn btn-secondary btn-sm">
                                    <i class="flaticon-circle"></i> Удалить
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

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


@endsection