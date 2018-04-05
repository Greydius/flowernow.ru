'use strict';

angular.module('flowApp').controller('productsList', function($scope, $element, $http, ModalService, $rootScope, shareService, CSRF_TOKEN, $httpParamSerializerJQLike) {

        $scope.products = [];
        $scope.flowers = jsonData.flowers;
        $rootScope.photos = [];
        $scope.prev_page = "";
        $scope.next_page = "";
        $scope.product_url = routes.products;
        $scope.route_product_url = routes.products;
        $scope.search_str = '';
        $scope.search_not_public = false;

        $scope.totalPages = 0;
        $scope.currentPage = 1;
        $scope.range = [];

        $scope.getProducts = function() {

                $scope.prev_page = "";
                $scope.next_page = "";

                $http({

                        method: 'GET',
                        url:  $scope.product_url,
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        params: {
                                'search': $scope.search_str,
                                'status': $scope.search_not_public ? 1 : 0,
                                'page': $scope.currentPage
                        }

                }).then(function (response) {
                        //$scope.products = response.data.products;
                        $scope.products = response.data.products.data;
                        $scope.prev_page = response.data.products.prev_page_url;
                        $scope.next_page = response.data.products.next_page_url;

                              $scope.totalPages   = response.data.products.last_page;
                              $scope.currentPage  = response.data.products.current_page;
                              // Pagination Range
                              var pages = [];

                              for(var i=1;i<=response.data.products.last_page;i++) {
                                pages.push(i);
                              }

                              $scope.range = pages;
                }, function (response) {


                }).then(function (response) {

                });

        };

        /*
        $scope.getProductsPage = function(page) {
                $scope.product_url = page;
                $scope.getProducts();
        }
        */

        $scope.getProductsPage = function(page) {
                $scope.currentPage = page;
                $scope.getProducts();
        }

        $scope.refreshPhoto = function (id, photo) {

                angular.forEach($scope.products, function(value, key) {
                        if(value.id == id) {
                                value.photos.push(photo);
                                //$rootScope.photos = [];
                                //$rootScope.photos = value.photos;
                                //shareService.setItem($scope.products[key]);
                        }
                });

                $scope.$apply();
        }

        $scope.editItem = function (e, item) {

                $scope.modalInstance = ModalService.showModal({
                        templateUrl: 'edit-item-modal.html',
                        controller: 'productEdit',
                        inputs: {
                                item: item,
                                photos: item.photos
                        },
                        scope: $scope
                });
                $scope.modalInstance.then(function(modal) {

                        modal.element.modal();

                        modal.element.on('shown.bs.modal', function() {
                                modal.element.find('.m-select2').select2();
                                myDropzoneOptions.url = '/admin/products/uploadPhoto/'+item.id
                                modal.element.find('#droparea').dropzone(myDropzoneOptions);

                                $('.product-photos').sortable({
                                        items: '.product-photos-container',
                                        placeholder: "highlight",
                                        start: function (event, ui) {
                                                //ui.item.toggleClass("highlight");
                                        },
                                        stop: function (event, ui) {
                                                //ui.item.toggleClass("highlight");
                                        },
                                        update: function(event, ui) {
                                                var priority = [];
                                                $('.product-photos .product-photos-container img').each(function () {

                                                        priority.push($(this).data('photo-id'));

                                                });

                                                $scope.changePriority($('input[name="product_id"]').val(), priority);
                                        }
                                }).disableSelection();
                        }).on('hidden.bs.modal', function() {

                                $('#product-photos').sortable('destroy');
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

        $scope.changePriority = function (product_id, priority) {
                $http({

                        method: 'POST',
                        url:  '/admin/api/v1/product/changePriority/'+product_id,
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        data: $httpParamSerializerJQLike({'priority' : priority})

                }).then(function (response) {
                        if(response.data.photos) {

                                //$rootScope.photos = response.data.photos;

                                var products_photos = [];

                                angular.forEach($scope.products, function(value, key) {
                                        if(value.id == product_id) {
                                                //value.photos = response.data.photos;

                                                angular.forEach(response.data.photos, function(photo_value, photo_key) {
                                                        /*
                                                        photo_value.id = response.data.photos[photo_key].id;
                                                        photo_value.photo = response.data.photos[photo_key].photo;
                                                        photo_value.priority = response.data.photos[photo_key].priority;
                                                        */

                                                        angular.forEach(value.photos, function(photo_value2, photo_key2) {
                                                                if(photo_value2.id == photo_value.id) {
                                                                        photo_value2.priority = photo_value.priority;
                                                                        products_photos.push(photo_value2);
                                                                }
                                                        })
                                                });

                                                value.photo = response.data.photos[0].photo;


                                        }
                                });
                        }
                }, function (response) {


                }).then(function (response) {

                });
        }

        $scope.deletePhoto = function (item) {
                $http({

                        method: 'POST',
                        url:  '/admin/api/v1/product/deletePhoto/'+item.id,
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

                }).then(function (response) {
                        if(response.data.photos) {

                                angular.forEach($scope.products, function(value, key) {
                                        if(value.id == item.product_id) {
                                                value.photo = response.data.photos[0].photo;
                                                angular.forEach(value.photos, function(photo_value, photo_key) {

                                                        if(photo_value.id == item.id) {
                                                                var index = value.photos.indexOf(value.photos[photo_key]);
                                                                value.photos.splice(index, 1);
                                                        }
                                                });
                                                //value.photos = response.data.photos;
                                        }
                                });


                                /*
                                angular.forEach($scope.photos, function(value, key) {
                                        if(value.id == item.id) {
                                                var index = $scope.photos.indexOf($scope.photos[key]);
                                                $scope.photos.splice(index, 1);
                                        }
                                });
                                */

                        }
                }, function (response) {


                }).then(function (response) {

                });
        }

        $scope.approveProduct = function (item) {

                var status = 1;

                $http({

                        method: 'POST',
                        url:  '/admin/api/v1/product/changeStatusProduct/'+item.id,
                        data: {
                                'status': status
                        }

                }).then(function (response) {
                        item.status = status;
                }, function (response) {


                }).then(function (response) {

                });
        }

        $scope.banProduct = function (item) {

                var status = 1;

                $scope.modalInstance = ModalService.showModal({
                        templateUrl: 'ban-item-modal.html',
                        controller: 'productBan',
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
                                                        value.status = 3;
                                                        value.status_comment = result.status_comment;
                                                }
                                        });
                                }
                        });
                });
        }

        $scope.search = function(keyEvent) {
                if (keyEvent.which === 13) {
                        $scope.search_str = $('#m_form_search').val();
                        $scope.product_url = routes.products;
                        $scope.getProducts();
                }
        }

        $scope.changeStatusFilter = function() {

                $scope.search_not_public = $('#m_form_status').is(':checked');
                $scope.product_url = routes.products;
                $scope.getProducts();
        }

        $scope.pauseItem = function(pause, item) {

                $http({

                        method: 'POST',
                        url:  '/admin/api/v1/product/changePauseProduct/'+item.id,
                        data: {
                                'pause': pause
                        }

                }).then(function (response) {
                        item.pause = pause;
                }, function (response) {


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

        $scope.getProducts();
});

angular.module('flowApp').controller('productEdit', function($scope, close, item, photos, $element, $http, shareService, $rootScope) {

        //shareService.setItem(angular.copy(item));

        //$scope.item = shareService.getItem();

        $scope.item = angular.copy(item);
        //$rootScope.photos = item.photos;
        //$scope.photos = $rootScope.photos;
        $scope.photos = photos;
        $scope.specialOffers = jsonData.specialOffers;

        $scope.itemSpecialOffers = item.special_offer_id ? item.special_offer_id.split(',') : [];

        $scope.productTypes = jsonData.productTypes;
        $scope.colors = jsonData.colors;
        $scope.times = jsonData.times;

        $scope.item.make_time = $scope.item.make_time ? $scope.item.make_time : 90;

        $scope.save = function(result) {

                var specialOffers = [];
                $('[name="specialOffer[]"]:checked').each(function () {
                        specialOffers.push($(this).val());
                });

                result.special_offer_id = specialOffers.join();

                $http({

                        method: 'POST',
                        url:  routes.productUpdate,
                        data: $.param($scope.item),
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },

                }).then(function (response) {

                        $element.modal('hide');
                        angular.forEach($scope.photos, function(value, key) {
                                if(value.priority == 0) {
                                        result.photo = value.photo;
                                }
                        })

                        if(response.data.product) {
                                result.status = response.data.product.status;
                        }

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

angular.module('flowApp').controller('productBan', function($scope, close, item, $element, $http, CSRF_TOKEN) {
        $scope.item = angular.copy(item);

        $scope.save = function(result) {

                $http({

                        method: 'POST',
                        url:   '/admin/api/v1/product/changeStatusProduct/'+item.id,
                        data: {'status': 3, 'status_comment': result.status_comment}

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