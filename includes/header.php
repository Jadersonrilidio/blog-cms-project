<?php ob_start(); ?>
<?php session_start(); ?>

<!-- Load Composer's autoloader -->
<?php require 'vendor/autoload.php'; ?>

<!-- language setter & obj instance: -->
<?php LanguageHandler::load_session_language(); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> <?php echo HEAD_TITLE; ?> </title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Config::REL_PATH; ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo Config::REL_PATH; ?>css/blog-home.css" rel="stylesheet">

    <!-- MY CSS STYLES -->
    <link href="<?php echo Config::REL_PATH; ?>css/my-styles.css" rel="stylesheet">

    <!-- Toastr pretty message boxes css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <link href="<?php echo Config::REL_PATH; ?>css/toastr.style.css" rel="stylesheet">

    <!-- Fonts Awesome CSS -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom Fonts -->
    <link href="<?php echo Config::ADMIN_REL_PATH; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- toast notification boxes listener -->
<?php Notifications::toastr_notifications_call(); ?>
