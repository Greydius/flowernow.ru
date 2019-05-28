@extends('layouts.admin')

@section('content')

    <div>


        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Директ @if($city) (г. {{ $city->name }}) @endif
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">

                <div class="row">
                    <div class="col-md-4">
                        <form action="" method="get" class="m-form m-form--fit m-form--label-align-right">
                            <select class="form-control" name="cityId" onchange="this.form.submit()">
                                <option value="0">Выберите город</option>
                                @foreach($cities as $key => $_city)
                                    <option value="{{ $_city->id }}" {{ !empty($city) && $city->id == $_city->id ? 'selected' : '' }}>{{ $key+1 }}. {{ $_city->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>

                <br>

                <div class="table-responsive">



                    <table class="table table-bordered table-hover" style="min-width: 972px;">
                        <thead>
                        <tr>
                            <th>URL</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(!empty($direct_url))
                            @foreach($direct_url as $item)
                                @if($item['products_count'] > 6)
                                    <tr>
                                        <td><a target="_blank" href="http://{{ $city->slug != 'moskva' ? $city->slug.'.' : '' }}floristum.ru/{{ $item['url'] }}">{{ $city->slug != 'moskva' ? $city->slug.'.' : '' }}floristum.ru/{{ $item['url'] }}</a></td>
                                        <td>
                                            <form method="post" action="/admin/direct/update/">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="cityId" value="{{ $city->id }}">
                                                <input type="checkbox" value="1" name="direct_check" class="direct_check" data-id="{{ $item['id'] }}" data-cityId="{{ $city->id }}" {{ $item['checked'] ? 'checked' : '' }}>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>




            </div>
        </div>

    </div>






@endsection

@section('footer')
    <script src="{{ asset('assets/admin/js/direct.js') }}"></script>
@stop