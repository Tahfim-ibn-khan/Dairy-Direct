
function printError(elemId, hintMsg) {
    document.getElementById(elemId).innerHTML = hintMsg;
}


function validateForm() {
    
    var f_name = document.offer.fname.value;
    var l_name = document.offer.lname.value;

    
    var fnameErr = lnameErr = true;

    
    if (f_name == "") {
        printError("fnameErr", "Please enter your offer name");
    } else {
        var regex = /^[a-zA-Z\s]+$/;
        if (regex.test(f_name) === false) {
            printError("fnameErr", "Please enter a valid offer name");
        } else {
            printError("fnameErr", "");
            fnameErr = false;
        }
    }

    
    if (l_name == "") {
        printError("lnameErr", "Please enter your offer details");
    } else {
        var regex = /^[a-zA-Z\s]+$/;
        if (regex.test(l_name) === false) {
            printError("lnameErr", "Please enter a valid offer details");
        } else {
            printError("lnameErr", "");
            lnameErr = false;
        }
    }
    

    
    if ((fnameErr || lnameErr) == true)
     {
        return false;
    }
    else {


    }
};
