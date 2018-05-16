$(document).ready(function() {
        $('#status_modal').on('show.bs.modal', function (e) {
                var $invoker = $(e.relatedTarget);
                var $form = $(this).find('form');
                $form.attr('action', '/admin/invoices/changeStatus/' + $invoker.data('id'));
        });

        $(document).on('submit', '#status_modal form', function () {

                $form = $(this);
                $btn = $('#status_modal [type="submit"]');
                $btn.prop('disabled', true);

                $.ajax({
                        url: $form.attr('action'),
                        type: 'post',
                        data: $form.serialize(),
                        success: function (data) {
                                window.location.reload(false);
                        },
                        error: function (data) {
                                toastr.error('Ошибка');
                                $btn.prop('disabled', false);
                        }
                });
                return false;
        })
});