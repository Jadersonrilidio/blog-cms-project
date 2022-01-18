<?php 

class RedLink {

    static public function github_repo_link () {
        echo 
        "<p> 
            <a class='btn my-red-btn' href='https://github.com/Jadersonrilidio/cms' target='_blank'>
                Github repository 
            </a>
        </p>";
    }

    static public function github_PagerDisplayer_link () {
        echo 
            "<p> 
                <a class='btn my-red-btn' href='https://github.com/Jadersonrilidio/cms/blob/master/classes/PagerDisplayer.php' target='_blank'>
                    Github repository: <small> PagerDisplayer class code </small> 
                </a>
            </p>";
    }

    static public function github_populate_database_link () {
        echo 
        "<p> 
            <a class='btn my-red-btn' href='https://github.com/Jadersonrilidio/cms/blob/master/functions/f_populate_database.php' target='_blank'>
                Github repository: <small> Populate Database functions </small>
            </a>
        </p>";
    }

    static public function github_mysql_database_link () {
        echo 
        "<p> 
            <a class='btn my-red-btn' href='https://github.com/Jadersonrilidio/cms/tree/master/db' target='_blank'>
                Github repository: <small> database.sql file </small>
            </a>
        </p>";
    }

    static public function github_admin_link () {
        echo 
        "<li class='nav nav-item my-red-navlink'> 
            <a class='nav nav-link my-red-navlink' style='background-color:red;color:white' href='https://github.com/Jadersonrilidio/cms/tree/master/admin' target='_blank'> 
                Github repository: <small> CMS page content </small>
            </a> 
        </li>";
    }

    static public function populate_database_page_link () {
        echo 
        "<li class='nav nav-item'> 
            <a class='nav nav-link' style='background-color:red;color:white' href='".Config::REL_PATH."populate_database'> 
                Populate DataBase <small> </small>
            </a> 
        </li>";
    }
}

?>