function UserDeleteController($scope, $location, $routeParams, User, action)
{
    if (CurrentUser.getId() == null) {
        $location.path('/login');
        return;
    }


    $scope.action = action;
    if (action == 'delete') {
        $scope.cancelButtonLabel = 'Cancel';
    } else {
        $scope.cancelButtonLabel = 'OK';
    }
    
    $scope.cancel = function()
    {
        $location.path('/users');
    };


    $scope.userLabelList = User.getLabels();
    
    var params = {
        user_id: $routeParams.user_id, 
        user_accesstoken: CurrentUser.getAccessToken()
    };
    $scope.user = User.get(params);
    
    $scope.delete = function(user_id)
    {
        User.delete(params, function() 
        {
            $location.path('/users');
        });
    };


}
