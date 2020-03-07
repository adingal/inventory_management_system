<?php include('../private/shared_items/main_header.php'); ?>

    <div id="content">
       <div id="login" class="d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-4 mx-auto">
                        <form action="#">
                            <h1 class="text-center">Sign in...</h1>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <button class="btn btn-secondary btn-block">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
       </div> 
    </div>
    
<?php include('../private/shared_items/main_footer.php'); ?>