@extends('layouts.admin')

@section('footer')

    <script src="{{ asset('assets/admin/ng/shopProfile.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/shopProfile.js') }}" type="text/javascript"></script>
@stop

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

                    <ul class="nav nav-tabs  m-tabs-line m-tabs-line--brand" role="tablist">
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_tabs_6_1" role="tab">
                                <i class="flaticon-interface-4"></i>
                                Название и лого
                            </a>
                        </li>
                        <li class="nav-item dropdown m-tabs__item">
                            <a class="nav-link m-tabs__link" href="#m_address" role="tab" data-toggle="tab">
                                <i class="flaticon-placeholder-2"></i>
                                Адрес
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_tabs_6_3" role="tab">
                                <i class="flaticon-multimedia"></i>
                                Logs
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_tabs_6_1" role="tabpanel">


								<div class="m-portlet__body">

                                    <div class="form-group m-form__group">
                                        <label for="shop_name">
                                            Название
                                        </label>
                                        <input type="text" class="form-control m-input" id="shop_name" value="{{ $shop->name }}" disabled>
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

                                </div>


                        </div>
                        <div class="tab-pane" id="m_address" role="tabpanel">

                            <div class="m-portlet__body">

                                    <div class="form-group m-form__group">
                                        <label for="shop_name">
                                            Город
                                        </label>
                                        <input type="text" class="form-control m-input"  value="{{ $shop->city->name }}" disabled>
                                    </div>


                            </div>

                        </div>
                        <div class="tab-pane" id="m_tabs_6_3" role="tabpanel">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection