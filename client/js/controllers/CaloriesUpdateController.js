function CaloriesUpdateController($scope, $location, $routeParams, Calories)
{
    if (CurrentUser.getId() == null) {
        $location.path('/login');
        return;
    }


    var params = {
        user_accesstoken: CurrentUser.getAccessToken()
    };


    $scope.cancel = function()
    {
        $location.path('/calories/user/' + CurrentUser.getId());
    };

    
    $scope.save = function()
    {
        if ($routeParams.calories_id != 'null')
        {
            Calories.update(params, $scope.calories, function() {
                $location.path('/calories/user/' + CurrentUser.getId());
            });
        } else {
            Calories.save(params, $scope.calories, function() {
                $location.path('/calories/user/' + CurrentUser.getId());
            });
        }
    };


    $scope.caloriesLabelList = Calories.getLabels();
    
    if ($routeParams.calories_id != 'null')
    {
        params.calories_id = $routeParams.calories_id;
        
        $scope.calories = Calories.get(params);
    } else {
        $scope.calories = {};
        $scope.calories.calories_datetime = Utils.getMySQLDateFromJSDate(new Date());
        $scope.calories.calories_text = '';
        $scope.calories.calories_number = '';
        $scope.calories.user_id = CurrentUser.getId();
    }


}
