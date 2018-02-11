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
                 _token: $('meta[name="csrf-token"]').attr('content')
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
                                angular.element('#productsListContainer').scope().refreshPhoto(response.id, response.photo);
                        }

                }).on("addedfile", function (file) {
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
})