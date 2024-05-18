
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}


function validateForm() {
    
    var email = document.forgotForm.email.value;
    var frname = document.forgotForm.recovery_account.value;
    
    var fnameErr=emailErr=true;


    if (frname == "") {
        printError("frameErr", "Please enter your username");
    } else {

            printError("frameErr", "");
            fnameErr = false;
    }
    
    
    if (email == "") {
        printError("emailErr", "Please enter your email address");
    } else {
        var regex = /^\S+@\S+\.\S+$/;
        if (regex.test(email) === false) {
            printError("emailErr", "Please enter a valid email address");
        } else {
            printError("emailErr", "");
            emailErr = false;
        }
    }


    
    if ((frnameErr||emailErr) == true)
     {
        return false;
    }
    else {


    }
};
