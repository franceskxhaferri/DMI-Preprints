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
            MathJax.Hub.Config({
            tex2jax: {
            inlineMath: [["$","$"],["\\(","\\)"]]
            }
            });
        </script>
        <script type="text/javascript"
                src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML-full">
        </script>
        <script type="text/javascript" src="./js/allscript.js">
        </script>
    </head>
    <body>
        <?php
        #importo file per utilizzare funzioni...
        require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'authorization/sec_sess.php';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/check_nomi_data.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'mysql/func.php');
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
			<form name='f1' action='view_preprints.php' method='GET' onsubmit='loading(load);'>
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
			<form name='f2' action='view_preprints.php' method='GET' onsubmit='loading(load);'>
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
			</div>
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
			<br/>
			Order results by:
			    	<label><input type='radio' name='o' value='dated' checked>Date &#8595;</label>
		                <label><input type='radio' name='o' value='datec'>Date &#8593;</label>
		                <label><input type='radio' name='o' value='idd'>Identifier &#8595;</label>
		                <label><input type='radio' name='o' value='idc'>Identifier &#8593;</label>
		                <label><input type='radio' name='o' value='named'>Author-name &#8595;</label>
		                <label><input type='radio' name='o' value='namec'>Author-name &#8593;</label>
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
                    <br/><br/>
                    <center>
                        <div style="margin-left:1%; margin-bottom:5px;">
                            <?php
                            print_r("<font style='font-weight: bold;'>Name: </font>");
                            print_r($_SESSION['nome']);
                            print_r(" <font style='font-weight: bold;'>Credentials: </font>");
                            print_r($_SESSION['logged_type']);
                            ?>
                        </div>
                        <hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>
                        <div id="sticker">
                            <div style="margin-left:1%;">
                                <form name="f1" action="modp.php" method="POST" onsubmit="loading(load);">
                                    <input type="submit" name="b1" value="Logout" id="botton_logout" class="bottoni" style="height:17px; color: red;" onclick="return confirmLogout()">
                                    <a style="height:17px; color:white;" href="./uploaded.php?p=1" id="bottone_keyword" class="bottoni" onclick="loading(load);">My uploads</a>
                                    <a style="height:17px; color:white;" href="./check_preprints.php" id="bottone_keyword" class="bottoni" onclick="loading(load);">Check section</a>
                                    <a style="height:17px; color:white;" href="./arXiv_panel.php" id="bottone_keyword" class="bottoni" onclick="loading(load);">ArXiv panel</a>
                                    <a style="height:17px; color:white;" href="./manual_edit.php" id="bottone_keyword" class="bottoni" onclick="loading(load);">Edit section</a>
                                    <a style="height:17px; color:white;" href="./archived_preprints.php" id="bottone_keyword" class="bottoni" onclick="loading(load);">Archived section</a>
                                </form>
                                <div>
                                    <?php
                                    if (check_approve() == true) {
                                        print_r(" <font style='color:red; font-style: italic'>There are preprint to be approved!</font>");
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </center>
                    <hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;">
                    <form name="f3" action="modp.php" method="POST" enctype="multipart/form-data" onsubmit="loading(load);">
                        <center>
                            <h2>Insert new paper</h2>
                            <h1>field with "*" are required</h1>
                            <br/>
                            <input type="reset" name="reset" value="Reset">
                            <br/>
                        </center>
                        <div id="divinsertcateg">*category:<br/>
                            <select name="category" required onchange='Checkcath(this.value);'>
                                <option value="">--Select Category--</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Mathematics">Mathematics</option>
                                <option value="Statistics">Statistics</option>
                                <option value="Physics">Physics</option>
                                <option value="Quantitative Biology">Quantitative Biology</option>
                                <option value="Quantitative Finance">Quantitative Finance</option>
                                <option value="Other">Other:</option>
                            </select>
                            <br/>
                            <div id="cat" hidden>
                                <textarea id="textboxcat" name="category2" class="textbox" placeholder="example of category: math.NA..."></textarea>
                            </div>
                        </div>
                        <div>
                            <div id="divinsert">
                                <div id="divcontinsert">
                                    *title:<br/>
                                    <textarea name="title" id="textbox" class="textbox" required placeholder="example of title: The geometric..." onkeyup="UpdateMathtit(this.value)"></textarea>
                                </div>
                            </div>
                            <div id="divpreview">
                                <div style="font-weight: bold;">
                                    preview:
                                </div>
                                <div id="divcontpreview">
                                    <div id="titlediv"></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div id="divinsert">
                                <div id="divcontinsert">
                                    *authors:<br/>
                                    <textarea name="author" id="textbox" class="textbox" required placeholder="example of author: Mario Rossi, Luca..." onkeyup="UpdateMathaut(this.value)"></textarea>
                                </div>
                            </div>
                            <div id="divpreview">
                                <div style="font-weight: bold;">
                                    preview:
                                </div>
                                <div id="divcontpreview">
                                    <div id="authordiv"></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div id="divinsert">
                                <div id="divcontinsert">
                                    journal reference:<br/>
                                    <textarea name="journal" id="textbox" class="textbox" placeholder="example of Journal: Numer. Linear Algebra..." onkeyup="UpdateMathjou(this.value)"></textarea>
                                </div>
                            </div>
                            <div id="divpreview">
                                <div style="font-weight: bold;">
                                    preview:
                                </div>
                                <div id="divcontpreview">
                                    <div id="journaldiv"></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div id="divinsert">
                                <div id="divcontinsert">
                                    comments:<br/>
                                    <textarea name="comments" id="textbox" class="textbox" placeholder="example of comments: 10 pages..." onkeyup="UpdateMathcom(this.value)"></textarea>
                                </div>
                            </div>
                            <div id="divpreview">
                                <div style="font-weight: bold;">
                                    preview:
                                </div>
                                <div id="divcontpreview">
                                    <div id="commentsdiv"></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div id="divinsert">
                                <div id="divcontinsertabs">
                                    *abstract:<br/>
                                    <textarea name="abstract" id="textboxabs" class="textbox" required placeholder="example of abstract: The geometric..." onkeyup="UpdateMathabs(this.value)"></textarea>
                                </div>
                            </div>
                            <div id="divpreview">
                                <div style="font-weight: bold;">
                                    preview:
                                </div>
                                <div id="divcontpreviewabs">
                                    <div id="abstractdiv"></div>
                                </div>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                        <center>
                            <div style="font-weight: bold;">
                                *PDF:
                                <br/>
                            </div>
                            <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                            <input type="file" required name="fileToUpload" id="fileToUpload">
                            <br/>
                            <br/>
                            <input type="submit" name="b3" value="Insert paper" style='width:80px;' id='bottone_keyword' class='bottoni' onclick="return confirmInsert()">
                            <hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>
                        </center>
                    </form>
                    <?php
                    $target_file = $basedir . basename($_FILES["fileToUpload"]["name"]);
                    if (isset($_POST['b1'])) {
                        session_start();
                        session_unset();
                        session_destroy();
                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
                    }
                    if (isset($_POST['b3'])) {
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
                        if ($_POST['category'] == "Other") {
                            $info[6] = $_POST['category2'];
                        } else {
                            $info[6] = $_POST['category'];
                        }
                        $info[1] = $_POST['title'];
                        $info[3] = $_POST['author'];
                        $info[7] = $_POST['abstract'];
                        #upload del file selezionato
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            $fileType = $_FILES["fileToUpload"]["type"];
                            #richiamo della funzione per inserire le info del preprint all'interno del database
                            $id = insert_pubb($info, $_SESSION['nome'] . " (" . $_SESSION['uid'] . ")");
                            rename($basedir . $_FILES["fileToUpload"]["name"], $basedir . $id . ".pdf");
                            #inserimento file nel database
                            insertpdf($id, $fileType);
                            echo '<script type="text/javascript">alert("Preprint inserted correctly!\nID generated: ' . $id . ', go on my upload to edit your pubblications.");</script>';
                        } else {
                            echo '<script type="text/javascript">alert("Sorry, there was an error uploading your file!");</script>';
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
        <script>
            UpdateMathtit('Here it will show a preview of what you write on title');
            UpdateMathjou('Here it will show a preview of what you write on journal reference');
            UpdateMathcom('Here it will show a preview of what you write on comments');
            UpdateMathaut('Here it will show a preview of what you write on authors');
            UpdateMathabs('Here it will show a preview of what you write on abstract');
        </script>
    <center>
        <div id="load">
            <img src="./images/loader.gif" alt="Loading" style="width: 192px; height: 94px;">
        </div>
    </center>
</body>
</html>
