
<!-- Header Settings -->
<?php include './includes/header.php'; ?>

<!-- PHP functions -->
<?php redirect_not_valid_token('index'); ?>
<?php $MSG_STATUS = reset_password(); ?>

<!-- Page Content -->
<div class="container">
    
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">

                        <h2 class="text-center"> Reset Password? </h2>
                        <p class="text-center"> You can reset your password here. </p>

                        <?php if (!empty($MSG_STATUS)) echo "<p class='my-status-msg-box text-center'> " . $MSG_STATUS . "</P>"; ?>

                        <div class="panel-body">

                            <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?email={$_GET['email']}&token={$_GET['token']}"; ?>" method="POST" id="login-form" autocomplete="off">
                                
                                <div class="form-group">
                                    <label for="user_password" class="sr-only"> New Password </label>
                                    <input type="password" name="user_password" id="password" class="form-control" placeholder="Enter new password">
                                </div>

                                <div class="form-group">
                                    <label for="repeat_password" class="sr-only"> Repeat Password </label>
                                    <input type="password" name="repeat_password" id="password" class="form-control" placeholder="Repeat new password">
                                </div>

                                <input type="submit" name="reset_password" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Reset password">

                                <br>
                                <a class="col-lg-12 text-center" href="index"> Return to Home Page </a>

                            </form>

                        </div> <!-- /.panel-body -->
                    </div> <!-- /.form-wrap -->
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

<hr>

<?php include "includes/footer.php";?>
