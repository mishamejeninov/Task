
// "use strict";

var App = angular.module("TaskManager", ["ui.sortable" , "ui.bootstrap" , "jcs-autoValidate" , "ngRoute" , "ngResource"])

.config(function($routeProvider) {
    // $locationProvider.html5Mode(true);
    $routeProvider
        // .when('/', {
        //     templateUrl:'Angular-js-todolist-master/templates/login.html',
        //     // controller: 'TodoCtrl'
        // })
        .when('/login', {
            templateUrl:'Angular-js-todolist-master/templates/login.html',
            controller: 'loginController'
        })
        .when('/register', {
            templateUrl:'Angular-js-todolist-master/templates/register.html',
            controller: 'registerController'
        })
        .when('/task', {
            templateUrl:'Angular-js-todolist-master/templates/task.html',
            controller: 'taskController'
        })
        .when('/label', {
            templateUrl:'Angular-js-todolist-master/templates/label.html',
            controller: 'labelController'
        })
        .when('/users', {
            templateUrl:'Angular-js-todolist-master/templates/users.html',
            controller: 'usersController'
        })
        .otherwise({
            redirectTo: '/login'
        });
});
