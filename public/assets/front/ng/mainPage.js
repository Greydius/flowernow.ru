'use strict';

angular.module('flowApp').controller('mainPage', function($scope, $element, $http, $httpParamSerializerJQLike) {
        $scope.popularProduct = jsonData.popularProduct;
        $scope.filters = {};
        $scope.isFiltered = false;
        $scope.title = '';
        $scope.links = '';

        $scope.otherPopularProducts = [];

        $scope.getProducts = function(page) {

                $scope.title = '';

                if(!page) {
                        page = 1;
                }

                $scope.filter();

                $('.preloader-wrapper').show();

                $http({

                        method: 'GET',
                        url:  routes.products + '?page='+page+'&' + $httpParamSerializerJQLike($scope.filters),
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

                }).then(function (response) {
                        $scope.otherPopularProducts = [];
                        $('.preloader-wrapper').hide();
                        if(response.data.products && response.data.products.data) {

                                if(response.data.products.current_page == 1) {
                                        $scope.popularProduct = response.data.products.data;
                                } else {
                                        $scope.popularProduct = $scope.popularProduct.concat(response.data.products.data);
                                }
                        }

                        if(response.data.popularProducts) {
                                $scope.otherPopularProducts = response.data.popularProducts;
                        }

                        $scope.title = response.data.title;

                        $scope.links = response.data.links;

                }, function (response) {
                        $('.preloader-wrapper').hide();

                }).then(function (response) {
                        $('.preloader-wrapper').hide();
                });

        };

        $scope.filter = function() {

                var $productType = $('#filter-product-type li.active');
                var $productFlower = $('input[name="flowers[]"]:checked');
                var $productPrice = $('#filter-product-price li.active');
                var $productColor = $('#filter-product-color .color-item.active');

                var path = {};

                $scope.filters = {};

                path.productType = 'all';
                if($productType.length) {
                        $scope.filters.productType = $productType.data('id');
                        path.productType = $productType.data('slug');
                }

                path.flowers = [];
                path.flower = [];
                if($productFlower.length) {
                        var flowersIds = [];
                        $productFlower.each(function() {
                                flowersIds.push($(this).val());
                                path.flower.push($(this).data('slug'));
                        });

                        $scope.filters.flowers = flowersIds;
                        path.flowers = flowersIds;
                }

                if($productPrice.length) {
                        $scope.filters.productPrice = $productPrice.data('id');
                        path.price_from = $productPrice.data('from');
                        path.price_to = $productPrice.data('to');
                }

                if($productColor.length) {
                        $scope.filters.color = $productColor.data('id');
                        path.color = $productColor.data('id');
                }

                if(Object.keys($scope.filters).length) {
                        $scope.isFiltered = true;
                } else {
                        $scope.isFiltered = false;
                }

                $scope.changeUrl(path);
        }

        $scope.resetFilter = function() {
                $scope.filters = {};
                $scope.isFiltered = false;
                $scope.clearFilterView();
                $scope.getProducts(1);
        }

        $scope.clearFilterView = function() {
                $('.filter-product-checker ul li, .color-item').removeClass('active');
                $('input[name="flowers[]"]').prop( "checked", false );
        }

        $scope.changeUrl = function(path) {
                var url = '/catalog/';
                var getParams = {};

                url += path.productType;

                if(path.flowers.length) {
                        url += '/' + path.flower[0];
                        if(path.flowers.length > 1) {
                                getParams.flowers = path.flowers.slice(1)
                        }
                } else {
                        url += '/vse-cvety';
                }

                if(path.price_from) {
                        getParams.price_from = path.price_from;
                }

                if(path.price_to) {
                        getParams.price_to = path.price_to;
                }

                if(path.color) {
                        getParams.color = path.color;
                }

                var serializeGetParams = $httpParamSerializerJQLike(getParams);

                var newurl = window.location.protocol + "//" + window.location.host + url;

                newurl += serializeGetParams ? '?'+serializeGetParams : '';

                window.history.pushState({path:newurl},'',newurl);
        }
})