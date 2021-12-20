
<?php





class Category extends QueryHandler {

    static public function select_all ($case='statement') { 
        $query = " SELECT * FROM categories ";
        switch ($case) {
            case 'query': return QueryHandler::query_handler($query, 'result');
            case 'statement': return QueryHandler::statement_handler($query);
        }
    }

    static public function select_cat_title_by_id ($id) { 
        $query = " SELECT cat_title FROM categories WHERE cat_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $id);
        mysqli_stmt_bind_result($stmt, $title);
        mysqli_stmt_fetch($stmt);
        return $title;
    }

    // TODO - Admin Functions:

    static public function create ($title) {
        $query = " INSERT INTO categories(cat_title) VALUES (?) ";
        $stmt = QueryHandler::statement_handler($query, 's', $title);
        return $stmt;
    }

    static public function update ($title, $id) {
        $query = " UPDATE categories SET cat_title = ? WHERE cat_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'si', $title, $id);
        return $stmt;
    }

    static public function delete ($id) {
        $query = " DELETE FROM categories WHERE cat_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $id);
        return $stmt;
    }

    static public function select_to_display_on_table () { 
        $query = " SELECT * FROM categories ";
        $stmt = QueryHandler::statement_handler($query);
        return $stmt;
    }

    static public function get_category_by_id ($id) {
        $query = "SELECT * FROM categories WHERE cat_id = ? ";
        $stmt = QueryHandler::statement_handler($query, 'i', $id);
        return $stmt;
    }

    static public function select_category_id_title () {
        $query = "SELECT cat_id, cat_title FROM categories";
        $stmt =  QueryHandler::statement_handler($query);
        return $stmt;
    }
}

?>