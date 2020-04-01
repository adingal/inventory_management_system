<?php
    require_once('../../private/init.php');

    $page_title = 'Edit User';

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
        redirect_to(url_for('/users/index.php'));
    } elseif (is_post()) {
        $user = [];
        $user['user_id'] = $id;
        $user['first_name'] = $_POST['first_name'] ?? '';
        $user['last_name'] = $_POST['last_name'] ?? '';
        $user['email'] = $_POST['email'] ?? '';
        $user['password'] = $_POST['password'] ?? '';

        $result = update_user($user);

        if ($result === true) {
          redirect_to(url_for('/users/index.php'));  
        } else {
            $errors = $result;
        }
    }

    $user = find_user_by_id($id);
    $formatted_date = date_format(date_create($user['registered_date']), 'M d, Y');
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

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
                                    if ($errors['email_blank'] ?? '') {
                                        echo $errors['email_blank'];
                                    } else if ($errors['email_length'] ?? '') {
                                        echo $errors['email_length'];
                                    }      
                                ?>
                            </small>                              
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" value="">
                            <small class="text-danger">
                                <?php
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
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>