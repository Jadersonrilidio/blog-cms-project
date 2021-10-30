<?php




class MySQLDataBaseConnection {
    static private $host = 'localhost';
    static private $user = 'root';
    static private $password = '';
    static private $dbname = 'my_cms_project';

    static protected function connection () {
        return mysqli_connect(Self::$host, Self::$user, Self::$password, Self::$dbname);
    }
}




class DBQuery extends MySQLDataBaseConnection {

    public static function query_handler ($query, $case='result') {
        $connection = MySQLDataBaseConnection::connection();

        $result = mysqli_query($connection, $query);
        if (!$result) die("Query error No" . mysqli_errno($connection) . ": " . mysqli_error($connection));
        
        switch ($case) {
            case 'result':      return $result;                     break;
            case 'num_rows':    return mysqli_num_rows($result);    break;
            case 'assoc_array': return mysqli_fetch_assoc($result); break;
        }
    }

    public static function statement_handler ($query, string $param_types=NULL, mixed ...$param_values) {
        $connection = MySQLDataBaseConnection::connection();

        $stmt = mysqli_prepare($connection, $query);
        
        if(isset($param_types) && count([...$param_values]) > 0) {
            mysqli_stmt_bind_param($stmt, $param_types, ...$param_values);
        }

        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        return $stmt;
    }
}




class InputTreatment extends MySQLDataBaseConnection {

    public static function escape ($input) {
        $connection = MySQLDataBaseConnection::connection();
        return mysqli_real_escape_string($connection, trim(strip_tags($input)));
    }

    public static function password_handler ($password, $cost=12, $encript_type=PASSWORD_BCRYPT) {
        $password = Self::escape($password);
        $password = password_hash($password, $encript_type, array('cost' => $cost));
        return $password;
    }
}



?>