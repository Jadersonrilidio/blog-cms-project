<?php


class MySessionHandler {

    static public function login_registered_user ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['user_role_id'] = $user['user_role_id'];
        $_SESSION['user_email'] = $user['user_email'];
        if ($user['user_lang']) $_SESSION['lang'] = $user['user_lang'];
        if ($user['user_image']) $_SESSION['user_img'] = $user['user_image'];
    }
    
    static public function session_login ($id, $name, $role_id, $email, $lang=NULL, $img=NULL) {
        $_SESSION['user_id'] = $id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_role_id'] = $role_id;
        $_SESSION['user_email'] = $email;
        if ($lang) $_SESSION['lang'] = $lang;
        if ($img) $_SESSION['user_img'] = $img;        
    }

    static public function session_logout () {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        unset($_SESSION['user_img']);
        Notifications::set_toastr_session(Notifications::LOGGED_OUT);
    }

    static public function uniqid_handler ($validator=NULL) {
        ($validator) ? Self::unset_uniqid() : Self::has_uniqid();
    }
    static private function has_uniqid () {
        if (isset($_SESSION['uniqid'])) {
            echo Config::REL_PATH."forgot/{$_SESSION['uniqid']}";
        } else {
            $_SESSION['uniqid'] = uniqid(true);
            echo Config::REL_PATH."forgot/{$_SESSION['uniqid']}";
        }
    }
    static private function unset_uniqid () {
            if (isset($_SESSION['uniqid'])) {
                unset($_SESSION['uniqid']);
                return true;
            }
        return false;
    }
}


?>