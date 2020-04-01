<?php
    require_once('../../private/init.php');

    require_login();

    $page_title = 'Users';

    $users = find_all_users();    
    $user_ids = find_all_users_id();
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="actions" class="pt-5 pb-2 mt-3">
        <div class="container">
            <div class="row">
                <div id="id_options" class="col-md-4 col-lg-3 mb-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="selected_id">User ID</label>
                        </div>
                        <select class="custom-select" id="selected_id">
                            <?php
                                while ($user_id = mysqli_fetch_row($user_ids)) {
                                    echo '<option value="' . h($user_id[0]) . '">';
                                    echo h($user_id[0]) . '</option>';
                                }
                            ?>      
                        </select>
                    </div>
                </div>
                <div class="col-md-8 col-lg-9 text-center text-md-right">
                    <a href="<?php echo url_for('/users/add.php'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                    <a href="<?php echo url_for('/users/view.php?id=1'); ?>" class="btn btn-success"><i class="far fa-eye"></i> View</a>
                </div>
            </div>
        </div>
    </div>
    <div id="users">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>User ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Registered Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($user = mysqli_fetch_assoc($users)) { ?>
                                <tr>
                                    <td><?php echo h($user['user_id']); ?></td>
                                    <td><?php echo h($user['first_name']); ?></td>
                                    <td><?php echo h($user['last_name']); ?></td>
                                    <td><?php echo h($user['email']); ?></td>
                                    <td><?php echo h($user['registered_date']); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php mysqli_free_result($users); ?>
<?php include(SHARED_PATH . '/main_footer.php'); ?>