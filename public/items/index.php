<?php
    require_once('../../private/init.php');

    $page_title = 'Items';
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="actions" class="pt-5 pb-2 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <select name="selected_item" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="col-md-10 text-right">
                    <a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                    <a href="#" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Edit</a>
                    <a href="#" class="btn btn-primary"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>
        </div>
    </div>
    <div id="items">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Added By</th>
                                <th>Added Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Item Name 1</td>
                                <td>Description 1</td>
                                <td>3</td>
                                <td>Juan Dela Cruz</td>
                                <td>March 7, 2020</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Item Name 2</td>
                                <td>Description 2</td>
                                <td>6</td>
                                <td>Jose Manalo</td>
                                <td>March 18, 2020</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Item Name 3</td>
                                <td>Description 3</td>
                                <td>9</td>
                                <td>Pepe Smith</td>
                                <td>May 14, 2020</td>                            
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>