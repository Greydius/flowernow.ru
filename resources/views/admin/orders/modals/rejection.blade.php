<div class="modal fade" id="rejection_modal" role="dialog" aria-labelledby="rejection_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejection_modalLabel">
                    Внимание
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                </button>
            </div>
            <div class="modal-body">
                Вы действительно хотите отказаться от данного заказа?<br>Заказ будет передан другому магазину и это может негативно сказаться на Вашем рейтинге!
                <form method="post" action="{{ route('admin.order.update', ['id' => $order->id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" value="1" name="rejection">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Нет
                </button>
                <button type="button" class="btn btn-danger" onclick="$(this).parents('.modal').find('form').submit()">
                    Да
                </button>
            </div>
        </div>
    </div>
</div>