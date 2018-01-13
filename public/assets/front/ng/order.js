'use strict';

angular.module('flowApp').controller('order', function($scope, $element, $http) {

        $scope.product = jsonData.product;
        $scope.qty = 1;

        console.log($scope.product);

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