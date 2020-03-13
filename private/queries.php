<?php

function find_all_items() {
    global $db;

    $sql = "SELECT * FROM items";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);

    return $result;
}



?>