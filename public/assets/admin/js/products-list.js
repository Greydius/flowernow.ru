Dropzone.autoDiscover = false;

Dropzone.options.myDropzone = {
        previewsContainer: false,
        acceptedFiles: 'image/*',
        init: function() {

            this.on("success", function(file, response) {
                    mApp.unblock("#myDropzone");
                    angular.element('#productsListContainer').scope().getProducts();

            }).on("addedfile", function(file) {
                    mApp.block("#myDropzone",{overlayColor:"#000000",type:"loader",state:"success",size:"lg"})
            }).on("error", function(file, errorMessage) {
                    mApp.unblock("#myDropzone")
                    if(errorMessage.error && errorMessage.message) {
                            toastr.error(errorMessage.message);
                    } else {
                            toastr.error('Ошибка!');
                    }
            });
        }
};

// Create options object for Dropzone
var myDropzoneOptions = {
        //url: '.',
        //clickable: false,
        params: {
                 _token: $('meta[name="csrf-token"]').attr('content'),
                isDop: $('#isDop').val()
        },
        createImageThumbnails: false,
        acceptedFiles: 'image/*',
        previewsContainer: false,
        clickable: '.upload-photo-btn',
        init: function () {

                this.on("success", function (file, response) {
                        /*
                        mApp.unblock("#myDropzone");
                        angular.element('#productsListContainer').scope().getProducts();
                        */
                        if(response.photo && response.id) {
                                $('.photo-preloader').hide();
                                angular.element('#productsListContainer').scope().refreshPhoto(response.id, response.photo);
                        }

                }).on("addedfile", function (file) {
                        $('.photo-preloader').show();
                        /*
                        mApp.block("#myDropzone", {overlayColor: "#000000", type: "loader", state: "success", size: "lg"})
                        */
                }).on("error", function (file, errorMessage) {
                        /*
                        mApp.unblock("#myDropzone")
                        if (errorMessage.error && errorMessage.message) {
                                toastr.error(errorMessage.message);
                        } else {
                                toastr.error('Ошибка!');
                        }
                        */
                });
        },
        /*
        accept: function (file, done) {
        }
        */
};

$(document).ready(function() {
        $('#myDropzone').dropzone();

        $(document).on('click', '#change_price', function() {

                var $btn = $(this);
                var $form = $('#m_modal_5 form');
                var url = $form.attr('action');


                $btn.prop('disabled', true);
                $.ajax({
                        url: url,
                        type: "POST",
                        data: $form.serialize(),
                        success: function (response) {
                                $btn.prop('disabled', false);
                                if(response.message) {
                                        toastr.success(response.message);
                                } else {
                                        toastr.success('Данные успешно сохранены!');
                                }

                                window.location = '/admin/products';
                        },
                        error: function (response) {

                                $btn.prop('disabled', false);

                                if(response.responseJSON.message) {
                                        toastr.error(response.responseJSON.message);
                                } else {
                                        toastr.error('Ошибка сохранения');
                                }

                        },
                        dataType: 'json'
                });
        })
})