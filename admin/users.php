<?php include 'includes/admin_header.php'; ?>

<!-- Navigation -->
<?php include 'includes/admin_navigationbar.php'; ?>

<!-- Page Function Set -->
<?php include 'functions/f_users.php'; ?>

<!-- PHP functions -->
<?php catch_user_id_array(); ?>
<?php update_role(); ?>

    <div id="wrapper">

        <!-- Page Heading -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12"> 

                        <h1 class="page-header"> <?php echo_user_page_head(); ?> <small> &ensp; Admin <?php echo_admin_username(); ?> </small> </h1>

                        <div class="col-xs-12">

                            <form action="<?php echo_form_action_link(); ?>" method="POST">

                                <div id="bulkOptionsContainer" class="col-xs-4">
                                    <select class="form-control" name="bulk_options">
                                        <option value="null"> Select Options </option>
                                        <option value="1"> Admin </option>
                                        <option value="2"> Subscriber </option>
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
                                            <th style="text-align:center"> Username </th>
                                            <th style="text-align:center"> Email </th>
                                            <th style="text-align:center"> Image </th>
                                            <th style="text-align:center"> Language </th>
                                            <th style="text-align:center"> Posts </th>
                                            <th style="text-align:center"> Comments </th>
                                            <th style="text-align:center"> Role </th>
                                            <th style="text-align:center"> Change Role </th>
                                            <th style="text-align:center"> Change Role </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php display_all_users_on_table(); ?>
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
