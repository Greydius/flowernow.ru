'use strict';

angular.module('flowApp').controller('orderView', function($scope, $element, $http, CSRF_TOKEN) {

    $scope.order = jsonData.order;
    $scope.mode = "view";
    
    console.log($scope.order);

    $scope.save = function() {
        $http({

            method: 'POST',
            url:  jsonData.orderUpdateUrl,
            data: {
                'receiving_date': $scope.order.receiving_date,
                'receiving_time': $scope.order.receiving_time,
                'name': $scope.order.name,
                'phone': $scope.order.phone,
                'email': $scope.order.email,
                'recipient_self': $scope.order.recipient_self,
                'recipient_name': $scope.order.recipient_name,
                'recipient_phone': $scope.order.recipient_phone,
                'text': $scope.order.text,
                'recipient_address': $scope.order.recipient_address,
                'recipient_info': $scope.order.recipient_info,
                'csrf-token': CSRF_TOKEN
            }

        }).then(function (response) {
            window.location.reload(false);
        }, function (response) {
            toastr.error('Ошибка');

        }).then(function (response) {

        });
    }
    
});