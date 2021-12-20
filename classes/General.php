
<?php

users_site_online_count();

function users_site_online_count () {
    if (isset($_GET['onlineusers'])) {
        
        session_start();
        require '../vendor/autoload.php';
        
        $session = session_id();
        $time = time();
        $timeout_seconds = 30;
        $timeout = $time - $timeout_seconds;

        $query = "SELECT * FROM users_online WHERE users_online_session = '$session'";
        $num_rows = QueryHandler::query_handler($query, 'num_rows');

        if ($num_rows == NULL) {
            $query = "INSERT INTO users_online(users_online_session,users_online_time) VALUES('$session','$time') ";
            QueryHandler::query_handler($query, 'result');
        } else {
            $query = "UPDATE users_online SET  users_online_time = '$time' WHERE users_online_session = '$session' ";
            QueryHandler::query_handler($query, 'result');
        }
        
        $query = "SELECT * FROM users_online WHERE users_online_time > '$timeout' ";
        $num_rows = QueryHandler::query_handler($query, 'num_rows');

        echo $num_rows;
    }
}


?>