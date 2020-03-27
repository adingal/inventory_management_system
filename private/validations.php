<?php

    // Test whether the given value is blank
    // Returns boolean
    function is_blank($value) {
        return !isset($value) || trim($value) === '';
    }

    // Test whether given value pass the minimum character length
    // Returns boolean
    function has_length_greater_than($value, $min) {
        $length = strlen(trim($value));
        return $length > $min;
    }

    // Test whether given value does not exceed the maximum character length
    // Returns boolean    
    function has_length_less_than($value, $max) {
        $length = strlen(trim($value));
        return $length < $max;
    }

    function has_unique_item_name($item_name, $item_id="0") {
        global $db;

        $sql = "SELECT * FROM items ";
        $sql .= "WHERE item_name = '" . db_escape($db, to_uppercase($item_name)) . "' ";
        $sql .= "AND item_id != '" . db_escape($db, $item_id) . "'";

        $item_set = mysqli_query($db, $sql);
        $item_count = mysqli_num_rows($item_set);
        mysqli_free_result($item_set);

        return $item_count === 0;
    }

?>