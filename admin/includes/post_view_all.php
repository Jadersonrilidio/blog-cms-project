<?php catch_post_id_array(); ?>
<?php delete_post(); ?>


<form action="<?php echo post_view_all_form_action_link(); ?>" method="POST">

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
        <a class="btn btn-primary" href="<?php echo Config::ADMIN_REL_PATH; ?>posts/add"> Add new post </a>
    </div>

    <br>

    <table class="table table-bordered table-hover text-center">

        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th class="text-center"> Id </th>
                <th class="text-center"> Author </th>
                <th class="text-center"> Title </th>
                <th class="text-center"> Category </th>
                <th class="text-center"> Status </th>
                <th class="text-center"> Image </th>
                <th class="text-center"> Tags </th>
                <th class="text-center"> Content </th>
                <th class="text-center"> Comments </th>
                <th class="text-center"> Date </th>
                <th class="text-center"> Delete </th>
                <th class="text-center"> Edit </th>
            </tr>
        </thead>

        <tbody>
            <?php display_posts_on_table(); ?>
        </tbody>

    </table>

</form>