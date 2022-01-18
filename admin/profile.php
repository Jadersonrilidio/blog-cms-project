<?php include 'includes/admin_header.php'; ?>

<!-- Navigation -->
<?php include 'includes/admin_navigationbar.php'; ?>

<!-- Page Function Set -->
<?php include 'functions/f_profile.php'; ?>
<?php include '../languages/en.php'; ?>

<?php update_user(); ?>
<?php change_password(); ?>

    <div id="wrapper">

        <!-- Page Heading -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12"> 
                        
                        <h1 class="page-header"> Profile <small> &ensp; Admin <?php echo_admin_username(); ?> </small> </h1>

                        <div class="col-xs-12">

                            <form role="form" action="<?php echo Config::ADMIN_REL_PATH."profile"; ?>" method="POST" id="login-form" enctype="multipart/form-data" autocomplete="off">
                                
                                <div class="form-group text-center">
                                    <img src="<?php echo profile_image_source(); ?>" width="240">
                                    <input class="center-block" type="file" name="user_img">
                                </div>

                                <?php FormErrorMsg::profile_has_username(); ?>
                                <?php FormErrorMsg::profile_username_exists(); ?>
                                
                                <div class="form-group">
                                    <label for="user_name"> <?php echo _USERNAME; ?> </label> 
                                    <input type="text" name="user_name" id="username" class="form-control" placeholder="<?php echo _USERNAME_INPUT; ?>"  autocomplete="on"
                                        value="<?php if(isset($_SESSION['user_name'])) echo $_SESSION['user_name']; ?>">
                                </div>

                                <?php FormErrorMsg::profile_has_email(); ?>
                                <?php FormErrorMsg::profile_email_exists(); ?>

                                <div class="form-group">
                                    <label for="user_email"> <?php echo _EMAIL; ?> </label>
                                    <input type="email" name="user_email" id="email" class="form-control" placeholder="<?php echo _EMAIL_INPUT; ?>"  autocomplete="on"
                                        value="<?php if(isset($_SESSION['user_email'])) echo $_SESSION['user_email']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="user_lang"> <?php echo PROFILE_LANG; ?> </label>
                                    <select class="form-control" name="user_lang">
                                        <option value=''></option>
                                        <option <?php select_user_language('en'); ?> value='en'> EN </option>
                                        <option <?php select_user_language('es'); ?> value='es'> ES </option>
                                        <option <?php select_user_language('pt'); ?> value='pt'> PT </option>
                                        <option <?php select_user_language('ru'); ?> value='ru'> RU </option>
                                    </select>
                                </div>

                                <div class="">
                                    <h5 style="cursor:pointer" href="javascript:;" data-toggle="collapse" data-target="#passwords">
                                        <strong> <?php echo PROFILE_CHANGE_PSWD; ?> <i class="fa fa-fw fa-caret-down"></i> </strong>
                                            <?php FormErrorMsg::profile_has_current_password(); ?>
                                            <?php FormErrorMsg::profile_wrong_current_password(); ?>
                                            <?php FormErrorMsg::profile_has_new_password(); ?>
                                            <?php FormErrorMsg::profile_has_rpt_password(); ?>
                                            <?php FormErrorMsg::profile_passwords_not_match(); ?>
                                    </h5>

                                    <div id="passwords" class="collapse well">

                                        <div class="form-group">
                                            <label for="old_password"> <?php echo PROFILE_CURRENT_PSWD; ?> </label>
                                            <input type="password" name="old_password" class="form-control" placeholder="current password">
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password"> <?php echo PROFILE_NEW_PSWD; ?> </label>
                                            <input type="password" name="new_password" class="form-control" placeholder="new password">
                                        </div>

                                        <div class="form-group">
                                            <label for="rpt_password"> <?php echo PROFILE_RPT_PSWD; ?> </label>
                                            <input type="password" name="rpt_password" class="form-control" placeholder="repeat password">
                                        </div>

                                        <input type="submit" name="change_password" class="btn btn-custom btn-lg btn-block" value="<?php echo CHANGE_PASSWORD_BTN; ?>">
                                        
                                    </div>
                                </div>

                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="<?php echo PROFILE_SAVE_CHANGES; ?>">

                            </form>

                        </div>
                        
                        <br>
                        <ol class="breadcrumb">
                            <li> <i class="fa fa-dashboard"> </i>  <a href="index"> Dashboard </a> </li>   
                        </ol>   

                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Heading -->

    </div>

<!-- Footer -->
<?php include 'includes/admin_footer.php'; ?>
