<?php

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

?>