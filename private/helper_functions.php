<?php

    function url_for($path) {
        // Add the leading '/' if not present
        if ($path[0] != '/') {
            $path = "/" . $path;
        }
        return WWW_ROOT . $path;
    }

    function is_post() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    function redirect_to($location) {
        header("Location: " . $location);
        exit;        
    }


?>