$(document).ready(function() {
        var bestPictures = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: '/searchCity?txt=%QUERY',
                        wildcard: '%QUERY',
                    filter: function(list) {
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
              '<div class="empty-message">Не могу найти</div>'
            ].join('\n'),

            suggestion: function(data) {
                    return '<div>'+data.name_long+'</div>';
            }
          }

        }).on('typeahead:selected', function(event, data){
                $('input.f-typeahead').val(data.name);
                changeCity(data.id);
        });
})

function changeCity(id){
        var location = window.location+"";
        $.cookie("city", id, { expires: 7 });
        window.location.reload("true");
}