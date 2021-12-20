
<?php

function sidebar_category_menus ($val=0) {
    $stmt = Category::select_all('statement');
    mysqli_stmt_bind_result($stmt, $id, $title);
    
    $counter = 0;
    while (mysqli_stmt_fetch($stmt)) {
        if ($counter % 2 == $val) {
            echo "<li> <a href='".Config::REL_PATH."category/{$id}'>{$title}</a> </li>";
        }
        $counter++;
    }
}


?>