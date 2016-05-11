
function CaloriesIndexController($scope, $http, $location, $routeParams, $rootScope,
    Calories)
{
    if (CurrentUser.getId() == null) {
        $location.path('/login');
        return;
    }

    
    $scope.caloriesLabelList = Calories.getLabels();

    var params = {
        user_id: CurrentUser.getId(),
        user_accesstoken: CurrentUser.getAccessToken(), 
    };
    
    $scope.filter = function()
    {
        for (var property in $scope.filterParams) {
            params[property] = $scope.filterParams[property];
        }
        
        caloriesList = Calories.search(params, function() {
                caloriesList = CaloriesModel.getCaloriesListWithFlag(caloriesList, 
                    CurrentUser.user.user_expectedcalories);

                $scope.caloriesList = caloriesList;
        });
    }

    $scope.clearFilter = function()
    {
        $scope.filterParams.fromDate = '';
        $scope.filterParams.toDate = '';
        $scope.filterParams.fromTime = '';
        $scope.filterParams.toTime = '';
    }
    
    $scope.read = function(calories_id)
    {
        $location.path('/calories/' + calories_id);
    };

    $scope.update = function(calories_id)
    {
        $location.path('/calories/update/' + calories_id);
    };
    
    $scope.delete = function(calories_id)
    {
        $location.path('/calories/delete/' + calories_id);
    }
            

    var caloriesList = Calories.query(params,
        function(caloriesList) {
            caloriesList = CaloriesModel.getCaloriesListWithFlag(caloriesList, 
                                CurrentUser.user.user_expectedcalories);
            $scope.caloriesList = caloriesList;
            
            if (caloriesList.length > 0) {
                var dateTimeFrom = new Date(caloriesList[0].calories_datetime);
                $scope.filterParams.fromDate = Utils.getDateFromJSDateTime(dateTimeFrom);
                
                var dateTimeTo = new Date(caloriesList[caloriesList.length - 1].calories_datetime);
                $scope.filterParams.toDate = Utils.getDateFromJSDateTime(dateTimeTo);
            }
                    
        }
    );


}
