<?php
    /*
    * Login Page  
    */

    // Require init file
    require_once('../private/init.php');

    // Set page title
    $page_title = 'IMS - Login';

    // Set initial variables
    $errors = [];
    $email = '';
    $password = '';

    // If post request
    if (is_post()) {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validations
        if (is_blank($email)) {
            $errors['email_blank'] = 'Email cannot be blank.';
        }

        if (is_blank($password)) {
            $errors['password_blank'] = 'Password cannot be blank.';
        }

        // If no errors
        if (empty($errors)) {
            $user = find_user_by_email($email);
            $failure_msg = 'Log in was unsuccessful.';

            // If user is found
            if ($user) {

                if (password_verify($password, $user['hashed_password'])) {
                // Password match
                    log_in_user($user);
                    redirect_to(url_for('/index.php'));
                } else {
                // Email found, but password does not match
                    $errors['login_fail'] = $failure_msg;
                }
            } else {
            // No email found
                $errors['login_fail'] = $failure_msg;
            }
        }
    }    
?>

<?php include(SHARED_PATH . '/main_header.php'); // Include header file ?>

<div id="content">
    <div id="login" class="d-flex align-items-center py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 mx-auto">
                    <form action="<?php echo url_for('/login.php'); ?>" method="post" class="bg-dark border rounded border-light text-white p-3">
                        <h1 class="text-center mb-3">Sign in...</h1>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Email" class="form-control">
                            <small class="text-white">
                                <?php
                                    // If there are errors for email
                                    if ($errors['email_blank'] ?? '') {
                                        echo $errors['email_blank'];
                                    }
                                ?>
                            </small>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" class="form-control">
                            <small class="text-white">
                                <?php
                                    // If there are errors for password
                                    if ($errors['password_blank'] ?? '') {
                                        echo $errors['password_blank'];
                                    }
                                ?>
                            </small>                                    
                        </div>
                        <button class="btn btn-outline-light btn-block">
                            Login
                        </button>
                        <small class="d-block text-white text-center p-0 pt-2">
                            <?php
                                // If there are errors on login
                                if ($errors['login_fail'] ?? '') {
                                    echo $errors['login_fail'];
                                }
                            ?>
                        </small>                                 
                    </form>
                </div> <!-- col-md-6 -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- login -->
</div> <!-- content -->

<?php include(SHARED_PATH . '/main_footer.php'); // Include footer file ?>