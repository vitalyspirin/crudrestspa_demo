var APIURLs = {
    
    path    :   function()
    {
        return window.location.pathname + '../server/web/v1/';
    },

    userLabels  : function()
    {
        var url = window.location.origin + this.path() + 'user/labels';
        return url;
    },

    userRoles  : function()
    {
        var url = window.location.origin + this.path() + 'user/roles';
        return url;
    },


    users    :   function(user_id)
    {
        var url = window.location.origin + this.path() + 'users/:user_id';

        return url;
    },    
    
    
    caloriesLabels  : function()
    {
        var url = window.location.origin + this.path() + 'calories/labels';
        return url;
    },

    
    caloriesIndex  : function()
    {
        var url = window.location.origin + this.path() + 'calories/user/:user_id';
        return url;
    },


    caloriesSearch  : function()
    {
        var url = window.location.origin + this.path() + 
            'calories/user/:user_id/search';
        return url;
    },


    calories  : function()
    {
        var url = window.location.origin + this.path() + 'calories/:calories_id';
        
        return url;
    }
    
    
}
