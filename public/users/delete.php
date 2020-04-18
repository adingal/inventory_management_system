<?php
    /*
    * Delete User Page  
    */

    // Require init file    
    require_once('../../private/init.php');

    // Require login
    require_login();

    // Set page title
    $page_title = 'Delete User';

    // Set id
    $id = $_GET['id'] ?? NULL;

    // If id is null
    if (is_null($id)) {
        redirect_to(url_for('/users/index.php'));
    }

    // Call find user by id function
    $user = find_user_by_id($id);

    // If post request
    if (is_post()) {

        // Call delete user function
        $result = delete_user($id);

        // If delete is successful
        if ($result) {
            redirect_to(url_for('/users/index.php'));
        }
    }

?>

<?php include(SHARED_PATH . '/main_header.php') // Include header file ?>

<div id="content">
    <div id="delete_user" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h1 class="display-5">Delete user...</h1>
                    <form action="<?php echo url_for('/users/delete.php?id=' . h(u($id))); ?>" method="post">
                        <div class="form-group">
                            <label for="">User ID</label>
                            <input type="text" class="form-control" name="user_id" value="<?php echo h($user['user_id']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" class="form-control" name="full_name" value="<?php echo h($user['first_name'] . ' ' . $user['last_name']); ?>" disabled>
                        </div>
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-dark" value="Delete">
                            <a href="<?php echo url_for('/users/index.php'); ?>" class="btn btn-dark">Cancel</a>
                        </div>
                    </form>
                </div> <!-- col-md-6 -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- delete_user -->
</div> <!-- content -->

<?php include(SHARED_PATH . '/main_footer.php') // Include footer file ?>