function resourceErrorHandler(response)
{
    var $scope = angular.element( document.getElementById('view') ).scope();

    $scope.errorMessage = '';
    var errorList;

    if ( Array.isArray(response.data) ) {
        // creating Calories with empty fields returns:
        // [
        //  {"field":"calories_text","message":"Description cannot be blank."},
        //  {"field":"calories_number","message":"Number of Calories cannot be blank."}
        // ]
        errorList = response.data;
        for (var i = 0; i < errorList.length; i++) {
            $scope.errorMessage += errorList[i].message + ' ';
        }
    } else {
        try {
            errorList = JSON.parse(response.data.message);
            
            for(var attribute in errorList) {
                $scope.errorMessage += errorList[attribute] + ' ';
            }
        } catch(e) {
            $scope.errorMessage = response.data.message;
        }
    }        

    $scope.error = true;
    
}
