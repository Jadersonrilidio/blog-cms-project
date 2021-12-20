<?php


class PagerDisplayer {

    protected $case;        /* index=1, search=2, author=3, category=4 */
    private $total_posts;
    private $num_pgs = 9;
    protected $limit = 5;
    protected $pg;
    protected $id;

    public function __construct (int $case=1, mixed $id=NULL) {
        $this->case = $case;
        $this->pg = isset($_GET['pg']) ? InputHandler::escape($_GET['pg']) : 1;
        $this->id = isset($id) ? $id : NULL;
        $this->total_posts = $this->get_total_posts_by_case();
    }

    public function display_pager ($limit=5) {
        if ($limit) $this->limit = $limit;
        
        if ($this->case == 1 && $this->total_posts == 0) {
            exit;
        } else if ($this->total_posts == 0) {
            $this->return_btn_html();
        } else {
            $this->pager_html();
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
        echo "{$this->select_link()}/{$prev_pg}";
    }

    private function next_page () { 
        $next_pg = ($this->pg >= $this->total_pages()) ? ($this->total_pages()) : ($this->pg + 1);
        echo "{$this->select_link()}/{$next_pg}";
    }

    private function first_page () {
        echo "<li> <a href='{$this->select_link()}/1'> << </a> </li>";
    }

    private function last_page () {
        echo "<li> <a href='{$this->select_link()}/{$this->total_pages()}'> >> </a> </li>";
    }

    private function pages_number () {
        $pg = $this->pg;
        $total_pg = $this->total_pages(); 
        $num_pgs = $this->num_pgs;
        $magic_num = ($num_pgs - 1) / 2;

        if ($pg <= ($num_pgs+1)/2) {
            
            if ($total_pg <= $num_pgs) {
                for ($i=1; $i<=$total_pg; $i++) {
                    $this->echo_page_number($i, $pg);
                }
            } else {
                for ($i=1; $i<=9; $i++) {
                    $this->echo_page_number($i, $pg);
                }
            }

        } else {

            if ($pg-$magic_num < 1) {
                for ($i=1; $i<=$pg; $i++) {
                    $this->echo_page_number($i, $pg);
                    $num_pgs -= 1;
                }

            } else if ($pg+$magic_num > $total_pg) {

                $cols = $num_pgs - $total_pg - 1 + $pg;
                for ($i=$pg-$cols; $i<=$pg; $i++) {
                    $this->echo_page_number($i, $pg);
                    $num_pgs -= 1;
                }
                
            } else {

                for ($i=$pg-$magic_num; $i<=$pg; $i++) {
                    $this->echo_page_number($i, $pg);
                    $num_pgs -= 1;
                }
            }
        
            for ($i=$pg+1; $i<=$pg+$num_pgs; $i++) {
                $this->echo_page_number($i, $pg);
            }
        }
    }

    private function echo_page_number ($i, $pg) {
        echo ($i == $pg)
            ? "<li> <a class='active_link' href='{$this->select_link()}/{$i}'>{$i}</a> </li>"
            : "<li> <a href='{$this->select_link()}/{$i}'>{$i}</a> </li>";
    }

    private function select_link () {
        switch ($this->case) {
            case 1: return Config::REL_PATH."index";
            case 2: return Config::REL_PATH."search/{$this->id}";
            case 3: return Config::REL_PATH."author/{$this->id}";
            case 4: return Config::REL_PATH."category/{$this->id}";
        }
    }

    private function get_total_posts_by_case () {
        switch ($this->case) {
            case 1: return Post::count_posts_by_status(1);
            case 2: return !empty($this->id) ? Post::posts_count_by_search_pattern($this->id) : 0;
            case 3: return Post::count_posts_by_author($this->id);
            case 4: return Post::count_posts_by_category($this->id);;
        }
    }

    private function total_pages () {
        return ceil($this->total_posts / $this->limit);
    }
}


?>