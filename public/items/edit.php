<?php
    /*
    * Edit Item Page  
    */

    // Require init file
    require_once('../../private/init.php');

    // Require login
    require_login();

    // Set page title
    $page_title = 'Edit Item';

    // Set user id
    $user_id = $_SESSION['user_id'] ?? '';

    // Set id
    $id = $_GET['id'] ?? NULL;

    // If id is null
    if (is_null($id)) {
        redirect_to(url_for('/items/index.php'));
    }
    
    // If post request
    if (is_post()) {
        $item = [];
        $item['item_id'] = $id;
        $item['item_name'] = $_POST['item_name'];
        $item['item_description'] = $_POST['description'];
        $item['quantity'] = $_POST['quantity'];

        // Call update item function
        $result = update_item($item);

        // If update is successful
        if (mysqli_affected_rows($db)) {
            $transaction = [];
            $transaction['user_id'] = $user_id ?? '';
            $transaction['item_id'] = $id ?? '';
            $transaction['quantity'] = $item['quantity'] ?? '';
            $transaction['transaction_type'] = 'Edit' ?? '';
            $transaction['remarks'] = $_POST['remarks'] ?? '';

            // Call insert transaction function and redirect
            insert_transaction($transaction);   
            redirect_to(url_for('/items/index.php'));
        } else {
        // If not set errors array
            $errors = $result;
        }
    }
    
    // Call find item by id function
    $item = find_item_by_id($id);

    // If item is empty
    if (empty($item)) {
        redirect_to(url_for('/items/index.php'));
    }

    // Call find user by id function
    $user = find_user_by_id($item['user_id']);

    // Format added date
    $formatted_date = date_format(date_create($item['added_date']), 'M d, Y');
?>

<?php include(SHARED_PATH . '/main_header.php'); // Include header file ?>

<div id="content">

    <div id="edit_item" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <form action="<?php echo url_for('/items/edit.php?id=' . h(u($id))); ?>" method="post">
                        <h1 class="display-5">Edit item...</h1>
                        <div class="form-group mb-2">
                            <label for="item_name">Item Name</label>
                            <input type="text" class="form-control" name="item_name" value="<?php echo h($item['item_name']); ?>">
                            <small class="text-danger">
                                <?php
                                    // If there are errors for item name
                                    if ($errors['item_name'] ?? '') {
                                        echo $errors['item_name'];
                                    } else if ($errors['item_min'] ?? '') {
                                        echo $errors['item_min'];
                                    } else if ($errors['item_max'] ?? '') {
                                        echo $errors['item_max'];
                                    }
                                ?>
                            </small>                        
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" cols="30" rows="5"><?php echo h($item['item_description']); ?></textarea>
                            <small class="text-danger">
                                <?php
                                    // If there are errors for description
                                    if ($errors['description_max'] ?? '') {
                                        echo $errors['description_max'];
                                    } else if ($errors['description_min'] ?? '') {
                                        echo $errors['description_min'];
                                    }
                                ?>
                            </small>                         
                        </div>
                        <div class="form-group mb-2">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" name="quantity" min="1" max="100" value="<?php echo h($item['quantity']); ?>">
                            <small class="text-danger">
                                <?php
                                    // If there are errors for quantity
                                    if ($errors['quantity'] ?? '') {
                                        echo $errors['quantity'];
                                    }
                                ?>
                            </small>                        
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" class="form-control" cols="30" rows="5"></textarea>
                        </div>                        
                        <div class="form-group mb-2">
                            <label for="added_by">Added By</label>
                            <input type="text" class="form-control" name="added_by" <?php echo 'value="' . h($user['first_name'] . ' ' . $user['last_name']) . '"'; ?> disabled>
                        </div>
                        <div class="form-group mb-2">
                            <label for="added_date">Added Date</label>
                            <input type="text" class="form-control" name="added_date" <?php echo 'value="' . ($formatted_date) . '" disabled'; ?>>
                        </div>
                        <div class="form-group mb-2 text-right">
                            <input type="submit" class="btn btn-dark" value="Edit">
                            <a href="<?php echo url_for('/items/index.php'); ?>" class="btn btn-dark">Cancel</a>
                        </div>
                    </form>
                </div> <!-- col-md-6 -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- edit_item --> 

</div> <!-- content -->

<?php include(SHARED_PATH . '/main_footer.php'); // Include footer file ?>