
var App = angular.module('App', ['ngRoute', 'ngResource']);


App.config(function($routeProvider) {

    $routeProvider

        // route for the about page
        .when('/login', {
            templateUrl : 'pages/login.html',
            controller  : 'LoginController'
        })
        
        .when('/logout', {
            templateUrl : 'pages/login.html',
            controller  : 'LogoutController'
        })

        .when('/calories/user/:user_id', {
            templateUrl : 'pages/calories/index.html',
            controller  : 'CaloriesIndexController'
        })
        
        .when('/calories/:calories_id', {
            templateUrl : 'pages/calories/delete.html',
            controller  : 'CaloriesDeleteController',
            resolve     : {
                action  :   function() {return 'read';}
            }
        })
        
        .when('/calories/update/:calories_id', {
            templateUrl : 'pages/calories/update.html',
            controller  : 'CaloriesUpdateController'
        })
        
        .when('/calories/delete/:calories_id', {
            templateUrl : 'pages/calories/delete.html',
            controller  : 'CaloriesDeleteController',
            resolve     : {
                action  :   function() {return 'delete';}
            }
        })

        .when('/users', {
            templateUrl : 'pages/users/index.html',
            controller  : 'UserIndexController'
        })

        .when('/users/:user_id', {
            templateUrl : 'pages/users/delete.html',
            controller  : 'UserDeleteController',
            resolve     : {
                action  :   function() {return 'read';}
            }
        })

        .when('/users/delete/:user_id', {
            templateUrl : 'pages/users/delete.html',
            controller  : 'UserDeleteController',
            resolve     : {
                action  :   function() {return 'delete';}
            }
        })

        .when('/users/update/:user_id', {
            templateUrl : 'pages/users/update.html',
            controller  : 'UserUpdateController',
        })
        
        .when('/debug/', {
            templateUrl : 'pages/debug.html',
            controller  : 'DebugController'
        })

        .otherwise( {redirectTo : redirect() });
});

function redirect(user_id)
{
    CurrentUser.load();
    if (CurrentUser.user == null) {
        redirectUrl = '/login';
    } else if (CurrentUser.user.user_role == 'user') {
        redirectUrl = '/calories/user/' + CurrentUser.getId();
    } else {
        redirectUrl = '/users';
    }

    return redirectUrl;
}


App.controller('DebugController', DebugController);

App.controller('LoginController', LoginController);
App.controller('LogoutController', LogoutController);

App.controller('CaloriesIndexController', CaloriesIndexController);
App.controller('CaloriesDeleteController', CaloriesDeleteController);
App.controller('CaloriesUpdateController', CaloriesUpdateController);

App.controller('UserIndexController', UserIndexController);
App.controller('UserDeleteController', UserDeleteController);
App.controller('UserUpdateController', UserUpdateController);


App.factory('User', User);
App.factory('Calories', Calories);


App.directive('datepicker', DatepickerDirective);


App.run( 
    function($rootScope)
    {
        CurrentUser.load();
        $rootScope.CurrentUser  = CurrentUser.user;

        $("ul.nav.navbar-nav").show(); // show menu only after Angular is loaded
                                       // so that {{ }} would be rendered properly

    }
);
