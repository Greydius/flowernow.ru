$(document).ready(function(){
        $(document).on('click', '#create_request', function () {

                var $modal = $('#request_modal');

                $form = $('form', $modal);

                $form.submit();

                return false;
        }).on('submit', '#request_modal form', function () {

                var $modal = $('#request_modal');

                $modal.modal('hide');

                $form = $('form', $modal);

                $.ajax({
                        url: $form.attr('action'),
                        type: 'post',
                        data: $form.serialize(),
                        success: function (data) {
                                window.location.reload(false);
                        },
                        error: function (data) {
                                toastr.error('Ошибка создания запроса');
                        }
                });

                return false;
        })
});