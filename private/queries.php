<?php

    // Items
    function find_all_items() {
        global $db;

        $sql = "SELECT * FROM items";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        return $result;
    }

    function insert_items($item) {
        global $db;

        $sql = "INSERT INTO items ";
        $sql .= "(item_name, item_description, quantity, added_by, added_date) ";
        $sql .= "VALUES ";
        $sql .= "(";
        $sql .= "'" . $item['item_name'] . "', ";
        $sql .= "'" . $item['item_description'] . "', ";
        $sql .= "'" . $item['quantity'] . "', ";
        $sql .= "'" . $item['added_by'] . "', ";
        $sql .= "NOW()";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        return $result;
    }

    function find_item_by_id($id) {
        global $db;

        $sql = "SELECT * FROM items ";
        $sql .= "WHERE item_id = '" . $id . "'";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        $item = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        
        // Returns associative array
        return $item;
    }

    function delete_item($id) {
        global $db;

        $sql = "DELETE FROM items ";
        $sql .= "WHERE id = '" . $id . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        return $result;
    }

?>