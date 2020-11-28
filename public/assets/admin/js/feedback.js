$(document).ready(function(){

        $('#feedback_date').mask('9999-99-99');

        $(document).on('change', '#shop_id', function () {
                $.ajax({
                        url: '/admin/feedback/shop_products',
                        type: "GET",
                        data: {
                                'shop_id': $(this).val()
                        },
                        success: function (response) {
                                $('#product_id').html('');
                                $('#product_id').append($('<option>', {
                                        value: 0,
                                        text: 'Выберите товар'
                                }));

                                $.each(response.products, function (i, item) {
                                        $('#product_id').append($('<option>', {
                                                value: item.id,
                                                text: item.name
                                        }));
                                });

                                if($('#old_product_id').length) {
                                        $('#product_id').val($('#old_product_id').val());
                                }
                        },
                        error: function (response) {

                        },
                        dataType: 'json'
                });
        })

        $('#shop_id').change();
})