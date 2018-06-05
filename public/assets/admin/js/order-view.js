$(document).ready(function(){
        $(document).on('submit', '#order-charge-frm', function(e) {
                e.preventDefault();

                var $form = $(this);
                var $errorContainer = $('.errors', $form);
                var $successContainer = $('.success', $form);

                $errorContainer.html('');
                $successContainer.html('');

                $.ajax({
                        url: $form.attr('action'),
                        type: 'POST',
                        data: $form.serialize(),
                        success: function(json) {
                                $successContainer.html(json.message);
                        }
                }).fail(function($xhr) {
                        var data = $xhr.responseJSON;
                        console.log(data);
                        $errorContainer.html(data.message);
                });

                return false;
        });
});