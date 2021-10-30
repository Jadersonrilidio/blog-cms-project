<?php include "MySQLDataBase.php"; ?>

<?php

class Post extends DBQuery {

    public static function create ($category_id, $title, $author, $content, $image=NULL, $tags=NULL, $status_id=1, $views=0) {
        $query = "INSERT INTO 
            posts(post_category_id,post_title,post_author,post_image,post_content,post_tags,post_status_id) 
            VALUES(?,?,?,?,?,?,?) ";

        DBQuery::statement_handler($query, 'isisssi', $category_id, $title, $author, $content, $image, $tags, $status_id); 
    }

    public static function select_all () {
        $query = " SELECT * FROM posts ";
        $result = DBQuery::query_handler($query);
        return $result;
    }

    public static function update () { 
        //TODO
        $query = " UPDATE posts SET ";
        $query .= " WHERE post_id = ? ";
    }

    public static function delete ($id) {
        $query = " DELETE FROM posts WHERE post_id = ? ";
        DBQuery::statement_handler($query, 'i', $id);
    }
    

    public static function publish ($id) {
        $query = "UPDATE SET post_status_id = 1 WHERE post_id = ? ";
        DBQuery::statement_handler($query, 'i', $id);
    }

    public static function draft ($id) {
        $query = "UPDATE SET post_status_id = 2 WHERE post_id = ? ";
        DBQuery::statement_handler($query, 'i', $id);
    }

    // OPTIMIZE - extra features: 

    // public static function ENHANCED_SELECT (string $fieldset_str=NULL, mixed ...$values) : mysqli_result|bool {
    //     $query = " SELECT * FROM posts ";

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
    //     $result = MyDataBase::query_handler($query, 'result');
    //     return $result;
    // }

    // static public function fieldset_validity ($fieldset) {
    //     $post_attributes_array = ['post_id', 'post_title', 'post_author', 'post_category_id', 'post_image', 'post_date_time', 'post_content', 'post_tags', 'post_status_id', 'post_views'];
    //     foreach ($fieldset as $field) {
    //         $check = array_search($field, $post_attributes_array);
    //         if ($check === false) return false;
    //     }
    //     return true;
    // }

    public static function clone ($id) {
        // TODO
    }

    public static function select_by_status ($status_id) {
        $query = " SELECT * FROM posts WHERE post_status_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $status_id);
        return $stmt;
    }

    public static function select_by_id ($post_id) {
        $query = " SELECT * FROM posts WHERE post_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $post_id);
        return $stmt;
    }

    public static function select_by_author ($author) {
        $query = " SELECT * FROM posts WHERE post_author = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $author);
        return $stmt;
    }
    
    public static function select_by_category ($cat_id) {
        $query = " SELECT * FROM posts WHERE post_category_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $cat_id);
        return $stmt;
    }

    public static function select_by_status_and_id ($status_id, $post_id) {
        $query = " SELECT * FROM posts WHERE post_status_id = ? AND post_id = ?";
        $stmt = DBQuery::statement_handler($query, 'ii', $status_id, $post_id);
        return $stmt;
    }

    public static function select_by_status_and_author ($status_id, $author) {
        $query = " SELECT * FROM posts WHERE post_status_id = ? AND post_author = ?";
        $stmt = DBQuery::statement_handler($query, 'ii', $status_id, $author);
        return $stmt;
    }

    public static function select_by_status_and_category ($status_id, $cat_id) {
        $query = " SELECT * FROM posts WHERE post_status_id = ? AND post_category_id = ?";
        $stmt = DBQuery::statement_handler($query, 'ii', $status_id, $cat_id);
        return $stmt;
    }

    public static function count_posts_by_category ($cat_id) {
        $query = "SELECT * FROM posts WHERE post_category_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $cat_id);
        $num_rows = mysqli_stmt_num_rows($stmt);
        return $num_rows;
    }

    public static function count_posts_by_author ($author) {
        $query = "SELECT * FROM posts WHERE post_author = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $author);
        $num_rows = mysqli_stmt_num_rows($stmt);
        return $num_rows;
    }
}


?>
