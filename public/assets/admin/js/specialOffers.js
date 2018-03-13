$(document).ready(function() {
        $(document).on('click', '.delete-offer-btn', function () {
                console.log($(this).data('id'));
                $('#delete-offer').data('id', $(this).data('id'));
                $('#delete_confirm_modal').modal('show');
        }).on('shown.bs.modal', '#delete_confirm_modal', function (event) {

        }).on('click', '#delete-offer', function () {
                var newForm = jQuery('<form>', {
                        'action': '/admin/specialOffers/destroy/' + $(this).data('id'),
                        'method': 'post'
                }).append(jQuery('<input>', {
                        'name': '_token',
                        'value': $('meta[name="csrf-token"]').attr('content'),
                        'type': 'hidden'
                })).appendTo('body');
                newForm.submit();
        });
});