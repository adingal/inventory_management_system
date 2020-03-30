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

        $errors = validate_item($item);

        if (!empty($errors)) {
            return $errors;
        }        

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

        # Item description
        // Check for minimum length of characters
        if (!has_length_greater_than($item['item_description'], 10)) {
            $errors['description_min'] = 'Please enter a minimum of 10 characters.';
        }

        // Check for maximum length of characters
        if (!has_length_less_than($item['item_description'], 101)) {
            $errors['description_max'] = 'Please enter a maximum of 100 characters only.';
        }
        
        # Quantity
        // Check for quantity value if present
        if (is_blank($item['quantity'])) {
            $errors['quantity'] = 'Please enter a quantity.';
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

        $errors = validate_user($user);

        if (!empty($errors)) {
            return $errors;
        }

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
    
    function validate_user($user) {
        $errors = [];

        # First name
        // Check for minimum length of characters
        if (!has_length_greater_than($user['first_name'], 1)) {
            $errors['first_name_min'] = 'Please enter a minimum of 2 characters.';
        }

        // Check for maximum length of characters
        if (!has_length_less_than($user['first_name'], 50)) {
            $errors['first_name_max'] = 'Please enter a maximum of 50 characters only.';
        }

        # Last name
        // Check for minimum length of characters
        if (!has_length_greater_than($user['last_name'], 1)) {
            $errors['last_name_min'] = 'Please enter a minimum of 2 characters.';
        }

        // Check for maximum length of characters
        if (!has_length_less_than($user['last_name'], 50)) {
            $errors['last_name_max'] = 'Please enter a maximum of 50 characters only.';
        }

        # Email
        // Check for minimum length of characters
        if (!has_length_greater_than($user['email'], 1)) {
            $errors['email_min'] = 'Email required.';
        }

        // Check for maximum length of characters
        if (!has_length_less_than($user['email'], 50)) {
            $errors['email_max'] = 'Please enter a maximum of 50 characters only.';
        }        

        // Check for minimum length of characters
        if (!has_valid_email_format($user['email'])) {
            $errors['email_valid'] = 'Please enter a valid email format.';
        }

        # Password
        // Check for minimum length of characters
        if (!has_length_greater_than($user['password'], 7)) {
            $errors['password_min'] = 'Please enter a minimum of 8 characters.';
        }

        // Check for maximum length of characters
        if (!has_length_less_than($user['password'], 50)) {
            $errors['password_max'] = 'Please enter a maximum of 20 characters only.';
        }

        // Check if password and confirm password matches
        if ($user['password'] !== $user['confirm_password']) {
            $errors['password_confirm'] = 'Password and confirm password does not match.';
        }
         
        return $errors;
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