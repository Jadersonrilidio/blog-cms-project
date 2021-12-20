<?php create_post(); ?>


<form action="<?php echo Config::ADMIN_REL_PATH."posts/add"; ?>" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title"> Post Title <?php FormErrorMsg::post_has_title(); ?> </label>
        <input class="form-control" type="text" name="post_title" placeholder="Insert post title"
            value="<?php echo_post_title() ?>">
    </div>
    
    <div class="form-group"> 
        <label for="post_author"> Author <?php FormErrorMsg::post_has_author(); ?> </label>
        <select class="form-control" name="post_author">
            <option value=''> </option>
            <?php user_admin_options_menu(); ?>
        </select>
    </div>

    <div class="form-group"> 
        <label for="post_category_id"> Category <?php FormErrorMsg::post_has_category(); ?> </label>
        <select class="form-control" name="post_category_id">
            <option value=''> </option>
            <?php category_options_menu(); ?>
        </select>
    </div>

    <div class="form-group"> 
        <label for="post_status_id"> Status <?php FormErrorMsg::post_has_status(); ?> </label>
        <select class="form-control" name="post_status_id">
            <option value=''></option>
            <?php post_status_options_menu(); ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_tags"> Tags </label>
        <input class="form-control" type="text" name="post_tags" placeholder="Insert tags"
            value="<?php echo_post_tags(); ?>">
    </div>

    <div class="form-group">
        <label for="post_image"> Image <?php FormErrorMsg::post_has_image(); ?> </label>
        <input type="file" name="post_image">
    </div>

    <div class="form-group">
        <label for="post_content"> Content <?php FormErrorMsg::post_has_content(); ?> </label>
        <textarea class="form-control" id="summernote" name="post_content" cols="30" rows="10"
            ><?php echo_post_content(); ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Create post"> 
    </div>

</form>
