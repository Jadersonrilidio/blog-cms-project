<?php

class MyDataBase {
    private $connection;
    
    function __construct ($host, $user, $password, $dbname) {
        $this->connection = mysqli_connect($host, $user, $password, $dbname);
    }

    function get_connection () {
        return $this->connection;
    }

    public static function query_handler ($query, $case='result') {
        global $connection;

        $result = mysqli_query($connection, $query);
        if (!$result) die("Query failed: " . mysqli_error($connection));
        
        switch ($case) {
            case 'result':
                return $result;
                break;
            case 'num_rows':
                return mysqli_num_rows($result);
                break;
            case 'assoc_array':
                return mysqli_fetch_assoc($result);
                break;
            default:
                return $result;
                break;
        }
    }

    public static function statement_handler ($query, $param_types=NULL, ...$param_values) {
        global $connection;

        $stmt = mysqli_prepare($connection, $query);
        
        if(isset($param_types) && count([...$param_values]) > 0) {
            mysqli_stmt_bind_param($stmt, $param_types, ...$param_values);
        }
        
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        return $stmt;
    }
}

$mydb = new MyDataBase('localhost', 'root', '', 'my_cms_project');
$connection = $mydb->get_connection();


?>