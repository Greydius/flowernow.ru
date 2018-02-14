'use strict';

angular.module('flowApp').controller('shopProfile', function($scope, $element, $http) {

        $scope.shop = jsonData.shop;
        $scope.address = jsonData.address;
        $scope.usersDirector = jsonData.workerDirector;
        $scope.usersFlorist = jsonData.workerFlorist;


        $scope.getShop = function() {
                $http({

                        method: 'GET',
                        url:  routes.shop + '/' + $('input[name="id"]').val(),
                        //data: $.param(data),
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },

                }).then(function (response) {
                        $scope.shop = response.data.shop;
                }, function (response) {


                }).then(function (response) {

                });

        };

        $scope.addNewAddress = function () {
                $scope.address.push({
                        name: ''
                })
        }

        $scope.deleteAddress = function (item) {
                var index = $scope.address.indexOf(item);
                $scope.address.splice(index, 1);
        }
        
        $scope.addNewDirector = function () {
                $scope.usersDirector.push({
                        name: ''
                })
        }

        $scope.deleteDirector = function (item) {
                var index = $scope.usersDirector.indexOf(item);
                $scope.usersDirector.splice(index, 1);
        }
        
        $scope.addNewFlorist = function () {
                $scope.usersFlorist.push({
                        name: ''
                })
        }

        $scope.deleteFlorist = function (item) {
                var index = $scope.usersFlorist.indexOf(item);
                $scope.usersFlorist.splice(index, 1);
        }
        

        if(!Object.keys($scope.address).length) {
                $scope.addNewAddress();
        }
        
        if(!Object.keys($scope.usersDirector).length) {
                $scope.addNewDirector();
        }
})