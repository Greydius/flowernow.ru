Dropzone.autoDiscover = false;

Dropzone.options.myDropzone = {
        previewsContainer: false,
        acceptedFiles: 'image/*',
        previewTemplate: '<h1>Hello</h1>',
        init: function() {

                console.log('init');

            this.on("success", function(file, response) {
                    mApp.unblock("#myDropzone");
                    angular.element('#shopProfileContainer').scope().getShop();
                    /*
                var a = document.createElement('span');
                a.className = "thumb-url btn btn-primary";
                a.setAttribute('data-clipboard-text', '/'+response);
                a.innerHTML = "copy url";
                file.previewTemplate.appendChild(a);
                */
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