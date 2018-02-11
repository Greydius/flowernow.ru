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
        }]).directive('phonemask', ['$timeout', function($timeout) {
                return {
                        link: function(scope, element, attr) {
                                $timeout(function() {
                                        element.mask("+7(999)999-99-99");;
                                });
                        }
                }
        }]);

})(window.angular);

angular.module('flowApp').factory('shareService', ['$timeout', function($timeout) {
        var item = {};

        return {

                getItem : function () {
                        return item;
                },

                setItem : function (newItem) {
                        item = newItem;
                        console.log(item);
                }

        }
}])