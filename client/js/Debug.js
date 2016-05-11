var Debug = {
    fillLoginFieldsAsUser : function() {
        var changeEvent = new Event('change');
                    
        var inputEmail = document.getElementById('inputEmail');
        var inputPassword = document.getElementById('inputPassword');
        
        var newUser = document.getElementById('newUser'); 
        if (newUser.checked == false) {
            inputEmail.value = "vitaly.spirin@gmail.com";
            inputEmail.dispatchEvent(changeEvent);

            inputPassword.value = "vitaly";
            inputPassword.dispatchEvent(changeEvent);
        } else {
            inputEmail.value = "john" + Date.now() + "@gmail.com";
            inputEmail.dispatchEvent(changeEvent);
            inputPassword.value = "john";
            inputPassword.dispatchEvent(changeEvent);
            
            var inputRetypePassword = document.getElementById('inputRetypePassword');
            inputRetypePassword.value = inputPassword.value;
            inputRetypePassword.dispatchEvent(changeEvent);
            
            var inputFirstName = document.getElementById('inputFirstName');
            inputFirstName.value = "John";
            inputFirstName.dispatchEvent(changeEvent);
            
            var inputLastName = document.getElementById('inputLastName');
            inputLastName.value = "Smith";
            inputLastName.dispatchEvent(changeEvent);
        }

    },
    
    fillLoginFieldsAsManager : function() {
        var changeEvent = new Event('change');
                    
        var inputEmail = document.getElementById('inputEmail');
        var inputPassword = document.getElementById('inputPassword');
        
        var newUser = document.getElementById('newUser'); 
        if (newUser.checked == false) {
            inputEmail.value = "john.smith@gmail.com";
            inputEmail.dispatchEvent(changeEvent);

            inputPassword.value = "john";
            inputPassword.dispatchEvent(changeEvent);
        }
    }
    
    
}
