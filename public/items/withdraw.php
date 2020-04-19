<?php
    /*
    * Withdraw Item Page  
    */

    // Require init file
    require_once('../../private/init.php');

    // Require login
    require_login();

    // Set page title
    $page_title = 'Withdraw Item';

    // Set id
    $id = $_GET['id'] ?? NULL;

    // Set user id
    $user_id = $_SESSION['user_id'];

    // If id is null
    if (is_null($id)) {
        redirect_to(url_for('/items/index.php'));
    }
    
    // Call find item by id function
    $item = find_item_by_id($id);

    // If item is empty
    if (empty($item)) {
        redirect_to(url_for('/items/index.php'));
    }
    
    $current_quantity = $item['quantity'] ?? 0;

    // If post request
    if (is_post()) {
        $transaction = [];
        $transaction['user_id'] = $user_id ?? '';
        $transaction['item_id'] = $id ?? '';
        $transaction['previous_quantity'] = $current_quantity ?? '';
        $transaction['quantity'] = $_POST['quantity'] ?? '';
        $transaction['remaining_quantity'] = $current_quantity - $_POST['quantity'] ?? '';
        $transaction['transaction_type'] = 'Withdraw' ?? '';
        $transaction['remarks'] = $_POST['remarks'] ?? '';

        // If withdraw quantity is greater than the current inventory
        if ($transaction['quantity'] > $item['quantity']) {
            $errors['quantity_limit'] = 'Please enter only the current available quantity.';
        }

        // If errors is empty
        if (empty($errors)) {
            // Call withdraw item function
            $result = withdraw_item($transaction['item_id'], $transaction['quantity']);
    
            // If withdraw is successful
            if ($result == true) {
                // Call insert transaction and redirect
                insert_transaction($transaction);
                redirect_to(url_for('/transactions/index.php'));
            }
        }
    }     
?>

<?php include(SHARED_PATH . '/main_header.php'); // Include header file ?>

<div id="content">
    <div id="withdraw_item" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?php echo url_for('items/withdraw.php?id=' . h(u($id))); ?>" method="post">
                        <div class="form-group">
                            <label for="item_id">Item ID</label>
                            <input type="text" class="form-control mb-2" name="item_id" value="<?php echo h($id); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="<?php echo h($item['item_name']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" min="1" max="<?php echo h($item['quantity']); ?>" value="1">
                            <small class="text-danger"> 
                                <?php
                                    // If there are errors for quantity limit 
                                    if ($errors) {
                                        echo $errors['quantity_limit'] . '<br>';
                                    }
                                    
                                    echo 'Available quantity: ' . h($item['quantity']);  
                                ?>
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-dark" data-dismiss="modal">Withdraw</button>
                            <a href="<?php echo url_for('/items/index.php'); ?>" class="btn btn-dark" data-dismiss="modal">Cancel</a>
                        </div>
                    </form>
                </div> <!-- col-md-6 -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- withdraw_item -->
</div> <!-- content -->

<?php include(SHARED_PATH . '/main_footer.php'); // Include footer file ?>

