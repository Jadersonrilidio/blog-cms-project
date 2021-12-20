
<?php





class User extends QueryHandler {

    static public function create_subscriber ($name, $password, $email) {
        $query = "INSERT INTO users(user_name,user_password,user_email) VALUES(?,?,?) ";
        $stmt = QueryHandler::statement_handler($query, 'sss', $name, $password, $email);
        return $stmt;
    }

    static public function select_login_attr_by_name ($user_name) {
        $query = "SELECT user_password, user_id, user_name, user_role_id, user_email, user_lang, user_image FROM users WHERE user_name = ? ";
        $stmt = QueryHandler::statement_handler($query, 's', $user_name);
        return $stmt;
    }

    static public function select_password ($user_id) {
        $query = "SELECT user_password FROM users WHERE user_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $user_id);
        mysqli_stmt_bind_result($stmt, $password);
        mysqli_stmt_fetch($stmt);
        return $password;
    }

    static public function select_user_name_by_id ($user_id) {
        $query = "SELECT user_name FROM users WHERE user_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $user_id);
        mysqli_stmt_bind_result($stmt, $user_name);
        mysqli_stmt_fetch($stmt);
        return $user_name;
    }

    static public function username_exists ($username) {
        $query = "SELECT * FROM users WHERE user_name = ? ";
        $stmt = QueryHandler::statement_handler($query, 's', $username);
        return (mysqli_stmt_num_rows($stmt) === 0) ? false : true;
    }
    
    static public function email_exists ($email) {
        $query = "SELECT * FROM users WHERE user_email = ? ";
        $stmt = QueryHandler::statement_handler($query, 's', $email);
        return (mysqli_stmt_num_rows($stmt) === 0) ? false : true;
    }

    static public function get_last_inserted_user($user_id) {
        $query = "SELECT * FROM users WHERE user_id = $user_id";
        $result = QueryHandler::query_handler($query, 'result');
        $register = mysqli_fetch_assoc($result);
        return $register;
    }

    static public function set_token ($token, $email) {
        $query = "UPDATE users SET user_token = ? WHERE user_email = ? ";
        $stmt = QueryHandler::statement_handler($query, 'ss', $token, $email);
        return $stmt;
    }

    static public function update_password_and_reset_token ($password, $email) {
        $query = "UPDATE users SET user_token = null, user_password = ? WHERE user_email = ? ";
        $stmt = QueryHandler::statement_handler($query, 'ss', $password, $email);
        return $stmt;
    }

    static public function update_password_by_id ($password, $id) {
        $query = "UPDATE users SET user_password = ? WHERE user_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'si', $password, $id);
        return $stmt;
    }

    static public function select_user_token_by_email ($email) {
        $query = " SELECT user_token FROM users WHERE user_email = ? ";
        $stmt = QueryHandler::statement_handler($query, 's', $email);
        mysqli_stmt_bind_result($stmt, $user_token);
        mysqli_stmt_fetch($stmt);
        return $user_token;
    }

    static public function select_all_admin_id_name () {
        $query = "SELECT user_id, user_name FROM users WHERE user_role_id = 1";
        $stmt = QueryHandler::statement_handler($query);
        return $stmt;
    }

    static public function select_all_to_display_on_table ($role=NULL) {
        $query = " SELECT U.user_id, U.user_name, U.user_email, U.user_image, U.user_lang, R.role_title 
            FROM users U LEFT JOIN roles R ON U.user_role_id = R.role_id ";

        if ($role) {
            if ($role == 1) $query .= " WHERE user_role_id = 1 ";
            if ($role == 2) $query .= " WHERE user_role_id = 2 ";
        }

        $stmt = QueryHandler::statement_handler($query);
        return $stmt;
    }

    static public function posts_count ($user_id) {
        $query = " SELECT COUNT(*) AS user_posts FROM posts WHERE post_author = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $user_id);
        mysqli_stmt_bind_result($stmt, $user_posts);
        mysqli_stmt_fetch($stmt);
        return $user_posts;
    }

    static public function comments_count ($user_id) {
        $query = " SELECT COUNT(*) AS user_comments FROM comments WHERE comment_author = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $user_id);
        mysqli_stmt_bind_result($stmt, $user_comments);
        mysqli_stmt_fetch($stmt);
        return $user_comments;
    }

    static public function change_role ($role_id, $user_id) {
        $query = " UPDATE users SET user_role_id = ? WHERE user_id = ? ";
        $stmt = Queryhandler::statement_handler($query, 'ii', $role_id, $user_id);
        return $stmt;
    }

    static public function select_user_lang($id) {
        $query = "SELECT user_lang FROM users WHERE user_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $id);
        mysqli_stmt_bind_result($stmt, $lang);
        mysqli_stmt_fetch($stmt);
        return $lang;
    }

    static public function update_user ($id, $username, $email, $language=NULL, $image=NULL) {
        $query = " UPDATE users SET user_name = ? , user_email = ? "; 
        if ($language) $query .= ", user_lang = ? ";
        if ($image) $query .= ", user_image = ? ";
        $query .= " WHERE user_id = ? ";

        $stmt = false;
        if ($language && $image) {
            $stmt = Queryhandler::statement_handler($query, 'ssssi', $username, $email, $language, $image, $id);
        } else if ($language) {
            $stmt = Queryhandler::statement_handler($query, 'sssi', $username, $email, $language, $id);
        } else if ($image) {
            $stmt = Queryhandler::statement_handler($query, 'sssi', $username, $email, $image, $id);
        } else {
            $stmt = Queryhandler::statement_handler($query, 'ssi', $username, $email, $id);
        }
        return $stmt;
    }

}




?>