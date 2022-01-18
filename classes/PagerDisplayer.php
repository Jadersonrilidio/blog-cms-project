<?php

class PagerDisplayer {

    protected $page_type;       /* Page Type: index:1, search:2, author:3, category:4 */
    private $total_posts;       /* total published posts, according to page_type */
    private $max_num_pg = 9;    /* Max amount of page-number-links the Pager will display (recommended to always be an odd number)(not considering Previous, Next, First and Last) */
    protected $limit;           /* number of posts displayed per page */
    protected $pg;              /* number of the current page (if any) */
    protected $id;              /* current identification id for category, author, search (if any) */

    public function __construct ($page_type=1, $id=NULL) {
        $this->page_type = $page_type;
        $this->limit = isset($_SESSION['limit']) ? InputHandler::escape($_SESSION['limit']) : 5; /* alter limit feature yet not implemented */
        $this->pg = isset($_GET['pg']) ? InputHandler::escape($_GET['pg']) : 1;
        $this->id = isset($id) ? $id : NULL;
        $this->total_posts = $this->get_total_posts_by_page_type();
    }

    public function display_pager ($limit=5) {
        if ($limit) $this->limit = $limit;
        
        if ($this->page_type == 1 && $this->total_posts == 0) {
            return;
        } else if ($this->total_posts == 0) {
            $this->return_btn_html();
            return;
        } else {
            $this->pager_html();
            return;
        }
    }

    private function return_btn_html () {
        ?>
            <ul class="pager">
                <li class="previous"> <a href="#" onClick="history.go(-1);"> &crarr; <?php echo PAGER_RETURN; ?> </a> </li> 
            </ul>
        <?php
    }

    private function pager_html () {
        ?>
            <ul class="pager">
                <li class="previous"> <a href="<?php $this->previous_page(); ?>"> &larr; <?php echo PAGER_PREVIOUS; ?> </a> </li>
                <?php $this->first_page(); $this->pages_number(); $this->last_page() ; ?>
                <li class="next"> <a href="<?php $this->next_page(); ?>"> <?php echo PAGER_NEXT; ?> &rarr; </a> </li>
            </ul>
        <?php
    }

    private function previous_page () {
        $prev_pg = ($this->pg > 2) ? ($this->pg - 1) : 1;
        echo "{$this->page_link()}/{$prev_pg}";
    }

    private function next_page () { 
        $next_pg = ($this->pg >= $this->total_pages()) ? ($this->total_pages()) : ($this->pg + 1);
        echo "{$this->page_link()}/{$next_pg}";
    }

    private function first_page () {
        echo "<li> <a href='{$this->page_link()}/1'> << </a> </li>";
    }

    private function last_page () {
        echo "<li> <a href='{$this->page_link()}/{$this->total_pages()}'> >> </a> </li>";
    }

    private function pages_number () {
        $pg = $this->pg;
        $total_pg = $this->total_pages(); 
        $max_num_pg = $this->max_num_pg;
        $magic_num = ($max_num_pg - 1) / 2;

        if ($total_pg <= $max_num_pg) {
            for ($i=1; $i<=$total_pg; $i++)
                $this->echo_page_number($i);
        } else {
            if ($pg <= $magic_num) 
                for ($i=1; $i<=$max_num_pg; $i++) 
                    $this->echo_page_number($i);
            else if ($pg >= $total_pg - $magic_num + 1) 
                for ($i=$total_pg-(2*$magic_num); $i<=$total_pg; $i++) 
                    $this->echo_page_number($i);
            else 
                for ($i=$pg-$magic_num; $i<=$pg+$magic_num; $i++) 
                    $this->echo_page_number($i);
        }
    }

    private function echo_page_number ($i) {
        echo ($i == $this->pg)
            ? "<li> <a class='active_link' href='{$this->page_link()}/{$i}'>{$i}</a> </li>"
            : "<li> <a href='{$this->page_link()}/{$i}'>{$i}</a> </li>";
    }

    private function page_link () {
        switch ($this->page_type) {
            case 1: return Config::REL_PATH."index";
            case 2: return Config::REL_PATH."search/{$this->id}";
            case 3: return Config::REL_PATH."author/{$this->id}";
            case 4: return Config::REL_PATH."category/{$this->id}";
        }
    }

    private function get_total_posts_by_page_type () {
        switch ($this->page_type) {
            case 1: return Post::count_posts_by_published();
            case 2: return !empty($this->id) ? Post::count_posts_by_search_pattern($this->id) : 0;
            case 3: return Post::count_posts_by_author($this->id);
            case 4: return Post::count_posts_by_category($this->id);;
        }
    }

    private function total_pages () {
        return ceil($this->total_posts / $this->limit);
    }
}

?>
