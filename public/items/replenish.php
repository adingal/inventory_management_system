<?php
    require_once('../../private/init.php');

    require_login();

    $page_title = 'Replenish Item';

    $user_id = $_SESSION['user_id'] ?? '';

    $id = $_GET['id'] ?? NULL;

    if (is_null($id)) {
        redirect_to(url_for('/items/index.php'));
    }

    $item = find_item_by_id($id);

    if (empty($item)) {
        redirect_to(url_for('/items/index.php'));
    }

    if (is_post()) {
        $errors = [];

        $item['replenish_quantity'] = $_POST['replenish_quantity'] ?? '1';
        if (empty($item['replenish_quantity'])) {
            $errors['replenish_quantity'] = 'Please enter a quantiy to replenish.';
        }

        if (empty($errors)) {
            $result = replenish_item($item);

            if ($result) {
                $transaction = [];
                $transaction['user_id'] = $user_id ?? '';
                $transaction['item_id'] = $id ?? '';
                $transaction['quantity'] = $item['replenish_quantity'] ?? '';
                $transaction['transaction_type'] = 'Replenish' ?? '';
                $transaction['remarks'] = $_POST['remarks'] ?? '';
    
                insert_transaction($transaction);            
                redirect_to(url_for('/items/index.php'));
            }
        } else {
            
        }

    }
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

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
                </div>
            </div>
        </div>
    </div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>