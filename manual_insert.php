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
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/arXiv_parsing.php');
        #importazione variabili globali
        include $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'impost_car.php';
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
			<form name='f4' action='view_preprints.php' method='GET'>
			</div>
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
                                            <a href='./view_preprints.php'>Publications</a>
                                            <a href="./reserved.php" class="current-page-item">Reserved Area</a>
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
                            <h2>manual insertion</h2>
                        </center>
                    </div>
                    <center>
                        Go to arXiv panel&nbsp&nbsp&nbsp
                        <a style="height:17px; color:white;" href="./arXiv_panel.php" id="bottone_keyword" class="bottoni" onclick="return confirmExit()" >Back</a><br/><br/>
                        <a style='color:#007897;' href='http://arxiv.org/' onclick='window.open(this.href);
                                        return false' title='arXiv'>arXiv.org</a>
                    </center>
                    <hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;">
                    <?php
                    if (sessioneavviata() == True) {
                        echo "<br/><br/><center>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE SECTION CAN'T BE USED IN THIS MOMENT!</center><br/>";
                    } else {
                        ?>
                        <center>
                            <div>
                                <form name='f2' action='manual_insert.php' method='POST'>
                                    Get paper informations from arXiv:
                                    <input type='search' autocomplete = 'on' style='width:175px;' name='id' id='textbox' required class='textbox' placeholder='Insert id(arXiv): 0000.0000' autofocus/> <input type='submit' name='b7' value='Get paper' style='width:70px;' id='bottone_keyword' class='bottoni' onclick="loading(load);"><br/>
                                </form>
                            </div>
                        </center>
                        <hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>
                        <?php
                        if (isset($_POST['b7'])) {
                            echo "<div hidden>";
                            $id = trim($_POST['id']);
                            arxiv_call($id, 0);
                            for ($i = 1; $i < 11; $i++) {
                                $id1 = $id . "v" . $i;
                                $ris = cercapreprint($id1);
                                if ($id1 == $ris[0]) {
                                    #azzeramento file temporaneo...
                                    azzerapreprint();
                                    break;
                                }
                            }
                        }
                        echo "</div>";
                        if ($id1 == $ris[0] && isset($_POST['b7'])) {
                            echo "
                <form name='f1' action='manual_insert.php' method='POST' enctype='multipart/form-data' onclick='myFunction()'>
                    <div style='margin-left:1%; margin-right:1%;'><div style='float:left; width:100%;'><center><div><br/><h2>paper informations</h2><h1>field with '*' are required</h1><br/><input type='reset' name='reset' value='Reset'><br/><br/></center>
                    	<div style='font-weight: bold;'>document:</div><br/><div style='float:left; width:49%;'><center><a href=./pdf_downloads/" . $id1 . ".pdf onclick='window.open(this.href);return false' style='color:#007897;' title='" . $ris[0] . "'>PDF</a></center></div>
			    <br/><br/><div style='font-weight: bold;'>id (not editable):</div><br/>
                            <textarea readonly style='width:49%;' name='id' id='textbox' class='textbox' placeholder='example of id: 0000.0000v1'>" . $ris[0] . "</textarea><br/><br/>
                            <div style='font-weight: bold;'>date (not editable):</div><br/>
                            <textarea readonly style='width:49%;' name='data' id='textbox' class='textbox' placeholder='example of data: 2011-12-30T10:37:35Z'>" . $ris[2] . "</textarea><br/><br/>
                            <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>category preview:</div><br/>
	    				<div id='categorydiv'></div>
	    			</div>
                            <div style='font-weight: bold;'>*category:</div><br/>
                            <textarea style='width:49%;' name='category' id='textbox' class='textbox' required placeholder='example of category: math.NA...' onkeyup='UpdateMathcat(this.value)' maxlength='280'>" . $ris[6] . "</textarea><br/><br/>
                            <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>title preview:</div><br/>
	    				<div id='titlediv'></div>
	    			</div>
                            <div style='font-weight: bold;'>*title:</div><br/>
                            <textarea style='width:49%;' name='title' id='textbox' class='textbox' required placeholder='example of title: The geometric...' autofocus onkeyup='UpdateMathtit(this.value)' maxlength='280'>" . $ris[1] . "</textarea><br/><br/>
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
                            <input type='file' name='fileToUpload' id='fileToUpload'><br/><br/><br/>
                            <input type='submit' name='b9' value='Remove' style='width:60px;' id='bottone_keyword' class='bottoni' onclick='return confirmDelete()'/>
                            <input type='submit' name='b10' value='Insert' style='width:60px;' id='bottone_keyword' class='bottoni' onclick='return confirmInsert()'/><br/><br/><br/><br/></center>
                            </div></div></form>";
                            echo "
                            	<script>
					UpdateMathtit('" . addslashes($ris[1]) . "');
					UpdateMathjou('" . addslashes($ris[4]) . "');
					UpdateMathcom('" . addslashes($ris[5]) . "');
					UpdateMathcat('" . addslashes($ris[6]) . "');
					UpdateMathaut('" . addslashes($ris[3]) . "');
					UpdateMathabs('" . addslashes($ris[7]) . "');
				</script>
				<script type='text/javascript'>
					function confirmExit()
					    {
						return confirm('All unsaved changes will be lost, it will be moved to check section, continue?');
					    }
				</script>
				";
                        } else {
                            echo "<form name='f2' action='manual_insert.php' method='POST' enctype='multipart/form-data' onclick='myFunction()'>
                    <div style='margin-left:1%; margin-right:1%;'><div style='float:left; width:100%;'><center><div><br/><h2>paper informations</h2><h1>field with '*' are required</h1><br/><input type='reset' name='reset' value='Reset'/><br/><br/></center>
                            <div style='font-weight: bold;'>*id:</div><br/>
                            <textarea style='width:49%;' name='id' id='textbox' class='textbox' required placeholder='example of id: 0000.0000v1' autofocus></textarea><br/><br/>
                            <div style='font-weight: bold;'>*date:</div><br/>
                            <textarea style='width:49%;' name='date' id='textbox' class='textbox' required placeholder='example of data: 2011-12-30T10:37:35Z'></textarea><br/><br/>
                        <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>category preview:</div><br/>
	    				<div id='categorydiv'></div>
	    			</div>
                            <div style='font-weight: bold;'>*category:</div><br/>
                            <textarea style='width:49%;' name='category' id='textbox' class='textbox' required placeholder='example of category: math.NA...' onkeyup='UpdateMathcat(this.value)' maxlength='280'>" . $ris[6] . "</textarea><br/><br/>
                             <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>title preview:</div><br/>
	    				<div id='titlediv'></div>
	    		</div>
                        <div style='font-weight: bold;'>*title:</div><br/>
                        <textarea style='width:49%;' name='title' id='textbox' class='textbox' required placeholder='example of title: The geometric...' onkeyup='UpdateMathtit(this.value)' maxlength='280'></textarea><br/><br/>
                        <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>authors preview:</div><br/>
	    				<div id='authordiv'></div>
	    		</div>
                        <div style='font-weight: bold;'>*authors:</div><br/>
                        <textarea style='width:49%;' name='author' id='textbox' class='textbox' required placeholder='example of author: Mario Rossi, Luca...' onkeyup='UpdateMathaut(this.value)' maxlength='280'></textarea><br/><br/>
                        <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>journal preview:</div><br/>
	    				<div id='journaldiv'></div>
	    		</div>
                        <div style='font-weight: bold;'>journal reference:</div><br/>
                        <textarea style='width:49%;' name='journal' id='textbox' class='textbox' placeholder='example of Journal: Numer. Linear Algebra...' onkeyup='UpdateMathjou(this.value)' maxlength='280'></textarea><br/><br/>
                        <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>comments preview:</div><br/>
	    				<div id='commentsdiv'></div>
	    		</div>
                        <div style='font-weight: bold;'>comments:</div><br/>
                        <textarea style='width:49%;' name='comments' id='textbox' class='textbox' placeholder='example of comments: 10 pages...' onkeyup='UpdateMathcom(this.value)' maxlength='280'></textarea><br/><br/>
                        <div style='float:right; width:49%;'>
	    				<div style='font-weight: bold;'>abstract preview:</div><br/>
	    				<div id='abstractdiv'></div>
	    		</div>
                        <div style='font-weight: bold;'>*abstract:</div><br/>
                        <textarea style='width:49%; height:300px;' name='abstract' id='textbox' class='textbox' required placeholder='example of abstract: The geometric...' onkeyup='UpdateMathabs(this.value)'></textarea><br/><br/></div><center>
                            <div style='font-weight: bold;'>*file to upload:</div>
                            <input type='hidden' name='MAX_FILE_SIZE' value='10000000'><br/>
                            <input type='file' required name='fileToUpload' id='fileToUpload'><br/><br/>
                            <input type='submit' name='b8' value='Insert' style='width:80px;' id='bottone_keyword' class='bottoni' onclick='return confirmInsert()'/><br/><br/></center>
                            </div></div>
                            </form><br/><br/>";
                        }
                        $target_file = $basedir2 . basename($_FILES["fileToUpload"]["name"]);
                        $type = "document/pdf"; // impostato il tipo per un'pdf
                        #bottone insert manually
                        if (isset($_POST['b8'])) {
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
                            $info[2] = $_POST['date'];
                            $info[3] = $_POST['author'];
                            $info[6] = $_POST['category'];
                            $info[7] = $_POST['abstract'];
                            #richiamo della funzione per il versionamento dei preprints
                            version_preprint($info[0]);
                            #richiamo della funzione per inserire le info del preprint all'interno del database
                            insert_preprints($info);
                            #upload del file selezionato
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                $fileType = $_FILES["fileToUpload"]["type"];
                                #inserimento file nel database
                                insert_one_pdf($info[0], $fileType);
                                echo '<script type="text/javascript">alert("Paper ' . $_POST['id'] . ' inserted correctly!");</script>';
                            } else {
                                echo '<script type="text/javascript">alert("Sorry, there was an error uploading your file!");</script>';
                            }
                        }
                        #bottone delete
                        if (isset($_POST['b9'])) {
                            #eliminazione del preprint selezionato
                            unlink($basedir3 . $_POST['id'] . ".pdf");
                            cancellaselected($_POST['id']);
                            echo '<script type="text/javascript">alert("Paper ' . $_POST['id'] . ' removed correctly!");</script>';
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./arXiv_panel.php">';
                        }
                        #bottone inserimento
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
                            $info[0] = $_POST['id'];
                            $info[1] = $_POST['title'];
                            $info[2] = $_POST['data'];
                            $info[3] = $_POST['author'];
                            $info[6] = $_POST['category'];
                            $info[7] = $_POST['abstract'];
                            #richiamo della funzione per il versionamento dei preprints
                            version_preprint($info[0]);
                            #richiamo della funzione per inserire le info del preprint all'interno del database
                            insert_preprints($info);
                            #inserimento del pdf sul database
                            insert_one_pdf2($_POST['id']);
                            #spostamento del file pdf
                            copy($basedir3 . $_POST['id'] . ".pdf", $copia . $_POST['id'] . ".pdf");
                            unlink($basedir3 . $_POST['id'] . ".pdf");
                            if ($_FILES["fileToUpload"]["size"] > 0) {
                                #caricamento del file scelto
                                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                    $fileType = $_FILES["fileToUpload"]["type"];
                                    #spostamento pdf
                                    #inserimento nel database del file
                                    insert_one_pdf($info[0], $fileType);
                                    echo '<script type="text/javascript">alert("Paper ' . $_POST['id'] . ' inserted correctly!");</script>';
                                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./arXiv_panel.php">';
                                } else {
                                    echo '<script type="text/javascript">alert("Error, file not uploaded!");</script>';
                                }
                            } else {
                                echo '<script type="text/javascript">alert("Paper ' . $_POST['id'] . ' inserted correctly!");</script>';
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./arXiv_panel.php">';
                            }
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
        </div>
        <br/>
    <center>
        <div id="load">
            <img src="./images/loader.gif" alt="Loading" style="width: 192px; height: 94px;">
            <div>
                </center>
                </body>
                </html>
