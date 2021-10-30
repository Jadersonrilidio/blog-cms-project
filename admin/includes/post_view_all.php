<?php include './includes/modal_delete_post.php'; ?>

<?php $MSG_STATUS = catch_post_id_array(); ?>
<?php if (isset($_GET['msg'])) $MSG_STATUS = $_GET['msg']; ?>

<h3> <?php echo ((isset($_GET['user_id'])) ? select_user_name_by_id($_GET['user_id'])."'s posts" : 'View all posts'); ?> </h3>

<?php if (!empty($MSG_STATUS)) echo "<br> <p class='my-status-msg-box'> <i>" . $MSG_STATUS . "</i> </p> <br>"; ?>

<form action="./index.php?page=posts&source=default<?php if (isset($_GET['user_id'])) echo "&user_id={$_GET['user_id']}"; ?>" method="POST">

    <div id="bulkOptionsContainer" class="col-xs-4">
        <select class="form-control" name="bulk_options">
            <option value="null"> Select Options </option>
            <option value="1"> Published </option>
            <option value="2"> Draft </option>
            <option value="clone"> Clone </option>
            <option value="delete"> Delete </option>
        </select>
    </div>

    <div>
         <input class="btn btn-success" name="submit" type="submit" value="Apply">
        <a class="btn btn-primary" href="index.php?page=posts&source=add_post"> Add new post </a>
    </div>

    <br>

    <table class="table table-bordered table-hover" style="text-align:center">

        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th style="text-align:center"> Id </th>
                <th style="text-align:center"> Author </th>
                <th style="text-align:center"> Title </th>
                <th style="text-align:center"> Category </th>
                <th style="text-align:center"> Status </th>
                <th style="text-align:center"> Image </th>
                <th style="text-align:center"> Tags </th>
                <th style="text-align:center"> Content </th>
                <th style="text-align:center"> Comments </th>
                <th style="text-align:center"> Date </th>
                <th style="text-align:center"> Delete </th>
                <th style="text-align:center"> Edit </th>
            </tr>
        </thead>

        <tbody>
            <?php display_posts_on_table(); ?>
        </tbody>

    </table>

</form>