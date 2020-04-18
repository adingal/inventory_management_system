<?php
    /*
    * Replenish Item Page  
    */

    // Require init file
    require_once('../../private/init.php');

    // Require login
    require_login();

    // Set page title
    $page_title = 'Replenish Item';

    // Set user id
    $user_id = $_SESSION['user_id'] ?? '';

    // Set it
    $id = $_GET['id'] ?? NULL;

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

    // If post request
    if (is_post()) {
        $errors = [];

        $item['replenish_quantity'] = $_POST['replenish_quantity'] ?? '1';

        // If item['replenish_quantity'] is empty
        if (empty($item['replenish_quantity'])) {
            $errors['replenish_quantity'] = 'Please enter a quantiy to replenish.';
        }

        // If errors is empty
        if (empty($errors)) {
            // Call replenish item function
            $result = replenish_item($item);

            // If replenish is successful
            if ($result == true) {
                $transaction = [];
                $transaction['user_id'] = $user_id ?? '';
                $transaction['item_id'] = $id ?? '';
                $transaction['quantity'] = $item['replenish_quantity'] ?? '';
                $transaction['transaction_type'] = 'Replenish' ?? '';
                $transaction['remarks'] = $_POST['remarks'] ?? '';
    
                // Call insert transaction and redirect
                insert_transaction($transaction);            
                redirect_to(url_for('/items/index.php'));
            }
        }
    }
?>

<?php include(SHARED_PATH . '/main_header.php'); // Include header file ?>

<div id="content">

    <div id="replenish_item" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?php echo url_for('/items/replenish.php?id=' . h(u($id))); ?>" method="post">
                        <h1 class="display-5 text-truncate">Replenish Item</h1>
                        <div class="form-group">
                            <label for="item_id">Item ID</label>
                            <input type="text" class="form-control" name="item_id" value="<?php echo h($item['item_id']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="<?php echo h($item['item_name']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Current Quantity</label>
                            <input type="number" class="form-control" name="quantity" value="<?php echo h($item['quantity']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="replenish_quantity">Replenish Quantity</label>
                            <input type="number" class="form-control" name="replenish_quantity" min="1" value="<?php echo $item['replenish_quantity']; ?>">
                            <small class="text-danger">
                                <?php
                                    // If there are errors for replenish quantity
                                    if ($errors['replenish_quantity'] ?? '') {
                                        echo $errors['replenish_quantity'];
                                    }
                                ?>
                            </small>                            
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" class="form-control" cols="30" rows="5"></textarea>                           
                        </div>                        
                        <div class="form-group text-right">
                            <input type="submit" class="btn btn-dark" value="Replenish">
                            <a href="<?php echo url_for('/items/index.php'); ?>" class="btn btn-dark">Cancel</a>                            
                        </div>
                    </form>
                </div> <!-- col-md-6 -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- replenish_item -->

</div> <!-- content -->

<?php include(SHARED_PATH . '/main_footer.php'); // Include footer file ?>