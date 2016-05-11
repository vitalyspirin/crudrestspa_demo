function CaloriesDeleteController($scope, $location, $routeParams, action, Calories)
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
        $location.path('/calories/user/' + CurrentUser.getId());
    };


    $scope.delete = function(calories_id)
    {
        Calories.delete(params, function() {
            $location.path('/calories/user/' + CurrentUser.getId());
        });
    };


    $scope.caloriesLabelList = Calories.getLabels();
    
    var params = {
        calories_id: $routeParams.calories_id, 
        user_accesstoken: CurrentUser.getAccessToken()
    };
    $scope.calories = Calories.get(params);


}
