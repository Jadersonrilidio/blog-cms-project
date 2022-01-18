<?php include 'includes/header.php'; ?>

<!-- PHP page function set -->
<?php include 'functions/f_login.php'; ?> 

<!-- Navigation Menu -->
<?php include 'includes/navigationbar.php'; ?>

<!-- PHP functions -->
<?php Permissions::redirect_logged('index'); ?>
<?php Login::login_user(); ?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">

                        <h1 class="text-center"> <?php echo PAGE_LOGIN_TITLE; ?> </h1>

                        <form role="form" action="<?php echo Config::REL_PATH; ?>login" method="POST" id="login-form" autocomplete="off">
                            
                            <?php FormErrorMsg::login_invalid_username_password(); ?>
                            <?php FormErrorMsg::login_has_username(); ?>

                            <div class="form-group">
                                <label for="user_name" class="sr-only"> <?php echo _USERNAME; ?> </label>
                                <input type="text" name="user_name" id="username" class="form-control" placeholder="<?php echo _USERNAME_INPUT; ?>" autocomplete="on">
                            </div>

                            <?php FormErrorMsg::login_has_password(); ?>

                            <div class="form-group">
                                <label for="user_password" class="sr-only"> <?php echo _PASSWORD; ?> </label>
                                <input type="password" name="user_password" id="key" class="form-control" placeholder="<?php echo _PASSWORD_INPUT; ?>">
                            </div>
                    
                            <input type="submit" name="submit_login" id="btn-login" class="btn btn-custom btn-lg btn-block" value="<?php echo LOGIN_BTN; ?>">

                            <a class="col-lg-12 text-left" href="<?php MySessionHandler::uniqid_handler(); ?>"> <small> <?php echo SIDEBAR_FORGOT_PASSWORD; ?> </small> </a>

                            <a class="col-lg-12 text-center" href="<?php echo Config::REL_PATH."registration"; ?>"> <?php echo PAGE_LOGIN_REGISTER_LINK; ?> </a>
                            
                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

<hr>

<?php include "includes/footer.php";?>

<script> addClassLogin(); </script>
