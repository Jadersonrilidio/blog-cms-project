<?php include './includes/modal_delete_comment.php'; ?>

<!-- Page Heading -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12"> 

                <h1 class="page-header"> Comments <small> &ensp; Admin <?php display_admin_user_name(); ?> </small> </h1>

                <div class="col-xs-12">

                    <?php if (isset($_GET['post_id'])) echo "<h3> Comments of post <small>'" . select_post_title_by_id($_GET['post_id']) . "'</small> </h3>"; ?>
                    
                    <?php $MSG_STATUS = comments_switch(); ?>
                    <?php $MSG_STATUS = catch_comment_id_array(); ?>
                    <?php if (isset($_GET['msg'])) $MSG_STATUS = $_GET['msg']; ?>
                    <?php if (!empty($MSG_STATUS)) echo "<p class='my-status-msg-box'> <i>" . $MSG_STATUS . "</i> </p> <br>"; ?>

                    <form action="./index.php?page=comments<?php if (isset($_GET['post_id'])) echo "&post_id={$_GET['post_id']}"; ?>" method="POST">

                        <div id="bulkOptionsContainer" class="col-xs-4">
                            <select class="form-control" name="bulk_options">
                                <option value="null"> Select Options </option>
                                <option value="1"> Approve </option>
                                <option value="2"> Unapprove </option>
                                <option value="delete"> Delete </option>
                            </select>
                        </div>

                        <div>
                            <input class="btn btn-success" name="submit" type="submit" value="Apply">
                        </div>

                        <br>

                        <table class="table table-bordered table-hover" style="text-align:center">

                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAllBoxes"></th>
                                    <th style="text-align:center"> Id </th>
                                    <th style="text-align:center"> Post </th>
                                    <th style="text-align:center"> Author </th>
                                    <th style="text-align:center"> Email </th>
                                    <th style="text-align:center"> Content </th>
                                    <th style="text-align:center"> Status </th>
                                    <th style="text-align:center"> Date </th>
                                    <th style="text-align:center"> Aprove </th>
                                    <th style="text-align:center"> Unapprove </th>
                                    <th style="text-align:center"> Delete </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php display_all_comments_on_table(); ?>
                            </tbody>

                        </table>

                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Page Heading -->
