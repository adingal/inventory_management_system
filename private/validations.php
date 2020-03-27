<?php

    // Test whether the given value is blank
    // Returns boolean
    function is_blank($value) {
        return !isset($value) || trim($value) === '';
    }

    // Test whether given value pass the minimum character length
    // Returns boolean
    function has_length_greater($value, $min) {
        $length = strlen($value);
        return $length > $min;
    }

    // Test whether given value does not exceed the maximum character length
    // Returns boolean    
    function has_length_less($value, $max) {
        $length = strlen($value);
        return $length < $max;
    }

?>