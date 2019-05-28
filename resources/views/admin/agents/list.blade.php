@extends('layouts.admin')

@section('content')

    <div>


        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Представители
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="min-width: 972px;">
                        <thead>
                        <tr>
                            <th>Город</th>
                            <th>Магазин</th>
                            <th>Webmaster</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($cities as $city)
                            <tr>
                                <td>{{ $city->name }}</td>
                                <td>{!! !empty($city->agent) ? '<a href="'.route('admin.shop.profile_edit', ['id' => $city->agent->shop->id]).'">'.$city->agent->shop->name.' (id:'.$city->agent->shop->id.')</a><br>'.$city->name.', '.(count($city->agent->shop->address) ? $city->agent->shop->address[0]->name : '') : ''!!}</td>
                                <td>@if(!empty($city->agent) && !empty($city->agent->webmaster)) <span class="m-badge m-badge--success m-badge--wide">установлен</span> @endif</td>
                                <td>
                                    <a href="{{ route('admin.agent.edit', ['city_id' => $city->id]) }}" class="btn btn-outline-accent m-btn m-btn--icon m-btn--icon-only">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>




            </div>
        </div>

    </div>






@endsection

@section('footer')
@stop