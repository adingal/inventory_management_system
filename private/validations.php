<?php

    // Test whether the given value is blank
    // Returns boolean
    function is_blank($value) {
        return !isset($value) || trim($value) === '';
    }

?>