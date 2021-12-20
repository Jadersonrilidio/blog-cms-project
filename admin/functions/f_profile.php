<?php

if (!isset($_SESSION['user_id'])) header('Location: index.php');

function edit_user () {
    if (!isset($_POST['user_edit'])) return "";

    if (empty($_POST['user_name'])) return "Must insert username...";
    if (empty($_POST['user_firstname'])) return "Must insert first name...";
    if (empty($_POST['user_lastname'])) return "Must insert last name...";
    if (empty($_POST['user_email'])) return "Must insert email...";
    if (empty($_POST['user_role_id'])) return "Must insert role...";

    $user_id = $_GET['user_id'];
    $user_name = $_POST['user_name'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role_id = $_POST['user_role_id'];

    $user_image = $_FILES['user_image']['name'];
    if (empty($user_image)) $user_image = get_user_image_by_id($user_id);
    $user_image_temp = $_FILES['user_image']['tmp_name'];

    $query = "UPDATE users SET ";
    $query .= "user_name = '$user_name', ";
    $query .= "user_firstname = '$user_firstname', ";
    $query .= "user_lastname = '$user_lastname', ";
    $query .= "user_email = '$user_email', ";
    $query .= "user_image = '$user_image', ";
    $query .= "user_role_id = '$user_role_id' ";
    $query .= "WHERE user_id = $user_id ";

    QueryHandler::query_handler($query, 'result');

    move_uploaded_file($user_image_temp, "../images/$user_image");

    return "User successfully updated!";
}

function get_user_image_by_id ($user_id) { 
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = QueryHandler::query_handler($query, 'result');

    $register = mysqli_fetch_assoc($result);

    return $register['user_image'];
}

function get_session_admin_variables () {
    if ($_SESSION['user_id'] !== null && isset($_POST['user_edit'])) {
        $_SESSION['user_name'] = $_POST['user_name'];
        $_SESSION['user_firstname'] = $_POST['user_firstname'];
        $_SESSION['user_lastname'] = $_POST['user_lastname'];
        $_SESSION['user_role_id'] = $_POST['user_role_id'];
        $_SESSION['user_email'] = $_POST['user_email'];
    } 
}

function get_user_by_session_id () { 
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = QueryHandler::query_handler($query, 'result');

    $register = mysqli_fetch_assoc($result);

    return $register;
}

?>