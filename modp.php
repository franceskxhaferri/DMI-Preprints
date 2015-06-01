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
                return confirm("All data are correct?");
            }
            function confirmLogout()
            {
                return confirm("Exit?");
            }
            function Checkcath(val) {
                var element = document.getElementById('cat');
                if (val == 'category' || val == 'Other')
                    element.style.display = 'block';
                else
                    element.style.display = 'none';
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
	    MathJax.Hub.Queue(["Typeset",MathJax.Hub,"titlediv"]);
	}
	})();
	//text area authors
	(function () {
	window.UpdateMathaut = function (TeX) {
	    //set the MathOutput HTML
	    document.getElementById("authordiv").innerHTML = TeX;
	    //reprocess the MathOutput Element
	    MathJax.Hub.Queue(["Typeset",MathJax.Hub,"authordiv"]);
	}
	})();
	//text area jouurnal
	(function () {
	window.UpdateMathjou = function (TeX) {
	    //set the MathOutput HTML
	    document.getElementById("journaldiv").innerHTML = TeX;
	    //reprocess the MathOutput Element
	    MathJax.Hub.Queue(["Typeset",MathJax.Hub,"journaldiv"]);
	}
	})();
	//text area comments
	(function () {
	window.UpdateMathcom = function (TeX) {
	    //set the MathOutput HTML
	    document.getElementById("commentsdiv").innerHTML = TeX;
	    //reprocess the MathOutput Element
	    MathJax.Hub.Queue(["Typeset",MathJax.Hub,"commentsdiv"]);
	}
	})();
	//text area abstract
	(function () {
	window.UpdateMathabs = function (TeX) {
	    //set the MathOutput HTML
	    document.getElementById("abstractdiv").innerHTML = TeX;
	    //reprocess the MathOutput Element
	    MathJax.Hub.Queue(["Typeset",MathJax.Hub,"abstractdiv"]);
	}
	})();
    </script>
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
                </div><br/>
            <center><div>
                    <?php
                    print_r("<font style='font-weight: bold;'>Name: </font>");
                    print_r($_SESSION['nome']);
                    print_r("<br/><font style='font-weight: bold;'>Access type: </font>");
                    print_r($_SESSION['logged_type']);
                    ?>
                    <br/><br/>
                    <table>
                        <tr>
                            <td>
                                <form name="f5" action="uploaded.php" method="GET">
                                    <input type="text" name="p" value="1" checked hidden/>
                                    <input type="submit" name="b5" value="Uploaded section" id="bottone_keyword" class="bottoni"/>
                                </form>
                            </td>
                            <td>
                                <form name="f4" action="archived_preprints.php" method="GET">
                                    <input type="text" name="p" value="1" checked hidden/>
                                    <input type="submit" name="b4" value="Archived section" id="bottone_keyword" class="bottoni"/>
                                </form>
                            </td>
                            <td>
                                <form name="f3" action="approve_preprints.php" method="GET">
                                    <input type="text" name="p" value="1" checked hidden/><input type="text" name="w" value="0" checked hidden/>
                                    <input type="submit" name="bb3" value="Approve section" id="bottone_keyword" class="bottoni"/>
                                </form>
                            </td>
                            <td>
                                <form name="f2" action="arXiv_panel.php" method="GET">
                                    <input type="submit" name="b2" value="ArXiv panel" id="bottone_keyword" class="bottoni">
                                </form>
                            </td>
                            <td>
                                <form name="f1" action="modp.php" method="POST">
                                    <input type="submit" name="b1" value="Logout" id="botton_logout" class="bottoni" style="color: red;" onclick="return confirmLogout()">
                                </form>
                            </td>
                        </tr>
                        </table>
                            </div></center>
                            <hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;">
                            <?php
                            if (sessioneavviata() == True) {
                                echo "<br/><br/><center>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE SECTION CAN'T BE USED IN THIS MOMENT!</center><br/>";
                            } else {
                                ?>
                                <form name="f3" action="modp.php" method="POST" enctype="multipart/form-data">
                <center><div><br/><h2>Insert new preprint</h2><h1>field with "*" are required</h1><br/>
                <input type="reset" name="reset" value="Reset"/><br/><br/></center>
                <div style="margin-left:1%; margin-right:1%;"><div style="float:left; width:100%;">
                        <div style="font-weight: bold;">*publication category:</div><br/>
                        <select name="category" required onchange='Checkcath(this.value);'>
                            <option value="">--Select Category--</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Statistics">Statistics</option>
                            <option value="Physics">Physics</option>
                            <option value="Quantitative Biology">Quantitative Biology</option>
                            <option value="Quantitative Finance">Quantitative Finance</option>
                            <option value="Other">Other:</option>
                        </select><br/><br/>
                        <div id="cat" hidden><textarea style="width:49%; height:16px;" name="category2" class="textbox" placeholder="example of category: math.NA..."></textarea><br/><br/></div>
                        <div style="float:right; width:49%;">
	    				<div style="font-weight: bold;">title preview:</div><br/>
	    				<div id="titlediv"></div>
	    		</div>
                        <div style="font-weight: bold;">*publication title:</div><br/>
                        <textarea style="width:49%; height:16px" name="title" id="textbox" class="textbox" required placeholder="example of title: The geometric..." onkeyup="UpdateMathtit(this.value)"></textarea><br/><br/>
                        <div style="float:right; width:49%;">
	    				<div style="font-weight: bold;">authors preview:</div><br/>
	    				<div id="authordiv"></div>
	    		</div>
                        <div style="font-weight: bold;">*authors name:</div><br/>
                        <textarea style="width:49%; height:16px" name="author" id="textbox" class="textbox" required placeholder="example of author: Mario Rossi, Luca..." onkeyup="UpdateMathaut(this.value)"></textarea><br/><br/>
                        <div style="float:right; width:49%;">
	    				<div style="font-weight: bold;">journal preview:</div><br/>
	    				<div id="journaldiv"></div>
	    		</div>
                        <div style="font-weight: bold;">journal reference:</div><br/>
                        <textarea style="width:49%; height:16px" name="journal" id="textbox" class="textbox" placeholder="example of Journal: Numer. Linear Algebra..." onkeyup="UpdateMathjou(this.value)"></textarea><br/><br/>
                        <div style="float:right; width:49%;">
	    				<div style="font-weight: bold;">comments preview:</div><br/>
	    				<div id="commentsdiv"></div>
	    		</div>
                        <div style="font-weight: bold;">comments:</div><br/>
                        <textarea style="width:49%; height:16px" name="comments" id="textbox" class="textbox" placeholder="example of comments: 10 pages..." onkeyup="UpdateMathcom(this.value)"></textarea><br/><br/>
                        <div style="float:right; width:49%;">
	    				<div style="font-weight: bold;">abstract preview:</div><br/>
	    				<div id="abstractdiv"></div>
	    		</div>
                        <div style="font-weight: bold;">*abstract:</div><br/>
                        <textarea style="width:49%; height:300px" name="abstract" id="textbox" class="textbox" required placeholder="example of abstract: The geometric..." onkeyup="UpdateMathabs(this.value)"></textarea><br/><br/></div>
		        </div></div>
		        <center>
                        <div style="font-weight: bold;">*PDF:<br/></div>
                        <input type="hidden" name="MAX_FILE_SIZE" value="10000000"><br/>
                        <input type="file" required name="fileToUpload" id="fileToUpload"><br/><br/>
                        <input type="submit" name="b3" value="Insert preprint" style='width:80px;' id='bottone_keyword' class='bottoni' onclick="return confirmInsert()"/><br/><br/></center>
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
                                                    $id = insert_pubb($info, $_SESSION['nome']." (".$_SESSION['uid'].")");
                                                    rename($basedir . $_FILES["fileToUpload"]["name"], $basedir . $id . ".pdf");
                                                    #inserimento file nel database
                                                    insertpdf($id, $fileType);
                                                    echo '<script type="text/javascript">alert("Preprint inserted correctly! ID generated: ' . $id . ' \nGo on uploaded section to edit your pubblications.");</script>';
                                                } else {
                                                    echo '<script type="text/javascript">alert("Sorry, there was an error uploading your file!");</script>';
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
                                <hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;"></div><br/><br/></center>
                        </body>
                        </html>
