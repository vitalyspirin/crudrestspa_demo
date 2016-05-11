function LoginController($scope, $http, $location, $rootScope, User)
{
    $scope.error = false;
    
    $scope.submit = function() {

        var url = APIURLs.users();

        User.save($scope.user, function(user) {
            CurrentUser.user = user;
            CurrentUser.save();
            
            $rootScope.CurrentUser = CurrentUser.user;
            
            if (CurrentUser.user.user_role == 'user') {
                $location.path('/calories/user/' + CurrentUser.getId());
            } else {
                $location.path('/users');
            }
        });

    }
    
    
}
