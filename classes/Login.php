<?php

class Login {

    static public function login_user () {
        if (!isset($_POST['submit_login'])) return false;
        if (empty($_POST['user_name']) || empty($_POST['user_password'])) return false;
    
        $user_name = InputHandler::escape($_POST['user_name']);
        $user_password = InputHandler::escape($_POST['user_password']);
    
        $stmt = User::select_login_attr_by_name($user_name);
        mysqli_stmt_bind_result($stmt, $password, $id, $name, $role_id, $email, $lang, $img);
    
        while (mysqli_stmt_fetch($stmt)) {
            if (password_verify($user_password, $password)) {
                Self::login_execute($id, $name, $role_id, $email, $lang, $img);
            }
        }
        return true;
    }
    
    static protected function login_execute ($id, $name, $role_id, $email, $lang=NULL, $img=NULL) {
        MySessionHandler::session_login($id, $name, $role_id, $email, $lang, $img);
        Notifications::set_toastr_session(Notifications::LOGGED_IN);
        Permissions::redirect($role_id==1 ? 'admin/index' : 'index');
    }
}


?>