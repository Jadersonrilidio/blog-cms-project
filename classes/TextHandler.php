<?php

class TextHandler {

    static public function text_shrink ($content, $num_chars) {
        $content = trim(strip_tags($content));
        if (strlen($content) >= $num_chars) {
            $content = substr($content, 0, $num_chars);
            $content = substr($content, 0, strrpos($content, ' ')) . "&emsp;... ";
        }
        return $content;
    }

    static public function text_comment_shrink ($content, $num_chars, $id) {
        $content = trim(strip_tags($content));
        if (strlen($content) >= $num_chars) {
            $content_main = substr($content, 0, $num_chars);
            $content_main = substr($content_main, 0, (strrpos($content_main, ' ')));
            $content_rest = substr($content, strlen($content_main), strlen($content));

            echo "<p style='text-align:justify'>{$content_main}";
            echo "<span id='comment-dots-{$id}'> ... </span>";
            echo "<span class='my-display-none' id='comment-more-{$id}'>{$content_rest}</span>";
            echo "&ensp; <a class='my-link' onclick='commentReadMore({$id},{$_SESSION['lang']})' id='comment-btn-{$id}'>".COMMENT_READ_MORE."</a>";
            echo "</p>";
        } else {
            echo "<p>{$content}</p>";
        }
    }
}


?>