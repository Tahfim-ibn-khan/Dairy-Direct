
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}


function validateForm() {
    
   
    var mail = document.signinForm.email.value;
    var password = document.signinForm.password.value;
    

    
    var  emailErr=passwordErr= true;

   

    
    if (mail == "") {
        printError("emailErr", "Please enter your email address");
    } else {
        var regex = /^\S+@\S+\.\S+$/;
        if (regex.test(mail) === false) {
            printError("emailErr", "Please enter a valid email address");
        } else {
            printError("emailErr", "");
            emailErr = false;
        }
    }

    
    if (password == "") {
        printError("passwordErr", "Please enter your password");
    } else {
        var regex = /^[a-zA-Z\s]+$/;
        if (regex.test(password) === false) {
            printError("passwordErr", "Please Enter a Password");
        } else {
            printError("passwordErr", "");
            passwordErr = false;
        }
    }



    
    if (( emailErr||passwordErr) == true)
     {
        return false;
    }
    else {


    }
};
