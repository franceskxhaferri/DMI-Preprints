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
        <script type="text/javascript" src="./js/allscript.js">
        </script>
    </head>
    <body>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'authorization/sec_sess.php';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/check_nomi_data.php');
        sec_session_start();
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 86400)) {
            if ($_SESSION['logged_type'] === "mod") {
                //sessione moderatore
                echo "<div id='gotop' hidden><a id='scrollToTop' title='Go top'><img style='width:25px; height:25px;' src='./images/top.gif'></a></div>";
                if ($_COOKIE['searchbarall'] == "1") {
                    #search bar
                    echo "<center><div id='stickbottom'>
		    <a href='view_preprints.php?clos=1' title='Close' name='close'><img src='./images/close.gif' style='height:15px; width:15px; float:left;'></a>
			     <div id='adva' hidden>
			     <div>
			     <div id ='adv2a'>
			<form name='f4' action='view_preprints.php' method='GET' onsubmit='loading(load);'>
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
			<form name='f4' action='view_preprints.php' method='GET' onsubmit='loading(load);'>
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
                ?>
                <div onclick="myFunction2()">
                    <div id="header-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="12u">
                                    <header id="header">
                                        <h1><a href="#" id="logo">DMI Papers</a></h1>
                                        <nav id="nav">
                                            <a href='./view_preprints.php' onclick="loading(load);">Publications</a>
                                            <a href="./reserved.php" class="current-page-item" onclick="loading(load);">Reserved Area</a>
                                        </nav>
                                    </header>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <center>
                            <br/>
                            <br/>
                            <h2>CHECK PAPER</h2>
                            Go to admin panel&nbsp&nbsp&nbsp
                            <a style='height:17px; color:white;' href='./modp.php' id='bottone_keyword' class='bottoni' onclick='loading(load);'>Back</a><br/>
                        </center>
                    </div>
                    <div>
                        <?php
                        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/insert_remove_db.php');
                        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/arXiv_parsing.php');
                        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'mysql/func.php');
                        #importazione variabili globali
                        include $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'impost_car.php';
                        if (sessioneavviata() == True) {
                            echo "<center><br/>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE LIST CAN'T BE CHANGED IN THIS MOMENT!</center><br/>";
                        } else {
                            echo "<div><hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'></div>";
                            #leggere cartella...
                            #Imposto la directory da leggere
                            $directory = $basedir3;
                            echo "<div id='arxivpreprints'><form name='f2' action='check_preprints.php' id='f1' method='GET' onsubmit='loading(load);'><center><table id='table'>";
                            #Apriamo una directory e leggiamone il contenuto.
                            if (is_dir($directory)) {
                                #Apro l'oggetto directory
                                if ($directory_handle = opendir($directory)) {
                                    #Scorro l'oggetto fino a quando non è termnato cioè false
                                    echo "<tr id='thhead'><td id='tdh' colspan='4' align='center'>DOWNLOADED FROM ARXIV</td></tr>";
                                    echo "<tr id='thhead'><td id='tdh'><label><input type='checkbox' name='checkall' onclick='checkedAll(f1);'/>N&deg;:</label></td><td id='tdh' align='center'>FILE:</td><td id='tdh' align='center'>RECORD:</td><td id='tdh' align='center'>FOUNDED:</td></tr>";
                                    $i = 0;
                                    $y = 1;
                                    while (($file = readdir($directory_handle)) !== false) {
                                        #Se l'elemento trovato è diverso da una directory
                                        #o dagli elementi . e .. lo visualizzo a schermo
                                        if ((!is_dir($file)) & ($file != ".") & ($file != "..") & ($file != "index.html")) {
                                            $array[$i] = $file;
                                            $ids = $file;
                                            $ids = substr($ids, 0, -4);
                                            $ids = str_replace("-", "/", $ids);
                                            echo "<tr id='th'><td id='td'><label><input type='checkbox' name='ch" . $i . "' value='checked'/>$y.</label></td><td id='td'><a href=./pdf_downloads/" . $file . " onclick='window.open(this.href);return false' title='" . $file . "'>" . $file . "</a></td><td id='td'><a href=./manual_edit.php?id=" . $ids . " onclick='window.open(this.href);return false' title='" . $ids . "'>" . $ids . "</a></td>";
                                            #recupero data creazione file
                                            $dat = date("Y-m-d H:i", filemtime($basedir3 . $file));
                                            echo "<td id='td'>$dat</td></tr>";
                                            $i++;
                                            $y++;
                                        }
                                    }
                                    echo "</table></center><center><br/><input type='submit' name='b2' value='Remove' style='width:100px;' id='bottone_keyword' class='bottoni' onclick='return confirmDelete3()'><input type='submit' name='b3' value='Insert' style='width:100px;' id='bottone_keyword' class='bottoni' onclick='return confirmInsert3()'><br/></center>
                                <input type='text' name=bb3 value='" . $_GET['bb3'] . "' hidden></form></div>";
                                    #Chiudo la lettura della directory.
                                    closedir($directory_handle);
                                }
                            }
                            $z = 0;
                            $lunghezza = $i;
                            #eliminazione pdf, lettura cartella e ...
                            if (isset($_GET['b2'])) {
                                for ($j = 0; $j < $lunghezza; $j++) {
                                    $percorso = $basedir3 . $array[$j];
                                    $percorso2 = $copia . $array[$j];
                                    if (isset($_GET["ch" . $j])) {
                                        $z++;
                                        if (is_dir($directory)) {
                                            if ($directory_handle = opendir($directory)) {
                                                while (($file = readdir($directory_handle)) !== false) {
                                                    if ((!is_dir($file)) & ($file != ".") & ($file != "..") & ($file != "index.html")) {
                                                        if ($file == $array[$j]) {
                                                            #cancello file...
                                                            unlink($percorso);
                                                            unlink($percorso2);
                                                            #cancello riga database...
                                                            remove_preprints($array[$j]);
                                                        }
                                                    }
                                                }
                                                #Chiudo la lettura della directory.
                                                closedir($directory_handle);
                                            }
                                        }
                                    }
                                }
                                #controllo se sono stati selezionati preprint da rimuovere
                                if ($z == 0) {
                                    echo '<script type="text/javascript">alert("No papers selected!");</script>';
                                } else {
                                    echo '<script type="text/javascript">alert("' . $z . ' papers removed correctly!");</script>';
                                    #aggiorno la pagina dopo 0 secondi
                                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./check_preprints.php">';
                                }
                            }
                            #inserimento pdf, lettura cartella e ...
                            if (isset($_GET['b3'])) {
                                for ($j = 0; $j < $lunghezza; $j++) {
                                    $percorso = $basedir3 . $array[$j];
                                    $percorso2 = $copia . $array[$j];
                                    if (isset($_GET["ch" . $j])) {
                                        $z++;
                                        if (is_dir($directory)) {
                                            if ($directory_handle = opendir($directory)) {
                                                while (($file = readdir($directory_handle)) !== false) {
                                                    if ((!is_dir($file)) & ($file != ".") & ($file != "..") & ($file != "index.html")) {
                                                        if ($file == $array[$j]) {
                                                            $idd = substr($file, 0, -4);
                                                            #inserimento file nel database
                                                            insert_one_pdf2($idd);
                                                        }
                                                    }
                                                }
                                                #Chiudo la lettura della directory.
                                                closedir($directory_handle);
                                            }
                                        }
                                    }
                                }
                                #controllo se sono stati selezionati preprint da rimuovere
                                if ($z == 0) {
                                    echo '<script type="text/javascript">alert("No papers selected!");</script>';
                                } else {
                                    echo '<script type="text/javascript">alert("' . $z . ' papers inserted correctly!");</script>';
                                    #aggiorno la pagina dopo 0 secondi
                                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./check_preprints.php">';
                                }
                            }
#################################################################################################################################################
                            #dmi papers
                            #leggere cartella...
                            #Imposto la directory da leggere
                            $directory2 = $basedir;
                            echo "<div id='dmipreprints'><form name='f3' action='check_preprints.php' id='f2' method='GET' onsubmit='loading(load);'><center><table id='table1'>";
                            #Apriamo una directory e leggiamone il contenuto.
                            if (is_dir($directory2)) {
                                #Apro l'oggetto directory
                                if ($directory_handle = opendir($directory2)) {
                                    #Scorro l'oggetto fino a quando non è termnato cioè false
                                    echo "<tr id='thhead'><td id='tdh' colspan='4' align='center'>SUBMITTED TO DMI</td></tr>";
                                    echo "<tr id='thhead'><td id='tdh'><label><input type='checkbox' name='checkall' onclick='checkedAll2(f2);'/>N&deg;:</label></td><td id='tdh' align='center'>FILE:</td><td id='tdh' align='center'>RECORD:</td><td id='tdh' align='center'>FOUNDED:</td></tr>";
                                    $t = 0;
                                    $y = 1;
                                    while (($file = readdir($directory_handle)) !== false) {
                                        #Se l'elemento trovato è diverso da una directory
                                        #o dagli elementi . e .. lo visualizzo a schermo
                                        if ((!is_dir($file)) & ($file != ".") & ($file != "..") & ($file != "index.html")) {
                                            $array2[$t] = $file;
                                            $ids = $file;
                                            $ids = substr($ids, 0, -4);
                                            $ids = str_replace("-", "/", $ids);
                                            echo "<tr id='th'><td id='td'><label><input type='checkbox' name='ck" . $t . "' value='checked'/>$y.</td><td id='td'><a href=./upload_dmi/" . $file . " onclick='window.open(this.href);return false' title='" . $file . "'>" . $file . "</a></label></td><td id='td'><a href=./manual_edit.php?id=" . $ids . " onclick='window.open(this.href);return false' title='" . $ids . "'>" . $ids . "</a></td>";
                                            #recupero data creazione file
                                            $dat = date("Y-m-d H:i", filemtime($basedir . $file));
                                            echo "<td id='td'>$dat</td></tr>";
                                            $t++;
                                            $y++;
                                        }
                                    }
                                    echo "</table></center><center><br/><input type='submit' name='b4' value='Remove' style='width:100px;' id='bottone_keyword' class='bottoni' onclick='return confirmDelete3()'><input type='submit' name='b5' value='Insert' style='width:100px;' id='bottone_keyword' class='bottoni' onclick='return confirmInsert3()'><br/></center>
                                <input type='text' name=bb3 value='" . $_GET['bb3'] . "' hidden></form></div><div style='clear:both;'></div>";
                                    #Chiudo la lettura della directory.
                                    closedir($directory_handle);
                                }
                            }
#################################################################################################################################################
                            $k = 0;
                            $lunghezza2 = $t;
                            #eliminazione pdf, lettura cartella e ...
                            if (isset($_GET['b4'])) {
                                for ($j = 0; $j < $lunghezza2; $j++) {
                                    $percorso = $basedir . $array2[$j];
                                    $percorso2 = $copia . $array2[$j];
                                    if (isset($_GET["ck" . $j])) {
                                        $k++;
                                        if (is_dir($directory2)) {
                                            if ($directory_handle = opendir($directory2)) {
                                                while (($file = readdir($directory_handle)) !== false) {
                                                    if ((!is_dir($file)) & ($file != ".") & ($file != "..") & ($file != "index.html")) {
                                                        if ($file == $array2[$j]) {
                                                            #cancello file...
                                                            unlink($percorso);
                                                            unlink($percorso2);
                                                            #cancello riga database...
                                                            remove_preprints($array2[$j]);
                                                        }
                                                    }
                                                }
                                                #Chiudo la lettura della directory.
                                                closedir($directory_handle);
                                            }
                                        }
                                    }
                                }
                                #controllo se sono stati selezionati preprint da rimuovere
                                if ($k == 0) {
                                    echo '<script type="text/javascript">alert("No paper selected!");</script>';
                                } else {
                                    echo '<script type="text/javascript">alert("' . $k . ' papers removed correctly!");</script>';
                                    #aggiorno la pagina dopo 0 secondi
                                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./check_preprints.php">';
                                }
                            }
                            #inserimento pdf, lettura cartella e ...
                            if (isset($_GET['b5'])) {
                                for ($j = 0; $j < $lunghezza; $j++) {
                                    $percorso = $basedir . $array2[$j];
                                    $percorso2 = $copia . $array2[$j];
                                    if (isset($_GET["ck" . $j])) {
                                        $k++;
                                        if (is_dir($directory2)) {
                                            if ($directory_handle = opendir($directory2)) {
                                                while (($file = readdir($directory_handle)) !== false) {
                                                    if ((!is_dir($file)) & ($file != ".") & ($file != "..") & ($file != "index.html")) {
                                                        if ($file == $array2[$j]) {
                                                            $idd = substr($file, 0, -4);
                                                            #inserimento file nel database
                                                            insertopdf($idd);
                                                        }
                                                    }
                                                }
                                                #Chiudo la lettura della directory.
                                                closedir($directory_handle);
                                            }
                                        }
                                    }
                                }
                                #controllo se sono stati selezionati preprint da rimuovere
                                if ($k == 0) {
                                    echo '<script type="text/javascript">alert("No papers selected!");</script>';
                                } else {
                                    echo '<script type="text/javascript">alert("' . $k . ' papers inserted correctly!");</script>';
                                    #aggiorno la pagina dopo 0 secondi
                                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./check_preprints.php">';
                                }
                            }
#################################################################################################################################################
                            echo "<hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>";
                            #avviso per utente di nessun preprint
                            if ($i + $t == 0) {
                                echo '<script type="text/javascript">alert("No paper to be checked!");</script>';
                            }
                        }
                    } else {
                        echo '<script type="text/javascript">alert("ACCESS DENIED!");</script>';
                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
                    }
                } else {
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
                }
                ?>
                <br/>
            </div>
        </div>
        <br/>
        <br/>
    <center>
        <div id="load">
            <img src="./images/loader.gif" alt="Loading" style="width: 192px; height: 94px;">
        </div>
    </center>
</body>
</html>
