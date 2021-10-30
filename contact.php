
<!-- Header Settings -->
<?php include './includes/header.php'; ?>

<!-- Navigation Menu -->
<?php include './includes/navbar.php'; ?>

<!-- Page Content -->
<div class="container">
    
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">

                        <?php is_logged(); ?>

                        <?php $MSG_STATUS = send_email(); ?>

                        <h1 class="text-center"> Contact </h1>

                        <?php echo "<p class='my-status-msg-box'> <i>" . $MSG_STATUS . "</i> </p>"; ?>

                        <form role="form" action="contact.php" method="POST" id="login-form" autocomplete="off">

                            <div class="form-group">
                                <label for="email" class="sr-only"> Email </label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email: &ensp; somebody@example.com"
                                    value="<?php if(is_logged()) echo $_SESSION['user_email']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="subject" class="sr-only"> Subject </label>
                                <input type="text" name="subject" class="form-control" placeholder="Enter your subject">
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" id="body" name="message" rows="7"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send Email">

                        </form>
                    
                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>

<hr>

<?php include "includes/footer.php";?>

<script> addClassContact(); </script>