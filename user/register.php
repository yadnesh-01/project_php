<?php 
    include('includes/header.php');
    include('includes/navbar.php'); 
    $page_title = "Create new Account";
    ?>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4> Registration form</h4>
                        </div>
                        <div class="card-body">
                            <form action="registerdata.php" method="POST">
                                <div class="form-group mb-3">
                                    <label for="username">Name</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cont">Phone Number</label>
                                    <input type="text" name="cont" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="unamr">User-ID</label>
                                    <input type="text" name="uname" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email">Email ID </label>
                                    <input type="text" name="email" class="form-control" required> 
                                </div>
                                <div class="form-group mb-3">
                                    <label for="upass">Password</label>
                                    <input type="password" name="upass" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"> Register Now </button>
                                </div>
                               
                            </form>
                        </div>
                        <div class="container">
                            <p> <a href="login.php">Login Here</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>