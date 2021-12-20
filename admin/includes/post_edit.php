<?php $post = select_post_attr_to_edit(); ?>
<?php update_post(); ?>


<form action="<?php echo_post_edit_form_action(); ?>" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
    <input type="hidden" name="post_date_time" value="<?php echo $post['post_date_time']; ?>">

    <div class="form-group">
        <label for="post_title"> Post Title <?php FormErrorMsg::post_has_title(); ?> </label>
        <input class="form-control" type="text" name="post_title" placeholder="Insert title"
            value="<?php echo $post['post_title']; ?>">
    </div>

    <div class="form-group"> 
        <label for="post_author"> Author <?php FormErrorMsg::post_has_author(); ?> </label>
        <select class="form-control" name="post_author">
            <option value=''> </option>
            <?php user_admin_options_menu($post['post_author']); ?>
        </select>
    </div>


    <div class="form-group">
        <label for="post_category_id"> Category <?php FormErrorMsg::post_has_category(); ?> </label>
        <select class="form-control" name="post_category_id">
            <option value=''></option>
            <?php category_options_menu($post['post_category_id']); ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_status_id"> Status <?php FormErrorMsg::post_has_status(); ?> </label>
        <select class="form-control" name="post_status_id">
            <option value=''></option>
            <?php post_status_options_menu($post['post_status_id']); ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_tags"> Tags </label>
        <input class="form-control" type="text" name="post_tags" placeholder="Insert tags"
            value="<?php echo $post['post_tags']; ?>">
    </div>

    <div class="form-group">
        <label for="post_image"> Image </label>
        <img src="<?php echo Config::REL_PATH."images/{$post['post_image']}"; ?>" width="100" >
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_content"> Content <?php FormErrorMsg::post_has_content(); ?> </label>
        <textarea class="form-control" id="summernote" name="post_content" cols="30" rows="10"
            ><?php echo $post['post_content']; ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Update post"> 
    </div>

</form>
