Dropzone.autoDiscover = false;

Dropzone.options.myDropzone = Dropzone.options.myDropzone2 = {
        previewsContainer: false,
        acceptedFiles: 'image/*',
        previewTemplate: '<h1>Hello</h1>',
        init: function() {

            this.on("success", function(file, response) {
                    mApp.unblock("#"+$(this.element).attr('id'));
                    angular.element('#shopProfileContainer').scope().getShop();
                    /*
                var a = document.createElement('span');
                a.className = "thumb-url btn btn-primary";
                a.setAttribute('data-clipboard-text', '/'+response);
                a.innerHTML = "copy url";
                file.previewTemplate.appendChild(a);
                */
            }).on("addedfile", function(file) {
                    mApp.block("#"+$(this.element).attr('id'),{overlayColor:"#000000",type:"loader",state:"success",size:"lg"})
            }).on("error", function(file, errorMessage) {
                    mApp.unblock("#"+$(this.element).attr('id'))
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
        $('#myDropzone2').dropzone();

        $('.datepair .time').timepicker({
                'showDuration': true,
                'timeFormat': 'H:i',
                'step': 15,
                'lang': {
                        mins: 'мин',
                        hr: 'ч',
                        hrs: 'ч'
                }
        });

        $('.datepair').datepair();
})