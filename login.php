<?php

include('inc/header.php');

/*
 * -----------------------------------------------------------------

        After LoggedIn, a user can not access login.php

 * ------------------------------------------------------------------
*/
if (isset($_SESSION['loggedIn'])) {
    ?>

    <script>window.location.href = 'index.php'</script>

<?php

}

?>

    <div class="py-0 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">

                        <?php alertMessage(); ?>

                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Login</h3>
                        </div>
                        <div class="card-body">
                            <form action="login-code.php" method="POST">
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="email" type="email" placeholder="name@example.com" required />
                                    <label for="inputEmail">Email address</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" name="password" type="password" placeholder="Password" required />
                                    <label for="inputPassword">Password</label>
                                </div>
<!--                                <div class="form-check mb-3">-->
<!--                                    <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />-->
<!--                                    <label class="form-check-label" for="inputRememberPassword">Remember Password</label>-->
<!--                                </div>-->
                                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                    <a class="small" href="password.html">Forgot Password?</a>
                                    <button type="submit" name="login" class="btn btn-primary" href="index.html">Login</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('inc/footer.php'); ?>