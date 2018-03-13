@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Создать спец. предложения
                            </h3>
                        </div>
                    </div>
                </div>
                <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('admin.specialOffers.store') }}">
                    {{ csrf_field() }}
                    <div class="m-portlet__body">
                        <div class="m-section">
                            <div class="m-section__content">

                                    <div class="form-group m-form__group">
                                        <label for="special_offer_name">
                                            Название
                                        </label>
                                        <input type="text" name="name" class="form-control m-input" id="special_offer_name" placeholder="Название" required>
                                    </div>

                                    <div class="form-group m-form__group">
                                        <label for="m_datepicker_1">
                                            Дата начала
                                        </label>
                                        <input type='text' class="form-control" name="date_from" id="m_datepicker_1" placeholder="Выберите дату" required/>
                                    </div>

                                    <div class="form-group m-form__group">
                                        <label for="m_datepicker_2">
                                            Дата окончания
                                        </label>
                                        <input type='text' class="form-control" name="date_to" id="m_datepicker_2" placeholder="Выберите дату" required/>
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
        $("#m_datepicker_1, #m_datepicker_2").datepicker({todayHighlight: true, format: 'yyyy-mm-dd', autoclose: true});
    </script>
@stop