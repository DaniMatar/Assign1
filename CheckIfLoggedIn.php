<?php
function checkIfLoggedIn(){
    session_start();
    if(empty($_SESSION['UserName']) || (empty($_SESSION['Password']))){
        header("location:Login.php");
    }
}
?>
