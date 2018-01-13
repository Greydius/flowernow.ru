'use strict';

angular.module('flowApp').controller('shopProfile', function($scope, $element, $http) {

        $scope.shop = jsonData.shop;

        $scope.getShop = function() {
                $http({

                        method: 'GET',
                        url:  routes.shop,
                        //data: $.param(data),
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },

                }).then(function (response) {
                        $scope.shop = response.data.shop;
                }, function (response) {


                }).then(function (response) {

                });

        };
})