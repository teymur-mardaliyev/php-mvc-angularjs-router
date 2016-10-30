/**
 * Created by Tima on 5/23/16.
 */

var routerApp = angular.module('routerApp', [
    'ngRoute',
    'routerControllers',
    'ui.bootstrap'
]).config(['$httpProvider', function ($httpProvider) {
    /*
     * It is for $_SERVER['SERVER_X_REQUESTED_WITH'].
     * In October 2012, Angular.js removed this header because they felt that it was rarely used.
     * @link - http://stackoverflow.com/questions/20475460/laravel-angularjs-requestajax-always-false
     * */
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
}]);


routerApp.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.when('/', {
            templateUrl: 'page/homepage',
            controller: 'HomeAction'
        }).when('/contact', {
            templateUrl: 'page/contact',
            controller: 'ContactAction'
        }).when('/category', {
            templateUrl: 'page/category',
            controller: 'CategoryAction'
        }).when('/category/:url', {
            templateUrl: function(params){
                return 'page/category/'+params.url
            },
            controller: 'CategoryAction'
        }).when('/articles', {
            // for list
            templateUrl: 'page/articles',
            controller: 'ArticleAction'
        }).when('/article/:url', {
            // for view
            // There we push `url` to our php router and then we can get template name of article
            templateUrl: function (params) {
                return 'page/article/' + params.url;
            },
            controller: 'ArticleAction'
        }).when('/add-article', {
            templateUrl: 'page/add-article',
            controller: 'ArticleAction'
        }).when('/edit-article/:id', {
            templateUrl: 'page/edit-article',
            controller: 'ArticleAction'
        }).otherwise({
            redirectTo: '/'
        });
    }]);


routerApp.service('remoteSendServices', ['$http', function ($http) {
    this.remoteSend = function ($scope, data, remote_url, _callback_) {
        $scope.formData = angular.copy(data);
        //console.log($scope.formData);
        $http({
            method: 'POST',
            url: remote_url,
            data: $.param($scope.formData),  // pass in data as strings
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}  // set the headers so angular passing info as form data (not request payload)
        }).success(function (data) {
            _callback_(data);
        });
    };
}]);

routerApp.service('friendUrl', [function () {
    this.runFriendUrl = function ($element, $id) {
        $($element).friendurl({id: $id, divider: '-', transliterate: true});

    }
}]);

routerApp.service('modalbox', ['$uibModal', function ($uibModal) {

    var modal = null;

    this.openModal = function (contentURL, _controller_, size, callback_, content) {

        modal = $uibModal.open({
            animation: true,
            templateUrl: contentURL,
            controller: _controller_,
            size: size
        });

        modal.result.then(function (arg) {
            if (arg == 'confirm') {
                callback_();
            }
        });
    };

}]);