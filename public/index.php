<?php
    require_once('../private/init.php');

    require_login();

    $page_title = 'Inventory Management System';

    $item_count = item_count();
    $user_count = user_count();
    $transaction_count = transaction_count();
?>

<?php include('../private/shared_items/main_header.php'); ?>

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