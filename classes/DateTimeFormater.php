<?php

class DateTimeFormater {
    
    static public function display_post_datetime ($datetime) {
        $date = date_create($datetime);
        $date = date_format($date, 'F d, Y - H:i.');
        return $date;
    }
    
    static public function display_comment_datetime ($datetime) {
        $date = date_create($datetime);
        $date = date_format($date, 'F d, Y - H:i:s.');
        return $date;
    }
    
}

?>