<?php

    // Require credentials to access database constants
    require_once('db_credentials.php');

    // Connect to database
    function db_connect() {
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        confirm_connection();
        return $connection;
    }

    // Disconnect to database
    function db_disconnect($connection) {
        if (isset($connection)) {
            mysqli_close($connection);
        }
    }

    // Escape string before using on queries
    function db_escape($connection, $string) {
        return mysqli_real_escape_string($connection, $string);
    }

    // Confirm connection if establish
    function confirm_connection() {
        if (mysqli_connect_errno()) {
            $msg = "Database connection failed: ";
            $msg .= mysqli_connect_error();
            $msg .= " (" . mysqli_connect_errno() . ")";

            exit($msg);
        }
    }

    // Confirm result set on queries
    function confirm_result_set($result_set) {
        if (!$result_set) {
            exit("Database query failed.");
        }
    }

?>