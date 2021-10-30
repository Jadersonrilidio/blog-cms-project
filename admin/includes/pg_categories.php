<?php include './includes/modal_delete_category.php'; ?>

<!-- Page Heading -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <?php $STATUS_MSG1 = add_category(); ?>
                <?php $STATUS_MSG2 = update_category(); ?>
                <?php $STATUS_MSG3 = delete_category(); ?>
                <?php if (isset($_GET['msg']))$STATUS_MSG3 = $_GET['msg']; ?>

                <h1 class="page-header"> Categories <small> <?php display_admin_user_name(); ?> </small> </h1>
                
                <div class="weel">

                    <form action="./index.php?page=categories" method="POST">
                        <div class="form-group">
                            <label for="cat_title"> Add category </label>
                            <input class="form-control" type="text" name="cat_title" placeholder="Type the new category name here...">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="cat_add" value="Add category"> 
                        </div>

                        <?php echo "<p class='my-status-msg-box'> <i>" . $STATUS_MSG1 . $STATUS_MSG2 . $STATUS_MSG3 . "</i> </p>"; ?>
                    </form>

                    <?php if (isset($_GET['cat_update'])) get_category_to_edit($_GET['cat_update']); ?>

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
                            <?php display_categories('table'); ?>
                        </tbody>
                    </table>

                </div>

                <ol class="breadcrumb">
                    <li> <i class="fa fa-dashboard"> </i>  <a href="index.php"> Dashboard </a> </li>   
                    <li class="active"> <i class="fa fa-file"> </i> Blank Page </li>
                </ol>

            </div>
        </div>
    </div>
</div>
<!-- End Page Heading -->