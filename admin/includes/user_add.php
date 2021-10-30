
<?php $MSG_STATUS = add_user(); ?>

<form action="./index.php?page=users&source=user_add" method="POST" enctype="multipart/form-data">

    <h3> Add user </h3>

    <?php if (!empty($MSG_STATUS)) echo "<p class='my-status-msg-box'> <i>" . $MSG_STATUS . "</i>"
        . " &emsp; or <a href='index.php?page=users&source=view_all'> View all users </a>"
        . " &emsp; or <a href='index.php?page=users&source=user_add'> Add more users </a> </p> <br>"; ?>

    <div class="form-group">
        <label for="user_name"> Username </label>
        <input class="form-control" type="text" name="user_name" placeholder="Type username..."
            value="<?php if (!empty($_POST['user_name'])) echo $_POST['user_name']; ?>">
    </div>

    <div class="form-group">
        <label for="user_firstname"> First name </label>
        <input class="form-control" type="text" name="user_firstname" placeholder="Type first name..."
            value="<?php if (!empty($_POST['user_firstname'])) echo $_POST['user_firstname']; ?>">
    </div>

    <div class="form-group">
        <label for="user_lastname"> Last name </label>
        <input class="form-control" type="text" name="user_lastname" placeholder="Type last name..."
            value="<?php if (!empty($_POST['user_lastname'])) echo $_POST['user_lastname']; ?>">
    </div>

    <div class="form-group">
        <label for="user_email"> Email </label>
        <input class="form-control" type="email" name="user_email" placeholder="Type email..."
            value="<?php if (!empty($_POST['user_email'])) echo $_POST['user_email']; ?>">
    </div>

    <div class="form-group"> 
        <label for="user_role_id"> Role </label>
        <select class="form-control" name="user_role_id">
            <option value=''></option>
            <?php if (!empty($_POST['user_role_id'])) $user_role_id = $_POST['user_role_id']; ?>
            <?php user_role_selector_menu($user_role_id); ?>
        </select>
    </div>

    <div class="form-group">
        <label for="user_password"> Password </label>
        <input class="form-control" type="password" name="user_password" placeholder="Type password..."
            value="<?php if (!empty($_POST['user_password'])) echo $_POST['user_password']; ?>">
    </div>

    <div class="form-group">
        <label for="user_image"> Image </label>
        <input type="file" name="user_image">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="user_add" value="Add user"> 
    </div>

</form>
