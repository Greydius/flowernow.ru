'use strict';

angular.module('flowApp').controller('invoicesList', function($scope, $element, $http, CSRF_TOKEN) {

        $scope.invoices = [];
        $scope.prev_page = "";
        $scope.next_page = "";
        $scope.currentPage = 1;

        $scope.getInvoices = function() {

                $scope.prev_page = "";
                $scope.next_page = "";

                $http({

                        method: 'GET',
                        url:  '/admin/api/v1/invoices',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        params: {
                                'page': $scope.currentPage,
                        }

                }).then(function (response) {
                        //$scope.products = response.data.products;
                        $scope.invoices = response.data.invoices.data;
                        $scope.prev_page = response.data.invoices.prev_page_url;
                        $scope.next_page = response.data.invoices.next_page_url;

                        $scope.totalPages = response.data.invoices.last_page;
                        $scope.currentPage = response.data.invoices.current_page;
                        // Pagination Range
                        var pages = [];

                        for (var i = 1; i <= response.data.invoices.last_page; i++) {
                                pages.push(i);
                        }

                        $scope.range = pages;
                }, function (response) {


                }).then(function (response) {

                });

        };

        $scope.getInvoices();

})