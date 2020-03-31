<?php
    require_once('../private/init.php');

    log_out_user();

    redirect_to(url_for('/login.php'));
?>