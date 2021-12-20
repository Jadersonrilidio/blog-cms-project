
<?php


class Comment extends QueryHandler {

    public static function create ($post_id, $author, $content) {
        $query = "INSERT INTO comments(comment_post_id,comment_author,comment_content) VALUES(?,?,?) ";
        $stmt = QueryHandler::statement_handler($query, 'iis', $post_id, $author, $content);
        return $stmt;
    }

    static public function select_approved_by_post_id ($post_id) {
        $query = " SELECT C.comment_id, C.comment_content, C.comment_date_time, U.user_id, U.user_name 
            FROM comments C LEFT JOIN users U ON C.comment_author = U.user_id  
            WHERE C.comment_post_id = ? AND C.comment_status_id = 1 
            ORDER BY C.comment_date_time DESC ";
        
        $stmt = QueryHandler::statement_handler($query, 'i', $post_id);
        return $stmt;
    }

    //TODO - Admin Functions:

    static public function approve ($id) {
        $query = "UPDATE comments SET comment_status_id = 1 WHERE comment_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $id);
        return $stmt;
    }

    static public function unapprove ($id) {
        $query = "UPDATE comments SET comment_status_id = 2 WHERE comment_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $id);
        return $stmt;
    }

    static public function delete ($id) {
        $query = "DELETE FROM comments WHERE comment_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $id);
        return $stmt;
    }

    static public function select_by_post_id_to_display_on_table ($post_id) {
        $query = " SELECT C.comment_id, C.comment_content, C.comment_date_time, 
            P.post_id, P.post_title, 
            U.user_id, U.user_name, 
            CS.comment_status_title 
            FROM comments C 
            LEFT JOIN posts P ON C.comment_post_id = P.post_id 
            LEFT JOIN users U ON C.comment_author = U.user_id 
            LEFT JOIN comment_status CS ON C.comment_status_id = CS.comment_status_id 
            WHERE C.comment_post_id = ? "; 

        $stmt = QueryHandler::statement_handler($query, 'i', $post_id);
        return $stmt;
    }

    static public function select_by_author_id_to_display_on_table ($author_id) {
        $query = " SELECT C.comment_id, C.comment_content, C.comment_date_time, 
            P.post_id, P.post_title, 
            U.user_id, U.user_name, 
            CS.comment_status_title 
            FROM comments C 
            LEFT JOIN posts P ON C.comment_post_id = P.post_id 
            LEFT JOIN users U ON C.comment_author = U.user_id 
            LEFT JOIN comment_status CS ON C.comment_status_id = CS.comment_status_id 
            WHERE C.comment_author = ? "; 

        $stmt = QueryHandler::statement_handler($query, 'i', $author_id);
        return $stmt;
    }

    static public function select_all_to_display_on_table () {
        $query = " SELECT C.comment_id, C.comment_content, C.comment_date_time, 
        P.post_id, P.post_title, 
        U.user_id, U.user_name, 
        CS.comment_status_title 
        FROM comments C 
        LEFT JOIN posts P ON C.comment_post_id = P.post_id 
        LEFT JOIN users U ON C.comment_author = U.user_id 
        LEFT JOIN comment_status CS ON C.comment_status_id = CS.comment_status_id ";

        $stmt = QueryHandler::statement_handler($query);
        return $stmt;
    }

    static public function TEST_select_all_to_display_on_table ($id=NULL, $case=NULL) {
        $query = " SELECT C.comment_id, C.comment_content, C.comment_date_time, 
        P.post_id, P.post_title, 
        U.user_id, U.user_name, 
        CS.comment_status_title 
        FROM comments C 
        LEFT JOIN posts P ON C.comment_post_id = P.post_id 
        LEFT JOIN users U ON C.comment_author = U.user_id 
        LEFT JOIN comment_status CS ON C.comment_status_id = CS.comment_status_id ";

        if ($id) {
            switch ($case) {
                case 'post':
                    $query .= " WHERE C.comment_post_id = ? ";
                    break;
                case 'author':
                    $query .= " WHERE C.comment_author = ? ";
                    break;
            }
        }
        $stmt = ($id) ? QueryHandler::statement_handler($query, 'i', $id) : QueryHandler::statement_handler($query);
        return $stmt;
    }


    // not in use yet???

    static public function count_by_post ($post_id) {
        $query = "SELECT * FROM comments WHERE comment_post_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $post_id);
        return mysqli_stmt_num_rows($stmt);
    }

    static public function count_by_author ($author) {
        $query = "SELECT * FROM comments WHERE comment_author = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $author);
        return mysqli_stmt_num_rows($stmt);
    }
}





?>
