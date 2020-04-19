<?php
    /*
    * User Index Page  
    */

    // Require init file
    require_once('../../private/init.php');

    // Require login
    require_login();

    // Set page title
    $page_title = 'Users';

    // Call find all users function
    $users = find_all_users();

    // Call find all users id function
    $user_ids = find_all_users_id();
?>

<?php include(SHARED_PATH . '/main_header.php'); // Include header file ?>

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

                            <!-- Loop on all user id and create options -->
                            <?php
                                while ($user_id = mysqli_fetch_row($user_ids)) {
                                    echo '<option value="' . h($user_id[0]) . '">';
                                    echo h($user_id[0]) . '</option>';
                                }

                                // Free up resources
                                mysqli_free_result($user_ids);
                            ?>

                        </select>
                    </div>
                </div> <!-- id_options -->
                <div class="col-md-8 col-lg-9 text-center text-md-right">
                    <a href="<?php echo url_for('/users/add.php'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                    <a href="<?php echo url_for('/users/view.php?id=1'); ?>" class="btn btn-success"><i class="far fa-eye"></i> View</a>
                </div> <!-- col-md-8 -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- actions -->
    <div id="users">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th class="font-weight-normal">ID</th>
                                <th class="font-weight-normal">First Name</th>
                                <th class="font-weight-normal">Last Name</th>
                                <th class="font-weight-normal">Email</th>
                                <th class="font-weight-normal">Registered Date</th>
                                <th class="font-weight-normal">Type</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Loop on all users and create row -->
                            <?php while ($user = mysqli_fetch_assoc($users)) { ?>

                                <tr>
                                    <td><?php echo h($user['user_id']); ?></td>
                                    <td><?php echo h($user['first_name']); ?></td>
                                    <td><?php echo h($user['last_name']); ?></td>
                                    <td><?php echo h($user['email']); ?></td>
                                    <td><?php echo h($user['registered_date']); ?></td>
                                    <td><?php echo h($user['user_type']); ?></td>
                                </tr>
                                
                            <?php
                                }

                                // Free up resources
                                mysqli_free_result($users);
                            ?>

                        </tbody>
                    </table>
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- users -->
</div> <!-- content -->

<?php include(SHARED_PATH . '/main_footer.php'); // Include footer file ?>