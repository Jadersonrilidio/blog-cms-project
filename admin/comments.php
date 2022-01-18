<?php include 'includes/admin_header.php'; ?>

<!-- Navigation -->
<?php include 'includes/admin_navigationbar.php'; ?>

<!-- Page Function Set -->
<?php include 'functions/f_comments.php'; ?>
<?php include 'includes/modals/modal_delete_comment.php'; ?>

<!-- PHP Functions -->
<?php catch_comment_id_array(); ?>
<?php comment_approve_unapprove_delete(); ?>

    <div id="wrapper">

        <!-- Page Heading -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12"> 

                        <h1 class="page-header"> <?php echo_page_header(); ?> <small> &ensp; Admin <?php echo_admin_username(); ?> </small> </h1>


                        <div class="col-xs-12">

                            <form action="<?php echo_form_action_link(); ?>" method="POST">

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

                                <table class="table table-bordered table-hover text-center">

                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="selectAllBoxes"></th>
                                            <th class="text-center"> Id </th>
                                            <th class="text-center"> Post </th>
                                            <th class="text-center"> Author </th>
                                            <th class="text-center"> Content </th>
                                            <th class="text-center"> Status </th>
                                            <th class="text-center"> Date </th>
                                            <th class="text-center"> Aprove </th>
                                            <th class="text-center"> Unapprove </th>
                                            <th class="text-center"> Delete </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php display_comments_on_table(); ?>
                                    </tbody>

                                </table>

                            </form>

                        </div>
                        
                        <br>
                        <ol class="breadcrumb">
                            <li> <i class="fa fa-dashboard"> </i>  <a href="index"> Dashboard </a> </li>   
                        </ol>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Heading -->

    </div>

<!-- Footer -->
<?php include 'includes/admin_footer.php'; ?>
