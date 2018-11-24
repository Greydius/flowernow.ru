'use strict';

angular.module('flowApp').controller('shopsList', function($scope, $element, $http, CSRF_TOKEN) {
        $scope.shops = [];

        $scope.prev_page = "";
        $scope.next_page = "";
        $scope.shops_url = routes.shopsList;
        $scope.search_str = '';

        $scope.getShops = function() {

                $scope.prev_page = "";
                $scope.next_page = "";

                $http({

                        method: 'GET',
                        url:  $scope.shops_url,
                        params: {
                                'search': $scope.search_str
                        }

                }).then(function (response) {
                        $scope.shops = response.data.shops.data;
                        $scope.prev_page = response.data.shops.prev_page_url;
                        $scope.next_page = response.data.shops.next_page_url;
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
});