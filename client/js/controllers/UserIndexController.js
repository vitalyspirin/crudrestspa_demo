function UserIndexController($scope, $http, $location, $routeParams, User)
{
    if (CurrentUser.user.user_role != 'manager') {
        $location.path('/calories/user/' + CurrentUser.getId());
        return;
    }


    $scope.userLabelList = User.getLabels();
    
    $scope.userList = User.query( {user_accesstoken: CurrentUser.getAccessToken()} );

    
    $scope.read = function(user_id)
    {
        $location.path('/users/' + user_id);
    };

    $scope.update = function(user_id)
    {
        $location.path('/users/update/' + user_id);
    };
    
    $scope.delete = function(user_id)
    {
        $location.path('/users/delete/' + user_id);
    }


}
