var region_visible = null;

const observer = lozad(); // lazy loads elements with default selector as '.lozad'
observer.observe();

$.ajax({
        beforeSend: function() {
                preloader('show');
        },
        complete: function() {
                preloader('hide');
        }
});

window.onbeforeunload = function(e) {
        // check condition
        preloader('show');
};

$(document).ready(function() {

        $(window).on('load', function () {
                setTimeout(function() {
                        preloader('hide');
                }, 500);
        })

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
        }).on('click', '.filter-product-checker ul li', function() {
                var isActive = $(this).hasClass('active')
                var $parent = $(this).parents('.filter-block');
                $('li', $parent).removeClass('active');
                $('.filter-block-on-main li').removeClass('active');
                if($(this).parents('.filter-block-on-main')) {
                        $('.filter-block li').removeClass('active');
                }
                if(!isActive) {
                        $(this).addClass('active');
                }

                applyFilter();
        }).on('click', '#filter-product-color .color-item', function() {
                var isActive = $(this).hasClass('active')
                $('#filter-product-color .color-item').removeClass('active');
                if(!isActive) {
                        $(this).addClass('active');
                }

                applyFilter();
        }).on('change', 'input[name="flowers[]"]', function() {
                applyFilter();
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

function applyFilter() {
        angular.element('.filters-container').scope().getProducts();
}