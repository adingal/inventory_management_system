<?php
    require_once('../../private/init.php');

    $page_title = 'Transactions';
?>

<?php include(SHARED_PATH . '/main_header.php'); ?>

<div id="content">
    <div id="actions" class="pt-5 pb-2 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="selected_item">Transaction ID</label>
                        </div>
                        <select class="custom-select" id="selected_item">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-9 text-center text-md-right">
                    <a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Add</a>
                    <a href="#" class="btn btn-success"><i class="fa fa-pencil-alt"></i> Edit</a>
                    <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
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
                                <th>Transaction ID</th>
                                <th>User ID</th>
                                <th>Item ID</th>
                                <th>Withdrawn Quantity</th>
                                <th>Transaction Date</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>3</td>
                                <td>6</td>
                                <td>5</td>
                                <td>March 7, 2020</td>
                                <td>Use for maintenance.</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2</td>
                                <td>4</td>
                                <td>6</td>
                                <td>March 18, 2020</td>
                                <td>Repair loader.</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>12</td>
                                <td>May 14, 2020</td>                            
                                <td>Use for PM.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/main_footer.php'); ?>