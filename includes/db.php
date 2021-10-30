<?php

class MyDB {
    private $connection;
    
    function __construct ($host, $user, $password, $dbname) {
        $this->connection = mysqli_connect($host, $user, $password, $dbname);
    }

    function get_connection () {
        return $this->connection;
    }

    /**
     * @author Jay;
     */
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

    /**
     * @author Jay;   
     */
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

    /**
     * @author Jay
     * @example escape any inserted input by the GET/POST super global variables;
     * 
     * @param input : data to be treated before use on queries;
     * @global connection : database connection;
     */
    public static function input_handler ($input) : string {
        global $connection;
        return mysqli_real_escape_string($connection, trim(strip_tags($input)));
    }

    /**
     * @author Jay;
     */
    public static function password_handler ($password, $cost = 12, $encript_type = PASSWORD_BCRYPT) {
        $password = MyDB::input_handler($password);
        $password = password_hash($password, $encript_type, array('cost' => $cost));
        return $password;
    }
}

$mydb = new MyDB('localhost', 'root', '', 'my_cms_project');
$connection = $mydb->get_connection();

?>