<?php
    /*
    * Add User Page  
    */

    // Require init file
    require_once('../../private/init.php');

    // Require login
    require_login();

    // Set page title
    $page_title = 'Add User';

    // If post request
    if (is_post()) {
        $user = [];
        $user['first_name'] = $_POST['first_name'] ?? '';
        $user['last_name'] = $_POST['last_name'] ?? '';
        $user['email'] = $_POST['email'] ?? '';
        $user['user_type'] = $_POST['user_type'] ?? '';
        $user['password'] = $_POST['password'] ?? '';
        $user['confirm_password'] = $_POST['confirm_password'] ?? '';

        // Call insert user function
        $result = insert_user($user);

        // If insert is successful
        if ($result === true) {
            redirect_to(url_for('/users/index.php'));
        } else {
        // If not set errors array
            $errors = $result;
        }
    } else {
        $user = [];
        $user['first_name'] = '';
        $user['last_name'] = '';
        $user['email'] = '';
        $user['user_type'] = 'User' ?? '';
        $user['password'] = '';
        $user['confirm_password'] = '';        
    }
?>

<?php include(SHARED_PATH . '/main_header.php'); // Include header file ?>

<div id="content">
    <div id="add_user" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h1 class="display-5">Add user...</h1>
                    <form action="<?php echo url_for('/users/add.php'); ?>" method="post">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo h($user['first_name']); ?>">
                            <small class="text-danger">
                                <?php
                                    // If there are errors for first name
                                    if ($errors['first_name_blank'] ?? '') {
                                        echo $errors['first_name_blank'];
                                    } else if ($errors['first_name_length'] ?? '') {
                                        echo $errors['first_name_length'];
                                    }                                   
                                ?>
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo h($user['last_name']); ?>">
                            <small class="text-danger">
                                <?php
                                    // If there are errors for last name
                                    if ($errors['last_name_blank'] ?? '') {
                                        echo $errors['last_name_blank'];
                                    } else if ($errors['last_name_length'] ?? '') {
                                        echo $errors['last_name_length'];
                                    }                                   
                                ?>
                            </small>                            
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo h($user['email']); ?>">
                            <small class="text-danger">
                                <?php
                                    // If there are errors for email
                                    if ($errors['email_blank'] ?? '') {
                                        echo $errors['email_blank'];
                                    } else if ($errors['email_length'] ?? '') {
                                        echo $errors['email_length'];
                                    } else if ($errors['email_valid'] ?? '') {
                                        echo $errors['email_valid'];
                                    }         
                                ?>
                            </small>                            
                        </div>
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select name="user_type" class="form-control">
                                    <option value="User">User</option>
                                    <option value="Admin">Admin</option>
                            </select>             
                            <small class="text-danger">
                                <?php
                                    // If there are errors for user type
                                    if ($errors['user_type_blank'] ?? '') {
                                        echo $errors['user_type_blank'];
                                    }      
                                ?>
                            </small>                                           
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" value="<?php echo h($user['password']); ?>">
                            <small class="text-danger">
                                <?php
                                    // If there are errors for password
                                    if ($errors['password_blank'] ?? '') {
                                        echo $errors['password_blank'];
                                    } else if ($errors['password_length'] ?? '') {
                                        echo $errors['password_length'];
                                    }         
                                ?>
                            </small>                               
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" value="<?php echo h($user['confirm_password']); ?>">
                            <small class="text-danger">
                                <?php
                                    // If there are errors for confirm password
                                    if ($errors['confirm_password_blank'] ?? '') {
                                        echo $errors['confirm_password_blank'];
                                    } else if ($errors['confirm_password_length'] ?? '') {
                                        echo $errors['confirm_password_length'];
                                    } else if ($errors['password_confirm'] ?? '') {
                                        echo $errors['password_confirm'];
                                    }
                                ?>
                            </small>                             
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-dark" value="Add">
                            <a href="<?php echo url_for('/users/index.php'); ?>" class="btn btn-dark">Cancel</a>
                        </div>
                    </form>                    
                </div> <!-- col-md-6 -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- add_user -->
</div> <!-- content -->

<?php include(SHARED_PATH . '/main_footer.php'); // Include footer file ?>