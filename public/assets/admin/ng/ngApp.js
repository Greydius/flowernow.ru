(function(angular) {
        'use strict';
        var myApp = angular.module('flowApp', ['angularModalService'], function($interpolateProvider) {
                $interpolateProvider.startSymbol('<%');
                $interpolateProvider.endSymbol('%>');
        });

        myApp.directive('select2', ['$timeout', function($timeout) {
                return {
                        link: function(scope, element, attr) {
                                $timeout(function() {
                                        element.select2({});
                                });
                        }
                }
        }])

})(window.angular);