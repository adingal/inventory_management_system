<?php

    // Create sessions on login
    function log_in_user($user) {
        session_regenerate_id();

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['last_login'] = time();
        $_SESSION['first_name'] = $user['first_name'];

        return true;
    }

    // Performs all actions to log out a user
    function log_out_user() {
        unset($_SESSION['user_id']);
        unset($_SESSION['last_login']);
        unset($_SESSION['first_name']);

        // May also use session_destroy(); destroys the whole session
        return true;
    }

    // Logic for determining if a user is login or not
    function is_logged_in() {
        return isset($_SESSION['user_id']);
    }

    // Use for all pages to require login
    function require_login() {
        if (!is_logged_in()) {
            redirect_to(url_for('/login.php'));
        }
    }

    // Check if current user is admin
    function is_admin() {
        $current_user = find_user_by_id($_SESSION['user_id']);

        if ($current_user['user_type'] == 'User') {
            redirect_to(url_for('users/index.php'));
        }
    }
?>