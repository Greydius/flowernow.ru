'use strict';

angular.module('flowApp').controller('promo-create', function($scope, $element, $http, CSRF_TOKEN, $httpParamSerializerJQLike) {
        $scope.promo = {};
        $scope.code = null;

        $scope.create = function(e) {

                e.preventDefault();

                var $form = angular.element(e.target);
                var $btn = $form.find('[type="submit"]');

                $btn.prop('disabled', true);

                $http({
                        method: 'POST',
                        url:  $form.attr('action'),
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        data: $httpParamSerializerJQLike($scope.promo)

                }).then(function (response) {
                        var data = response.data;
                        $scope.promo = {};
                        $scope.code = data.promo;
                }, function (response) {
                        if(response.data.error && response.data.message) {
                                    toastr.error(response.data.message);
                        } else {
                                    toastr.error('Ошибка!');
                        }

                }).then(function (response) {
                        $btn.prop('disabled', false);
                });

        };
});