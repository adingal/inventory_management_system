<?php

    // Add the root directory on links
    function url_for($path) {
        // Add the leading '/' if not present
        if ($path[0] != '/') {
            $path = '/' . $path;
        }
        return WWW_ROOT . $path;
    }

    // Test if request method is post
    function is_post() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    // Redirect to location
    function redirect_to($location) {
        header('Location: ' . $location);
        exit;        
    }

    // Url encode string
    function u($string="") {
        return urlencode($string);
    }

    // Escape string
    function h($string="") {
        return htmlspecialchars($string);
    }
?>