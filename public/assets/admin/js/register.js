$(document).ready(function() {
        $('#register_form').submit(function() {
                var $form = $(this);
                var $modal = $('#reg-code-modal');
                var $modalForm = $('form', $modal);
                var $fieldsContainer = $('.fields_container', $modalForm);

                $.ajax({
                        url: $form.attr('action'),
                        type: 'post',
                        data: $form.serialize(),
                      success: function(data) {
                         // handle the successful response
                              console.log(data)
                              if(data.message) {
                                      toastr.success(data.message);
                              } else if(data.code) {
                                      $('input.form-control', $form).each(function () {
                                              $('<input>').attr({
                                                      type: 'hidden',
                                                      name: $(this).attr('name'),
                                                      value: $(this).val()
                                              }).appendTo($fieldsContainer);
                                      });

                                      if(data.code_value) {
                                              $('#reg-code').val(data.code_value);
                                      }

                                      $modal.modal('show');
                              }
                      },
                      error: function(data){
                        for(datos in data.responseJSON['errors']){
                                toastr.error(data.responseJSON['errors'][datos][0]);
                        }
                      }
                });

                return false;
        });

        $('#register_code_form').validate({

                onkeyup: false,
                rules:{
                        code:{
                                required: true
                        }
                },
                messages:{

                        code:{
                                required: "Введите код"
                        },
                },
                errorPlacement: function(error,element){
                        if(error.html()) {
                                toastr.error(error.html());
                        }
                },
                highlight:function(element, errorClass, validClass) {
                        return false;
                }
        });

        $('#register_code_form').submit(function() {
                var $form = $(this);

                if($('#register_code_form').validate().checkForm()) {
                        $.ajax({
                                url: $form.attr('action'),
                                type: 'post',
                                data: $form.serialize(),
                                success: function(data) {
                                        // handle the successful response
                                        if(data.url) {
                                              window.location = data.url;
                                        }
                                },
                                error: function(data){
                                        for(datos in data.responseJSON['errors']){
                                                toastr.error(data.responseJSON['errors'][datos][0]);
                                        }
                                }
                        });
                }

                return false;
        });

        /*
        $('input.f-typeahead').typeahead({
            source:  function (query, process) {
                return $.get('/ajaxpro.php', { query: query }, function (data) {
                        console.log(data);
                        data = $.parseJSON(data);
                    return process(data);
                });
            }
        });
        */



/*
        $('input.f-typeahead').typeahead(
                {
                  hint: true,
                  highlight: true,
                  minLength: 2
                }, {

                        source: function (query, syncResults, asyncResults) {
                                $.getJSON('/searchCity', {
                                    txt: query
                                }, function (data) {
                                    asyncResults(data || [])
                                })
                        },
                }
        );

        */

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
                        console.log(city);
                        return city;
                });
            }
        },
        /*
  remote: {
    url: '/searchCity?txt=%QUERY',
    wildcard: '%QUERY'
  }
  */
});

$('input.f-typeahead').typeahead(
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
    suggestion: Handlebars.compile('<div>{{name_long}}</div>')
  }

}).on('typeahead:selected', function(event, data){
        $('input.f-typeahead').val(data.name);
        $('#city_id').val(data.id);
});

});