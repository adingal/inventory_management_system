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
        $sql .= "(item_name, item_description, quantity, user_id, added_date) ";
        $sql .= "VALUES ";
        $sql .= "(";
        $sql .= "'" . db_escape($db, $item['item_name']) . "', ";
        $sql .= "'" . db_escape($db, $item['item_description']) . "', ";
        $sql .= "'" . db_escape($db, $item['quantity']) . "', ";
        $sql .= "'" . db_escape($db, $item['user_id']) . "', ";
        $sql .= "NOW()";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;            
        }
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

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;            
        }
    }

    function delete_item($id) {
        global $db;

        $sql = "DELETE FROM items ";
        $sql .= "WHERE item_id = '" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;            
        }
    }

    function withdraw_item($item_id, $user_id, $quantity, $remarks) {
        global $db;

        $sql = "UPDATE items SET ";
        $sql .= "quantity = quantity - '" . db_escape($db, $quantity) . "' ";
        $sql .= "WHERE item_id = '" . db_escape($db, $item_id) . "';";
        $sql .= "INSERT INTO transactions ";
        $sql .= "(user_id, item_id, withdrawn_quantity, transaction_date, remarks) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db, $user_id) . "', "; 
        $sql .= "'" . db_escape($db, $item_id) . "', "; 
        $sql .= "'" . db_escape($db, $quantity) . "', "; 
        $sql .= "NOW(), "; 
        $sql .= "'" . db_escape($db, $remarks) . "')";
        
        $result = mysqli_multi_query($db, $sql);

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;             
        }
    }

    function replenish_item($item) {
        global $db;

        $sql = "UPDATE items SET ";
        $sql .= "quantity = '" . db_escape($db, $item['replenish_quantity']) . "' + quantity ";
        $sql .= "WHERE item_id = '" . db_escape($db, $item['item_id']) . "'";

        $result = mysqli_query($db, $sql);

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;            
        }
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

    function find_user_by_email($email) {
        global $db;

        $sql = "SELECT * FROM users ";
        $sql .= "WHERE email = '" . db_escape($db, $email) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        
        if ($result) {
            $user = mysqli_fetch_assoc($result);
            mysqli_free_result($result);

            return $user;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            
            exit();
        }
    }

    function insert_user($user) {
        global $db;

        $errors = validate_user($user);

        if (!empty($errors)) {
            return $errors;
        }

        $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO users ";
        $sql .= "(first_name, last_name, email, hashed_password, registered_date) ";
        $sql .= "VALUES ";
        $sql .= "(";
        $sql .= "'" . db_escape($db, $user['first_name']) . "', ";
        $sql .= "'" . db_escape($db, $user['last_name']) . "', ";
        $sql .= "'" . db_escape($db, $user['email']) . "', ";
        $sql .= "'" . db_escape($db, $hashed_password) . "', ";
        $sql .= "NOW()";
        $sql .= ")";

        $result = mysqli_query($db, $sql);

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;            
        }
    }

    function update_user($user) {
        global $db;

        $password_sent = !is_blank($user['password']);

        $errors = validate_user($user, ['password_required' => $password_sent]);

        if (!empty($errors)) {
            return $errors;
        }  
        
        $hashed_password = password_hash($user['password'], PASSWORD_BCRYPT);

        $sql = "UPDATE users SET ";
        $sql .= "first_name = '" . db_escape($db, $user['first_name']) . "', ";
        $sql .= "last_name = '" . db_escape($db, $user['last_name']) . "', ";
        $sql .= "email = '" . db_escape($db, $user['email']) . "'";

        if ($password_sent) {
            $sql .= ", hashed_password = '" . db_escape($db, $hashed_password) . "' ";
        }

        $sql .= "WHERE user_id = '" . db_escape($db, $user['user_id']) . "' ";
        $sql .= "LIMIT 1";

        echo $sql;

        $result = mysqli_query($db, $sql);

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;            
        }        
    }

    function delete_user($id) {
        global $db;

        $sql = "DELETE FROM users ";
        $sql .= "WHERE user_id = '" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);

        if ($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;            
        }        
    }

    function user_count() {
        global $db;

        $sql = "SELECT user_id FROM users";

        $result = mysqli_query($db, $sql);
        $user_count = mysqli_num_rows($result);
        mysqli_free_result($result);

        return $user_count;
    }
    
    function validate_user($user, $options=[]) {
        $errors = [];

        $password_required = $options['password_required'] ?? true;

        # First name
        if (is_blank($user['first_name'])) {
            $errors['first_name_blank'] = 'First name cannot be blank.';
        } else if (!has_length($user['first_name'], ['min' => 2, 'max' => 50])) {
            $errors['first_name_length'] = 'Please enter a name between 2 to 50 characters only.';
        }

        # Last name
        if (is_blank($user['last_name'])) {
            $errors['last_name_blank'] = 'Last name cannot be blank.';
        } else if (!has_length($user['last_name'], ['min' => 2, 'max' => 50])) {
            $errors['last_name_length'] = 'Please enter a name between 2 to 50 characters only.';
        }

        # Email
        if (is_blank($user['email'])) {
            $errors['email_blank'] = 'Email cannot be blank.';
        } else if (!has_length($user['email'], ['min' => 2, 'max' => 50])) {
            $errors['email_length'] = 'Please enter an email between 2 to 50 characters only.';
        } else if (!has_valid_email_format($user['email'])) {
            $errors['email_valid'] = 'Please enter a valid email format.';
        }

        # If password was changed
        if ($password_required) {
            # Password
            if (is_blank($user['password'])) {
                $errors['password_blank'] = 'Password cannot be blank.';
            } else if (!has_length($user['password'], ['min' => 8, 'max' => 20])) {
                $errors['password_length'] = 'Please enter a password between 8 to 20 characters only.';
            }
            
            if (isset($user['confirm_password'])) {
                # Confirm Password
                if (is_blank($user['confirm_password'])) {
                    $errors['confirm_password_blank'] = 'Confirm password cannot be blank.';
                } else if (!has_length($user['confirm_password'], ['min' => 8, 'max' => 20])) {
                    $errors['confirm_password_length'] = 'Please enter a password between 8 to 20 characters only.';
                } else if ($user['password'] !== $user['confirm_password']) {
                    $errors['password_confirm'] = 'Password and confirm password does not match.';
                }
            }
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