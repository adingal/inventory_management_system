<?php
    require_once('../../private/init.php');

    require_login();

    $page_title = 'View User';

    $user_id = $_SESSION['user_id'] ?? '';

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
        redirect_to(url_for('/users/index.php'));
    }

    $user = find_user_by_id($id);
    $current_user = find_user_by_id($user_id);
    $user_access = ($current_user['user_type'] == 'Admin');
     
    $formatted_date = date_format(date_create($user['registered_date']), 'M d, Y');
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="view_user" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <h1 class="display-5"><?php echo h($user['first_name'] . ' ' . $user['last_name']); ?></h1>
                    <form action="<?php echo url_for('/users/view.php' . h(u($id))); ?>">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo h($user['first_name']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo h($user['last_name']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo h($user['email']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <input type="text" class="form-control" name="user_type" value="<?php echo h($user['user_type']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="registered_date">Registered Date</label>
                            <input type="text" class="form-control" name="registered_date" value="<?php echo h($formatted_date); ?>" disabled>
                        </div>
                        <div class="form-group text-right">
                            <?php
                                // Show edit and delete button only if current user is Admin
                                if ($user_access) {
                                    echo '<a href="';
                                    echo url_for('/users/edit.php?id=' . h(u($id)));
                                    echo '" class="btn btn-dark mr-1">Edit</a>';

                                    echo '<a href="';
                                    echo url_for('/users/delete.php?id=' . h(u($id)));
                                    echo '" class="btn btn-dark">Delete</a>';
                                } else {
                                    echo '<small class="text-danger mr-2">
                                            Only admins can edit an account.
                                          </small>';
                                }
                            ?>
                            <a href="<?php echo url_for('/users/index.php'); ?>" class="btn btn-dark">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>