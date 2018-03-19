'use strict';

angular.module('flowApp').controller('ordersList', function($scope, $element, $http, CSRF_TOKEN) {

        $scope.orders = [];

        $scope.getOrders = function() {
                $http({

                        method: 'GET',
                        url:  routes.orders,
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },

                }).then(function (response) {
                        $scope.orders = response.data.orders;
                        angular.forEach($scope.orders, function(value, key) {
                          value.payed_at_dt = new Date(value.payed_at);
                          value.receiving_date_dt = new Date(value.receiving_date);
                        });
                        
                }, function (response) {


                }).then(function (response) {

                });

        };


        $scope.getOrders();

        $scope.changeStatus = function(item, prev_status) {

                var $controller =  $('#change-status-'+item.id);

                $controller.prop('disabled', 'disabled');

                $http({

                        method: 'POST',
                        url:  '/admin/order/'+item.id,
                        data: {'status': item.status, 'csrf-token': CSRF_TOKEN}

                }).then(function (response) {
                        toastr.success('Статус изменен успешно');
                }, function (response) {
                        toastr.error('Ошибка');
                        item.status = prev_status;

                }).then(function (response) {
                        $controller.prop('disabled', false);
                });

        };
});