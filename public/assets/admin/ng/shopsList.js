'use strict';

angular.module('flowApp').controller('shopsList', function($scope, $element, $http, CSRF_TOKEN) {
        $scope.shops = [];

        $scope.prev_page = "";
        $scope.next_page = "";
        $scope.shops_url = routes.shopsList;
        $scope.search_str = '';

        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];

        $scope.getShops = function() {

                $scope.prev_page = "";
                $scope.next_page = "";

                $http({

                        method: 'GET',
                        url:  $scope.shops_url,
                        params: {
                                'search': $scope.search_str,
                                'page': $scope.currentPage,
                        }

                }).then(function (response) {
                        $scope.shops = response.data.shops.data;
                        $scope.prev_page = response.data.shops.prev_page_url;
                        $scope.next_page = response.data.shops.next_page_url;


                        $scope.totalPages   = response.data.shops.last_page;
                        $scope.currentPage  = response.data.shops.current_page;
                        // Pagination Range
                        var pages = [];

                        for(var i=1;i<=response.data.shops.last_page;i++) {
                                pages.push(i);
                        }

                        $scope.range = pages;

                        console.log($scope.totalPages);
                }, function (response) {


                }).then(function (response) {

                });

        };

        $scope.search = function(keyEvent) {
                if (keyEvent.which === 13) {
                        $scope.search_str = $('#m_form_search').val();
                        $scope.getShops();
                }
        }

        $scope.getShops();

        $scope.sendProductEmail = function(shop) {
                toastr.warning('Подождите. Идет формирование уведомления!');
                $http({

                        method: 'POST',
                        url:  '/admin/shop/sendProductEmail/' + shop.id,
                        data: {'csrf-token': CSRF_TOKEN}

                }).then(function (response) {
                        toastr.success('Уведомление успешно отправлено!');
                }, function (response) {
                        toastr.error('Ошибка!');
                }).then(function (response) {

                });
        }

        $scope.ranges = function (min, max, step) {
                step = step || 1;
                var input = [];
                for (var i = min; i <= max; i += step) {
                        input.push(i);
                }
                return input;
        }

        $scope.getShopsPage = function(page) {
                $scope.currentPage = page;
                $scope.getShops();
        }
});