'use strict';

angular.module('flowApp').controller('mainPage', function($scope, $element, $http, ModalService, $httpParamSerializerJQLike) {
        $scope.popularProduct = jsonData.popularProduct;
        $scope.flowers = jsonData.flowers;
        $scope.productTypes = jsonData.productTypes;
        $scope.colors = jsonData.colors;
        $scope.times = jsonData.times;
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

                return;

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

                var $productType = $('.filter-product-type li.active');
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
                /*
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
                */
				
                var newurl = $scope.prepareUrl(path);

                
				//window.history.pushState({path:newurl},'',newurl);
                 
				if(current_lang == 'en'){
          if (currentCity != 'moskov') {
            newurl = newurl.replace(".ru", `.ru/en/${currentCity}`);
          } else {
            newurl = newurl.replace(".ru", `.ru/en/`);
          }
				} 
				//console.log(current_lang+'-'+newurl);
				window.location = newurl;
        }

        $scope.prepareUrl = function(path) {
                var url = '/catalog/';
                var getParams = {};

                url += path.productType;

                if(path.flowers.length) {
                        url += '/' + path.flower[0];
                        if(path.flowers.length > 1) {
                                getParams.flowers = path.flowers.slice(1)
                        }
                } else if(path.productType != 'single') {
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

                return newurl;
        }

        $scope.mobileFilter = function() {

                var $productType = $('[name="m-filter-product-type"]:checked');
                var $productFlower = $('input[name="m-flowers[]"]:checked');
                var $productPrice = $('[name="m-price"]:checked');
                var $productColor = $('[name="m-filter-color"]:checked');

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
                        $scope.filters.color = $productColor.val();
                        path.color = $productColor.val();
                }

                if(Object.keys($scope.filters).length) {
                        $scope.isFiltered = true;
                } else {
                        $scope.isFiltered = false;
                }

                $scope.mobileChangeUrl(path);
        }

        $scope.mobileChangeUrl = function(path) {
                var newurl = $scope.prepareUrl(path);

                if (current_lang == 'en') {
                  if (currentCity != 'moskov') {
                    newurl = newurl.replace(".ru", `.ru/en/${currentCity}`);
                  } else {
                    newurl = newurl.replace(".ru", `.ru/en/`);
                  }
                }

                console.log(newurl);

                window.location = newurl;
        }

        $scope.mobileFilterReset = function () {
                window.location = '/';
        }

        $scope.closeMobileFilter = function () {
                $('.filters-container').removeClass('active');
                $('body').removeClass('blocked');
        }

        $scope.showMobileFilter = function () {
                $('.filters-container').addClass('active');
                $('body').addClass('blocked');
        }

        $scope.editItem = function (e, itemId) {

                $http({

                        method: 'GET',
                        url:  '/admin/api/v1/product/' + itemId,
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

                }).then(function (response) {
                        $scope.item = response.data.product;
                        $scope.modalInstance = ModalService.showModal({
                                templateUrl: 'edit-item-modal.html',
                                controller: 'productEdit',
                                inputs: {
                                        item: $scope.item
                                },
                                scope: $scope
                        });

                        $scope.modalInstance.then(function(modal) {
                                modal.element.modal();
                        });
                }, function (response) {
                        $('.preloader-wrapper').hide();

                }).then(function (response) {
                        $('.preloader-wrapper').hide();
                });


                /*
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
                */
        }

        $scope.starItem = function(star, itemId) {
                $http({

                        method: 'POST',
                        url:  '/admin/api/v1/product/changeStarProduct/'+itemId,
                        data: {
                                'star': star
                        }

                }).then(function (response) {
                        window.location.reload();
                }, function (response) {


                }).then(function (response) {

                });
        }
})

angular.module('flowApp').controller('productEdit', function($scope, close, item, $element, $http, shareService, $rootScope) {

        $scope.save = function(result) {
                console.log($scope.item);

                $http({

                        method: 'POST',
                        url:  '/admin/products/update',
                        data: $.param($scope.item),
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },

                }).then(function (response) {

                        $element.modal('hide');
                        window.location.reload();

                }, function (response) {
                        if(response.data.error && response.data.message) {
                                alert(response.data.message);
                        } else {
                                alert('Ошибка!');
                        }
                }).then(function (response) {

                });

                /*
                $element.modal('hide');
                close(result, 500);
                */
        };

})