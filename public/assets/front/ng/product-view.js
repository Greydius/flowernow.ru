'use strict';

angular.module('flowApp').controller('product-view', function($scope, $element, $http) {
        $scope.product = jsonData.product;
        $scope.shopSingleProducts = jsonData.shopSingleProducts;
        $scope.qty = $scope.product.single_product ? $scope.product.single_product.qty_from : 1;
        $scope.startcounting = null;

        $scope.changeQty = function (qty) {

                $scope.qty = qty;

                $http({

                        method: 'GET',
                        url:  '/api/v1/singleProduct/getProductByQty',
                        headers: { 'Content-Type': 'application/json' },
                        params: {
                                qty: qty,
                                product_id: $scope.product.id
                        }

                }).then(function (response) {
                        $scope.product = response.data.product;
                        $('#go_to_order').attr('href', response.data.cart_link);
                }, function (response) {


                }).then(function (response) {

                });
        }
        
        $scope.upQty = function () {
                if($scope.startcounting) {
                        clearTimeout($scope.startcounting);
                }
                $scope.qty++;
                $scope.startcounting = setTimeout(function ()
                {
                   $scope.changeQty($scope.qty);
                }, 300);
        }

        $scope.downQty = function () {
                if($scope.startcounting) {
                        clearTimeout($scope.startcounting);
                }

                if($scope.qty >= 8) {
                        $scope.qty--;
                        $scope.startcounting = setTimeout(function ()
                        {
                           $scope.changeQty($scope.qty);
                        }, 300);
                }
        }
        
        $scope.$watch('qty', function () {
                if($scope.qty <= 7) {
                        $('#downQty').addClass('disabled');
                        $('#downQty').prop("disabled", true);
                } else {
                        $('#downQty').removeClass('disabled');
                        $('#downQty').prop("disabled", false);
                }
        });
        
        $(document).on('input', 'input[name="qty"]', function() {
                if($scope.startcounting) {
                        clearTimeout($scope.startcounting);
                }

                $scope.startcounting = setTimeout(function ()
                {
                   $scope.changeQty($scope.qty);
                }, 300);
        });
})