$(document).ready(function() {
        var bestPictures = new Bloodhound({
                datumTokenizer: function (datum) {
                        return Bloodhound.tokenizers.whitespace(datum.value);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: '/searchCity?txt=%QUERY',
                        wildcard: '%QUERY',
                    filter: function(list) {
                            console.log(list);
                        // This should not be required, but I have left it incase you still need some sort of filtering on your server response
                        return $.map(list, function(city) {
                                city.name_long = city.name + ', ' + city.region.name;
                                return city;
                        });
                    }
                }
        });

        $('#inputCity').typeahead(
                {
                          hint: false,
                          highlight: true,
                          minLength: 2,
                        autoselect: true
                        }

                , {
          name: 'best-pictures',
          display: 'name',
          source: bestPictures,
          templates: {
            empty: [
              '<div class="empty-message">Этого города нет во Floristum.ru — попробуйте ввести ближайший.</div>'
            ].join('\n'),

            suggestion: function(data) {
                    return '<div>'+data.name_long+'</div>';
            }
          }

        }).on('typeahead:selected', function(event, data){
                $('input.f-typeahead').val(data.name);
                changeCity(data);
        });

        $('.link-city [rel="popover"]').popover({
                container: 'body',
                html: true,
                content: function () {
                        var clone = $($(this).data('popover-content')).clone(true).removeClass('hide');
                        return clone;
                },
                placement: 'bottom'
        }).click(function (e) {
                e.preventDefault();
        }).popover('show');

})

function cityPopover(action) {
        if(action == 'hide') {
                $('#link-city-popover').hide();
        } else if(action == 'show') {
                $('#link-city-popover').showe();
        }
}

function setCity() {
        cityPopover('hide');

        return false;
}

function changeCity(data){
        /*
        var location = window.location+"";
        $.cookie("city", id, { expires: 7 });
        window.location.reload();
        */

        //var protocol = window.location.protocol;
        var protocol = 'http:';
        var subdomain = '';

        if(data.slug && data.slug != 'moskva') {
                subdomain = data.slug+'.';
        }

        var location = protocol+'//'+subdomain+'floristum.ru';

        window.location = protocol+'//'+subdomain+'floristum.ru';
}


$.fn.preloader = function (action) {

        return $(this).each(function () {
                switch (action) {
                        case 'show':
                                //$('<div class="fl-preloader"><div class="spinner"></div></div>').appendTo($(this));
                                $('<div class="preloader-wrapper"></div>').appendTo($('body'));
                                break;
                        case 'hide':
                                //$(this).find('.fl-preloader').remove();
                                $('body').find('.preloader-wrapper').remove();
                                break;
                        default:
                                break;
                }
        });
}


window.onpopstate = function(event) {
        //console.log("location: " + document.location + ", state: " + JSON.stringify(event.state));
};