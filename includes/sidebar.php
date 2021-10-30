
 <div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">

        <h4> Blog Search </h4>

        <form action="index.php?page=search" method="GET">

            <div class="input-group">
                <input type="text" class="form-control" name="pattern" placeholder="Enter your search pattern here...">
                
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="page" value="search">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>

        </form>

    </div>
    <!-- End Blog Search Well -->


    <!-- Blog login Well -->
    <?php if (isset($_SESSION['user_id'])): ?>

        <div class="well">
            <div class="input-group">
                <label> Welcome back, <?php echo $_SESSION['user_name']."!"; ?> &ensp; </label>
                <a class="btn btn-primary" href='./index.php?page=logout'> Logout </a>
                <a class="btn btn-primary"  href='#'> Profile </a>
            </div>
        </div>

    <?php else: ?> 

        <div class="well">

            <h4> Log in <small> <p class="my-status-msg-box"> <i> <?php echo $LOGIN_STATUS; ?> </i> </p> </small> </h4>

            <form action="./index.php" method="POST">

                <div class="form-group">
                    <input type="text" class="form-control" name="user_name" placeholder="Enter username">
                </div>

                <div class="input-group">
                    <input type="password" class="form-control" name="user_password" placeholder="Enter password">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary" name="user_login"> Login </button>
                    </span>
                </div>

                <a class="col-lg-12 text-left" href="forgot_password?forgot=<?php echo uniqid(true); ?>" style="margin-top:5px">
                    <small> Forgot your password? </small>
                </a> <br>

            </form>

        </div>

    <?php endif; ?>
    <!-- End Blog login Well -->


    <!-- Blog Categories Well -->
    <div class="well">

        <h4>Blog Categories</h4>

        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">

                    <?php cat_links(); ?>
                    
                </ul>
            </div> <!-- /.col-lg-6 -->
        </div> <!-- /.row -->

    </div>
    <!-- End Blog Categories Well -->

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>
