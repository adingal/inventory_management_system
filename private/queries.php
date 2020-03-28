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

    function insert_item($item) {
        global $db;

        $errors = validate_item($item);

        if (!empty($errors)) {
            return $errors;
        }

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

    function item_count() {
        global $db;

        $sql = "SELECT item_id FROM items";

        $result = mysqli_query($db, $sql);
        $item_count = mysqli_num_rows($result);
        mysqli_free_result($result);

        return $item_count;
    }

    function validate_item($item) {
        $errors = [];        

        # Item name
        // Check whether item name is not in used
        $current_id = $item['item_id'] ?? '0';
        if (!has_unique_item_name($item['item_name'], $current_id)) {
            $errors['item_name'] = 'Item name already in used.';
        }
        
        // Check for minimum length of characters
        if (!has_length_greater_than($item['item_name'], 6)) {
            $errors['item_min'] = 'Please enter a minimum of 6 characters.';
        }

        // Check for maximum length of characters
        if (!has_length_less_than($item['item_name'], 11)) {
            $errors['item_max'] = 'Please enter a maximum of 10 characters only.';
        }
        
        return $errors;
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

    function insert_user($user) {
        global $db;

        $sql = "INSERT INTO users ";
        $sql .= "(first_name, last_name, email, hashed_password, registered_date) ";
        $sql .= "VALUES ";
        $sql .= "(";
        $sql .= "'" . db_escape($db, $user['first_name']) . "', ";
        $sql .= "'" . db_escape($db, $user['last_name']) . "', ";
        $sql .= "'" . db_escape($db, $user['email']) . "', ";
        $sql .= "'" . db_escape($db, $user['hashed_password']) . "', ";
        $sql .= "NOW()";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        return $result;
    }

    function update_user($user) {
        global $db;

        $sql = "UPDATE users SET ";
        $sql .= "first_name = '" . db_escape($db, $user['first_name']) . "', ";
        $sql .= "last_name = '" . db_escape($db, $user['last_name']) . "', ";
        $sql .= "email = '" . db_escape($db, $user['email']) . "' ";
        $sql .= "WHERE user_id = '" . db_escape($db, $user['user_id']) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        return $result;
    }

    function delete_user($id) {
        global $db;

        $sql = "DELETE FROM users ";
        $sql .= "WHERE user_id = '" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        return $result;
    }

    function user_count() {
        global $db;

        $sql = "SELECT user_id FROM users";

        $result = mysqli_query($db, $sql);
        $user_count = mysqli_num_rows($result);
        mysqli_free_result($result);

        return $user_count;
    }    

    // Transactions
    function find_all_transactions() {
        global $db;

        $sql = "SELECT * FROM transactions";

        $result = mysqli_query($db, $sql);

        return $result;
    }

    function find_all_transactions_id() {
        global $db;

        $sql = "SELECT transaction_id FROM transactions ";
        $sql .= "ORDER BY transaction_id ASC";        
        $result = mysqli_query($db, $sql);

        return $result;
    }

    function find_transaction_by_id($id) {
        global $db;

        $sql = "SELECT * FROM transactions ";
        $sql .= "WHERE transaction_id = '" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        $transaction = mysqli_fetch_assoc($result);
        mysqli_free_result($result);

        // Returns associative array
        return $transaction;
    }

    function delete_transaction($id) {
        global $db;

        $sql = "DELETE FROM transactions ";
        $sql .= "WHERE transaction_id = '" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        return $result;
    }

    function transaction_count() {
        global $db;

        $sql = "SELECT transaction_id FROM transactions";

        $result = mysqli_query($db, $sql);
        $transaction_count = mysqli_num_rows($result);
        mysqli_free_result($result);

        return $transaction_count;
    }     

?>