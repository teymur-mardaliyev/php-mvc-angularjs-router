/**
 * Created by Tima on 5/23/16.
 */

var routerControllers = angular.module('routerControllers', []);

routerControllers.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance) {
    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
    $scope.modalconfirm = function () {
        $uibModalInstance.close('confirm');
    };
});

routerControllers.controller('HomeAction', ['$scope', '$http', 'remoteSendServices',

    function ($scope, $http) {

        $scope.posts = [];

        $scope.getAllPosts = function () {
            $http.get('ajax/post/all').success(function (data) {
                $scope.posts = data;
            });

            $scope.orderProp = '-id';
        };

    }]);

routerControllers.controller('ContactAction', ['$scope', '$http', 'remoteSendServices',

    function ($scope, $http, remoteSendServices) {

        $scope.sendContact = function (form_data) {
            console.log(form_data);
            function _callback_(data) {
                if (data.status == 200) {
                    $(".contac-form input,.contac-form textarea").val("");
                    $(".contac-form select").select();
                    $scope.alert_mode = 'success';
                    $scope.alert_message = 'Your message has been sent!';
                } else {
                    $scope.alert_mode = 'warning';
                    $scope.alert_message = 'Your message has not been sent!';
                }
            }

            remoteSendServices.remoteSend($scope, form_data, 'contact/send', _callback_)
        };

    }]);

routerControllers.controller('CategoryAction', ['$scope', '$http', 'remoteSendServices', 'modalbox', 'friendUrl',

    function ($scope, $http, remoteSendServices, modalbox, friendUrl) {

        $scope.selected = {};
        $scope.categories = [];
        $scope.category = [];
        $scope.posts = [];

        $scope.getCategories = function () {
            $http.get('ajax/category/all').success(function (data) {
                $scope.categories = data;
            });

            $scope.orderProp = '-id';
        };

        $scope.objectToArray = function (obj) {
            $scope.arrFromMyObj = Object.keys(obj).map(function (key) {
                return obj[key];
            });
        };

        $scope.getCategoryPosts = function (id) {
            $http.get('ajax/category/posts/'+id).success(function (data) {
                $scope.posts = data;
            });

            $scope.orderProp = '-id';
        };

        $scope.addNewCategory = function (form_data) {
            console.log(form_data);
            function _callback_(data) {
                if (data.status == 200) {
                    $(".category-form input").val("");
                    $(".category-form select").select();
                    $scope.getCategories();
                    $scope.alert_mode = 'success';
                    $scope.alert_message = 'Category has been inserted successfully!';
                } else {
                    $scope.alert_mode = 'warning';
                    $scope.alert_message = 'Category has not been inserted!';
                }
            }

            remoteSendServices.remoteSend($scope, form_data, 'ajax/category/add', _callback_)
        };


        $scope.removeCategory = function (index, category) {

            var modalContent = {
                title: 'Modal title',
                body: 'Body message'
            };

            modalbox.openModal('myModalContent.html', 'ModalInstanceCtrl', '', confirm_, modalContent);

            function _callback_(data) {
                if (data.status == 200) {
                    $scope.alert_mode = 'danger';
                    $scope.alert_message = 'Category has been removed successfully!';
                    $scope.categories.splice(index, 1);
                } else {
                    $scope.alert_mode = 'warning';
                    $scope.alert_message = 'Category has not been removed!';
                }
            }

            function confirm_() {
                remoteSendServices.remoteSend($scope, category, 'ajax/category/remove', _callback_);
            }
        };

        $scope.reset = function () {
            $scope.selected = {};
        };

        friendUrl.runFriendUrl('.slug-link:first , #slug-link', 'slug-link');

    }]);

routerControllers.controller('ArticleAction', ['$scope', '$http', '$routeParams', 'remoteSendServices', 'modalbox', 'friendUrl',

    function ($scope, $http, $routeParams, remoteSendServices, modalbox, friendUrl) {

        $scope.categories = [];
        $scope.articles = [];
        $scope.article = [];


        $scope.getCategories = function () {
            $http.get('ajax/category/all').success(function (data) {
                $scope.categories = data;
            });

            $scope.orderProp = '-id';
        };

        $scope.getArticles = function () {
            $http.get('ajax/article/all').success(function (data) {
                $scope.articles = data;
            });

            $scope.orderProp = '-id';
        };

        /*
         Also, you can use like below.
         $scope.getArticle = function ($id) {
             $http.get('ajax/article/get/' + $id ? $id : $routeParams.id).success(function (data) {
                $scope.article = data;
             });
         };
         */

        $scope.getEditArticle = function () {
            $http.get('ajax/article/get/' + $routeParams.id).success(function (data) {
                $scope.article = data;
            });
        };

        $scope.getArticle = function ($id) {
            $http.get('ajax/article/get/' + $id).success(function (data) {
                $scope.article = data;
            });
        };

        $scope.objectToArray = function (obj) {
            $scope.arrFromMyObj = Object.keys(obj).map(function (key) {
                return obj[key];
            });
        };

        $scope.addNewArticle = function (form_data) {
            console.log(form_data);
            function _callback_(data) {
                if (data.status == 200) {
                    $(".article-form input, .article-form textarea").val("");
                    $(".category-form select").select();
                    $scope.alert_mode = 'success';
                    $scope.alert_message = 'Article has been inserted successfully!';
                } else {
                    $scope.alert_mode = 'warning';
                    $scope.alert_message = 'Article has not been inserted!';
                }
            }

            remoteSendServices.remoteSend($scope, form_data, 'ajax/article/insert', _callback_)
        };

        $scope.editArticle = function (form_data) {
            console.log(form_data);
            form_data.id = $routeParams.id;
            function _callback_(data) {
                if (data.status == 200) {
                    $scope.alert_mode = 'success';
                    $scope.alert_message = 'Article has been updated successfully!';
                } else {
                    $scope.alert_mode = 'warning';
                    $scope.alert_message = 'Article has not been updated!';
                }
            }

            remoteSendServices.remoteSend($scope, form_data, 'ajax/article/update', _callback_)
        };

        $scope.removeArticle = function (index, article) {

            var modalContent = {
                title: 'Modal title',
                body: 'Body message'
            };

            modalbox.openModal('myModalContent.html', 'ModalInstanceCtrl', '', confirm_, modalContent);

            function _callback_(data) {
                if (data.status == 200) {
                    $scope.alert_mode = 'danger';
                    $scope.alert_message = 'Article has been removed successfully!';
                    $scope.articles.splice(index, 1);
                } else {
                    $scope.alert_mode = 'warning';
                    $scope.alert_message = 'Article has not been removed!';
                }
            }

            function confirm_() {
                remoteSendServices.remoteSend($scope, article, 'ajax/article/remove', _callback_);
            }
        };

        $scope.getCategories();
        $scope.getArticles();
        //$scope.getEditArticle();

        friendUrl.runFriendUrl('.slug-link:first , #slug-link', 'slug-link');


    }]);