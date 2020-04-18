<?php
    /*
    * Edit User Page  
    */

    // Require init file
    require_once('../../private/init.php');

    // Require login
    require_login();

    // Set page title
    $page_title = 'Edit User';

    // Set id
    $id = $_GET['id'] ?? NULL;

    // If id is null
    if (is_null($id)) {
        redirect_to(url_for('/users/index.php'));
    } elseif (is_post()) {
    // If post request
        $user = [];
        $user['user_id'] = $id;
        $user['first_name'] = $_POST['first_name'] ?? '';
        $user['last_name'] = $_POST['last_name'] ?? '';
        $user['email'] = $_POST['email'] ?? '';
        $user['user_type'] = $_POST['user_type'] ?? '';
        $user['password'] = $_POST['password'] ?? '';

        // Call update user function
        $result = update_user($user);

        // If update is successful
        if ($result === true) {
          redirect_to(url_for('/users/index.php'));  
        } else {
        // If not set errors array
            $errors = $result;
        }
    }

    // Declare user type array
    $user_type = ['User', 'Admin'];

    // Call find user by id function
    $user = find_user_by_id($id);

    // Format the registered date
    $formatted_date = date_format(date_create($user['registered_date']), 'M d, Y');
?>

<?php include(SHARED_PATH . '/main_header.php'); // Include header file ?>

<div id="content">
    <div id="edit_user" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h1 class="display-5">Edit user...</h1>
                    <form action="<?php echo url_for('/users/edit.php?id=' . h(u($id))); ?>" method="post">
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
                                    }      
                                ?>
                            </small>                              
                        </div>
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <select name="user_type" class="form-control">
                                    <?php
                                        foreach ($user_type as $type) {
                                            echo '<option value="' . $type . '"';
                                            if ($user['user_type'] == $type) {  
                                                echo ' selected';
                                            }
                                            echo '>' . $type . '</option>'; 
                                        }
                                    ?>
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
                            <input type="password" class="form-control" name="password" value="">
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
                            <label for="registered_date">Registered Date</label>
                            <input type="text" class="form-control" name="registered_date" value="<?php echo h($formatted_date); ?>" disabled>
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-dark" value="Edit">
                            <a href="<?php echo url_for('/users/index.php'); ?>" class="btn btn-dark">Cancel</a>
                        </div>
                    </form>
                </div> <!-- col-md-6 -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- edit_user -->
</div> <!-- content -->

<?php include(SHARED_PATH . '/main_footer.php'); // Include footer file ?>