<?php

    function url_for($path) {
        // Add the leading '/' if not present
        if ($path[0] != '/') {
            $path = '/' . $path;
        }
        return WWW_ROOT . $path;
    }

    function is_post() {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    function redirect_to($location) {
        header('Location: ' . $location);
        exit;        
    }

    function u($string="") {
        return urlencode($string);
    }

    function h($string="") {
        return htmlspecialchars($string);
    }

    function to_lowercase($string="") {
        return strtolower($string);
    }

    function to_uppercase($string="") {
        return strtoupper($string);
    }
?>