var region_visible = null;

$(document).ready(function() {
        $('.phone').mask("+7(999)999-99-99");


        $(document).on('shown.bs.modal', '#city-choose-popup', function() {

                if(region_visible == null ) {
                        region_visible = $('ul.regions').parent('div').is(':visible');
                }

        }).on('input', '#search-city-input', function() {
                var $city = $(this);
                var city_txt = $city.val();

                if(region_visible) {
                        $('ul.regions').parent('div').hide();
                }

                $('ul.cities li').hide();

                if(city_txt != '') {
                        $("ul.cities li a:Contains('"+city_txt+"')").parents('li').show();

                } else {
                        if(region_visible) {
                                $('ul.regions').parent('div').show();
                        }
                }
        }).on('input', 'input[name="q"]', function(e) {
                if (e.which == 13) {
                        $(this).parent('form').submit();
                        return false;
                }
        });
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

function chooseCity() {
        var $popup = $('#city-choose-popup');

        if(!$popup.length) {
                preloader('show');
                $.ajax({
                        url: '/choosePopup',
                        success: function(data) {
                                $('body').append(data);
                                //$('ul.cities li').hide();
                                selectCityByDetected();
                                preloader('hide');
                                $('#city-choose-popup').modal('show');
                        }
                });
        } else {
                $popup.modal('show');
        }
}

function selectCityByDetected() {
        $('ul.cities li').hide();

        var city_id = detectedCity.id;
        var region_id = detectedCity.region.id;

        var $cities = $('ul.cities li a[data-region-id="'+region_id+'"]');
        var $city = $('ul.cities li a[data-id="'+city_id+'"]');
        var $region = $('ul.regions li a[data-id="'+region_id+'"]');

        $cities.parents('li').show();

        $('ul.cities li a').removeClass('active');
        $city.addClass('active');

        $('ul.regions li a').removeClass('active');
        $region.addClass('active');
}

function selectRegion(region_id) {
        var $region = $('ul.regions li a[data-id="'+region_id+'"]');
        $('ul.regions li a').removeClass('active');
        $region.addClass('active');

        $('ul.cities li').hide();

        var $cities = $('ul.cities li a[data-region-id="'+region_id+'"]');
        $cities.parents('li').show();
}

jQuery.expr[":"].Contains = jQuery.expr.createPseudo(function(arg) {
    return function( elem ) {
        return jQuery(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});