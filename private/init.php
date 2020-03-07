<?php
    // Turn on output buffering
    ob_start();

    // Turn on session
    session_start();

    // Declare constants for file path
    define("PRIVATE_PATH", dirname(__FILE__));
    define("PROJECT_PATH", dirname(PRIVATE_PATH));
    define("PUBLIC_PATH", PROJECT_PATH . '/public');
    define("SHARED_PATH", PRIVATE_PATH . '/shared_items'); 
    
    // Declare constant for website root
    $public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
    $doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
    define("WWW_ROOT", $doc_root);
    
    require_once('helper_functions.php');
    require_once('authentication.php');

?>