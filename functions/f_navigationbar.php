
<?php

$cat_id = (isset($_GET['cat_id'])) ? InputHandler::escape($_GET['cat_id']) : NULL;

function dropdown_title () {
    return (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : NAV_DROPDOWN;
}

function navbar_greeting_logged_user () {
    if (isset($_SESSION['user_name'])) {
        ?>
        <li class='nav nav-item'> <a class='nav nav-link'> <strong> <?php Permissions::greeting_logged_user(); ?> </strong> </a> </li>;
        <?php
    }
}

function navbar_category_menus () {
    global $cat_id;
    
    $stmt = Category::select_all('statement');
    mysqli_stmt_bind_result($stmt, $id, $title);
    
    while (mysqli_stmt_fetch($stmt)) {
        echo (isset($cat_id) && $id == $cat_id)
            ? "<li class='nav nav-item active' > <a class='nav nav-link' href='".Config::REL_PATH."category/{$id}'>{$title}</a> </li>"
            : "<li class='nav nav-item'> <a class='nav nav-link' href='".Config::REL_PATH."category/{$id}'>{$title}</a> </li>";
    }
}

function display_user_menus () {
    if (Permissions::is_admin()) {
        ?>
        <li class='nav nav-item'> <a class='nav nav-link' href='<?php echo Config::REL_PATH."admin/index"; ?>'> <i class="fa fa-fw fa-cog"> </i> <?php echo NAV_ADMIN; ?> </a> </li>
        <li class='nav nav-item'> <a class='nav nav-link' href='<?php echo Config::REL_PATH."profile"; ?>'> <i class="fa fa-fw fa-user"> </i> <?php echo NAV_PROFILE; ?> </a> </li> 
        <li class="divider"> </li>
        <li class='nav nav-item'> <a class='nav nav-link' href='<?php echo Config::REL_PATH."logout"; ?>'> <i class="fa fa-fw fa-power-off"> </i> <?php echo NAV_LOGOUT; ?> </a> </li> 
        <?php
    } else if (Permissions::is_logged()) {
        ?>
        <li class='nav nav-item'> <a class='nav nav-link' href='<?php echo Config::REL_PATH."profile"; ?>'> <i class="fa fa-fw fa-user"> </i> <?php echo NAV_PROFILE; ?> </a> </li>
        <li class="divider"> </li>
        <li class='nav nav-item'> <a class='nav nav-link' href='<?php echo Config::REL_PATH."logout"; ?>'> <i class="fa fa-fw fa-power-off"> </i> <?php echo NAV_LOGOUT; ?> </a> </li> 
        <?php
    } else {
        ?>
        <li class='nav nav-item'> <a class='nav nav-link' href='<?php echo Config::REL_PATH."login"; ?>'> <?php echo NAV_LOGIN; ?> </a> </li> 
        <li class='nav nav-item'> <a class='nav nav-link' href='<?php echo Config::REL_PATH."registration"; ?>'> <?php echo NAV_REGISTER; ?> </a> </li>
        <?php
    } 
}

function has_profile_image () {
    $user_image = isset($_SESSION['user_img']) ? $_SESSION['user_img'] : NULL;

    if ($user_image != NULL) {
        return "<img src='".Config::REL_PATH."images/{$user_image}"."' width='20'> &ensp;";
    } else {
        return "<i class='fa fa-fw fa-user'> </i> &ensp;";
    }
}

?>
