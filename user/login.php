<?php 
    include('includes/header.php');
    include('includes/navbar.php'); 
    $page_title = "Log in";
    ?>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4> Login form</h4>
                        </div>
                        <div class="card-body">
                            <form action="logintab.php" method="post">
                               
                                <div class="form-group mb-3">
                                    <label for="uname">User Id</label>
                                    <input type="text" name="uname" class="form-control"required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="upass">Password</label>
                                    <input type="password" name="upass" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="login_btn" class="btn btn-primary"> Login Now </button>
                                </div>
                               
                            </form>
                        </div>

                        <div class="container">
                            <p><a href="register.php">Create an Account</a> </p>
                        </div>

                        <div class="container"> 
                            <p> <a href="../restlogs/login.php"> Click For Restaurant Login </a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>