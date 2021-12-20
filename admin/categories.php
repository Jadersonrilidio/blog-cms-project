
<!-- Header -->
<?php include 'includes/admin_header.php'; ?>

<!-- Navigation -->
<?php include 'includes/admin_navigationbar.php'; ?>

<!-- Page Function Set -->
<?php include 'functions/f_categories.php'; ?>
<?php include 'includes/modals/modal_delete_category.php'; ?>

<!-- PHP Functions -->
<?php add_category(); ?>
<?php update_category(); ?>
<?php delete_category(); ?>

    <div id="wrapper">

        <!-- Page Heading -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header"> Categories <small> &ensp; Admin <?php echo_admin_username(); ?> </small> </h1>
                        
                        <div class="weel">

                            <form action="<?php echo Config::ADMIN_REL_PATH; ?>categories" method="POST">

                                <div class="form-group">
                                    <label for="cat_title"> Add category <?php FormErrorMsg::category_has_title_to_add(); ?> </label>
                                    <input class="form-control" type="text" name="cat_title" placeholder="Insert category name">
                                </div>

                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="add" value="Add category"> 
                                </div>
                            </form>

                            <?php display_category_to_update(); ?>

                        </div>

                        <div class="col-xs-12">
                            
                            <table class="table" style="text-align:center">

                                <thead>
                                    <tr>
                                        <th style="text-align:center"> Id </th>
                                        <th style="text-align:center"> Category Title </th>
                                        <th style="text-align:center"> Delete Category </th>
                                        <th style="text-align:center"> Edit Category </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php display_categories_on_table(); ?>
                                </tbody>

                            </table>

                        </div>

                        <ol class="breadcrumb">
                            <li> <i class="fa fa-dashboard"> </i>  <a href="index"> Dashboard </a> </li>   
                            <li class="active"> <i class="fa fa-file"> </i> Blank Page </li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Heading -->

    </div>

<!-- Footer -->
<?php include 'includes/admin_footer.php'; ?>
