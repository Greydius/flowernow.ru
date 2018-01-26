'use strict';

angular.module('flowApp').controller('productsList', function($scope, $element, $http, ModalService) {

        $scope.products = [];
        $scope.flowers = jsonData.flowers;

        $scope.getProducts = function() {
                $http({

                        method: 'GET',
                        url:  routes.products,
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },

                }).then(function (response) {
                        $scope.products = response.data.products;
                }, function (response) {


                }).then(function (response) {

                });

        };

        $scope.editItem = function (e, item) {

                $scope.modalInstance = ModalService.showModal({
                        templateUrl: 'edit-item-modal.html',
                        controller: 'productEdit',
                        inputs: {
                                item: item
                        },
                        scope: $scope
                });
                $scope.modalInstance.then(function(modal) {

                        modal.element.modal();

                        modal.element.on('shown.bs.modal', function() {
                                modal.element.find('.m-select2').select2();
                        });

                        modal.close.then(function(result) {
                                if(result) {
                                        angular.forEach($scope.products, function(value, key) {
                                                if(value.id == result.id) {
                                                        $scope.products[key] = result;
                                                }
                                        });
                                }
                        });
                });
        }
        
        $scope.deleteItem = function (item) {

                $scope.modalInstance = ModalService.showModal({
                        templateUrl: 'delete-item-modal.html',
                        controller: 'productDelete',
                        inputs: {
                                item: item
                        },
                        scope: $scope
                });
                $scope.modalInstance.then(function(modal) {

                        modal.element.modal();

                        modal.element.on('shown.bs.modal', function() {
                                
                        });

                        modal.close.then(function(result) {
                                if(result) {
                                        angular.forEach($scope.products, function(value, key) {
                                                if(value.id == result.id) {
                                                        var index = $scope.products.indexOf($scope.products[key]);
                                                        $scope.products.splice(index, 1);
                                                }
                                        });
                                }
                        });
                });
        }

        $scope.getProducts();
});

angular.module('flowApp').controller('productEdit', function($scope, close, item, $element, $http) {
        $scope.item = angular.copy(item);

        $scope.productTypes = jsonData.productTypes;
        $scope.colors = jsonData.colors;
        $scope.times = jsonData.times;

        $scope.item.make_time = $scope.item.make_time ? $scope.item.make_time : 90;

        $scope.save = function(result) {

                $http({

                        method: 'POST',
                        url:  routes.productUpdate,
                        data: $.param($scope.item),
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },

                }).then(function (response) {

                        $element.modal('hide');
                        close(result, 500);

                }, function (response) {
                        if(response.data.error && response.data.message) {
                                    toastr.error(response.data.message);
                        } else {
                                    toastr.error('Ошибка!');
                        }
                }).then(function (response) {

                });

                /*
                $element.modal('hide');
                close(result, 500);
                */
        };

        $scope.addComposition  = function(result) {
                $scope.item.compositions.push({});
        }

        $scope.deleteComposition = function(i) {
                var index = $scope.item.compositions.indexOf(i);
                $scope.item.compositions.splice(index, 1);
        }
})

angular.module('flowApp').controller('productDelete', function($scope, close, item, $element, $http, CSRF_TOKEN) {
        $scope.item = item;

        $scope.save = function(result) {

                $http({

                        method: 'POST',
                        url:  routes.productDelete + $scope.item.id,
                        data: {'csrf-token': CSRF_TOKEN},
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },

                }).then(function (response) {

                        $element.modal('hide');
                        close(result, 500);

                }, function (response) {
                        if(response.data.error && response.data.message) {
                                    toastr.error(response.data.message);
                        } else {
                                    toastr.error('Ошибка!');
                        }
                }).then(function (response) {

                });

                /*
                $element.modal('hide');
                close(result, 500);
                */
        };
})