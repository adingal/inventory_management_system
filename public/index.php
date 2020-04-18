<?php
    /*
    * Main Index Page
    */

    // Require init file
    require_once('../private/init.php');

    // Require login
    require_login();

    // Set page title
    $page_title = 'Inventory Management System';

    // Call item count function
    $item_count = item_count();

    // Call user count function
    $user_count = user_count();

    // Call transaction count function
    $transaction_count = transaction_count();
?>

<?php include('../private/shared_items/main_header.php'); // Include header file ?>

    <div id="content">
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
                                    <a href="<?php echo url_for('/items/index.php'); ?>" class="btn btn-outline-light">View</a>
                                </div>
                            </div>
                        </div> <!-- col-md-4 -->
                        <div class="col-md-4">
                            <div class="card bg-success text-center text-white mb-3">
                                <div class="card-body">
                                    <h2 class="display-5 text-truncate">Transactions</h2>
                                    <h3 class="display-4">
                                        <i class="far fa-edit"></i>
                                    </h3>
                                    <h4><?php echo h($transaction_count); ?></h4>
                                    <a href="<?php echo url_for('/transactions/index.php'); ?>" class="btn btn-outline-light">View</a>
                                </div>
                            </div>
                        </div> <!-- col-md-4 -->
                        <div class="col-md-4">
                            <div class="card bg-danger text-center text-white mb-3">
                                <div class="card-body">
                                    <h2 class="display-5">Users</h2>
                                    <h3 class="display-4">
                                        <i class="fa fa-user"></i>
                                    </h3>
                                    <h4><?php echo h($user_count); ?></h4>
                                    <a href="<?php echo url_for('/users/index.php'); ?>" class="btn btn-outline-light">View</a>
                                </div>
                            </div>
                        </div> <!-- col-md-4 -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- home -->
    </div> <!-- content -->
    
<?php include('../private/shared_items/main_footer.php'); // Include footer file ?>