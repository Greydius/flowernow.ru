$(document).ready(function() {
        $('.phone').mask("+998(99)999-99-99");

        $('[data-toggle="tooltip"]').tooltip();
});

function appPreloader(action) {
        if(action == 'show') {
                mApp.block(".m-grid",{overlayColor:"#000000",type:"loader",state:"success",size:"lg"});
        } else if(action == 'hide') {
                mApp.unblock(".m-grid");
        }
}