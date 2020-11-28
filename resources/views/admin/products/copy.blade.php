@extends('layouts.admin')

@section('content')

    <h3 class="m-portlet__head-text">
        Копировать товары
    </h3>

    <div class="row">
        <div class="col-sm-12">

                <form action="{{ route('products.copyProcess') }}" enctype="multipart/form-data" method="post">
                    {{ csrf_field() }}
                    <div class="row">

                            <div class="col-md-5">
                                <select class="form-control" name="from_shop_id">
                                    <option value="">С магазина</option>
                                    @foreach($shops as $shop)
                                        <option value="{{ $shop->id }}">{{ $shop->id .' '. $shop->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <select class="form-control" name="to_shop_id">
                                    <option value="">В магазин</option>
                                    @foreach($shops as $shop)
                                        <option value="{{ $shop->id }}">{{ $shop->id .' '. $shop->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-2">
                                <input type="submit" value="Копировать" class="form-control btn-info">
                            </div>

                    </div>

                </form>
        </div>
    </div>

@endsection

@section('head')
@stop

@section('footer')
@stop