<?php
    /*
    * Delete Item Page  
    */

    // Require init file
    require_once('../../private/init.php');

    // Require login
    require_login();

    // Set page title
    $page_title = 'Delete Item';

    // Set user id
    $user_id = $_SESSION['user_id'] ?? '';

    // Set id
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
        // Call delete item function
        $result = delete_item($id);

        // If delete is successful
        if ($result == true) {
            $transaction = [];
            $transaction['user_id'] = $user_id ?? '';
            $transaction['item_id'] = $id ?? '';
            $transaction['quantity'] = $item['quantity'] ?? '';
            $transaction['transaction_type'] = 'Delete' ?? '';
            $transaction['remarks'] = $_POST['remarks'] ?? '';

            // Call insert transaction function and redirect
            insert_transaction($transaction);
            redirect_to(url_for('/items/index.php'));
        }
    }  
?>

<?php include(SHARED_PATH . '/main_header.php'); // Include header file ?>

<div id="content">
    <div id="delete_item" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?php echo url_for('/items/delete.php?id=' . h(u($id))); ?>" method="post">
                        <h1 class="display-5">Delete item...</h1>
                        <div class="form-group mb-2">
                            <label for="item_id">Item ID</label>
                            <input type="text" class="form-control" name="item_id" value="<?php echo h($item['item_id']); ?>" disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="<?php echo h($item['item_name']); ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" class="form-control" cols="30" rows="5"></textarea>
                        </div>                          
                        <div class="form-group mb-2 text-right">
                            <input type="submit" class="btn btn-dark" value="Delete">
                            <a href="<?php echo url_for('/items/index.php'); ?>" class="btn btn-dark">Cancel</a>
                        </div>                        
                    </form>
                </div> <!-- col-md-6 -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- delete_item -->
</div> <!-- content -->

<?php include(SHARED_PATH . '/main_footer.php'); // Include footer file ?>