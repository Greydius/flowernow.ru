@extends('layouts.admin')

@section('content')

    @if($user->admin)
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.product.single-stat') }}" class="btn btn-info">Заполненность поштучных</a>
                <br><br>
            </div>
        </div>
    @endif

    <div class="row">

        @foreach($products as $product)
            <div class="col-xl-3">

                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head" style="height: 40px; padding: 0 5px">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    {{ $product->name }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <form class="m-form m-form--fit">

                        <div class="m-portlet__body" style="padding-top: 0; padding-bottom: 0;">
                            <div class="row">
                                <div class="col-xl-12 products-img-wraper">

                                    <a href="{{ route('products.single.category', ['parent_id' => $product->id]) }}" style="display: block">
                                        <img ng-src="/uploads/single/{{ $product->photo }}" width="100%" />
                                    </a>
                                </div>
                            </div>
                        </div>


                    </form>

                </div>

            </div>

            @endforeach
    </div>

@endsection

@section('head')

@stop

@section('footer')
    <script src="{{ asset('assets/admin/ng/single.js?v='.rand(1, 9999)) }}" type="text/javascript"></script>
    <script type="text/javascript">
        jsonData.products = {!! $products->toJson() !!};
    </script>
@stop