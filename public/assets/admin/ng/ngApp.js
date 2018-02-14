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
        }]).directive('bsTooltip', function() {
                return {
                        restrict: 'A',
                        link: function(scope, element, attrs) {
                                $(element).hover(function() {
                                        $(element).tooltip('show');
                                }, function() {
                                        $(element).tooltip('hide');
                                });
                        }
                };
        }).directive('postsPagination', function(){
           return{
              restrict: 'E',
              template: '<ul class="pagination">'+
                '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPosts(1)">«</a></li>'+
                '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPosts(currentPage-1)">‹ Prev</a></li>'+
                '<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
                    '<a href="javascript:void(0)" ng-click="getPosts(i)">{{i}}</a>'+
                '</li>'+
                '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPosts(currentPage+1)">Next ›</a></li>'+
                '<li ng-show="currentPage != totalPages"><a href="javascript:void(0)" ng-click="getPosts(totalPages)">»</a></li>'+
              '</ul>'
           };
        });

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