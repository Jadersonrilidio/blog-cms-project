<?php include 'includes/header.php'; ?>

<!-- PHP page function set -->
<?php include 'functions/f_registration.php'; ?>

<!-- Navigation Menu -->
<?php include 'includes/navigationbar.php'; ?>

<!-- PHP function call -->
<?php Permissions::redirect_logged('index'); ?>
<?php register_user(); ?>

<!-- Page Content -->
<div class="container">
    
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">

                        <h1 class="text-center"> <?php echo _REGISTER; ?> </h1>

                        <form role="form" action="<?php echo Config::REL_PATH."registration"; ?>" method="POST" id="login-form" autocomplete="off">
                            
                            <?php FormErrorMsg::register_has_username(); ?>
                            <?php FormErrorMsg::register_username_exists(); ?>

                            <div class="form-group">
                                <label for="user_name" class="sr-only"> <?php echo _USERNAME; ?> </label> 
                                <input type="text" name="user_name" id="username" class="form-control" placeholder="<?php echo _USERNAME_INPUT; ?>"  autocomplete="on"
                                    value="<?php if(!empty($username)) echo $username; ?>">
                            </div>

                            <?php FormErrorMsg::register_has_email(); ?>
                            <?php FormErrorMsg::register_email_exists(); ?>

                            <div class="form-group">
                                <label for="user_email" class="sr-only"> <?php echo _EMAIL; ?> </label>
                                <input type="email" name="user_email" id="email" class="form-control" placeholder="<?php echo _EMAIL_INPUT; ?>"  autocomplete="on"
                                    value="<?php if(!empty($email)) echo $email; ?>">
                            </div>

                            <?php FormErrorMsg::register_has_password(); ?>
                            <?php FormErrorMsg::register_password_match(); ?>

                            <div class="form-group">
                                <label for="user_password" class="sr-only"> <?php echo _PASSWORD; ?> </label>
                                <input type="password" name="user_password" id="key" class="form-control" placeholder="<?php echo _PASSWORD_INPUT; ?>">
                            </div>
                            
                            <?php FormErrorMsg::register_has_rpt_password(); ?>
                            
                            <div class="form-group">
                                <label for="repeat_password" class="sr-only"> <?php echo _RPT_PASSWORD; ?> </label>
                                <input type="password" name="repeat_password" id="key" class="form-control" placeholder="<?php echo _RPT_PASSWORD_INPUT; ?>">
                            </div>
                    
                            <input type="submit" name="user_register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="<?php echo _REGISTER; ?>">

                            <br> <a class="col-lg-12 text-center" href="<?php echo Config::REL_PATH."login"; ?>"> <?php echo _LOGINPAGE_BTN; ?> </a>
                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

<hr>

<?php include "includes/footer.php";?>

<script> addClassRegister(); </script>
