@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Спец. предложения
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-section">
                        <div class="m-section__content">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            Название
                                        </th>
                                        <th>
                                            Дата начала
                                        </th>
                                        <th>
                                            Дата окончания
                                        </th>
                                        <th>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($specialOffers as $offers)
                                        <tr>
                                            <td>
                                                {{ $offers->name }}
                                            </td>
                                            <td>
                                                {{ $offers->date_from }}
                                            </td>
                                            <td>
                                                {{ $offers->date_to }}
                                            </td>
                                            <td class="text-right">
                                                <button type="button" class="btn btn-danger m-btn m-btn--icon m-btn--icon-only delete-offer-btn" data-id="{{ $offers->id }}" data-toggle="tooltip" title="" data-original-title="Удалить">
                                                    <i class="la la-close"></i>
                                                </button>
                                                <a href="{{ route('admin.specialOffers.edit', ['id' => $offers->id]) }}" class="btn btn-info m-btn m-btn--icon m-btn--icon-only" data-toggle="tooltip" title="" data-original-title="Редактировать">
                                                    <i class="la la-pencil"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit m-form">
                    <div class="m-form__actions">
                        <a href="{{ route('admin.specialOffers.create') }}" class="btn btn-outline-success m-btn m-btn--icon">
                            <span>
                                <i class="la la-plus"></i>
                                <span>
                                    Добавить
                                </span>
                            </span>
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="delete_confirm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <p>
                        Вы действительно хотите удалить данное спец. предложение?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="button" class="btn btn-danger" id="delete-offer">
                        Удалить
                    </button>
                </div>
            </div>
        </div>
    </div>
<!--end::Modal-->
@endsection

@section('head')
@stop

@section('footer')
    <script src="{{ asset('assets/admin/js/specialOffers.js') }}" type="text/javascript"></script>
@stop