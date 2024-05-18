<?php 

function showMessage(){
    if (isset($_SESSION['message'])) {
        $message[]=$_SESSION['message'];
        unset($_SESSION['message']);
        foreach ($message as $message) {
            echo '
                <div class="message">
                    <span>'.$message.'</span>
                    <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
                </div>
            ';
        }
    }
}
?>


