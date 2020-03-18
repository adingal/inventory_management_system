<?php
    # Note: Use double quotes for added protection 

    // Items
    function find_all_items() {
        global $db;

        $sql = "SELECT * FROM items";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        return $result;
    }

    function find_all_items_id() {
        global $db;

        $sql = "SELECT item_id FROM items ";
        $sql .= "ORDER BY item_id ASC";
        $result = mysqli_query($db, $sql); 

        return $result;
    }

    function find_item_by_id($id) {
        global $db;

        $sql = "SELECT * FROM items ";
        $sql .= "WHERE item_id = '" . db_escape($db, $id) . "'";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        $item = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        
        // Returns associative array
        return $item;
    }

    function insert_items($item) {
        global $db;

        $sql = "INSERT INTO items ";
        $sql .= "(item_name, item_description, quantity, added_by, added_date) ";
        $sql .= "VALUES ";
        $sql .= "(";
        $sql .= "'" . db_escape($db, $item['item_name']) . "', ";
        $sql .= "'" . db_escape($db, $item['item_description']) . "', ";
        $sql .= "'" . db_escape($db, $item['quantity']) . "', ";
        $sql .= "'" . db_escape($db, $item['added_by']) . "', ";
        $sql .= "NOW()";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        return $result;
    }

    function update_item($item) {
        global $db;

        $sql = "UPDATE items SET ";
        $sql .= "item_name = '" . db_escape($db, $item['item_name']) . "', ";
        $sql .= "item_description = '" . db_escape($db, $item['item_description']) . "', ";
        $sql .= "quantity = '" . db_escape($db, $item['quantity']) . "' ";
        $sql .= "WHERE item_id = '" . db_escape($db, $item['item_id']) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        return $result;
    }

    function delete_item($id) {
        global $db;

        $sql = "DELETE FROM items ";
        $sql .= "WHERE item_id = '" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        return $result;
    }

    // Users
    function find_all_users() {
        global $db;

        $sql = "SELECT * FROM users";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);

        return $result;
    }
    
    function find_all_users_id() {
        global $db;

        $sql = "SELECT user_id FROM users ";
        $sql .= "ORDER BY user_id ASC";
        $result = mysqli_query($db, $sql); 

        return $result;
    }
    
    function find_user_by_id($id) {
        global $db;

        $sql = "SELECT * FROM users ";
        $sql .= "WHERE user_id = '" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        // Returns associative array
        return $user;
    }

    function update_user($user) {
        global $db;

        $sql = "UPDATE users SET ";
        $sql .= "first_name = '" . db_escape($db, $user['first_name']) . "' ";
        $sql .= "last_name = '" . db_escape($db, $user['last_name']) . "' ";
        $sql .= "email = '" . db_escape($db, $user['email']) . "' ";
        $sql .= "WHERE user_id = '" . db_escape($db, $user['user_id']) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        return $result;
    }

?>