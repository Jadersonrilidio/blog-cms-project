<?php include "MySQLDataBase.php"; ?>

<?php

class Comment extends DBQuery {

    public static function create () {
        // TODO
    }

    public static function select_all () {
        $query = "SELECT * FROM comments ";
        $result = DBQuery::query_handler($query, 'result');
        return $result;
    }

    public static function update () {
        // TODO
    }
    
    public static function delete () {
        // TODO
    }

    public static function approve () {
        // TODO
    }

    public static function unapprove () {
        // TODO
    }

    // OPTIMIZE - extra features: 

    // public static function ENHANCED_SELECT (string $fieldset_str=NULL, mixed ...$values) : mysqli_result|bool {
    //     $query = " SELECT * FROM comments ";

    //     if (isset($fieldset_str)) {
    //         $fieldset = explode(',', $fieldset_str);
    //         if (!Comment::fieldset_validity($fieldset)) return false;
            
    //         $temp_counter = 0;
    //         $query .= " WHERE ";
            
    //         foreach (array_combine($fieldset, [...$values]) as $key => $value) {
    //             if ($temp_counter != 0) $query .= " AND ";
    //             is_string($value) 
    //                 ? $query .= " $key = '$value' " 
    //                 : $query .= " $key = $value ";
    //             ++$temp_counter;
    //         }
    //     }
    //     $result = DBQuery::query_handler($query, 'result');
    //     return $result;
    // }

    // static public function fieldset_validity ($fieldset) {
    //     $comment_attributes_array = ['comment_id', 'comment_author', 'comment_post_id', 'comment_content', 'comment_email', 'comment_date_time', 'comment_status_id'];
    //     foreach ($fieldset as $field) {
    //         $check = array_search($field, $comment_attributes_array);
    //         if ($check === false) return false;
    //     }
    //     return true;
    // }

    public static function select_by_id ($id) {
        $query = "SELECT * FROM comments WHERE comment_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $id);
        return $stmt;
    }

    public static function select_by_status ($status) {
        $query = "SELECT * FROM comments WHERE comment_status_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $status);
        return $stmt;
    }

    public static function select_by_author ($author) {
        $query = "SELECT * FROM comments WHERE comment_author = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $author);
        return $stmt;
    }

    public static function select_by_post ($post_id) {
        $query = "SELECT * FROM comments WHERE comment_post_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $post_id);
        return $stmt;
    }

    public static function select_by_status_and_author ($status, $author) {
        $query = "SELECT * FROM comments WHERE comment_status_id = ? AND comment_author = ? ";
        $stmt = DBQuery::statement_handler($query, 'ii', $status, $author);
        return $stmt;
    }

    public static function select_by_status_and_post ($status, $post_id) {
        $query = "SELECT * FROM comments WHERE comment_status_id = ? AND comment_post_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'ii', $status, $post_id);
        return $stmt;
    }

    // OPTIMIZE - extra functions working, but could have been done better 

    public static function count_by_post ($post_id) {
        $query = "SELECT * FROM comments WHERE comment_post_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $post_id);
        return mysqli_stmt_num_rows($stmt);
    }

    public static function count_by_author ($author) {
        $query = "SELECT * FROM comments WHERE comment_author = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $author);
        return mysqli_stmt_num_rows($stmt);
    }

}
