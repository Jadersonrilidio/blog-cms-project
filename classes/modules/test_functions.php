<?php include "./includes/db.php"; ?>

<?php

function before_function_execute (string $function_name, $check_var = null, string $case = 'default', $param = null) {
    switch ($case) {
        case 'isset':
            echo "case isset <br>";
            if (isset($check_var)) $function_name($param);
            break;
        case 'notset':
            echo "case notset <br>";
            if (!isset($check_var)) $function_name($param);
            break;
        case 'empty':
            echo "case empty <br>";
            if (empty($check_var)) $function_name($param);
            break;
        case 'notempty':
            echo "case notempty <br>";
            if (!empty($check_var)) $function_name($param);
            break;
        case 'true':
            echo "case true <br>";
            if ($check_var) $function_name($param);
            break;
        case 'false':
            echo "case false <br>";
            if (!$check_var) $function_name($param);
            break;
        default:
        echo "default <br>";
            $function_name($param);
            break;
    }
}

?>
