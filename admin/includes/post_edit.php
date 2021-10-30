
<?php $MSG_STATUS = update_post(); ?>
<?php $post = select_post_to_edit(); ?>

<form action="./index.php?page=posts&source=edit_post&post_id=<?php echo $post['post_id']; ?>"
    method="POST" enctype="multipart/form-data">

    <h3> Edit post - Id <?php echo $post['post_id']; ?></h3>
    <?php if (!empty($MSG_STATUS)) echo "<br> <p class='my-status-msg-box-fixed'> <i>" . $MSG_STATUS . "</i>"
        . " &emsp; - &emsp; <a href='../index.php?page=post&post_id=" . $post['post_id'] . "'> View post </a>"
        . " &emsp; - &emsp; <a href='index.php?page=posts&source=default'> View all posts </a>"
        . " &emsp; - &emsp; <a href='index.php?page=posts&source=add_post'> Add more posts </a> </p> <br>"; ?>

    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
    <input type="hidden" name="post_date_time" value="<?php echo $post['post_date_time']; ?>">
    <!-- <input type="hidden" name="post_comment_count" value="<?php #echo $post['post_comment_count']; ?>"> -->

    <div class="form-group">
        <label for="post_title"> Post Title </label>
        <input class="form-control" type="text" name="post_title" placeholder="Type the post title here..."
            value="<?php echo $post['post_title']; ?>">
    </div>

    <div class="form-group"> 
        <label for="post_author"> Author </label>
        <select class="form-control" name="post_author">
            <option value=''> </option>
            <?php if (!empty($post['post_author'])) $post_author = $post['post_author']; ?>
            <?php user_admin_selector_menu($post_author); ?>
        </select>
    </div>


    <div class="form-group">
        <label for="post_category_id"> Category </label>
        <select class="form-control" name="post_category_id">
            <?php category_selector_menu($post['post_category_id']); ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_status_id"> Status </label>
        <select class="form-control" name="post_status_id">
            <option value=''></option>
            <?php post_status_selector_menu($post['post_status_id']); ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_tags"> Tags </label>
        <input class="form-control" type="text" name="post_tags" placeholder="Insert the post tags here..."
            value="<?php echo $post['post_tags']; ?>">
    </div>

    <div class="form-group">
        <label for="post_image"> Image </label>
        <img src="../images/<?php echo $post['post_image']; ?>" width="100" >
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_content"> Content </label>
        <textarea class="form-control" id="summernote" name="post_content" cols="30" rows="10" placeholder="Write the post content here..."
            ><?php echo $post['post_content']; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_post" value="Update post"> 
    </div>

</form>