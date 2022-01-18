<?php

function echo_admin_username () {
    if (isset($_SESSION['user_name'])) echo $_SESSION['user_name'];
}

?>