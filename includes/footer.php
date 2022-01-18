
    <footer>
        
        <div class="row">
            
            <div class="col-lg-12 text-center">
                <p> <?php echo FOOTER_TEXT; ?> </p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </footer>

</div>

    <!-- jQuery -->
    <script src="<?php echo Config::REL_PATH; ?>js/jquery.js"></script>
    
    <!-- My language variables -->
    <script src="<?php echo Config::REL_PATH; ?>js/languages.js"></script>
    
    <!-- My scripts -->
    <script src="<?php echo Config::REL_PATH; ?>js/scripts.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Config::REL_PATH; ?>js/bootstrap.min.js"></script>

    <!-- Toastr pretty message boxes js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="<?php echo Config::REL_PATH; ?>js/toastr.script.js"></script>
    <script> mainNotificationsCall(<?php echo $_SESSION['lang']; ?>); </script>

</body>

</html>
