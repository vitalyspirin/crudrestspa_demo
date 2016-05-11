function UserUpdateController($scope, $location, $routeParams, User)
{
    if (CurrentUser.getId() == null) {
        $location.path('/login');
        return;
    }
    

    var params = {
        user_id: $routeParams.user_id, 
        user_accesstoken: CurrentUser.getAccessToken()
    };


    $scope.cancel = function()
    {
        $location.path('/users');
    };


    $scope.save = function()
    {
        if ($routeParams.user_id != 'null')
        {
            User.update(params, $scope.user, function() {
                $location.path('/users');
            });
        } else {
            User.save($scope.user, function() {
                $location.path('/users');
            });
        }
    }


    $scope.userLabelList = User.getLabels();
    $scope.userRoleList = User.getRoles();
    
    if ($routeParams.user_id != 'null')
    {
        $scope.user = User.get(params);
    } else {
        $scope.user = {};
        $scope.user.user_firstname = '';
        $scope.user.user_lasttname = '';
        $scope.user.user_role = 'user';
        $scope.user.user_expectedcalories = 2500;
    }

    
}
