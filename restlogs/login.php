<?php 
    include('includes/header.php');
    include('includes/navbar.php'); 
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
                                    <label for="ruid">User Id</label>
                                    <input type="text" name="ruid" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="rpass">Password</label>
                                    <input type="password" name="rpass" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="login_btn" class="btn btn-primary"> Login Now </button>
                                </div>
                               
                            </form>    
                        </div>
                            <div class="container"> 
                                <p> <a href="../user/login.php"> Click For Customer Login </a> </p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php') ?>