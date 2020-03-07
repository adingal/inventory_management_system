<?php require_once('../private/init.php'); ?>

<?php include('../private/shared_items/main_header.php'); ?>

    <div id="content">
        <?php if (!is_logged_in()) { ?>
            <div id="login" class="d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 mx-auto">
                            <form action="#" class="bg-dark border rounded border-light text-white p-3">
                                <h1 class="text-center mb-3">Sign in...</h1>
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" placeholder="Password" class="form-control">
                                </div>
                                <button class="btn btn-outline-light btn-block">
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div id="home" class="mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
                            <h1 class="mb-3">Recent Transactions</h1>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Item Name</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Withdrawn By</th>
                                        <th>Withdraw Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Item 1</td>
                                        <td>Item 1 description</td>
                                        <td>5</td>
                                        <td>Jose Manalo</td>
                                        <td>March 5, 2020</td>
                                    </tr>
                                    <tr>
                                        <td>Item 2</td>
                                        <td>Item 2 description</td>
                                        <td>3</td>
                                        <td>Jose Manalo</td>
                                        <td>March 4, 2020</td>
                                    </tr>
                                    <tr>
                                        <td>Item 3</td>
                                        <td>Item 3 description</td>
                                        <td>2</td>
                                        <td>Jose Manalo</td>
                                        <td>March 7, 2020</td>
                                    </tr>
                                    <tr>
                                        <td>Item 1</td>
                                        <td>Item 1 description</td>
                                        <td>5</td>
                                        <td>Jose Manalo</td>
                                        <td>March 5, 2020</td>
                                    </tr>
                                    <tr>
                                        <td>Item 2</td>
                                        <td>Item 2 description</td>
                                        <td>3</td>
                                        <td>Jose Manalo</td>
                                        <td>March 4, 2020</td>
                                    </tr>
                                    <tr>
                                        <td>Item 3</td>
                                        <td>Item 3 description</td>
                                        <td>2</td>
                                        <td>Jose Manalo</td>
                                        <td>March 7, 2020</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary text-center text-white mb-3">
                                <div class="card-body">
                                    <h2>Items</h2>
                                    <h3 class="display-4">
                                        <i class="fas fa-boxes"></i>
                                    </h3>
                                    <a href="" class="btn btn-outline-light btn-sm">View</a>
                                </div>
                            </div>
                            <div class="card bg-success text-center text-white mb-3">
                                <div class="card-body">
                                    <h2>Transactions</h2>
                                    <h3 class="display-4">
                                        <i class="far fa-edit"></i>
                                    </h3>
                                    <a href="" class="btn btn-outline-light btn-sm">View</a>
                                </div>
                            </div>
                            <div class="card bg-danger text-center text-white mb-3">
                                <div class="card-body">
                                    <h2>Users</h2>
                                    <h3 class="display-4">
                                        <i class="fa fa-user"></i>
                                    </h3>
                                    <a href="" class="btn btn-outline-light btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    
<?php include('../private/shared_items/main_footer.php'); ?>