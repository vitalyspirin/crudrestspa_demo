var CaloriesModel =
{
    getCaloriesListWithFlag :   function(caloriesList, user_expectedcalories)
    {
        var CaloriesPerDayList = this.getCaloriesPerDayList(caloriesList);

        for(var i = 0; i < caloriesList.length; i++) {
    
            var caloriesDateStr = 
                Utils.getDateStrFromMySQLDateTime(caloriesList[i].calories_datetime);
                
            if (CaloriesPerDayList[caloriesDateStr] > user_expectedcalories) {
                caloriesList[i].exceededLimit = true;
            } else {
                caloriesList[i].exceededLimit = false;
            }
        }

        return caloriesList;
    },

    
    getCaloriesPerDayList   :   function(caloriesList)
    {
        var CaloriesPerDayList = {};
        
        var date = null;
        var caloriesDaily = 0;
        for(var i = 0; i < caloriesList.length; i++) {
            
            var caloriesDateStr = 
                Utils.getDateStrFromMySQLDateTime(caloriesList[i].calories_datetime);
            
            if (date != caloriesDateStr) {
                if (date != null) {
                    CaloriesPerDayList[date] = caloriesDaily;
                }
                date = caloriesDateStr;
                caloriesDaily = caloriesList[i].calories_number;
            } else {
                caloriesDaily += caloriesList[i].calories_number;
            }

        }
        CaloriesPerDayList[date] = caloriesDaily;

        return CaloriesPerDayList;         
    }
    
    
}
