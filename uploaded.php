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
        <script type='text/javascript'>
            function confirmInsert()
            {
                return confirm("Are you sure?");
            }
            function confirmLogout()
            {
                return confirm("All unsaved information will be lost, exit?");
            }
        </script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({
            tex2jax: {
            inlineMath: [["$","$"],["\\(","\\)"]]
            }
            });
        </script>
        <script type="text/javascript"
                src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML-full">
        </script>
    </head>
    <body>
        <?php
        #importo file per utilizzare funzioni...
        require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'authorization/sec_sess.php';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/check_nomi_data.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'mysql/func.php');
        sec_session_start();
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 86400)) {
            if ($_SESSION['logged_type'] === "mod" or $_SESSION['logged_type'] === "user") {
                //sessione moderatore
                if ($_SESSION['logged_type'] === "mod") {
                    $ind = "modp.php";
                } else {
                    $ind = "userp.php";
                }
                ?>
                <div id="header-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="12u">
                                <header id="header">
                                    <h1><a href="#" id="logo">DMI Papers</a></h1>
                                    <nav id="nav">
                                        <a href='./view_preprints.php'>Publications</a>
                                        <a href="./reserved.php" class="current-page-item">Reserved Area</a>
                                    </nav>
                                </header>
                            </div>
                        </div>
                    </div>
                </div>
            <center><div><br/>
                    Go back to new insertion: <a style="color:white;" href="<?php echo $ind; ?>" id="bottoni" class="bottoni">Back</a>
                </div>
                <?php
                if ($_COOKIE['searchbarall'] == "1") {
                    #search bar
                    echo "<center><div style='width:100%; padding: 10px; position: fixed; bottom: 0px;'>
				    	<form name='f3' action='view_preprints.php' method='GET'>
					<input type='submit' name='More' value='More'/>
					<select name='f'>
					    <option value='all' selected='selected'>All papers:</option>
					    <option value='author'>Authors:</option>
					    <option value='category'>Category:</option>
					    <option value='year'>Year:</option>
					    <option value='id'>ID:</option>
					</select>
					<input type='search' autocomplete = 'on' style='width:20%;' name='r' placeholder='Author name, part, etc.' value='" . $_GET['r'] . "'/>
				    <input type='submit' name='s' value='Send'/>
				    <input type='text' name='o' value='dated' hidden>
				    </form></div>
				    <form name='f4' action='view_preprints.php' method='GET'>
			<div id='adv' hidden><br/>
			<font color='#007897'>Advanced search:</font><br/>
				<div style='height:30px;'>
				Filter by
				<select name='f'>
				    <option value='all' selected='selected'>All papers:</option>
				    <option value='author'>Authors:</option>
				    <option value='category'>Category:</option>
				    <option value='year'>Year:</option>
				    <option value='id'>ID:</option>
				</select>
				<input type='search' autocomplete = 'on' style='width:40%;' name='r' placeholder='Author name, part, etc.' value='" . $_GET['r'] . "'/> <input type='submit' name='s' value='Send'/></form></div></center>";
                }
                #lettura preprint caricati
                leggiupload($_SESSION['nome'] . " (" . $_SESSION['uid'] . ")");
            } else {
                echo '<script type="text/javascript">alert("ACCESS DENIED!");</script>';
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
            }
        } else {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
        }
        ?>
    </div></center><br/><br/>
</body>
</html>
