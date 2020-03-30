<?php
    require_once('../../private/init.php');

    $page_title = 'Add User';

    if (is_post()) {
        $user = [];
        $user['first_name'] = $_POST['first_name'] ?? '';
        $user['last_name'] = $_POST['last_name'] ?? '';
        $user['email'] = $_POST['email'] ?? '';
        $user['password'] = $_POST['password'] ?? '';
        $user['confirm_password'] = $_POST['confirm_password'] ?? '';

        $result = insert_user($user);

        if ($result === true) {
            redirect_to(url_for('/users/index.php'));
        } else {
            $errors = $result;
        }
    } else {
        $user = [];
        $user['first_name'] = '';
        $user['last_name'] = '';
        $user['email'] = '';
        $user['password'] = '';
        $user['confirm_password'] = '';        
    }
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

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
                                    if ($errors['first_name_min'] ?? '') {
                                        echo $errors['first_name_min'];
                                    } else if ($errors['first_name_max'] ?? '') {
                                        echo $errors['first_name_max'];
                                    }                                   
                                ?>
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo h($user['last_name']); ?>">
                            <small class="text-danger">
                                <?php
                                    if ($errors['last_name_min'] ?? '') {
                                        echo $errors['last_name_min'];
                                    } else if ($errors['last_name_max'] ?? '') {
                                        echo $errors['last_name_max'];
                                    }                                   
                                ?>
                            </small>                            
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo h($user['email']); ?>">
                            <small class="text-danger">
                                <?php
                                    if ($errors['email_min'] ?? '') {
                                        echo $errors['email_min'];
                                    } else if ($errors['email_max'] ?? '') {
                                        echo $errors['email_max'];
                                    } else if ($errors['email_valid'] ?? '') {
                                        echo $errors['email_valid'];
                                    }         
                                ?>
                            </small>                            
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" value="<?php echo h($user['password']); ?>">
                            <small class="text-danger">
                                <?php
                                    if ($errors['password_min'] ?? '') {
                                        echo $errors['password_min'];
                                    } else if ($errors['password_max'] ?? '') {
                                        echo $errors['password_max'];
                                    }         
                                ?>
                            </small>                               
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" value="<?php echo h($user['confirm_password']); ?>">
                            <small class="text-danger">
                                <?php
                                    if ($errors['confirm_password_min'] ?? '') {
                                        echo $errors['confirm_password_min'];
                                    } else if ($errors['confirm_password_max'] ?? '') {
                                        echo $errors['confirm_password_max'];
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>