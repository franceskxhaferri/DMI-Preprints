<!DOCTYPE html>
<html>
    <head>
        <title>DMI Papers</title>
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
                src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
        </script>
        <script type="text/javascript" src="./js/allscript.js">
        </script>
        <?php
        #controllo cookie pageview
        if ($_COOKIE['pageview'] == "") {
            echo "<script>javascript:checkCookie4();</script>";
        } else {
            if ($_COOKIE['pageview'] == "0") {
                $string = "Enable";
            } else {
                $string = "Disable";
            }
        }
        #disabilita searchbar su altre pagine
        if ((isset($_GET['clos'])) && $_GET['clos'] == "1" && $_COOKIE['searchbarall'] == "1") {
            echo "<script>javascript:checkCookie7();</script>";
            echo "<meta http-equiv='refresh' content='0'; URL=./view_preprints.php>";
        }
        #controllo cookie searchbar all
        if ($_COOKIE['searchbarall'] == "0" or ! isset($_COOKIE['searchbarall'])) {
            $string3 = "Enable";
        } else {
            $string3 = "Disable";
        }
        ?>
    </head>
    <body><?php
        require_once './graphics/header_main_page.php';
        sec_session_start();
        if (isset($_SESSION['logged_type']) && $_SESSION['logged_type'] === "mod") {
            $t = "Go to arXiv panel";
            $rit = "arXiv_panel.php";
            $nav = "<header id='header'>
                                    <h1><a href='#' id='logo'>DMI Papers</a></h1>
                                    <nav id='nav'>
                                        <a href='./index.php' class='current-page-item' onclick='loading(load);'>Publications</a>
                                        <a href='./reserved.php' onclick='loading(load);'>Reserved Area</a>
                                    </nav>
                                </header>";
        } else if (isset($_SESSION['logged_type']) && $_SESSION['logged_type'] === "user") {
            $t = "Go to reserved area";
            $rit = "reserved.php";
            $nav = "<header id='header'>
                                    <h1><a href='#' id='logo'>DMI Papers</a></h1>
                                    <nav id='nav'>
                                        <a href='./index.php' class='current-page-item' onclick='loading(load);'>Publications</a>
                                        <a href='./reserved.php' onclick='loading(load);'>Reserved Area</a>
                                    </nav>
                                </header>";
        } else {
            $t = "Go to homepage";
            $rit = "main.php";
            $nav = "<header id='header'>
                                    <h1><a href='#' id='logo'>DMI Papers</a></h1>
                                    <nav id='nav'>
                                        <a href='./index.php' class='current-page-item' onclick='loading(load);'>Publications</a>
                                        <a href='./reserved.php' onclick='loading(load);'>Reserved Area</a>
                                    </nav>
                                </header>";
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
        </div><br/><br/>
    <center>
        <?php
        echo "<div id='gotop' hidden><a id='scrollToTop' title='Go top'><img style='width:25px; height:25px;' src='./images/top.gif'></a></div>";
        ?>
        <br/>
    </div><br/><br/><br/><br/>
    <div class="searchboxContainer" align="center">
        <form name="f1" action="view_preprints.php" method="GET" onsubmit="loading(load);">
            <?php
            if ($_GET['advanced'] == "yes") {
                echo '<div><a href="./index.php" style="color:#ffffff; float:left;" class="buttonNav2" >Simple Search</a></div>
                    	<div><a href="./index.php?advanced=yes" style="color:#3C3C3C; float:left;" class="buttonNav" >Advanced Search</a></div>
                        <div><a href="./index.php?fulltext=yes" style="color:#ffffff; float:left;" class="buttonNav2" >Fulltext Search</a></div>';
                $html = "<div class='adv' align='center'>
                    <input type='search' value='" . $_GET['r'] . "' autocomplete = 'on' class='searchbar' name='r' placeholder='Author name, id of publication, year of publication, etc.' required>
                    <input type='submit' name='s' value='Send' class='button' style='width:60px; height: 25px;'><br/><br/>
                        <div align='left' class='restrictionbox'>
                            Reset form selections:<br/>
	                    <input type='reset' name='reset' value='Reset'><br/><br/><br/>
                            Years restriction:<br/>
                            From <input type='text' name='year2' style='width:35px' placeholder='First' class='textbox'> to <input type='text' name='year3' style='width:35px' placeholder='Last' class='textbox'>
                            <br/><br/><br/>
                            Results for page:<br/>
                            <select name='rp'>
                                <option value='5' selected='selected'>5</option>
                                <option value='10'>10</option>
                                <option value='15'>15</option>
                                <option value='20'>20</option>
                                <option value='25'>25</option>
                                <option value='50'>50</option>
                            </select>
                        </div>
                        <div align='left' class='searchonbox'>
                            Search on:<br/>
                            <label><input type='checkbox' name='d' value='1' id='d' class='checkbox'>Archived</label><br/>
                            <label><input type='checkbox' name='all' value='1' id='all' class='checkbox' onChange='DisAllFields(this.id);'>Full Record</label><br/>
                            <label><input type='checkbox' name='h' value='1' id='h' class='checkbox'>Author(s)</label><br/>
                            <label><input type='checkbox' name='t' value='1' id='t' class='checkbox'>Title</label><br/>
                            <label><input type='checkbox' name='a' value='1' id='a' class='checkbox'>Abstract</label><br/>
                            <label><input type='checkbox' name='e' value='1' id='e' class='checkbox'>Date</label><br/>
                            <label><input type='checkbox' name='y' value='1' id='y' class='checkbox'>Category</label><br/>
                            <label><input type='checkbox' name='c' value='1' id='c' class='checkbox'>Comments</label><br/>
                            <label><input type='checkbox' name='j' value='1' id='j' class='checkbox'>Journal Ref</label><br/>
                            <label><input type='checkbox' name='i' value='1' id='i' class='checkbox'>Identifier(ID)</label><br/>
                        </div>
                        <div align='left' class='orderbox'>
                            Order results:<br/>
                            <label><input type='radio' name='o' value='dated' checked>Publication Date &#8595;</label><br/>
                            <label><input type='radio' name='o' value='datec'>Publication Date &#8593;</label><br/>
                            <label><input type='radio' name='o' value='idd'>Identifier(ID) &#8595;</label><br/>
                            <label><input type='radio' name='o' value='idc'>Identifier(ID) &#8593;</label><br/>
                            <label><input type='radio' name='o' value='named'>Author Name &#8595;</label><br/>
                            <label><input type='radio' name='o' value='namec'>Author Name &#8593;</label><br/>
                        </div>
                        <div style='clear:both;'></div></div>";
            } else if ($_GET['fulltext'] == "yes") {
                echo '<div><a href="./index.php" style="color:#ffffff; float:left;" class="buttonNav2" >Simple Search</a></div>'
                . '<div><a href="./index.php?advanced=yes" style="color:#ffffff; float:left;" class="buttonNav2" >Advanced Search</a></div>'
                . '<div><a href="./index.php?fulltext=yes" style="color:#3C3C3C; float:left;" class="buttonNav" >Fulltext Search</a></div>';
                $html = "<div class='fulltext' align='center'>
                        <form name='f2' action='view_preprints.php' method='GET' onsubmit='loading(load);'>
                            <input type='search' value='" . $_GET['ft'] . "' autocomplete = 'on' class='searchbar' name='ft' placeholder='Insert phrase, name, keyword, etc.'/>
                            <input type='submit' name='go' value='Send' style='width:60px; height: 25px;' class='button'/><br/><br/>
                             <div align='left' class='restrictionbox'>
		                    Reset form selections:<br/>
		                    <input type='reset' name='reset' value='Reset'><br/><br/>
                            </div>
                            <div align='left' class='restrictionbox'>
		                    Results for page:<br/>
		                    <select name='rp'>
		                        <option value='5' selected='selected'>5</option>
		                        <option value='10'>10</option>
		                        <option value='15'>15</option>
		                        <option value='20'>20</option>
		                        <option value='25'>25</option>
		                        <option value='50'>50</option>
		                    </select><br/><br/>
                            </div>
                            <div align='left' class='searchonbox'>
		                    Search on: <br/>
		                    <label><input type='radio' name='st' value='1' checked>Currents</label><br/>
		                    <label><input type='radio' name='st' value='0'>Archived</label><br/>
                            </div>
                        </form><div style='clear:both;'></div></div>
                    </div>";
            } else {
                echo '<div><a href="./index.php" style="color:#3C3C3C; float:left;" class="buttonNav" >Simple Search</a></div>'
                . '<div><a href="./index.php?advanced=yes" style="color:#ffffff; float:left;" class="buttonNav2" >Advanced Search</a></div>'
                . '<div><a href="./index.php?fulltext=yes" style="color:#ffffff; float:left;" class="buttonNav2" >Fulltext Search</a></div>';
                $html = "<div class='simple'>
                    <select name='f' class='selector' style='height: 25px;'>
                        <option value='all' selected='selected'>All papers:</option>
                        <option value='author'>Authors:</option>
                        <option value='category'>Category:</option>
                        <option value='year'>Year:</option>
                        <option value='id'>ID:</option>
                    </select>
                    <input type='radio' name='o' value='dated' checked hidden>
                    <input style='width:65%;' type='search' autocomplete = 'on' class='searchbar' name='r' placeholder='Author name, year of publication, etc.' required>
                    <input type='submit' name='s' value='Send' class='button' style='width:60px; height: 25px;'>
                </div>";
            }
            ?>
            <div class="searchbox"><br/>
                <?php
                echo $html;
                ?>
            </div>
        </form>
    </div><br/><br/><br/>
    <div align="center">
        <h2>Latest insertions</h2>
        <?php
        require_once './recents.php';
        require_once './graphics/loader.php';
        ?>
    </div>
</center>
</div>
</body>
</html>
