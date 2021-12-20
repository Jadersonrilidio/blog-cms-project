<?php


class LanguageHandler {

    private $language;
    private $default = 'en';

    public function __construct() {
        $this->language = (isset($_POST['lang'])) ? ($_POST['lang']) : $this->default;
        if (!isset($_SESSION['lang'])) $_SESSION['lang'] = $this->default;
    }
    
    public function set_language () {
        if (!isset($_SESSION['lang']) || $_SESSION['lang'] != $this->language) {
            $_SESSION['lang'] = $this->language;
            echo "<script type='text/javascript'> location.reload(); </script>";
        } 
    }
    
    static public function select_language ($language) {
        if ($_SESSION['lang'] == $language) echo "selected";
    }

    static public function include_language_file () {
        include "languages/{$_SESSION['lang']}.php";
    }

    static public function load_session_language () {
        if (!isset($_SESSION['lang'])) $_SESSION['lang'] = 'en';
        if (isset($_POST['lang'])) {
            $lang = new LanguageHandler();
            $lang->set_language();
        }
        LanguageHandler::include_language_file();
    }
}


?>