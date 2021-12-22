<?php include 'functions/f_navigationbar.php'; ?>

<nav class="navbar navbar-inverse navbar-fixed-top">

    <div class="container">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only"> Toggle navigation </span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo Config::REL_PATH; ?>index"> <?php echo NAV_HOME; ?> </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
            <!-- Left navbar Menus -->
            <ul class="nav navbar-nav navbar-left">
                
                <!-- Categories Dropdown -->
                <li class="nav-item dropdown">
                    <a style="font-size:1.1em" href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php echo NAV_CATEGORY; ?> <b class="caret"> </b>
                    </a>
                    <ul class="nav nav-item dropdown-menu">
                        <?php navbar_category_menus(); ?>
                    </ul>
                </li>

                <!-- Search form -->
                <li class="nav nav-item">
                    <form class="form-inline" style="margin-top:8px" action="<?php echo Config::REL_PATH."search"; ?>" method="GET" onsubmit="return false;">
                        <div class="input-group">
                            <input type="text" class="form-control" style="width:400px;height:36px" name="pattern" placeholder="<?php echo SIDEBAR_SEARCH_PLACEHOLDER; ?>">
                            <span class="input-group-btn" >
                                <button class="btn btn-default" style="width:50px;height:36px" type="submit" onclick="window.location.href=this.form.action + '/' + this.form.pattern.value;">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                </li>

            </ul>

            <!-- Right navbar menus -->
            <ul class="nav navbar-nav navbar-right">

                <!-- greeting text -->
                <?php navbar_greeting_logged_user(); ?>
                
                <!-- Contact Menu -->
                <li class='nav nav-item'> <a class='nav nav-link' href='<?php echo Config::REL_PATH."contact"; ?>'> <?php echo NAV_CONTACT; ?> </a> </li>

                <!-- Language Dropdown -->
                <li class="nav nav-item dropdown">
                    <form action="" class="nav na navbar-form" id="language_form" method="POST">
                        <label for="lang"> <i style="color:gray;font-size:1.2em" class="fa fa-fw fa-globe"></i> </label>
                        <select style="border:none;background-color:rgb(34, 32, 32);font-style:bold;color:gray;width:45px" class="nav nav-item form-control" name="lang" onchange="changeLanguage()">
                            <option class="nav nav-item" <?php LanguageHandler::select_language('en'); ?> value="en"> EN </option>
                            <option class="nav nav-item" <?php LanguageHandler::select_language('es'); ?> value="es"> ES </option>
                            <option class="nav nav-item" <?php LanguageHandler::select_language('pt'); ?> value="pt"> PT </option>
                            <option class="nav nav-item" <?php LanguageHandler::select_language('ru'); ?> value="ru"> RU </option>
                        </select> 
                    </form>
                </li>

                <!-- User Dropdown Menu -->
                <li class="nav nav-item dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo has_profile_image(); ?>
                        <?php echo dropdown_title(); ?> <b class="caret"> </b>
                    </a>
                    
                    <ul class="nav nav-item dropdown-menu">
                        <?php display_user_menus(); ?>
                    </ul>
                </li>

            </ul>
            
        </div> 
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
