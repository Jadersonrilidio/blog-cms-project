<?php include 'includes/phpmailer.php'; ?>

<!-- Header Settings -->
<?php include './includes/header.php'; ?>

<!-- PHP functions -->
<?php redirect_not_allowed('index'); ?>
<?php $MSG_STATUS = forgot_password_mail(); ?>

<!-- Page Content -->
<div class="container">
    
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">

                        <h2 class="text-center"> Forgot Password? </h2>
                        <p class="text-center"> You can request to reset here. </p>

                        <?php if (!empty($MSG_STATUS)) echo "<p class='my-status-msg-box text-center'> " . $MSG_STATUS . "</P>"; ?>

                        <div class="panel-body">

                            <form role="form" action="forgot_password?forgot=<?php echo $_GET['forgot']; ?>" method="POST" id="login-form" autocomplete="off">
                                
                                <div class="form-group">
                                    <label for="user_email" class="sr-only"> Email </label>
                                    <input type="email" name="user_email" id="email" class="form-control" placeholder="Enter email: somebody@example.com">
                                </div>

                                <input type="submit" name="send_email" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send email">

                                <br>
                                <a class="col-lg-12 text-center" href="login"> I remember my email! - Login Page </a>
                            
                            </form>

                        </div> <!-- /.panel-body -->
                    </div> <!-- /.form-wrap -->
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

<hr>

<?php include "includes/footer.php";?>
