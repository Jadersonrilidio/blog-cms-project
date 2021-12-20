<?php include 'functions/f_sidebar.php'; ?>

<div class="col-md-4">


    <!-- Blog Search Well -->
    <div class="well">

        <h4> <?php echo SIDEBAR_SEARCH_BOX; ?> </h4>

        <form action="<?php echo Config::REL_PATH."search"; ?>" method="GET" onsubmit="return false;">

            <div class="input-group">
                <input type="text" class="form-control" name="pattern" placeholder="<?php echo SIDEBAR_SEARCH_PLACEHOLDER; ?>">
                
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" onclick="window.location.href=this.form.action + '/' + this.form.pattern.value;">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>

        </form>

    </div>
    <!-- End Blog Search Well -->





    <!-- Blog login Well -->
    <?php Login::login_user(); ?>

    <?php if (isset($_SESSION['user_id'])): ?>

        <div class="well">
            <div class="input-group">
                <label> <?php echo SIDEBAR_GREETING_USER_BOX; ?> </label>
                <a class="btn btn-primary" href='<?php echo Config::REL_PATH."logout"; ?>'> <?php echo SIDEBAR_LOGOUT_BTN; ?> </a>
                <a class="btn btn-primary"  href='<?php echo Config::REL_PATH."profile"; ?>'> <?php echo SIDEBAR_PROFILE_BTN; ?> </a>
            </div>
        </div>

    <?php else: ?> 

        <div class="well">

            <h4> <?php echo SIDEBAR_LOGIN_BTN; ?> </h4>

            <form action="<?php echo Config::REL_PATH."index"; ?>" method="POST">

                <?php FormErrorMsg::login_invalid_username_password(); ?>
                <?php FormErrorMsg::login_has_username(); ?>

                <div class="form-group">
                    <input type="text" class="form-control" name="user_name" placeholder="<?php echo SIDEBAR_USERNAME_PLACEHOLDER; ?>">
                </div>

                <?php FormErrorMsg::login_has_password(); ?>
                
                <div class="input-group">
                    <input type="password" class="form-control" name="user_password" placeholder="<?php echo SIDEBAR_PASSWORD_PLACEHOLDER; ?>">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" name="submit_login"> <?php echo SIDEBAR_LOGIN_BTN; ?> </button>
                    </span>
                </div>

                <a class="col-lg-12 text-left" href="<?php MySessionHandler::uniqid_handler(); ?>" style="margin-top:5px"> <small> <?php echo SIDEBAR_FORGOT_PASSWORD; ?> </small> </a> <br>

            </form>

        </div>

    <?php endif; ?>
    <!-- End Blog login Well -->

    



    <!-- Blog Categories Well -->
    <div class="well">

        <h4> <?php echo SIDEBAR_CATEGORIES_BOX; ?> </h4>

        <div class="row">
            <div class="col-lg-6" style="float:left">

                <ul class="list-unstyled">
                    <?php sidebar_category_menus(0); ?>
                </ul>

            </div> <!-- /.col-lg-6 -->

            <div class="col-lg-6" style="float:right">

                <ul class="list-unstyled">
                    <?php sidebar_category_menus(1); ?>
                </ul>

            </div> <!-- /.col-lg-6 -->
        </div> <!-- /.row -->

    </div>
    <!-- End Blog Categories Well -->




    <!-- Side Widget Well -->
    <div class="well">
        <h4> <?php echo SIDEBAR_WIDGET_BOX; ?> </h4>
        <p> <?php echo SIDEBAR_USERS_ONLINE; ?> <span class="users-site-online"> </span> </p>
    </div>

</div>
