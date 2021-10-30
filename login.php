
<!-- Header Settings -->
<?php include './includes/header.php'; ?>

<!-- Navigation Menu -->
<?php include './includes/navbar.php'; ?>

<!-- Page Content -->
<div class="container">
    
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        
                        <?php redirect_logged('index'); ?>

                        <h1 class="text-center"> Login </h1>

                        <?php echo "<p class='my-status-msg-box'> <i>" . $LOGIN_STATUS . "</i> </p>"; ?>

                        <form role="form" action="login.php" method="POST" id="login-form" autocomplete="off">
                            
                            <div class="form-group">
                                <label for="user_name" class="sr-only"> Username </label>
                                <input type="text" name="user_name" id="username" class="form-control" placeholder="Enter username...">
                            </div>

                            <div class="form-group">
                                <label for="user_password" class="sr-only"> Password </label>
                                <input type="password" name="user_password" id="key" class="form-control" placeholder="Enter Password...">
                            </div>
                    
                            <input type="submit" name="user_login" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Login">

                            <a class="col-lg-12 text-left" href="forgot_password?forgot=<?php echo uniqid(true); ?>">
                                <small> Forgot your password? </small>
                            </a>

                            <a class="col-lg-12 text-center" href="registration.php"> I'm not a user! - Register Page </a>
                            
                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

<hr>

<?php include "includes/footer.php";?>

<script> addClassLogin(); </script>