'use strict';

$(document).ready(function() {

        angular.element(document).ready(function () {
                $('#dop-products-container .owl-carousel').owlCarousel({
                        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                        dots: false,
                        loop: false,
                        margin: 10,
                        nav: true,
                        responsive: {
                                0: {
                                        items: 1
                                },
                                600: {
                                        items: 3
                                },
                                1000: {
                                        items: 5
                                }
                        }
                })
        });

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
                        $('[name="email"]').val($('.order-email:visible').val());

                        submitForm(form);
                } else {
                        $('html, body').animate({
                                scrollTop: $(".error", form).eq(0).offset().top - 80
                        }, 500);
                }

                return false;
        }).on('click', '.create-order-ur', function () {
                var form = $(this).parents('form');
                var button = $(".create-order-ur");
          button.attr('disabled', true);
          $(".clock-wrapper-outer").addClass('active');

                if(fromValidateUr()) {
                        $('[name="phone"]').val($('.customer_phone:visible').intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164));
                        $('[name="recipient_phone"]').val($('#recipient_phone').intlTelInput("getNumber", intlTelInputUtils.numberFormat.E164));
                        $('[name="email"]').val($('.order-email:visible').val());

                        submitForm(form);
                } else {
                        $('html, body').animate({
                                scrollTop: $(".error", form).eq(0).offset().top - 80
                        }, 500);
                  button.attr('disabled', false);
                  $(".clock-wrapper-outer").removeClass('active');
                }

                return false;
        }).on('shown.bs.tab', '#payment_methods_list a[data-toggle="tab"]', function () {
                $('[name="payment"]').val($(this).data('payment'));
        }).on('change', '[name="delivery_out"]', function () {
                if($(this).is(':checked')) {
                        $('#delivery_out_container').show();
                } else {
                        $('#delivery_out_container').hide()
                }
        }).on('input', '[name="delivery_out_distance"]', function () {
                console.log('input');
        });

        function  fromValidate() {
                var valid = true;

                var phoneError = false;
                var receiving_date = $('[name="receiving_date"]');
                var receiving_time = $('[name="receiving_time"]');
                var customer_phone = $('.customer_phone:visible');
                var customer_email = $('.order-email:visible');

                var isEntity = $(".payment-type.entity").hasClass('active');

                receiving_date.removeClass('error');
                receiving_time.removeClass('error');
                customer_phone.removeClass('error');
                customer_email.removeClass('error');


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

                if (isEntity){
                  if (customer_email.val() == '') {
                    $.notify("Введите email", "error");
                    customer_email.addClass('error');
                  }else if (!customer_email.val().match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)) {
                    $.notify("Введите корректный email", "error");
                    customer_email.addClass('error');
                  }
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

        function  fromValidateUr() {

                var valid = fromValidate();

                var phoneError = false;
                var ur_name = $('[name="ur_name"]');
                ur_name.removeClass('error');

                if(ur_name.val() == '') {
                        $.notify("Введите название юр. лица", "error");
                        ur_name.addClass('error');
                        valid = false;
                }

                return valid;
        }

        function  submitForm($form) {

                preloader('show');

                var dopProducts = '';

                $.each(angular.element(document.getElementById('order-container')).scope().selectedDopProducts, function(index, value) {
                        dopProducts += 'dop_products['+value.id+']='+value.qty+'&';
                })

                $.ajax({
                        url: $form.attr('action'),
                        type: $form.attr('method'),
                        data: $form.serialize() + '&promo_code=' + $('input[name="promo_code"]').val() + '&' + dopProducts,
                        success: function(data) {
                                preloader('hide');
                                if(data.order_id) {
                                        $('[name="order_id"]').val(data.order_id);
                                        angular.element(document.getElementById('order-container')).scope().order_id = data.order_id;
                                }

                                if(data.cloudpayments) {
                                        pay(data.cloudpayments);
                                } else if(data.link) {
                                        window.location = data.link;
                                }

                                if(data.sms_send) {
                                        angular.element(document.getElementById('order-container')).scope().sms_send = data.sms_send;
                                }

                                angular.element(document.getElementById('order-container')).scope().$apply();

                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                preloader('hide');
                                $.notify(XMLHttpRequest.responseJSON.message, "error");
                                var button = $(".create-order-ur");
                                button.attr('disabled', false);
                                $(".clock-wrapper-outer").removeClass('active');
                        }
                });
        }

        function pay(options) {
            var widget = new cp.CloudPayments();
            widget.auth(options,
                function (options) { // success
                    //действие при успешной оплате
                        window.location = '/payment/success';
                },
                function (reason, options) { // fail
                    //действие при неуспешной оплате
                        $.notify("Неуспешная оплата. Попробуйте еще раз. ("+reason+")", "error")
                });
        };
}) ;

angular.module('flowApp').controller('order', function($scope, $element, $http) {

        $scope.product = jsonData.product;
        $scope.qty = jsonData.qty;
        $scope.delivery_out_distance = null;
        $scope.delivery_out_price = $scope.product.shop.delivery_out_price;
        $scope.promo_code = null;
        $scope.promo = null;
        $scope.selectedDopProducts = [];
        $scope.allDopProducts = jsonData.dopProducts;
        $scope.sms_send = false;
        $scope.sms_code = '';
        $scope.phone = '';
        $scope.order_id = null;

        $scope.total = function () {

                var dopTotalPrice = 0;

                angular.forEach($scope.selectedDopProducts, function (v, k) {
                        dopTotalPrice += parseInt(v.clientPrice)*v.qty;
                });

                if(!$scope.product.single) {
                        return parseInt($scope.product.clientPrice * $scope.qty + $scope.delivery_out_distance*$scope.delivery_out_price + dopTotalPrice);
                } else {
                        return parseInt($scope.product.clientPrice + $scope.delivery_out_distance*$scope.delivery_out_price + dopTotalPrice);
                }
        }

        $scope.totalFull = function () {

                var dopTotalPrice = 0;

                angular.forEach($scope.selectedDopProducts, function (v, k) {
                        dopTotalPrice += parseInt(v.clientPrice)*v.qty;
                });

                if(!$scope.product.single) {
                        return parseInt($scope.product.fullPrice * $scope.qty + $scope.delivery_out_distance*$scope.delivery_out_price + dopTotalPrice);
                } else {
                        return parseInt($scope.product.fullPrice + $scope.delivery_out_distance*$scope.delivery_out_price + dopTotalPrice);
                }
        }

        $scope.upQty = function () {
                $scope.qty++;
        }

        $scope.downQty = function () {
                if($scope.qty >= (!$scope.product.single ? 2 : 8)) {
                        $scope.qty--;
                }
        }

        $scope.upQtyDop = function ($item) {
                $item.qty++;
        }

        $scope.downQtyDop = function ($item) {
                if($item.qty >= 2) {
                        $item.qty--;
                }
        }

        $scope.getPromoCodeinfo = function(e) {

                if($scope.promo_code) {
                        var $btn = angular.element(e.target);

                        $btn.prop('disabled', true);

                        $http({
                                method: 'GET',
                                url: '/getPromoCodeinfo',
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                                params: {
                                        'code': $scope.promo_code,
                                        'productId': $scope.product.id
                                }

                        }).then(function (response) {
                                var data = response.data;
                                $scope.product = data.product;
                                $scope.promo = data.promo;

                        }, function (response) {
                                if (response.data.error && response.data.message) {
                                        $.notify(response.data.message, "error");
                                } else {
                                        $.notify('Ошибка!', "error");
                                }

                        }).then(function (response) {
                                $btn.prop('disabled', false);
                        });
                }

                $scope.applyPromoCode = function() {

                }

        };

        $scope.$watch('qty', function () {
                $http({
                        method: 'GET',
                        url:  '/api/v1/singleProduct/getProductByQty',
                        headers: { 'Content-Type': 'application/json' },
                        params: {
                                qty: $scope.qty,
                                product_id: $scope.product.id
                        }

                }).then(function (response) {
                        var data = response.data;
                        $scope.product = data.product;

                }, function (response) {
                        if (response.data.error && response.data.message) {
                                $.notify(response.data.message, "error");
                        } else {
                                $.notify('Ошибка!', "error");
                        }

                }).then(function (response) {
                        
                });
        });

        $scope.addDopProduct = function ($item) {

                var exist = false;
                angular.forEach($scope.selectedDopProducts, function (v, k) {
                        if (v.id == $item.id) {
                                exist = true;
                        }
                });
                if (!exist) {
                        $item.qty = 1;
                        $scope.selectedDopProducts.push($item);
                } else {
                        var index = $scope.selectedDopProducts.indexOf($item);
                        $scope.selectedDopProducts.splice(index, 1);
                }

                /*
                angular.forEach($scope.allDopProducts, function(value, key) {
                        if(value.id == $id) {
                                var exist = false;
                                angular.forEach($scope.selectedDopProducts, function(v, k) {
                                        if(v.id == $item.id) {
                                                exist = true;
                                        }
                                });
                                if(!exist) {
                                        $scope.selectedDopProducts.push(value);
                                } else {
                                        var index = $scope.selectedDopProducts.indexOf(value);
                                        $scope.selectedDopProducts.splice(index, 1);
                                }
                        }
                });
                */
        }

        $scope.btnDopClass = function ($item) {
                var $return = 'warning';

                angular.forEach($scope.selectedDopProducts, function(value, key) {
                        if(value.id == $item.id) {
                                $return = 'success';
                        }
                })

                return $return;
        }

        $scope.confirmSmsCode = function () {
                if($scope.sms_code == '') {
                        $('#sms_code').addClass('error');
                } else {
                        preloader('show');

                        $http({
                                method: 'GET',
                                url: '/order/confirmSmsCode/'+$scope.order_id,
                                headers: {'Content-Type': 'application/json'},
                                params: {
                                        sms_code: $scope.sms_code
                                }

                        }).then(function (response) {
                                var data = response.data;

                                if(data.link) {
                                        window.location = data.link;
                                }

                        }, function (response) {
                                if (response.data.error) {
                                        $('#sms_code').addClass('error');
                                }

                        }).then(function (response) {
                                preloader('hide');
                        });
                }
        }

        $scope.$watch('sms_code', function(newValue, oldValue) {
                $('#sms_code').removeClass('error');
        });
})