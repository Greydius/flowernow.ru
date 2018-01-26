'use strict';

$(document).ready(function() {

        $('.datepicker').datepicker({
                format: 'dd.mm.yyyy',
                language: 'ru',
                autoclose: true,
                startDate: new Date()
        });

        $('.datepicker').datepicker("update", new Date());

        var telInput = $(".phone_input");

        telInput.each(function(index) {

                var currentInput = $(this);

                $(this).intlTelInput({
                        preferredCountries: ['RU', 'UA', 'BY', 'KZ'],
                        formatOnDisplay: true,
                        /*
                        initialCountry: "auto",
                        geoIpLookup: function(callback) {
                                $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                                        var countryCode = (resp && resp.country) ? resp.country : "";
                                        callback(countryCode);
                                });
                        },
                        */
                        utilsScript: "/assets/plugins/intl-tel-input-12.1.0/js/utils.js",
                        customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                                return currentInput.data('placeholder') + " " + selectedCountryPlaceholder;
                        }
                })
        });

        telInput.intlTelInput({
                preferredCountries: ['RU', 'UA', 'BY', 'KZ'],
                formatOnDisplay: true,
                /*
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                        $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                                var countryCode = (resp && resp.country) ? resp.country : "";
                                callback(countryCode);
                        });
                },
                */
                utilsScript: "/assets/plugins/intl-tel-input-12.1.0/js/utils.js",
                customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData) {
                        console.log(this.data);
                        return "e.g. " + selectedCountryPlaceholder;
                }
        });

        //telInput.on("keyup change", resetIntlTelInput);

        function resetIntlTelInput() {
                if (typeof intlTelInputUtils !== 'undefined') { // utils are lazy loaded, so must check
                  var currentText = telInput.intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164);
                  if (typeof currentText === 'string') { // sometimes the currentText is an object :)
                      telInput.intlTelInput('setNumber', currentText); // will autoformat because of formatOnDisplay=true
                  }
                }
        }

        $(document).on('click', '#recipient_self', function () {
                if($(this).is(':checked')) {
                        $('.form2').show();
                        $('.form1').hide();
                } else {
                        $('.form1').show();
                        $('.form2').hide();
                }
        }).on('click', '.create-order', function () {
                var form = $(this).parents('form');

                if(fromValidate()) {
                        $('[name="phone"]').val($('.customer_phone:visible').intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164));
                        $('[name="recipient_phone"]').val($('#recipient_phone').intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164));

                        submitForm(form);
                } else {
                        $('html, body').animate({
                                scrollTop: $(".error", form).eq(0).offset().top - 80
                        }, 500);
                }

                return false;
        }).on('shown.bs.tab', '#payment_methods_list a[data-toggle="tab"]', function () {
                $('[name="payment"]').val($(this).data('payment'));
        });

        function  fromValidate() {
                var valid = true;

                var phoneError = false;
                var receiving_date = $('[name="receiving_date"]');
                var receiving_time = $('[name="receiving_time"]');
                var customer_phone = $('.customer_phone:visible');

                receiving_date.removeClass('error');
                receiving_time.removeClass('error');
                customer_phone.removeClass('error');


                telInput.filter(":visible").each(function () {
                        if($(this).val() != '') {
                                if(!$(this).intlTelInput("isValidNumber")) {
                                        $(this).addClass('error');
                                        phoneError = true;
                                } else {
                                        $(this).removeClass('error');
                                }
                        }
                });

                if(phoneError) {
                        $.notify("Неверный формат телефона", "error");
                        valid = false;
                } else if(customer_phone.val() == '') {
                        $.notify("Введите номер телефона", "error");
                        customer_phone.addClass('error');
                        valid = false;
                }



                if(receiving_date.val() == '') {
                        $.notify("Выберите дату", "error");
                        receiving_date.addClass('error');
                        valid = false;
                } else {
                        var selectedDate = moment(receiving_date.val(), "DD.MM.YYYY");
                        if(!selectedDate.isValid() || moment().startOf('day').diff(selectedDate.startOf('day'), 'days') > 0) {
                                $.notify("Неверный формат даты", "error")
                                receiving_date.addClass('error');
                                valid = false;
                        }
                }

                if(receiving_time.val() == '') {
                        $.notify("Выберите время доставки", "error");
                        receiving_time.addClass('error');
                        valid = false;
                }

                return valid;
        }

        function  submitForm($form) {

                preloader('show');

                $.ajax({
                        url: $form.attr('action'),
                        type: $form.attr('method'),
                        data: $form.serialize(),
                        success: function(data) {
                                preloader('hide');
                                console.log(data);
                                if(data.order_id) {
                                        $('[name="order_id"]').val(data.order_id);
                                }

                                if(data.cloudpayments) {
                                        pay(data.cloudpayments);
                                }
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                preloader('hide');
                                $.notify(XMLHttpRequest.responseJSON.message, "error");
                        }
                });
        }

        function pay(options) {
            var widget = new cp.CloudPayments();
            widget.charge(options,
                function (options) { // success
                    //действие при успешной оплате
                        window.location = '/payment/success';
                },
                function (reason, options) { // fail
                    //действие при неуспешной оплате
                        $.notify("Неуспешной оплата. Попробуйте еще раз. ("+reason+")", "error")
                });
        };
}) ;

angular.module('flowApp').controller('order', function($scope, $element, $http) {

        $scope.product = jsonData.product;
        $scope.qty = 1;

        $scope.total = function () {
                return parseInt($scope.product.clientPrice * $scope.qty);
        }

        $scope.upQty = function () {
                $scope.qty++;
        }

        $scope.downQty = function () {
                if($scope.qty >= 2) {
                        $scope.qty--;
                }
        }
})