<?php 


class Permissions {

    static public function greeting_logged_user () { 
        if (Self::is_logged()) 
               echo GREETING_USER." {$_SESSION['user_name']}!";
    }
    
    static public function is_logged () {
        return (isset($_SESSION['user_id'])) ? true : false;
    }
    
    static public function is_admin () {
        return (Self::is_logged() && $_SESSION['user_role_id'] == 1) ? true : false;
    }
    
    static public function redirect ($location) {
        header("Location: ".Config::REL_PATH.$location);
    }
    
    static public function redirect_logged ($location) {
        if (Self::is_logged()) Self::redirect($location);
    }

    static public function redirect_not_logged ($location) {
        if (!Self::is_logged()) Self::redirect($location);
    }

    static public function redirect_not_admin ($location) {
        if (!Self::is_admin()) Self::redirect($location);
    }
    
    static public function redirect_not_valid_uniqid ($location) {
        if (!isset($_GET['forgot']) || !isset($_SESSION['uniqid']) || $_GET['forgot'] != $_SESSION['uniqid']) {
            Self::redirect($location);
        }
    }
    
    static public function redirect_not_valid_token ($location) { 
        if (!isset($_GET['email']) || !isset($_GET['token'])) Self::redirect($location);
    
        $email = InputHandler::escape($_GET['email']);
        $token = InputHandler::escape($_GET['token']);
    
        $user_token = User::select_user_token_by_email($email);
        if ($token != $user_token) Self::redirect($location);
    }
}


?>