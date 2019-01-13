'use strict';

angular.module('flowApp').controller('single-products', function($scope, $element, $http, CSRF_TOKEN) {
        $scope.products = jsonData.products;

        $scope.savePrice = function (product) {
                $http({

                        method: 'POST',
                        url:  '/admin/api/v1/singleProduct/savePrice/'+product.id,
                        headers: { 'Content-Type': 'application/json' },
                        data: {
                                price: product.price
                        }

                }).then(function (response) {

                }, function (response) {


                }).then(function (response) {
                        product.edit_mode = false;
                });
        }
})