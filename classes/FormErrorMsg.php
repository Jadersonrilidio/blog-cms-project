
<?php 

class FormErrorMsg {

    static public function register_has_username () {
        if (isset($_POST['user_register']) && empty($_POST['user_name'])) 
            echo "<span class='my-msg-status'>".NO_USERNAME."</span>";
    }

    static public function register_username_exists () {
        if (!empty($_POST['user_name']) && User::username_exists($_POST['user_name'])) 
            echo "<span class='my-msg-status'>".USERNAME_EXISTS."</span>";
    }

    static public function register_has_email () {
        if (isset($_POST['user_register']) && empty($_POST['user_email'])) 
            echo "<span class='my-msg-status'>".NO_EMAIL."</span>";
    }

    static public function register_email_exists () {
        if (!empty($_POST['user_email']) && User::email_exists($_POST['user_email'])) 
            echo "<span class='my-msg-status'>".EMAIL_EXISTS."</span>";
    }

    static public function register_has_password () {
        if (!empty($_POST['user_register']) && empty($_POST['user_password'])) 
            echo "<span class='my-msg-status'>".NO_PASSWORD."</span>";
    }

    static public function register_password_match () {
        if (isset($_POST['user_register']) && !empty($_POST['user_password']) && $_POST['user_password'] != $_POST['repeat_password']) 
            echo "<span class='my-msg-status'>".PASSWORD_NOT_MATCH."</span>";
    }

    static public function register_has_rpt_password () {
        if (isset($_POST['user_register']) && empty($_POST['repeat_password'])) 
            echo "<span class='my-msg-status'>".NO_RPT_PASSWORD."</span>";
    }

    static public function login_has_username () {
        if (isset($_POST['submit_login']) && empty($_POST['user_name'])) 
            echo "<span class='my-msg-status'>".NO_USERNAME."</span>";
    }

    static public function login_has_password () {
        if (isset($_POST['submit_login']) && empty($_POST['user_password'])) 
            echo "<span class='my-msg-status'>".NO_PASSWORD."</span>";
    }

    static public function login_invalid_username_password () {
        $echoit = false;

        if (isset($_POST['submit_login']) && !empty($_POST['user_name']) && !empty($_POST['user_password'])) {
            $user_name = InputHandler::escape($_POST['user_name']);
            $user_password = InputHandler::escape($_POST['user_password']);

            $stmt = User::select_login_attr_by_name($user_name);
            mysqli_stmt_bind_result($stmt, $password, $id, $name, $role_id, $email, $lang, $img);
            mysqli_stmt_fetch($stmt);
            if (!$stmt || !password_verify($user_password, $password)) $echoit = true;
        }
        if ($echoit) echo "<span class='my-msg-status'>".INVALID_USERNAME_PASSWORD."</span>";
    }

    static public function contact_has_email () {
        if (isset($_POST['submit']) && empty($_POST['email']))
            echo "<span class='my-msg-status'>".NO_EMAIL."</span>";
    }

    static public function contact_has_subject () {
        if (isset($_POST['submit']) && empty($_POST['subject']))
            echo "<span class='my-msg-status'>".NO_SUBJECT."</span>";
    }

    static public function contact_has_message () {
        if (isset($_POST['submit']) && empty($_POST['message']))
            echo "<span class='my-msg-status'>".NO_MESSAGE."</span>";
    }

    static public function comment_has_message () {
        if (isset($_POST['create_comment']) && empty($_POST['comment_content']))
            echo "<span class='my-msg-status'>".NO_MESSAGE."</span>";
    }


    static public function forgot_has_email () {
        if (isset($_POST['send_email']) && empty($_POST['user_email']))
            echo "<span class='my-msg-status'>".NO_EMAIL."</span>";
    }

    static public function forgot_invalid_email () {
        if (isset($_POST['send_email']) && !empty($_POST['user_email'])) {
            $email = InputHandler::escape($_POST['user_email']);

            if (!User::email_exists($email))
                echo "<span class='my-msg-status'>".INVALID_EMAIL.CHECK_CORRECTION."</span>";
        }
    }

    static public function reset_has_password () {
        if (isset($_POST['reset_password']) && empty($_POST['user_password'])) 
            echo "<span class='my-msg-status'>".NO_PASSWORD."</span>";
    }

    static public function reset_password_match () {
        if (isset($_POST['reset_password']) && !empty($_POST['user_password']) && $_POST['user_password'] != $_POST['repeat_password']) 
            echo "<span class='my-msg-status'>".PASSWORD_NOT_MATCH."</span>";
    }

    static public function reset_has_rpt_password () {
        if (isset($_POST['reset_password']) && empty($_POST['repeat_password'])) 
            echo "<span class='my-msg-status'>".NO_RPT_PASSWORD."</span>";
    }

    static public function profile_has_username () {
        if (isset($_POST['submit']) && empty($_POST['user_name'])) 
            echo "<span class='my-msg-status'>".NO_USERNAME."</span>";
    }

    static public function profile_username_exists () {
        if (isset($_POST['submit']) && User::username_exists($_POST['user_name'])) {
            if ($_POST['user_name'] != $_SESSION['user_name'])
                echo "<span class='my-msg-status'>".USERNAME_EXISTS."</span>";
        }
    }

    static public function profile_has_email () {
        if (isset($_POST['submit']) && empty($_POST['user_email'])) 
            echo "<span class='my-msg-status'>".NO_EMAIL."</span>";
    }

    static public function profile_email_exists () {
        if (isset($_POST['submit']) && User::email_exists($_POST['user_email'])) {
            if ($_POST['user_email'] != $_SESSION['user_email'])
                echo "<span class='my-msg-status'>".EMAIL_EXISTS."</span>";
        }
    }

    static public function profile_has_current_password () {
        if (isset($_POST['change_password']) && empty($_POST['old_password'])) 
            echo "<span class='my-msg-status'>".NO_PASSWORD."</span>";
    }

    static public function profile_wrong_current_password () {
        $echoit = false;
        if (isset($_POST['change_password']) && !empty($_POST['old_password'])) {
            $user_password = InputHandler::escape($_POST['old_password']);
            $password = User::select_password($_SESSION['user_id']);
            if (!password_verify($user_password, $password)) $echoit = true;
        }
        if ($echoit) echo "<span class='my-msg-status'>".INVALID_PASSWORD."</span>";
    }

    static public function profile_has_new_password () {
        if (isset($_POST['change_password']) && empty($_POST['new_password'])) 
            echo "<span class='my-msg-status'>".NO_NEW_PASSWORD."</span>";
    }

    static public function profile_has_rpt_password () {
        if (isset($_POST['change_password']) && empty($_POST['rpt_password'])) 
            echo "<span class='my-msg-status'>".NO_RPT_PASSWORD."</span>";
    }

    static public function profile_passwords_not_match () {
        if (isset($_POST['change_password']) && !empty($_POST['new_password']) && !empty($_POST['rpt_password']) && $_POST['new_password'] != $_POST['rpt_password']) 
            echo "<span class='my-msg-status'>".PASSWORD_NOT_MATCH."</span>";
    }

    //TODO - Admin functions

    static public function post_has_title () {
        if (isset($_POST['submit']) && empty($_POST['post_title']))
            echo "<span class='my-msg-status'>".NO_TITLE."</span>";
    }
    
    static public function post_has_author () {
        if (isset($_POST['submit']) && empty($_POST['post_author']))
            echo "<span class='my-msg-status'>".NO_AUTHOR."</span>";
    }
    
    static public function post_has_category () {
        if (isset($_POST['submit']) && empty($_POST['post_category_id']))
            echo "<span class='my-msg-status'>".NO_CATEGORY."</span>";
    }
    
    static public function post_has_status () {
        if (isset($_POST['submit']) && empty($_POST['post_status_id']))
            echo "<span class='my-msg-status'>".NO_STATUS."</span>";
    }
    
    static public function post_has_image () {
        if (isset($_POST['submit']) && empty($_POST['post_image']))
            echo "<span class='my-msg-status'>".NO_IMAGE."</span>";
    }
    
    static public function post_has_content () {
        if (isset($_POST['submit']) && empty($_POST['post_content']))
            echo "<span class='my-msg-status'>".NO_CONTENT."</span>";
    }

    static public function category_has_title_to_add () {
        if (isset($_POST['add']) && empty($_POST['cat_title']))
            echo "<span class='my-msg-status'>".NO_TITLE."</span>";
    }

    static public function category_has_title_to_edit () {
        if (isset($_POST['update']) && empty($_POST['cat_title']))
            echo "<span class='my-msg-status'>".NO_TITLE."</span>";
    }

}


?>