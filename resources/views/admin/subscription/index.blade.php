@extends('layouts.admin')

@section('content')

<div>


    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        Рассылки
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">

            <a href="{{ route('admin.subscription.create') }}" class="btn btn-outline-success m-btn m-btn--icon">
                            <span>
                                <i class="la la-plus"></i>
                                <span>
                                    Разовая рассылка
                                </span>
                            </span>
            </a>

            <a href="{{ route('admin.subscription.create2') }}" class="btn btn-outline-success m-btn m-btn--icon">
                            <span>
                                <i class="la la-plus"></i>
                                <span>
                                    Ежедневная рассылка
                                </span>
                            </span>
            </a>

            <br><br>

            <div class="table-responsive">
                <table class="table table-bordered table-hover" style="min-width: 972px;">
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th>Тип</th>
                            <th>Создано/Отправлено</th>
                            <th>Действия</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($subscriptions as $subscription)
                            <tr>
                                <td>{{ $subscription->name }}</td>
                                <td>{{ $subscription->start_time ? 'ежедневная' : 'разовая' }}</td>
                                <td>{{ $subscription->subscriptionList()->count() }}/{{ $subscription->subscriptionList()->where('send', 1)->count() }}</td>
                                <td>

                                    @if($subscription->active)
                                        <button class="btn btn-outline-warning m-btn m-btn--icon m-btn--icon-only"  data-toggle="modal" data-target="#pause" data-id="{{ $subscription->id }}">
                                            <i class="la la-pause"></i>
                                        </button>
                                    @else
                                        <button  class="btn btn-outline-success m-btn m-btn--icon m-btn--icon-only" data-toggle="modal"  data-target="#play" data-id="{{ $subscription->id }}">
                                            <i class="la la-play"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>


<div class="modal fade" id="play" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('admin.subscription.run') }}">
            <input type="hidden" value="" name="id">
            {{ csrf_field() }}
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
                    Вы действительно хотите запустить рассылку?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Закрыть
                    </button>
                    <button type="submit" class="btn btn-success">
                        Запустить
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="pause" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('admin.subscription.pause') }}">
            <input type="hidden" value="" name="id">
            {{ csrf_field() }}
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
                Вы действительно хотите приостановить рассылку?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Закрыть
                </button>
                <button type="submit" class="btn btn-danger">
                    Остановить
                </button>
            </div>
        </div>
        </form>
    </div>
</div>





@endsection

@section('footer')
    <script>
        $(document).on('shown.bs.modal', '#play, #pause', function(event) {
                var button = $(event.relatedTarget);
                $('[name="id"]', this).val(button.data('id'));
        });
    </script>
@stop