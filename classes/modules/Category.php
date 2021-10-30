<?php include "MySQLDataBase.php"; ?>

<?php

class Category extends DBQuery {

    public static function create ($cat_title) {
        $query = " INSERT INTO categories(cat_title) VALUES(?) ";
        $stmt = DBQuery::statement_handler($query, 's', $cat_title);
        return $stmt;
    }

    public static function select_all () {
        $query = " SELECT * FROM categories ";
        $result = DBQuery::query_handler($query, 'result');
        return $result;
    }

    public static function update ($cat_id, $cat_title) {
        $query = " UPDATE categories SET cat_title = ? WHERE cat_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'si', $cat_title, $cat_id);
        return $stmt;
    }

    public static function delete ($cat_id) {
        $query = " DELETE FROM categories WHERE cat_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $cat_id);
        return $stmt;
    }

    // OPTIMIZE - extra features: 

    public static function select_by_id ($cat_id) {
        $query = " SELECT * FROM categories WHERE cat_id = ? ";
        $stmt = DBQuery::statement_handler($query, 'i', $cat_id);
        return $stmt;
    }

    public static function select_by_title ($cat_title) {
        $query = " SELECT * FROM categories WHERE cat_title = ? ";
        $stmt = DBQuery::statement_handler($query, 's', $cat_title);
        return $stmt;
    }
}


