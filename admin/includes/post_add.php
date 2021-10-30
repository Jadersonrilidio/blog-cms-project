
<?php $MSG_STATUS = create_post(); ?>

<form action="./index.php?page=posts&source=add_post" method="POST" enctype="multipart/form-data">

    <h3> Add post </h3>

    <?php if (!empty($MSG_STATUS)) echo "<br> <p class='my-status-msg-box-fixed'> <i>" . $MSG_STATUS . "</i>"
        . " &emsp; - &emsp; <a href='../index.php?page=post&post_id=" . get_last_created_post_id() . "'> View post </a>"
        . " &emsp; - &emsp; <a href='index.php?page=posts&source=default'> View all posts </a>"
        . " &emsp; - &emsp; <a href='index.php?page=posts&source=add_post'> Add more posts </a> </p> <br>"; ?>

    <div class="form-group">
        <label for="post_title"> Post Title </label>
        <input class="form-control" type="text" name="post_title" placeholder="Type the post title here..."
            value="<?php if (!empty($_POST['post_title'])) echo $_POST['post_title']; ?>">
    </div>

    <div class="form-group"> 
        <label for="post_author"> Author </label>
        <select class="form-control" name="post_author">
            <option value=''> </option>
            <?php if (!empty($_POST['post_author'])) $post_author = $_POST['post_author']; ?>
            <?php user_admin_selector_menu($post_author); ?>
        </select>
    </div>

    <div class="form-group"> 
        <label for="post_category_id"> Category </label>
        <select class="form-control" name="post_category_id">
            <option value=''> </option>
            <?php if (!empty($_POST['post_category_id'])) $post_category_id = $_POST['post_category_id']; ?>
            <?php category_selector_menu($post_category_id); ?>
        </select>
    </div>

    <div class="form-group"> 
        <label for="post_status_id"> Status </label>
        <select class="form-control" name="post_status_id">
            <option value=''></option>
            <?php if (!empty($_POST['post_status_id'])) $post_status_id = $_POST['post_status_id']; ?>
            <?php post_status_selector_menu($post_status_id); ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_tags"> Tags </label>
        <input class="form-control" type="text" name="post_tags" placeholder="Insert tags here..."
            value="<?php if (!empty($_POST['post_tags'])) echo $_POST['post_tags']; ?>">
    </div>

    <div class="form-group">
        <label for="post_image"> Image </label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_content"> Content </label>
        <textarea class="form-control" id="summernote" name="post_content" cols="30" rows="10" placeholder="Write the post content here..."
            ><?php if (!empty($_POST['post_content'])) echo $_POST['post_content']; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Create post"> 
    </div>

</form>
