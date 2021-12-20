
<!-- Header Settings -->
<?php include 'includes/header.php'; ?>

<!-- PHP page function set -->
<?php include 'functions/f_contact.php'; ?>

<!-- PHP functions -->
<?php send_email(); ?>
<?php Permissions::is_logged(); ?>

<!-- Navigation Menu -->
<?php include 'includes/navigationbar.php'; ?>

<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">

                        <h1 class="text-center"> <?php echo PAGE_CONTACT_TITLE; ?> </h1>

                        <form role="form" action="<?php echo Config::REL_PATH."contact"; ?>" method="POST" id="login-form" autocomplete="on">

                            <?php FormErrorMsg::contact_has_email(); ?>

                            <div class="form-group">
                                <label for="email" class="sr-only"> <?php echo _EMAIL; ?> </label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL_INPUT; ?>"
                                    value="<?php set_user_email(); ?>">
                            </div>

                            <?php FormErrorMsg::contact_has_subject(); ?>

                            <div class="form-group">
                                <label for="subject" class="sr-only"> <?php echo SUBJECT; ?> </label>
                                <input type="text" name="subject" class="form-control" placeholder="<?php echo SUBJECT_INPUT; ?>"
                                    value="<?php set_subject(); ?>">
                            </div>

                            <?php FormErrorMsg::contact_has_message(); ?>

                            <div class="form-group">
                                <textarea class="form-control" id="body" name="message" rows="7"><?php set_message(); ?></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="<?php echo SEND_BTN; ?>">

                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

<hr>

<?php include "includes/footer.php";?>

<script> addClassContact(); </script>