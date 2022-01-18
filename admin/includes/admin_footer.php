
    <!-- jQuery -->
    <script src="<?php echo Config::ADMIN_REL_PATH; ?>js/jquery.js"></script>

    <!-- my script for initialize summernote -->
    <script src="<?php echo Config::ADMIN_REL_PATH; ?>js/scripts.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Config::ADMIN_REL_PATH; ?>js/bootstrap.min.js"></script>

    <!-- include summernote js -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script> -->
    <script src="<?php echo Config::ADMIN_REL_PATH; ?>js/summernote.min.js"></script>

    <!-- Toastr pretty message boxes js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="<?php echo Config::REL_PATH; ?>js/toastr.script.js"></script>
    <script> adminNotificationsCall(<?php echo $_SESSION['lang']; ?>); </script>

</body>

</html>