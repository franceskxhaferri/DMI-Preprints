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
                src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
        </script>
        <script type="text/javascript" src="./js/allscript.js">
        </script>
    </head>
    <body>
        <?php
        #importo file per utilizzare funzioni...
        require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'authorization/sec_sess.php';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/check_nomi_data.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/insert_remove_db.php');
        sec_session_start();
        echo "<div id='gotop' hidden><a id='scrollToTop' title='Go top'><img style='width:25px; height:25px;' src='./images/top.gif'></a></div>";
        if ($_COOKIE['searchbarall'] == "1") {
            #search bar
            echo "<center><div id='stickbottom'>
		    <a href='view_preprints.php?clos=1' title='Close' name='close'><img src='./images/close.gif' style='height:15px; width:15px; float:left;'></a>
			     <div id='adva' hidden>
			     <div>
			     <div id ='adv2a'>
			<form name='f4' action='view_preprints.php' method='GET'>
			    <font color='#007897'>Full text search: (<a style='color:#007897;' onclick='window.open(this.href);
				    return false' href='http://en.wikipedia.org/wiki/Full_text_search'>info</a>)</font><br/>
			    <div style='height:30px;'>
				Search: <input type='search' autocomplete = 'on' style='width:50%;' name='ft' placeholder='Insert phrase, name, keyword, etc.' value='" . $_GET['ft'] . "'/>
				<input type='submit' name='go' value='Send'/></div>
			    <div style='height:20px;'>
				Reset selections: <input type='reset' name='reset' value='Reset'>&nbsp&nbsp
				Results for page: 
				<select name='rp'>
				    <option value='5' selected='selected'>5</option>
				    <option value='10'>10</option>
				    <option value='15'>15</option>
				    <option value='20'>20</option>
				    <option value='25'>25</option>
				    <option value='50'>50</option>
				</select>
				&nbsp&nbspGo to page:
                        <input type='text' name='p' style='width:25px' placeholder='n&#176;'>&nbsp&nbsp
				Search on: 
				<label><input type='radio' name='st' value='1' checked>Currents</label>
				<label><input type='radio' name='st' value='0'>Archived</label>
			    </form></div>
		    </div>
		    </div>
			<form name='f4' action='view_preprints.php' method='GET'>
			<font color='#007897'>Advanced search options:</font><br/>
			    Reset selections: <input type='reset' name='reset' value='Reset'>&nbsp&nbsp
			    Years restrictions: 
			    until <input type='text' name='year1' style='width:35px' placeholder='Last'>
			    , or from <input type='text' name='year2' style='width:35px' placeholder='First'>
			    to <input type='text' name='year3' style='width:35px' placeholder='Last'>
			    &nbsp&nbspResults for page: 
			    <select name='rp'>
				<option value='5' selected='selected'>5</option>
				<option value='10'>10</option>
				<option value='15'>15</option>
				<option value='20'>20</option>
				<option value='25'>25</option>
				<option value='50'>50</option>
			    </select>
			    &nbsp&nbspGo to page:
                        <input type='text' name='p' style='width:25px' placeholder='n&#176;'>
			<div>
			    Search on:
			    <label><input type='checkbox' name='d' value='1'>Archived</label>
			    <label><input type='checkbox' name='all' value='1'>Record</label>
			    <label><input type='checkbox' name='h' value='1'>Author</label>
			    <label><input type='checkbox' name='t' value='1'>Title</label>
			    <label><input type='checkbox' name='a' value='1'>Abstract</label>
			    <label><input type='checkbox' name='e' value='1'>Date</label>
			    <label><input type='checkbox' name='y' value='1'>Category</label>
			    <label><input type='checkbox' name='c' value='1'>Comments</label>
			    <label><input type='checkbox' name='j' value='1'>Journal-ref</label>
			    <label><input type='checkbox' name='i' value='1'>ID</label>
			</div>
			<div>Order results by:
			    	<label><input type='radio' name='o' value='dated' checked>Date &#8595;</label>
		                <label><input type='radio' name='o' value='datec'>Date &#8593;</label>
		                <label><input type='radio' name='o' value='idd'>Identifier &#8595;</label>
		                <label><input type='radio' name='o' value='idc'>Identifier &#8593;</label>
		                <label><input type='radio' name='o' value='named'>Author-name &#8595;</label>
		                <label><input type='radio' name='o' value='namec'>Author-name &#8593;</label>
				</div>
		    </div>
		        Advanced:
		        <input type='button' value='Show/Hide' onclick='javascript:showHide2(adva,adv2a);'/>
		         Filter results by 
		        <select name='f'>
		            <option value='all' selected='selected'>All papers:</option>
		            <option value='author'>Authors:</option>
		            <option value='category'>Category:</option>
		            <option value='year'>Year:</option>
		            <option value='id'>ID:</option>
		        </select>
		        <input type='search' autocomplete = 'on' style='width:30%;' name='r' placeholder='Author name, part, etc.' value='" . $_GET['r'] . "'/>
		    <input type='submit' name='s' value='Send'/></form>
		    </div></center>";
        }
        if ($_SESSION['logged_type'] === "mod") {
            $nav = "<tr><form name='f2' action='archived_preprints.php' method='GET'>
		<td align='right'>Delete all archived papers from database&nbsp&nbsp&nbsp</td>
		<td><input type='submit' name='c' value='Remove all' id='bottone_keyword' class='bottoni' onclick='return confirmDelete5()'/></td>
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
        <div onclick="myFunction2()">
            <div id="header-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="12u">
                            <?php echo $nav2; ?>
                        </div>
                    </div>
                </div>
            </div>
            <center>
                <div>
                    <br/>
                    <br/>
                    <h2>ARCHIVED PAPERS</h2>
                </div>
                <?php
                if ($cred == 1) {
                    echo "
                        <table>
                        <tr>
                        <td align='right'>
                        Go to admin panel&nbsp&nbsp&nbsp
                        </td>
                        <td align='center'>
                        <a style='height:17px; color:white;' href='./modp.php' id='bottone_keyword' class='bottoni'>Back</a>
                        </td>
                        </tr>";
                    echo $nav . "</table>";
                }
                ?>
                <div onclick="myFunction()">
                    <?php
                    if (sessioneavviata() == True) {
                        echo "<br/><br/><center>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE SECTION CAN'T BE USED IN THIS MOMENT!</center><br/>";
                    } else {
                        if (isset($_GET['c'])) {
                            #funzione gestione preprint archiviati
                            leggipreprintarchiviati();
                        } else {
                            #funzione gestione preprint archiviati
                            leggipreprintarchiviati();
                        }
                    }
                    ?>
                </div>
            </center>
        </div>
        <br/>
        <br/>
    </body>
</html>
