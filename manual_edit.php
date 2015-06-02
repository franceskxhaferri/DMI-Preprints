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
            function confirmDelete()
            {
                return confirm("Delete this preprint?");
            }
            function confirmInsert()
            {
                return confirm("Update preprint information?");
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
        <script>
            //text area title
            (function () {
                window.UpdateMathtit = function (TeX) {
                    //set the MathOutput HTML
                    document.getElementById("titlediv").innerHTML = TeX;
                    //reprocess the MathOutput Element
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "titlediv"]);
                }
            })();
            //text area authors
            (function () {
                window.UpdateMathaut = function (TeX) {
                    //set the MathOutput HTML
                    document.getElementById("authordiv").innerHTML = TeX;
                    //reprocess the MathOutput Element
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "authordiv"]);
                }
            })();
            //text area journal
            (function () {
                window.UpdateMathjou = function (TeX) {
                    //set the MathOutput HTML
                    document.getElementById("journaldiv").innerHTML = TeX;
                    //reprocess the MathOutput Element
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "journaldiv"]);
                }
            })();
            //text area comments
            (function () {
                window.UpdateMathcom = function (TeX) {
                    //set the MathOutput HTML
                    document.getElementById("commentsdiv").innerHTML = TeX;
                    //reprocess the MathOutput Element
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "commentsdiv"]);
                }
            })();
            //text area category
            (function () {
                window.UpdateMathcat = function (TeX) {
                    //set the MathOutput HTML
                    document.getElementById("categorydiv").innerHTML = TeX;
                    //reprocess the MathOutput Element
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "categorydiv"]);
                }
            })();
            //text area abstract
            (function () {
                window.UpdateMathabs = function (TeX) {
                    //set the MathOutput HTML
                    document.getElementById("abstractdiv").innerHTML = TeX;
                    //reprocess the MathOutput Element
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub, "abstractdiv"]);
                }
            })();
        </script>
        <?php
        #importo file per utilizzare funzioni...
        require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'authorization/sec_sess.php';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/check_nomi_data.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/insert_remove_db.php');
        sec_session_start();
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 86400)) {
            if ($_SESSION['logged_type'] === "mod") {
                //sessione moderatore
                ?>
                <div id="header-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="12u">
                                <header id="header">
                                    <h1><a href="#" id="logo">DMI Papers</a></h1>
                                    <nav id="nav">
                                        <a href='view_preprints.php?p=1&w=0'>Publications</a>
                                        <a href="reserved.php" class="current-page-item">Reserved Area</a>
                                    </nav>
                                </header>
                            </div>
                        </div>
                    </div>
                </div>
                <div><center><br/><br/><h2>manual editing</h2></center>
                </div><center>
                <table>
                    <tr><form name="f1" action="modp.php" method="GET"><td align="right" style='width:150px; height:16px'>Go to admin panel&nbsp&nbsp&nbsp</td>
                        <td><input type="submit" name="b1" value="Back" id='bottone_keyword' class='bottoni' onclick="return confirmExit()"/></td>
                        </tr>
                    </form></table>
            </center>
            <?php
            if (sessioneavviata() == True) {
                echo "<br/><center>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE SECTION CAN'T BE USED IN THIS MOMENT!</center><br/>";
            } else {
                if (!isset($_GET['id'])) {
                    echo "<center><br/><a style='color:#007897;' href='./view_preprints.php?p=1&w=0' onclick='window.open(this.href); return false' title='Go to preprints list'>View from inserted preprints</a></center>";
                    echo "<hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>";
                    echo " <center><div><form name='f2' action='manual_edit.php' method='POST'>Insert id of publication: <input type='search' autocomplete = 'on' style='width:175px;' name='id' id='textbox' required class='textbox' placeholder='example of id: 0000.0000v1' autofocus/> <input type='submit' name='bottoni8' value='Get preprint' style='width:70px;' id='bottone_keyword' class='bottoni'/><br/>
		               </form></div></center>
		               ";
                    $var = False;
                }
                echo "<hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>";
                if (isset($_POST['bottoni8']) or isset($_POST['bottoni9']) or isset($_POST['bottoni10']) or isset($_GET['id'])) {
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
                <form name='f1' action='manual_edit.php' method='POST' enctype='multipart/form-data'>
                    <div style='margin-left:1%; margin-right:1%;'><div style='float:left; width:100%;'><center><div><br/><h2>preprint informations</h2><h1>field with '*' are required</h1><br/><input type='reset' name='reset' value='Reset'><br/><br/></center>
                    	    <div style='font-weight: bold;'>UID publisher(not editable):</div><br/>
                            <textarea readonly style='width:49%;' name='uid' id='textbox' class='textbox'>" . $ris[8] . "</textarea><br/><br/>
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
                           <input type='submit' name='bottoni9' value='Remove' style='width:60px;' id='bottone_keyword' class='bottoni' onclick='return confirmDelete()'/>
                            <input type='submit' name='bottoni10' value='Complete' style='width:60px;' id='bottone_keyword' class='bottoni' onclick='return confirmInsert()'/><br/><br/></center>
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
#importazione variabili globali
                    include $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'impost_car.php';
                    $target_file = $basedir2 . basename($_FILES["fileToUpload"]["name"]);
                    if (isset($_POST['bottoni9'])) {
                        $id1 = $_POST['id'];
                        #eliminazione del preprint selezionato
                        delete_pdf($id1);
                        cancellaselected($id1);
                        echo '<script type="text/javascript">alert("Preprint ' . $_POST['id'] . ' removed correctly!");</script>';
                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./manual_edit.php">';
                    }
                    if (isset($_POST['bottoni10'])) {
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
                                echo '<script type="text/javascript">alert("Preprint ' . $_POST['id'] . ' updated correctly!");</script>';
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./manual_edit.php">';
                            } else {
                                echo '<script type="text/javascript">alert("Error, file not uploaded!");</script>';
                            }
                        } else {
                            echo '<script type="text/javascript">alert("Preprint ' . $_POST['id'] . ' updated correctly!");</script>';
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./manual_edit.php">';
                        }
                    }
                    echo "<hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>";
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
</div><br/><br/>
</body>
</html>
