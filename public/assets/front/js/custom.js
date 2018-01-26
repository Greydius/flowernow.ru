$(document).ready(function() {
        $('.phone').mask("+7(999)999-99-99");
});

function preloader(action) {
        var Body = $('body');

        if(action == 'show') {
                $('.preloader-wrapper').fadeIn();
                Body.addClass('preloader-site');
        } else if(action == 'hide') {
                $('.preloader-wrapper').fadeOut();
                $('body').removeClass('preloader-site');
        }
}