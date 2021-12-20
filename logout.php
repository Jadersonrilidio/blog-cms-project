<?php ob_start()?>
<?php session_start(); ?>

<!-- Load Composer's autoloader -->
<?php require 'vendor/autoload.php'; ?>

<?php

MySessionHandler::session_logout();
Permissions::redirect('index');

?>