function DebugController($scope, $http, $location, $rootScope)
{
console.log('inside DebugController()');

    $scope.sessionStorage = sessionStorage;
    $scope.currentUser = CurrentUser;
}
