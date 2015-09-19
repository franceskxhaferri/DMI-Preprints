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
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'mysql/func.php');
        #importazione variabili globali
        include $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'impost_car.php';
        sec_session_start();
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 86400)) {
            #if ($_SESSION['nome']." (".$_SESSION['uid'].")" == $row['uid'] && $row['uid'] != ""){
            if (($_SESSION['logged_type'] === "mod" or $_SESSION['logged_type'] === "user") &&
                    ($_SESSION['nome'] . " (" . $_SESSION['uid'] . ")" == $_GET['r']) && $_GET['r'] != " ()") {
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
		        <input type='search' autocomplete = 'on' style='width:30%;' name='r' placeholder='Author name, part, etc.' value=''/>
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
                    <center>
                        <div>
                            <br/>
                            <br/>
                            <h2>manual editing</h2>
                        </div>
                        <form name="f1" action="uploaded.php" method="GET">
                            <table>
                                <tr>
                                    <td align="right" style='width:150px; height:16px'>Go to uploaded&nbsp&nbsp&nbsp
                                    </td>
                                    <td>
                                        <input type="submit" name="b1" value="Back" id='bottone_keyword' class='bottoni' onclick="return confirmExit()">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </center>
                    <?php
                    if (!isset($_GET['id'])) {
                        echo "<center><br/><a style='color:#007897;' href='./view_preprints.php?p=1&w=0' onclick='window.open(this.href); return false' title='Go to preprints list'>View from inserted preprints</a></center>";
                        echo "<hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>";
                        echo " <center><div><form name='f2' action='manual_edit.php' method='POST' onsubmit='loading(load);'>Insert id of publication: <input type='search' autocomplete = 'on' style='width:175px;' name='id' id='textbox' required class='textbox' placeholder='example of id: 0000.0000v1' autofocus/> <input type='submit' name='b8' value='Get preprint' style='width:70px;' id='bottone_keyword' class='bottoni'/><br/>
		               </form></div></center>
		               ";
                        $var = False;
                    }
                    echo "<hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>";
                    if (isset($_POST['b8']) or isset($_POST['b9']) or isset($_POST['b11']) or isset($_POST['b10']) or isset($_GET['id'])) {
                        if (empty($_POST['id'])) {
                            $id = $_GET['id'];
                        } else {
                            $id = $_POST['id'];
                        }
                        #adattamento stringa
                        $id = trim($id);
                        #funzione per recupero informazioni dell'preprint
                        $ris = cercapreprint($id);
                        if ($ris[0] == $id) {
                            #sblocco altri campi
                            $var = True;
                        } else {
                            echo '<script type="text/javascript">alert("ID incorrect!");</script>';
                        }
                    }
                    if ($var == True) {
                        echo "<script type='text/javascript'>
				function confirmExit()
				{
				   return confirm('All unsaved changes will be lost, continue?');
				}
			</script>
                <form name='f1' action='edit.php?r=" . $_GET['r'] . "' method='POST' enctype='multipart/form-data' onsubmit='loading(load);'>
                    <div style='margin-left:1%; margin-right:1%;'><div style='float:left; width:100%;'><center><br/><h2>Publication informations</h2><h1>field with '*' are required</h1><br/><input type='reset' name='reset' value='Reset'><br/><br/></center>
			    <div style='font-weight: bold;'>id of pubblication (not editable):</div><br/>
                            <textarea readonly style='width:49%;' name='id' id='textbox' class='textbox' placeholder='example of id: 0000.0000v1'>" . $ris[0] . "</textarea><br/><br/>
                            <div style='font-weight: bold;'>data of pubblication (not editable):</div><br/>
                            <textarea readonly style='width:49%;' name='data' id='textbox' class='textbox' placeholder='example of data: 2011-12-30T10:37:35Z'>" . $ris[2] . "</textarea><br/><br/>
                            <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>category preview:</div><br/>
	    				<div id='categorydiv'></div>
	    			</div>
                            <div style='font-weight: bold;'>*category:</div><br/>
                            <textarea style='width:49%;' name='category' id='textbox' class='textbox' required placeholder='example of category: math.NA...' autofocus onkeyup='UpdateMathcat(this.value)' maxlength='280'>" . $ris[6] . "</textarea><br/><br/>
                            <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>title preview:</div><br/>
	    				<div id='titlediv'></div>
	    			</div>
                            <div style='font-weight: bold;'>*title:</div><br/>
                            <textarea style='width:49%;' name='title' id='textbox' class='textbox' required placeholder='example of title: The geometric...' onkeyup='UpdateMathtit(this.value)' maxlength='280'>" . $ris[1] . "</textarea><br/><br/>
                            <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>authors preview:</div><br/>
	    				<div id='authordiv'></div>
	    			</div>
                            <div style='font-weight: bold;'>*authors:</div><br/>
                            <textarea style='width:49%;' name='author' id='textbox' class='textbox' required placeholder='example of author: Mario Rossi, Luca...' onkeyup='UpdateMathaut(this.value)' maxlength='280'>" . $ris[3] . "</textarea><br/><br/>
                            <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>journal preview:</div><br/>
	    				<div id='journaldiv'></div>
	    			</div>
                            <div style='font-weight: bold;'>journal reference:</div><br/>
                            <textarea style='width:49%;' name='journal' id='textbox' class='textbox' placeholder='example of Journal: Numer. Linear Algebra...' onkeyup='UpdateMathjou(this.value)' maxlength='280'>" . $ris[4] . "</textarea><br/><br/>
                            <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>comments preview:</div><br/>
	    				<div id='commentsdiv'></div>
	    			</div>
                            <div style='font-weight: bold;'>comments:</div><br/>
                            <textarea style='width:49%;' name='comments' id='textbox' class='textbox' placeholder='example of comments: 10 pages...' onkeyup='UpdateMathcom(this.value)' maxlength='280'>" . $ris[5] . "</textarea><br/><br/>
                            <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>abstract preview:</div><br/>
	    				<div id='abstractdiv'></div>
	    			</div>
                            <div style='font-weight: bold;'>*abstract:</div><br/>
                            <textarea style='width:49%; height:300px;' name='abstract' id='textbox' class='textbox' required placeholder='example of abstract: The geometric...' onkeyup='UpdateMathabs(this.value)'>" . $ris[7] . "</textarea><br/><br/><center>
                            <div style='font-weight: bold;'>file to upload:</div>
                            <input type='hidden' name='MAX_FILE_SIZE' value='10000000'><br/>
                            <input type='file' name='fileToUpload' id='fileToUpload'><br/><br/>
                            <br/><input type='submit' name='b9' value='Remove' style='width:60px;' id='bottone_keyword' class='bottoni' onclick='return confirmDelete2()'/>
                            <input type='submit' name='b10' value='Upgrade' style='width:60px;' id='bottone_keyword' class='bottoni' onclick='return confirmUpgrade()'/>
                            <input type='submit' name='b11' value='Update' style='width:60px;' id='bottone_keyword' class='bottoni' onclick='return confirmInsert2()'/><br/><br/><br/><br/></center>
                            </div></div></form>";
                        echo "
                            	<script>
					UpdateMathtit('" . addslashes($ris[1]) . "');
					UpdateMathjou('" . addslashes($ris[4]) . "');
					UpdateMathcom('" . addslashes($ris[5]) . "');
					UpdateMathcat('" . addslashes($ris[6]) . "');
					UpdateMathaut('" . addslashes($ris[3]) . "');
					UpdateMathabs('" . addslashes($ris[7]) . "');
				</script>";
                        $target_file = $basedir . basename($_FILES["fileToUpload"]["name"]);
                        #bottone cancella
                        if (isset($_POST['b9'])) {
                            $id1 = $_POST['id'];
                            #eliminazione del preprint selezionato
                            delete_pdf($id1);
                            cancellaselected($id1);
                            echo '<script type="text/javascript">
                            alert("Publication ' . $_POST['id'] . ' removed correctly!");
                            window.close();</script>';
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./uploaded.php">';
                        }
                        #bottone upgrade
                        if (isset($_POST['b10'])) {
                            if (empty($_POST['journal'])) {
                                $info[4] = "No journal ref";
                            } else {
                                $info[4] = $_POST['journal'];
                            }
                            if (empty($_POST['comments'])) {
                                $info[5] = "No journal ref";
                            } else {
                                $info[5] = $_POST['comments'];
                            }
                            $rest = substr($_POST['id'], 0, -1);
                            $len = strlen($_POST['id']);
                            $ver = substr($_POST['id'], $len - 1, $len);
                            $ver++;
                            $info[0] = $rest . $ver;
                            $info[1] = $_POST['title'];
                            $info[2] = $_POST['data'];
                            $info[3] = $_POST['author'];
                            $info[6] = $_POST['category'];
                            $info[7] = $_POST['abstract'];
                            if ($_FILES["fileToUpload"]["size"] > 0) {
                                #caricamento del file scelto
                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                    $fileType = $_FILES["fileToUpload"]["type"];
                                    #richiamo della funzione per il versionamento dei preprints
                                    version_preprintd($info[0]);
                                    #richiamo della funzione per inserire le info del preprint all'interno del database
                                    insert_p($info, $_GET['r']);
                                    rename($basedir . $_FILES["fileToUpload"]["name"], $basedir . $info[0] . ".pdf");
                                    #spostamento pdf
                                    #inserimento nel database del file
                                    insertpdf($info[0], $fileType);
                                    echo '<script type="text/javascript">
                                    alert("Publication ' . $_POST['id'] . ' upgrated to ' . $info[0] . ' correctly!");
                                    window.close();</script>';
                                } else {
                                    echo '<script type="text/javascript">alert("Error, file not uploaded!");</script>';
                                }
                            } else {
                                echo '<script type="text/javascript">alert("Select file to upload!");</script>';
                            }
                        }
                        #bottone aggiorna info
                        if (isset($_POST['b11'])) {
                            if (empty($_POST['journal'])) {
                                $info[4] = "No journal ref";
                            } else {
                                $info[4] = $_POST['journal'];
                            }
                            if (empty($_POST['comments'])) {
                                $info[5] = "No journal ref";
                            } else {
                                $info[5] = $_POST['comments'];
                            }
                            $info[0] = $_POST['id'];
                            $info[1] = $_POST['title'];
                            $info[2] = $_POST['data'];
                            $info[3] = $_POST['author'];
                            $info[6] = $_POST['category'];
                            $info[7] = $_POST['abstract'];
                            #richiamo della funzione per inserire le info del preprint all'interno del database
                            update_preprints($info);
                            $check = $_POST['check'];
                            #controllo se ci sono file da caricare
                            if ($_FILES["fileToUpload"]["size"] > 0) {
                                #caricamento del file scelto
                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                    $fileType = $_FILES["fileToUpload"]["type"];
                                    #inserimento nel database del file
                                    insert_one_pdf($info[0], $fileType);
                                    echo '<script type="text/javascript">alert("Publication ' . $_POST['id'] . ' updated correctly!");
                                    window.close();</script>';
                                } else {
                                    echo '<script type="text/javascript">alert("Error, file not uploaded!");</script>';
                                }
                            } else {
                                echo '<script type="text/javascript">alert("Publication ' . $_POST['id'] . ' updated correctly!");
                                window.close();</script>';
                            }
                        }
                        echo "<hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>";
                    }
                } else {
                    echo '<script type="text/javascript">alert("ACCESS DENIED!");</script>';
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
                }
            } else {
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
            }
            ?>
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
