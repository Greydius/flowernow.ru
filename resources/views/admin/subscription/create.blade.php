@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Создать разовую рассылку
                            </h3>
                        </div>
                    </div>
                </div>
                <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('admin.subscription.store') }}">
                    {{ csrf_field() }}
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">

                                    <div class="form-group m-form__group">
                                        <label for=name">
                                            Название
                                        </label>
                                        <input type="text" name="name" class="form-control m-input" id="name" placeholder="Название" required>
                                    </div>

                                    <div class="form-group m-form__group">
                                        <label for=name">
                                            Города
                                        </label>
                                        <select class="form-control m-selyect2" id="m_select2_3" name="cities[]" multiple="multiple" required>
                                            @foreach($cities as $city)
                                                <option value="{{ $city->city_id }}">{{ $city->name.' ('.$city->region.')' }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group m-form__group">
                                        <label for=message">
                                            Сообщение
                                        </label>
                                        <textarea required name="message" id="message" class="form-control" rows="5"></textarea>
                                    </div>

                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <button type="submit" class="btn btn-outline-success m-btn m-btn--icon">
                            <span>
                                <i class="la la-check"></i>
                                <span>
                                    Сохранить
                                </span>
                            </span>
                        </button>
                        <p class="text-muted">После сохранения, рассылку надо запустить</p>
                    </div>
                </div>
                </form>


            </div>
        </div>
    </div>
@endsection

@section('head')
@stop

@section('footer')
    <script>
        //$("#m_datepicker_1, #m_datepicker_2").datepicker({todayHighlight: true, format: 'yyyy-mm-dd', autoclose: true});
        $("#m_select2_3").select2();
    </script>
@stop