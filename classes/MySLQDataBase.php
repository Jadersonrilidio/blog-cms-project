
<?php





class MySQLDataBaseConnection {
    private const HOST = 'localhost';
    private const USER = 'root';
    private const PSWD = '';
    private const DBNAME = 'blog_cms';

    static protected function connection () {
        return mysqli_connect(Self::HOST, Self::USER, Self::PSWD, Self::DBNAME);
    }
}





class QueryHandler extends MySQLDataBaseConnection {

    static public function query_handler ($query, $case='result') {
        $connection = MySQLDataBaseConnection::connection();
        $result = mysqli_query($connection, $query);
        if (!$result) die("Query error No" . mysqli_errno($connection) . ": " . mysqli_error($connection));
        
        switch ($case) {
            case 'result':      return $result; 
            case 'num_rows':    return mysqli_num_rows($result); 
            case 'assoc_array': return mysqli_fetch_assoc($result); //fetches only one row set of values
        }
    }

    static public function statement_handler ($query, string $param_types=NULL, mixed ...$param_values) {
        $connection = MySQLDataBaseConnection::connection();
        $stmt = mysqli_prepare($connection, $query);
        if (isset($param_types)) mysqli_stmt_bind_param($stmt, $param_types, ...$param_values);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        return $stmt;
    }
}





class InputHandler extends MySQLDataBaseConnection {

    static public function escape ($input) {
        $connection = MySQLDataBaseConnection::connection();
        return mysqli_real_escape_string($connection, trim(strip_tags($input)));
    }

    static public function password_handler ($password, $cost=12, $encript_type=PASSWORD_BCRYPT) {
        $password = Self::escape($password);
        $password = password_hash($password, $encript_type, array('cost' => $cost));
        return $password;
    }
}





?>
