$(document).ready(function(){


        $(document).on('change', '.direct_check', function () {
                var checked = $(this).is(':checked');
                var $form = $(this).parents('form');
                var cityId = $(this).data('cityId');
                var id = $(this).data('id');

                $.ajax({
                        url: $form.attr('action')+id,
                        type: $form.attr('method'),
                        data: $form.serialize(),
                        success: function (response) {

                        },
                        error: function (response) {

                        },
                        dataType: 'json'
                });
        })
})