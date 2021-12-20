
<!-- includes -->
<?php include 'functions/f_login.php'; ?>

<?php Login::login_user(); ?>

<!--
    ISSUES:
    how to properly make the form to englobe all the buttons the way the are?
    what to insert in form action link?
    how the form button could activate the modal closing only in case of successful login?
    do we need to include login functions file here? where?
    
    
    
    NO WE DON'T -> do we need to include vendor/autoload?
-->

<!-- Modal -->
<div class="modal fade" id="loginModal">
    <div class="modal-dialog">
        
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title text-center"> Login </h2>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-wrap">

                    <form role="form" action="<?php echo Config::REL_PATH."post"; ?>" method="POST" id="login-form" autocomplete="off">
                        
                        <div class="form-group">
                            <label for="user_name" class="sr-only"> Username </label>
                            <input type="text" name="user_name" id="username" class="form-control" placeholder="Enter username" autocomplete="on">
                        </div>

                        <div class="form-group">
                            <label for="user_password" class="sr-only"> Password </label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Enter Password">
                        </div>
                        
                         <!-- Modal footer -->
                        <div class="modal-footer">
                            <a href="" class="btn" data-dismiss="modal" data-toggle='modal' data-target='#registerModal' style="float:left" > I'm not a user! - Register &emsp;&emsp; </a> 
                            <button type="submit" class="btn btn-primary" id="btn-register" name="user_register"> Login </button>
                            <button type="button" class="btn" data-dismiss="modal"> Cancel </button>
                        </div>

                    </form>

                </div>
            </div>
            <!-- Modal body Ends -->

        </div>

    </div>
</div>
<!-- End Modal -->