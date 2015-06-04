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
            function confirmDelete()
            {
                return confirm("Remove all archived papers?");
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
        if ($_SESSION['logged_type'] === "mod") {
            $nav = "<tr><form name='f2' action='archived_preprints.php' method='GET'>
		<td align='right'>Delete all archived papers from database&nbsp&nbsp&nbsp</td>
		<td><input type='submit' name='c' value='Remove all' id='bottone_keyword' class='bottoni' onclick='return confirmDelete()'/></td>
		</form></tr>";
            $nav2 = "<header id='header'>
                                    <h1><a href='#' id='logo'>DMI Papers</a></h1>
                                    <nav id='nav'>
                                        <a href='./view_preprints.php'>Publications</a>
                                        <a href='./reserved.php' class='current-page-item'>Reserved Area</a>
                                    </nav>
                                </header>";
            $rit = "modp.php";
            $cred = 1;
        } else {
            $nav = "";
            $nav2 = "<header id='header'>
                                    <h1><a href='#' id='logo'>DMI Papers</a></h1>
                                    <nav id='nav'>
                                        <a href='./view_preprints.php' class='current-page-item'>Publications</a>
                                        <a href='./reserved.php'>Reserved Area</a>
                                    </nav>
                                </header>";
        }
        ?>
        <div id="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="12u">
                        <?php echo $nav2; ?>
                    </div>
                </div>
            </div>
        </div>
        <div><center><br/><br/><h2>ARCHIVED PAPERS</h2></center>
        </div><center>
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
        if ($cred == 1) {
            echo "<table>
            	<tr>
                <td align='right'>Go to admin panel&nbsp&nbsp&nbsp</td>
                <td align='center'><a style='height:17px; color:white;' href='./modp.php' id='bottone_keyword' class='bottoni'>Back</a></td>
                </tr>";
            echo $nav;
        }
        ?>
    </table>
</center>
<?php
if (sessioneavviata() == True) {
    echo "<br/><br/><center>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE SECTION CAN'T BE USED IN THIS MOMENT!</center><br/>";
} else {
    echo "<br/><center><a style='text-decoration: none;' href='javascript:FinePagina()'> &nbsp&nbsp&nbsp&nbsp&nbsp&#8595;&nbsp&nbsp&nbsp&nbsp&nbsp </a></center><center><div>";
    if (isset($_GET['c'])) {
        #funzione gestione preprint archiviati
        leggipreprintarchiviati();
    } else {
        #funzione gestione preprint archiviati
        leggipreprintarchiviati();
        echo "<center><a style='text-decoration: none;' href='javascript:window.scrollTo(0,0)'> &nbsp&nbsp&nbsp&nbsp&nbsp&#8593;&nbsp&nbsp&nbsp&nbsp&nbsp </a></center><br/>";
    }
}
?>
</div></center><br/><br/>
</body>
</html>
