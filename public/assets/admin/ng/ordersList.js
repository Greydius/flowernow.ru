'use strict';

angular.module('flowApp').controller('ordersList', function($scope, $element, $http) {

        $scope.orders = [];

        $scope.getOrders = function() {
                $http({

                        method: 'GET',
                        url:  routes.orders,
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },

                }).then(function (response) {
                        $scope.orders = response.data.orders;
                }, function (response) {


                }).then(function (response) {

                });

        };


        $scope.getOrders();
});