<?php
    /*
    * Logout Page  
    */

    // Rquire init file
    require_once('../private/init.php');

    // Call log out user function
    log_out_user();

    // Redirect to login page
    redirect_to(url_for('/login.php'));
?>