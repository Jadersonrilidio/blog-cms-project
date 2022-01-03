
<?php

class Post extends QueryHandler {
    protected const ID = 'post_id';
    protected const CATEGORY_ID = 'post_category_id';
    protected const TITLE = 'post_title';
    protected const AUTHOR = 'post_author';
    protected const DATE_TIME = 'post_date_time';
    protected const IMAGE = 'post_image';
    protected const CONTENT = 'post_content';
    protected const TAGS = 'post_tags';
    protected const STATUS_ID = 'post_status_id';
    static protected $attr_name_string = Self::ID.','.Self::CATEGORY_ID.','.Self::TITLE.','.Self::AUTHOR.','.Self::DATE_TIME.','.Self::IMAGE.','.Self::CONTENT.','.Self::TAGS.','.Self::STATUS_ID;
    static protected $attr_name_array = [Self::ID, Self::CATEGORY_ID, Self::TITLE, Self::AUTHOR, Self::DATE_TIME, Self::IMAGE, Self::CONTENT, Self::TAGS, Self::STATUS_ID];

    static public function select_published_to_display ($start, $limit) {
        $query = " SELECT 
            P.post_id AS id, 
            C.cat_title AS post_category, 
            P.post_title AS title, 
            U.user_name AS author_name, 
            P.post_date_time AS date_time, 
            P.post_image AS img, 
            P.post_content AS content, 
            P.post_tags AS tags, 
            PS.post_status_title AS post_status, 
            C.cat_id AS cat_id, 
            U.user_id As user_id, 
            PS.post_status_id AS post_status_id 
            FROM posts P 
            LEFT JOIN categories C ON P.post_category_id = C.cat_id 
            LEFT JOIN users U ON P.post_author = U.user_id 
            LEFT JOIN post_status PS ON P.post_status_id = PS.post_status_id 
            WHERE PS.post_status_id = 1 ORDER BY P.post_date_time DESC LIMIT $start, $limit ";
        
        $stmt = QueryHandler::statement_handler($query);
        return $stmt;
    }

    static public function select_published_match_to_display ($search_pattern, $start, $limit) {
        $search_pattern = '%'.$search_pattern.'%';
        $query = " SELECT 
            P.post_id AS id, 
            C.cat_title AS post_category, 
            P.post_title AS title, 
            U.user_name AS author_name, 
            P.post_date_time AS date_time, 
            P.post_image AS img, 
            P.post_content AS content, 
            P.post_tags AS tags, 
            PS.post_status_title AS post_status, 
            C.cat_id AS cat_id, 
            U.user_id As user_id, 
            PS.post_status_id AS post_status_id 
            FROM posts P 
            LEFT JOIN categories C ON P.post_category_id = C.cat_id 
            LEFT JOIN users U ON P.post_author = U.user_id 
            LEFT JOIN post_status PS ON P.post_status_id = PS.post_status_id 
            WHERE P.post_tags LIKE ? AND PS.post_status_id = 1 
            ORDER BY P.post_date_time DESC LIMIT $start, $limit ";

        $stmt = QueryHandler::statement_handler($query, 's', $search_pattern);
        return $stmt;
    }

    static public function select_published_by_category_to_display ($cat_id, $start, $limit) { 
        $query = " SELECT 
            P.post_id AS id, 
            C.cat_title AS post_category, 
            P.post_title AS title, 
            U.user_name AS author_name, 
            P.post_date_time AS date_time, 
            P.post_image AS img, 
            P.post_content AS content, 
            P.post_tags AS tags, 
            PS.post_status_title AS post_status, 
            C.cat_id AS cat_id, 
            U.user_id As user_id, 
            PS.post_status_id AS post_status_id 
            FROM posts P 
            LEFT JOIN categories C ON P.post_category_id = C.cat_id 
            LEFT JOIN users U ON P.post_author = U.user_id 
            LEFT JOIN post_status PS ON P.post_status_id = PS.post_status_id 
            WHERE P.post_category_id = ? AND PS.post_status_id = 1 
            ORDER BY P.post_date_time DESC LIMIT $start, $limit ";

        $stmt = QueryHandler::statement_handler($query, 'i', $cat_id);
        return $stmt;
    }

    static public function select_published_by_author_to_display ($user_id, $start, $limit) {
        $query = " SELECT 
            P.post_id AS id, 
            C.cat_title AS post_category, 
            P.post_title AS title, 
            U.user_name AS author_name, 
            P.post_date_time AS date_time, 
            P.post_image AS img, 
            P.post_content AS content, 
            P.post_tags AS tags, 
            PS.post_status_title AS post_status, 
            C.cat_id AS cat_id, 
            U.user_id As user_id, 
            PS.post_status_id AS post_status_id 
            FROM posts P 
            LEFT JOIN categories C ON P.post_category_id = C.cat_id 
            LEFT JOIN users U ON P.post_author = U.user_id 
            LEFT JOIN post_status PS ON P.post_status_id = PS.post_status_id 
            WHERE P.post_author = ? AND PS.post_status_id = 1 
            ORDER BY P.post_date_time DESC LIMIT $start, $limit ";

        $stmt = QueryHandler::statement_handler($query, 'i', $user_id);
        return $stmt;
    }

    static public function select_by_id_to_display ($post_id) { 
        $query = "SELECT p.post_title, p.post_date_time, p.post_image, 
            p.post_content, p.post_author, u.user_name 
            FROM posts p LEFT JOIN users u ON p.post_author = u.user_id 
            WHERE p.post_id = ? ";

        $stmt = QueryHandler::statement_handler($query, 'i', $post_id);
        return $stmt;
    }

    static public function count_posts_by_status ($status_id) {
        $query = "SELECT * FROM posts WHERE post_status_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $status_id);
        $num_rows = mysqli_stmt_num_rows($stmt);
        return $num_rows;
    }

    static public function count_posts_by_category ($cat_id) { 
        $query = "SELECT * FROM posts WHERE post_category_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $cat_id);
        $num_rows = mysqli_stmt_num_rows($stmt);
        return $num_rows;
    }

    static public function count_posts_by_author ($author_id) {
        $query = "SELECT * FROM posts WHERE post_author = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $author_id);
        $num_rows = mysqli_stmt_num_rows($stmt);
        return $num_rows;
    }

    static public function posts_count_by_search_pattern ($search_pattern) {
        $search_pattern = '%'.$search_pattern.'%';
        $query = "SELECT * FROM posts WHERE post_tags LIKE ? AND post_status_id = 1 ";
        $stmt = QueryHandler::statement_handler($query, 's', $search_pattern);
        $num_rows = mysqli_stmt_num_rows($stmt);
        return $num_rows;
    }

    //TODO - Admin Functions:

    static public function create ($title, $cat_id, $author, $content, $image=NULL, $tags=NULL, $status_id=1) {
        $query = "INSERT INTO posts(post_title,post_category_id,post_author,post_content,post_image,post_tags,post_status_id) VALUES(?,?,?,?,?,?,?) ";
        $stmt = QueryHandler::statement_handler($query, 'siisssi', $title, $cat_id, $author, $content, $image, $tags, $status_id); 
        return $stmt;
    }

    static public function select_posts_to_display_on_table ($author=NULL) {
        $stmt = NULL;

        $query = "SELECT P.post_id, P.post_title, P.post_date_time, P.post_image, P.post_content, P.post_tags, 
        C.cat_title, U.user_id, U.user_name, PS.post_status_title 
        FROM posts P 
        LEFT JOIN categories C ON P.post_category_id = C.cat_id 
        LEFT JOIN users U ON P.post_author = U.user_id 
        LEFT JOIN post_status PS ON P.post_status_id = PS.post_status_id "; 

        if ($author) {
            $query .= " WHERE P.post_author = ? ORDER BY P.post_date_time DESC ";
            $stmt = QueryHandler::statement_handler($query, 'i', $author);
        } else {
            $query .= " ORDER BY P.post_date_time DESC ";
            $stmt = QueryHandler::statement_handler($query);
        }
        return $stmt;
    }

    static public function update ($cat_id, $title, $author, $datetime, $image, $content, $tags, $status_id, $id) { 
        $query = " UPDATE posts SET 
        post_category_id = ?, 
        post_title = ?, 
        post_author = ?, 
        post_date_time = ?, 
        post_image = ?, 
        post_content = ?, 
        post_tags = ?, 
        post_status_id = ? 
        WHERE post_id = ? ";
    
        $stmt = QueryHandler::statement_handler($query, 'isissssii', $cat_id, $title, $author, $datetime, $image, $content, $tags, $status_id, $id);
        return $stmt;
    }

    static public function delete ($id) {
        $query = " DELETE FROM posts WHERE post_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $id);
        return $stmt;
    }

    static public function publish ($id) {
        $query = "UPDATE posts SET post_status_id = 1 WHERE post_id = ? ";
        QueryHandler::statement_handler($query, 'i', $id);
    }

    static public function draft ($id) {
        $query = " UPDATE posts SET post_status_id = 2 WHERE post_id = ? ";
        QueryHandler::statement_handler($query, 'i', $id);
    }

    static public function get_post_title_by_id ($id) {
        $query = " SELECT post_title FROM posts WHERE post_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $id);
        mysqli_stmt_bind_result($stmt, $title);
        mysqli_stmt_fetch($stmt);
        return $title;
    }

    static public function clone ($id) {
        $query = " INSERT INTO posts(post_title,post_author,post_category_id,post_image,post_content,post_tags,post_status_id) 
            SELECT post_title, post_author, post_category_id, post_image, post_content, post_tags, post_status_id 
            FROM posts WHERE post_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $id);
        return $stmt;
    }

    static public function post_comment_count ($post_id) {
        $query = " SELECT COUNT(comment_post_id) FROM comments WHERE comment_post_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $post_id);
        mysqli_stmt_bind_result($stmt, $comment_count);
        mysqli_stmt_fetch($stmt);
        return $comment_count;
    }

    static public function select_post_status_id_title () {
        $query = " SELECT post_status_id, post_status_title FROM post_status ";
        $stmt = QueryHandler::statement_handler($query);
        return $stmt;
    }

    static public function get_post_attr_to_edit ($id) {
        $query = "SELECT * FROM posts WHERE post_id = $id ";
        $register = QueryHandler::query_handler($query, 'assoc_array');
        return $register;
    }

    static public function get_image_by_id ($id) {
        $query = " SELECT post_image FROM posts WHERE post_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $id);
        mysqli_stmt_bind_result($stmt, $image);
        mysqli_stmt_fetch($stmt);
        return $image;
    }

}





?>
