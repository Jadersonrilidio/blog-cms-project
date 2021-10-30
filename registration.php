
<!-- Header Settings -->
<?php include './includes/header.php'; ?>

<!-- Navigation Menu -->
<?php include './includes/navbar.php'; ?>

<!-- PHP state functions -->
<?php set_lang(); ?>
<?php include_lang_file(); ?>


<!-- Page Content -->
<div class="container">
    
    <!-- select language box -->
    <form action="" class="navbar-form navbar-right" id="language_form" method="GET">
        <label class="text-center"> <?php echo _NAV_LANG; ?> </label>
        <select class="form-control" name="lang" onchange="changeLanguage()">
            <option <?php select_lang('en'); ?> value="en"> English </option>
            <option <?php select_lang('es'); ?> value="es"> Espanõl </option>
            <option <?php select_lang('ru'); ?> value="ru"> Русский </option>
        </select> 
    </form>


    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">

                        <?php redirect_logged('index'); ?>

                        <?php $MSG_STATUS = register_new_user(); ?>

                        <h1 class="text-center"> <?php echo _REGISTER; ?> </h1>

                        <?php echo "<p class='my-status-msg-box'> <i>" . $MSG_STATUS . "</i> </p>"; ?>

                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            
                            <div class="form-group">
                                <label for="user_name" class="sr-only"> <?php echo _USERNAME; ?> </label> 
                                <p> <i style="color:red"> <?php if (isset($_POST['user_register']) && empty($_POST['user_name'])) echo "Must insert valid username."; ?> </i> </p>
                                <p> <i style="color:red"> <?php if (isset($_POST['user_name']) && username_exists($_POST['user_name'])) echo "Username already exists."; ?> </i> </p>
                                <input type="text" name="user_name" id="username" class="form-control" placeholder="<?php echo _USERNAME_INPUT; ?>"  autocomplete="on"
                                    value="<?php if(!empty($_POST['user_name'])) echo $_POST['user_name']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="user_email" class="sr-only"> <?php echo _EMAIL; ?> </label>
                                <p> <i style="color:red"> <?php if (isset($_POST['user_register']) && empty($_POST['user_email'])) echo "Must insert valid email."; ?> </i> </p>
                                <p> <i style="color:red"> <?php if (isset($_POST['user_email']) && email_exists($_POST['user_email'])) echo "Email already exists."; ?> </i> </p>
                                <input type="email" name="user_email" id="email" class="form-control" placeholder="<?php echo _EMAIL_INPUT; ?>"  autocomplete="on"
                                    value="<?php if(!empty($_POST['user_email'])) echo $_POST['user_email']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="user_password" class="sr-only"> <?php echo _PASSWORD; ?> </label>
                                <p> <i style="color:red"> <?php if (isset($_POST['user_register']) && empty($_POST['user_password'])) echo "Must insert password."; ?> </i> </p>
                                <p> <i style="color:red"> <?php if (isset($_POST['user_register']) && $_POST['user_password'] != $_POST['repeat_password']) echo "Passwords do not match."; ?> </i> </p>
                                <input type="password" name="user_password" id="key" class="form-control" placeholder="<?php echo _PASSWORD_INPUT; ?>">
                            </div>

                            <div class="form-group">
                                <label for="repeat_password" class="sr-only"> <?php echo _RPT_PASSWORD; ?> </label>
                                <p> <i style="color:red"> <?php if (isset($_POST['user_register']) && empty($_POST['repeat_password'])) echo "Must repeat password."; ?> </i> </p>
                                <input type="password" name="repeat_password" id="key" class="form-control" placeholder="<?php echo _RPT_PASSWORD_INPUT; ?>">
                            </div>
                    
                            <input type="submit" name="user_register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="<?php echo _REGISTER; ?>">

                            <br><a class="col-lg-12 text-center" href="login.php"> <?php echo _LOGINPAGE_BTN; ?> </a>
                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

<hr>

<?php include "includes/footer.php";?>

<script> addClassRegister(); </script>
