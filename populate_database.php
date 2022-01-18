<?php include 'includes/header.php'; ?>

<style>body{background-color:rgb(70, 70, 70);color:whitesmoke}</style>

<!-- PHP page function set -->
<?php include 'functions/f_populate_database.php'; ?>

<!-- Navigation Menu -->
<?php include 'includes/navigationbar.php'; ?>

<!-- PHP function call -->
<?php populate_database(); ?>
<?php truncate_all_tables(); ?>

<!-- Page Content -->
<div class="container">
    
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    
                    <?php RedLink::github_populate_database_link(); ?>
                    <?php RedLink::github_mysql_database_link(); ?>
                    
                    <div class="form-wrap">

                        <h1 class="text-center"> Populate DataBase </h1>

                        <form role="form" action="<?php echo Config::REL_PATH.'populate_database'; ?>" method="POST" autocomplete="off">
                            <?php InputErrorMsg::cat_empty(); ?>
                            <?php InputErrorMsg::cat_not_numeric(); ?>
                            <?php InputErrorMsg::cat_out_of_range(); ?>
                            <div class="form-group">
                                <input class="form-control" type="text" name="category" placeholder="Type the number of categories (between 1 - 10)">
                            </div>

                            <?php InputErrorMsg::user_empty(); ?>
                            <?php InputErrorMsg::user_not_numeric(); ?>
                            <?php InputErrorMsg::user_out_of_range(); ?>
                            <div class="form-group">
                                <input class="form-control" type="text" name="user" placeholder="Type the number of users (between 1 - 50)">
                            </div>

                            <?php InputErrorMsg::post_empty(); ?>
                            <?php InputErrorMsg::post_not_numeric(); ?>
                            <?php InputErrorMsg::post_out_of_range(); ?>
                            <div class="form-group">
                                <input class="form-control" type="text" name="post" placeholder="Type the number of posts (between 1 - 70)">
                            </div>

                            <?php InputErrorMsg::comment_empty(); ?>
                            <?php InputErrorMsg::comment_not_numeric(); ?>
                            <?php InputErrorMsg::comment_out_of_range(); ?>
                            <div class="form-group">
                                <input class="form-control" type="text" name="comment" placeholder="Type the number of comments (between 1 - 500)">
                            </div>    
                                
                            <input class="btn btn-primary btn-block" type="submit" name="populate" value="Populate DataBase" title="Populates the DataBase with random categories, posts, users and comments">
                            <input class="btn btn-warning btn-block" type="submit" name="truncate" value="Reset Database to Default" title="Reset the database to default values">
                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

<hr>

<?php include "includes/footer.php";?>