<!DOCTYPE html>
<html>
    <head>
        <title>DMIPreprints</title>
        <!--<script src="js/jquery.min.js"></script>-->
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script src="js/config.js"></script>
        <script src="js/skel.min.js"></script>
        <script src="js/skel-panels.min.js"></script>
        <noscript>
        <link rel="stylesheet" href="css/skel-noscript.css" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/style-desktop.css" />
        </noscript>
        <link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" type="text/css" href="css/tabelle.css">
        <link rel="stylesheet" type="text/css" href="css/controlli.css">
        <script src="js/targetweb-modal-overlay.js"></script>
        <link href='css/targetweb-modal-overlay.css' rel='stylesheet' type='text/css'>
        <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
        <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
        <script>
            webshims.setOptions('waitReady', false);
            webshims.setOptions('forms-ext', {types: 'date'});
            webshims.polyfill('forms forms-ext');
        </script>

        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
        </script>
        <script type="text/javascript"
                src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
        </script>
        <script type="text/javascript">
            function FinePagina()
            {
                var w = window.screen.width;
                var h = window.screen.height;
                window.scrollTo(w * h, w * h)
            }
            function showHide(id)
            {
                if (id.style.display != 'block')
                    id.style.display = 'block';
                else
                    id.style.display = 'none';
            }
        </script>
    </head>
    <body>
        <?php
        if ($_GET['w'] != "0") {
            $view = 0;
            $upview = 1;
            $string = "Disable";
        } else {
            $view = 1;
            $upview = 0;
            $string = "Enable";
        }
        #importo file per utilizzare funzioni...
        require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'authorization/sec_sess.php';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/check_nomi_data.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/insert_remove_db.php');
        sec_session_start();
        if ($_SESSION['logged_type'] === "mod") {
            $t = "Go to arXiv panel";
            $rit = "arXiv_panel.php";
            $nav = "<header id='header'>
                                    <h1><a href='#' id='logo'>DMI Preprints</a></h1>
                                    <nav id='nav'>
                                        <a href='main.php'>DMI Publications</a>
                                        <a href='view_preprints.php?p=1&w=0'>arXiv Publications</a>
                                        <a href='reserved.php' class='current-page-item'>Reserved Area</a>
                                    </nav>
                                </header>";
        } else if ($_SESSION['logged_type'] === "user") {
            $t = "Go to reserved area";
            $rit = "reserved.php";
            $nav = "<header id='header'>
                                    <h1><a href='#' id='logo'>DMI Preprints</a></h1>
                                    <nav id='nav'>
                                        <a href='main.php'>DMI Publications</a>
                                        <a href='view_preprints.php?p=1&w=0' class='current-page-item'>arXiv Publications</a>
                                        <a href='reserved.php'>Reserved Area</a>
                                    </nav>
                                </header>";
        } else {
            $t = "Go to homepage";
            $rit = "main.php";
            $nav = "<header id='header'>
                                    <h1><a href='#' id='logo'>DMI Preprints</a></h1>
                                    <nav id='nav'>
                                        <a href='main.php'>DMI Publications</a>
                                        <a href='view_preprints.php?p=1&w=0' class='current-page-item'>arXiv Publications</a>
                                        <a href='reserved.php'>Reserved Area</a>
                                    </nav>
                                </header>";
        }
        if ($_SESSION['logged_type'] != "mod") {
            $str1 = "<h1><center>in this section are the preprints that have been published by the <a style='color:#007897;' href='./authors_list.php' onclick='window.open(this.href); return false'>authors</a> of the department on arxiv.org</center></h1>";
            $str2 = "ARXIV PREPRINTS";
        } else {
            $str2 = "APPROVED PREPRINTS";
        }
        ?>
        <div id="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="12u">
                        <?php echo $nav; ?>
                    </div>
                </div>
            </div>
        </div>
        <div><center><br/><br/><h2><?php echo $str2; ?></h2></center>
            <?php
            echo $str1;
            ?>
        </div><center>
        <?php
        if ($_SESSION['logged_type'] === "mod") {
            echo "<form name='f1' action='$rit' method='GET'>
		        $t&nbsp&nbsp&nbsp
		        <input type='submit' name='b1' value='Back' id='bottone_keyword' class='bottoni'/>
		    </form>
		    ";
        }
        ?>
        <br/><a style='color:#007897;' href="archived_preprints.php?p=1" onclick='window.open(this.href);
                return false'>Archived preprints</a><br/><br/>
        <form name="f5" action="view_preprints.php?p=1&w=<?php echo $view; ?>" method="POST">
            Enable/Disable on page view
            <input type="submit" style="width:40px;" name="w" value="<?php echo $string; ?>" id="bottone_keyword" class="bottoni"/>
        </form>
        <form name="f4" action="view_preprints.php" method="GET">
            <input type="text" name="p" value="1" hidden>
            <input type="text" name="w" value="<?php echo $upview; ?>" hidden>
            Advanced:
            <input type="button" value="Show/Hide" onclick="javascript:showHide(adv);"/>
            Filter by
            <select name="f">
                <option value="all" selected="selected">All preprint:</option>
                <option value="author">Authors:</option>
                <option value="category">Category:</option>
                <option value="year">Year:</option>
                <option value="id">Identifier(ID):</option>
            </select>
            <input type="search" autocomplete = "off" style="width:200px;" name="r" placeholder="Author name or part, etc." value="<?php echo $_GET['r']; ?>"/>
            <input type="submit" name="s" value="Go"/>
            <div id="adv" hidden>
                <div style="float:left; width:37%;" align="right">Search on:</div>
                <div style="float:right; width:63%;" align="left">
                    <label><input type="checkbox" name="d" value="1">Include-archived</label>
                    <label><input type="checkbox" name="all" value="1">Record</label>
                    <label><input type="checkbox" name="h" value="1">Author</label>
                    <label><input type="checkbox" name="t" value="1">Title</label>
                    <label><input type="checkbox" name="e" value="1">Year</label><br/>
                    <label><input type="checkbox" name="a" value="1">Abstract</label>
                    <label><input type="checkbox" name="y" value="1">Category</label>
                    <label><input type="checkbox" name="c" value="1">Comments</label>
                    <label><input type="checkbox" name="j" value="1">Journal-ref</label>
                    <label><input type="checkbox" name="i" value="1">ID</label>
                </div>
                <div style="float:right; width:100%;" align="center">Order by:
                    <label><input type="radio" name="o" value="dated" checked>Date(D)</label>
                    <label><input type="radio" name="o" value="datec">Date(I)</label>
                    <label><input type="radio" name="o" value="idd">ID(D)</label>
                    <label><input type="radio" name="o" value="idc">ID(I)</label>
                    <label><input type="radio" name="o" value="named">Name(D)</label>
                    <label><input type="radio" name="o" value="namec">Name(I)</label>
                </div><br/><br/><br/>
            </div>
        </form>
        <?php
        echo "<br/><center><a style='text-decoration: none;' href='javascript:FinePagina()'> &nbsp&nbsp&nbsp&nbsp&nbsp&#8595;&nbsp&nbsp&nbsp&nbsp&nbsp </a></center><center>";
        if (isset($_GET['s'])) {
            if ($_GET['t'] == 1 or $_GET['a'] == 1 or $_GET['c'] == 1 or $_GET['j'] == 1 or $_GET['h'] == 1 or $_GET['y'] == 1 or $_GET['all'] == 1 or $_GET['d'] == 1 or $_GET['e'] or $_GET['i']) {
                searchpreprint();
                echo "<center><a style='text-decoration: none;' href='javascript:window.scrollTo(0,0)'>&nbsp&nbsp&nbsp&nbsp&nbsp&#8593;&nbsp&nbsp&nbsp&nbsp&nbsp </a></center><br/>";
            } else {
                #funzione lettura e filtro preprint
                filtropreprint();
                echo "<center><a style='text-decoration: none;' href='javascript:window.scrollTo(0,0)'>&nbsp&nbsp&nbsp&nbsp&nbsp&#8593;&nbsp&nbsp&nbsp&nbsp&nbsp </a></center><br/>";
            }
        } else {
            if ($_GET['t'] == 1 or $_GET['a'] == 1 or $_GET['c'] == 1 or $_GET['j'] == 1 or $_GET['h'] == 1 or $_GET['y'] == 1 or $_GET['all'] == 1 or $_GET['d'] == 1 or $_GET['e'] or $_GET['i']) {
                searchpreprint();
                echo "<center><a style='text-decoration: none;' href='javascript:window.scrollTo(0,0)'>&nbsp&nbsp&nbsp&nbsp&nbsp&#8593;&nbsp&nbsp&nbsp&nbsp&nbsp </a></center><br/>";
            } else {
                #funzione lettura e filtro preprint
                filtropreprint();
                echo "<center><a style='text-decoration: none;' href='javascript:window.scrollTo(0,0)'> &nbsp&nbsp&nbsp&nbsp&nbsp&#8593;&nbsp&nbsp&nbsp&nbsp&nbsp </a></center><br/>";
            }
        }
        ?>
    </div>
</body>
</html>
