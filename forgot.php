<?php include 'includes/header.php'; ?>
<?php include 'functions/phpmailer_forgot_pswd.php'; ?>

<!-- PHP page function set -->
<?php include 'functions/f_forgot.php'; ?> 

<!-- PHP functions -->
<?php forgot_password_mail(); ?>
<?php Permissions::redirect_not_valid_uniqid('index'); ?>

<!-- Page Content -->
<div class="container">
    
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">

                        <h2 class="text-center"> <?php echo PAGE_FORGOT_TITLE; ?> </h2>
                        <p class="text-center"> <?php echo PAGE_FORGOT_SUBTITLE; ?> </p>

                        <div class="panel-body">

                            <form role="form" action="<?php echo Config::REL_PATH."forgot/{$_GET['forgot']}"; ?>" method="POST" id="login-form" autocomplete="off">
                                
                                <?php FormErrorMsg::forgot_has_email(); ?>
                                <?php FormErrorMsg::forgot_invalid_email(); ?>

                                <div class="form-group">
                                    <label for="user_email" class="sr-only"> <?php echo _EMAIL; ?> </label>
                                    <input type="email" name="user_email" id="email" class="form-control" placeholder="<?php echo _EMAIL_INPUT; ?>" autocomplete="on">
                                </div>

                                <input type="submit" name="send_email" id="btn-login" class="btn btn-custom btn-lg btn-block" value="<?php echo SEND_BTN; ?>">

                                <br>
                                <a class="col-lg-12 text-center" href="<?php echo Config::REL_PATH."login"; ?>"> <?php echo PAGE_FORGOT_LOGIN_LINK; ?> </a>
                                <br><br>
                                <a class="col-lg-12 text-center" href="<?php echo Config::REL_PATH."index"; ?>"> <?php echo PAGE_FORGOT_HOME_LINK; ?> </a>
                            
                            </form>

                        </div> <!-- /.panel-body -->
                    </div> <!-- /.form-wrap -->
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

<hr>

<?php include "includes/footer.php";?>
