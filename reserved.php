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
        <link rel="stylesheet" type="text/css" href="css/tabelle.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <link rel="stylesheet" type="text/css" href="css/controlli.css">
        <link rel="stylesheet" type="text/css" href="css/uploadForm.css">
        <!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
    </head>
    <body>
        <script>
            function logout() {
                $("#container_principale").load("reserved/logout.php", function () {
                    $("#container_principale").load("reserved/submit_loginChooser.php", function () {
                        location.reload(true);
                    });
                });
            }
            function chkLogin() {
                var uidV = $('#input_uid').val();
                var pwV = $('#input_pw').val();
                $("#left_content").load("reserved/submit_loginCheck.php", {uid: uidV, pw: pwV}, function () {
                    $("#right_content").load("reserved/submit_loginChooser.php");
                    location.reload(true);
                });
            }
        </script>
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
        ?>
        <div id="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="12u">
                        <header id="header">
                            <h1><a href="#" id="logo">DMI Papers</a></h1>
                            <nav id="nav">
                                <a href="./view_preprints.php">Publications</a>
                                <a href="./reserved.php" class="current-page-item">Reserved Area</a>
                            </nav>
                        </header>
                    </div>
                </div>
            </div>
        </div>
        <div id="container_principale" class="contenitore">
            <?php
            //TEST DEBUG
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'reserved/submit_loginChooser.php';
            ?>
        </div>
    </body>
</html>
