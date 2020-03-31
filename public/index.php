<?php
    require_once('../private/init.php');

    $page_title = 'Inventory Management System';

    $errors = [];
    $email = '';
    $password = '';

    $item_count = item_count();
    $user_count = user_count();
    $transaction_count = transaction_count();

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

<?php include('../private/shared_items/main_header.php'); ?>

    <div id="content">
            <div id="login" class="d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mx-auto">
                            <form action="<?php echo url_for('/index.php'); ?>" method="post" class="bg-dark border rounded border-light text-white p-3">
                                <h1 class="text-center mb-3">Sign in...</h1>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" class="form-control">
                                    <small class="text-white">
                                        <?php
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
                                            if ($errors['password_blank'] ?? '') {
                                                echo $errors['password_blank'];
                                            }
                                        ?>
                                    </small>                                    
                                </div>
                                <button class="btn btn-outline-light btn-block">
                                    Login
                                </button>
                                <small class="text-white">
                                    <?php
                                        if ($errors['login_fail'] ?? '') {
                                            echo $errors['login_fail'];
                                        }
                                    ?>
                                </small>                                 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="home" class="mt-5">
                <div class="container">
                    <h1 class="display-4 mb-5 pb-2">Tracking</h1>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-center text-white mb-3">
                                <div class="card-body">
                                    <h2 class="display-5">Items</h2>
                                    <h3 class="display-4">
                                        <i class="fas fa-boxes"></i>
                                    </h3>
                                    <h4><?php echo h($item_count); ?></h4>
                                    <a href="" class="btn btn-outline-light">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-center text-white mb-3">
                                <div class="card-body">
                                    <h2 class="display-5 text-truncate">Transactions</h2>
                                    <h3 class="display-4">
                                        <i class="far fa-edit"></i>
                                    </h3>
                                    <h4><?php echo h($transaction_count); ?></h4>
                                    <a href="" class="btn btn-outline-light">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-danger text-center text-white mb-3">
                                <div class="card-body">
                                    <h2 class="display-5">Users</h2>
                                    <h3 class="display-4">
                                        <i class="fa fa-user"></i>
                                    </h3>
                                    <h4><?php echo h($user_count); ?></h4>
                                    <a href="" class="btn btn-outline-light">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    
<?php include('../private/shared_items/main_footer.php'); ?>