
<?php $MSG_STATUS = edit_user(); ?>
<?php $user = get_user_by_id(); ?>

<form action="./index.php?page=users&source=user_edit&user_id=<?php echo $_GET['user_id']; ?>" method="POST" enctype="multipart/form-data">

    <h3> Edit user </h3>

    <?php if (!empty($MSG_STATUS)) echo "<p class='my-status-msg-box'> <i>" . $MSG_STATUS . "</i>"
        . " &emsp; <a href='index.php?page=users&source=view_all'> View all users </a>"
        . " &emsp; <a href='index.php?page=users&source=user_add'> Add more users </a> </p> <br>"; ?>

    <div class="form-group">
        <label for="user_name"> Username </label>
        <input class="form-control" type="text" name="user_name" placeholder="Type username..."
            value="<?php if (!empty($user['user_name'])) echo $user['user_name']; ?>">
    </div>

    <div class="form-group">
        <label for="user_firstname"> First name </label>
        <input class="form-control" type="text" name="user_firstname" placeholder="Type first name..."
            value="<?php if (!empty($user['user_firstname'])) echo $user['user_firstname']; ?>">
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

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="user_edit" value="Update user"> 
    </div>

</form>
