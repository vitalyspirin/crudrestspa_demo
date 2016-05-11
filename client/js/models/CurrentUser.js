var CurrentUser = 
{
    user    :
    {
        user_id             :   null,
        user_firstname      :   null,
        user_lastname       :   null,
        user_accesstoken    :   null,
        user_role           :   null,
        user_expectedcalories:  null
    },
    
    
    save    :   function()
    {
        sessionStorage.setItem('CurrentUser', JSON.stringify(this.user));
    },
    
    
    load    :   function()
    {
        user = sessionStorage.getItem('CurrentUser');
        
        if (user != null) {
            CurrentUser.user = JSON.parse(user);
        }
    },
    
    
    getId   :   function()
    {
        this.load();

        return CurrentUser.user.user_id;
    },

    
    getAccessToken  :   function()
    {
        return this.user.user_accesstoken;
    },

    
    clear   :   function()
    {
        sessionStorage.removeItem('CurrentUser');
    }
    
}
