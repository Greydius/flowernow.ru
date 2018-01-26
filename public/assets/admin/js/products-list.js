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

$(document).ready(function() {
        $('#myDropzone').dropzone();
})