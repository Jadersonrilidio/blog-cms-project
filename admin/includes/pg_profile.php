
<!-- Page Heading -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12"> 
                
                <?php if (!isset($_SESSION['user_id'])) header('Location: index.php'); ?>
                
                <?php $MSG_STATUS = edit_user(); ?>
                <?php get_session_admin_variables(); ?> #FIXME - test if it's working properly 
                <?php $user = get_user_by_session_id(); ?>

                <h1 class="page-header"> Profile <small> &ensp; Admin <?php display_admin_user_name(); ?> </small> </h1>

                <div class="col-xs-12">

                    <form action="./index.php?page=profile&user_id=<?php echo $_SESSION['user_id']; ?>" method="POST" enctype="multipart/form-data">

                        <?php if (!empty($MSG_STATUS)) echo "<p class='my-status-msg-box'> <i>" . $MSG_STATUS . "</i> </p> <br>"; ?>

                        <div class="form-group">
                            <label for="user_name"> Username </label>
                            <input class="form-control" type="text" name="user_name" placeholder="Type username..."
                                value="<?php echo $user['user_name']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_firstname"> First name </label>
                            <input class="form-control" type="text" name="user_firstname" placeholder="Type first name..."
                                value="<?php echo $user['user_firstname']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_lastname"> Last name </label>
                            <input class="form-control" type="text" name="user_lastname" placeholder="Type last name..."
                                value="<?php echo $user['user_lastname']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_email"> Email </label>
                            <input class="form-control" type="email" name="user_email" placeholder="Type email..."
                                value="<?php echo $user['user_email']; ?>">
                        </div>

                        <div class="form-group"> 
                            <label for="user_role_id"> Role </label>
                            <select class="form-control" name="user_role_id">
                                <option value=''></option>
                                <?php if (!empty($user['user_role_id'])) $user_role_id = $user['user_role_id']; ?>
                                <?php user_role_selector_menu($user_role_id); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="user_image"> Image </label>
                            <img src="../images/<?php echo $user['user_image']; ?>" width="100">
                            <input type="file" name="user_image">
                        </div>

                        <!-- <div class="well"> FIXME - create a separate box to change the password 
                            <label for="user_new_password"> Create New Password </label>
                            <input class="form-control" type="password" name="user_new_password" placeholder="Insert new password here... ">
                            <br>
                            <input class="form-control" type="password" name="user_prev_password" placeholder="Insert correct previous password...">
                            <br>
                            <input class="btn btn-primary" type="submit" name="password_edit" value="Change password"> 
                        </div> -->

                        <br>

                        <div class="form-group">

                            <div class="input-group">
                                <input class="btn btn-primary" type="submit" name="user_edit" value="Update user"> 
                                <!-- <input class="btn btn-primary" type="submit" name="password_edit" value="Change Password">  -->
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Page Heading -->
