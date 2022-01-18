<?php include 'includes/header.php'; ?>

<!-- PHP page function set -->
<?php include 'functions/f_reset.php'; ?> 

<!-- PHP functions -->
<?php Permissions::redirect_not_valid_token('index'); ?>
<?php reset_password(); ?>

<!-- Page Content -->
<div class="container">
    
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">

                        <h2 class="text-center"> <?php echo PAGE_RESET_TITLE; ?> </h2>
                        <p class="text-center"> <?php echo PAGE_RESET_SUBTITLE; ?> </p>

                        <div class="panel-body">

                            <form role="form" action="<?php display_action_link(); ?>" method="POST" id="login-form" autocomplete="off">
                                
                                <?php FormErrorMsg::reset_has_password(); ?>
                                <?php FormErrorMsg::reset_password_match(); ?>

                                <div class="form-group">
                                    <label for="user_password" class="sr-only"> <?php echo _NEW_PASSWORD; ?> </label>
                                    <input type="password" name="user_password" id="password" class="form-control" placeholder="<?php echo _NEW_PASSWORD_INPUT; ?>">
                                </div>

                                <?php FormErrorMsg::reset_has_rpt_password(); ?>

                                <div class="form-group">
                                    <label for="repeat_password" class="sr-only"> <?php echo _RPT_PASSWORD; ?> </label>
                                    <input type="password" name="repeat_password" id="password" class="form-control" placeholder="<?php echo _RPT_PASSWORD_INPUT; ?>">
                                </div>

                                <input type="submit" name="reset_password" id="btn-login" class="btn btn-custom btn-lg btn-block" value="<?php echo _RESET_PASSWORD_BTN; ?>">

                                <br>
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
