@extends('layouts.admin')

@section('content')

    <div class="m-portlet m-portlet--mobile" ng-controller="shopsList">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Статистика по заполнению поштучеых
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <!--begin: Search Form -->
            <div class="m-form m-form--label-align-right  m--margin-bottom-30">
                <div class="row align-items-center">
                    <div class="col-xl-12 order-2 order-xl-1">
                        <div class="form-group m-form__group row align-items-center">
                            <div class="col-md-4">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input m-input--solid" placeholder="Поиск..." id="m_form_search" ng-keypress="search($event)">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                        <span>
                                            <i class="la la-search"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end: Search Form -->
            <!--begin: Datatable -->
            <div >



                <div class="table-responsive" style="width: 100%; overflow-x: scroll">
                    <table style=" width: 100%" class="table table-bordered">
                        <thead class="">
                            <tr class="m-datatable__row" style="height: 53px;">
                                <th>id</th>
                                <th>Название</th>
                                @foreach($singles as $single)
                                    <th>{{ $single->name }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="" style="">
                            @foreach($shops as $shop)

                                <tr>
                                    <td>{{ $shop->id }}</td>
                                    <td>{{ $shop->name }}<br>{{ $shop->city->name }}</td>
                                    @foreach($singles as $single)
                                        <th>
                                            {{ (isset($products[$shop->id]) && isset($products[$shop->id][$single->id])) ? $products[$shop->id][$single->id] : '' }}
                                        </th>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $shops->links() }}

            </div>
            <!--end: Datatable -->
        </div>
    </div>



@endsection

@section('head')
@stop

@section('footer')
    <script src="{{ asset('assets/admin/ng/shopsList.js?v=1') }}" type="text/javascript"></script>
    <script type="text/javascript">
        routes.shopsList = '{{ route('admin.api.shops.list')  }}';
    </script>
@stop