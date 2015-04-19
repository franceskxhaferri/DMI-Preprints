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
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
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
        </script>
    </head>
    <body>
        <?php
        #importo file per utilizzare funzioni...
        require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'authorization/sec_sess.php';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/check_nomi_data.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/insert_remove_db.php');
        sec_session_start();
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 86400)) {
            if ($_SESSION['logged_type'] === "mod" or $_SESSION['logged_type'] === "user") {
                //sessione moderatore
                ?>
                <div id="header-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="12u">
                                <header id="header">
                                    <h1><a href="#" id="logo">DMI Preprints</a></h1>
                                    <nav id="nav">
                                        <a href="main.php">preprint search</a>
                                        <a href="reserved.php" class="current-page-item">Reserved Area</a>
                                    </nav>
                                </header>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="div_menu_ricerca" class="contenitore"><center><br/><h2>ARCHIVED PREPRINTS</h2></center>
                </div><center>
                <table>
                    <tr><form name="f1" action="view_preprints.php?p=1" method="POST">
                        <td align="right">Go to current preprints&nbsp&nbsp&nbsp</td>
                        <td><input type="submit" name="bottoni7" value="Back" id="bottone_keyword" class="bottoni"/></td>
                    </form></tr>
                    <?php
                    if ($_SESSION['logged_type'] === "mod") {
                        echo "<tr><form name='f2' action='archived_preprints.php' method='GET'>
                        <td align='right'>Delete all archived preprints from database&nbsp&nbsp&nbsp</td>
                        <td><input type='submit' name='c' value='Remove all' id='bottone_keyword' class='bottoni'/></td>
                    </form></tr>";
                    }
                    ?>
                </table>
            </center>
            <?php
            if (sessioneavviata() == True) {
                echo "<br/><br/><center>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE SECTION CAN'T BE USED IN THIS MOMENT!</center><br/>";
            } else {
                echo "<br/><br/><center><a style='text-decoration: none;' href='javascript:FinePagina()'>&#8595; end of page</a></center><center><div><br/><br/><h2>preprints list</h2><hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'><br/>  ";
                if (isset($_GET['c'])) {
                    leggipreprintarchiviati();
                } else {
                    leggipreprintarchiviati();
                    echo "<center><a style='text-decoration: none;' href='javascript:window.scrollTo(0,0)'>&#8593; top of page</a></center><br/>";
                }
            }
        } else {
            echo "<center><br/>ACCESS DENIED!</center>";
            echo '<META HTTP-EQUIV="Refresh" Content="2; URL=./reserved.php">';
        }
    } else {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
    }
    ?>
</div></center>
</body>
</html>
