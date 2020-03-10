<?php
    require_once('../../private/init.php');

    $page_title = 'Add Items';
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">

<div id="add_items" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="#" method="post">
                    <h1 class="display-5">Add new item...</h1>
                    <div class="form-group mb-2">
                        <label for="item_name">Item Name</label>
                        <input type="text" class="form-control" name="item_name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="description">Description</label>
                        <textarea class="d-block w-100" name="description" cols="30" rows="5"></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" min="1" max="100">
                    </div>
                    <div class="form-group mb-2">
                        <label for="added_by">Added By</label>
                        <input type="text" class="form-control" name="added_by">
                    </div>
                    <div class="form-group mb-2 text-right">
                        <input type="submit" class="btn btn-dark" value="Submit">
                        <input type="submit" class="btn btn-dark" value="Cancel">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>