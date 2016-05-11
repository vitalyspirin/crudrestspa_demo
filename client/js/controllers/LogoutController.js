function LogoutController($scope, $http, $location, $rootScope)
{
    CurrentUser.clear();
    $rootScope.CurrentUser.user_id = null;
    
    $location.path('/login');
}
