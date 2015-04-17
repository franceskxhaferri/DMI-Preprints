<!DOCTYPE html>
<html>
    <head>
        <title>DMIPreprints</title>
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
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
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
        </script>
    </head>
    <body>
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
                                    <h1><a href="#" id="logo">DMI Preprints</a></h1>
                                    <nav id="nav">
                                        <a href="main.php">preprint search</a>
                                        <a href="reserved.php" class="current-page-item">Reserved Area</a>
                                    </nav>
                                </header>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="div_menu_ricerca" class="contenitore"><center><br/><h2>INSERTED PREPRINTS</h2></center>
                </div><center>
                    <table>
                        <tr><form name="f1" action="arXiv_panel.php" method="POST">
                        <td align="right">Go to arXiv panel&nbsp&nbsp&nbsp</td>
                            <td colspan="2"><input type="submit" name="bottoni1" value="Back" id="bottone_keyword" class="bottoni"/></td>
                        </form></tr>
                        <tr><form name="f3" action="manual_edit.php" method="POST">
                        <td align="right">Manual editing for inserted preprint&nbsp&nbsp&nbsp</td>
                            <td colspan="2"><input type="submit" name="bottoni2" value="View" id="bottone_keyword" class="bottoni"/></td>
                        </form></tr>
                        <tr><form name="f2" action="archived_preprints.php" method="POST">
                        <td align="right">View archived preprints&nbsp&nbsp&nbsp</td>
                            <td colspan="2"><input type="submit" name="bottoni2" value="View" id="bottone_keyword" class="bottoni"/></td>
                        </form></tr>
                        <tr><form name="f4" action="view_preprints.php" method="POST">
                        <td align="right">Filter by name&nbsp&nbsp&nbsp</td>
                            <td><input type="submit" name="bottoni9" value="Apply" id="bottone_keyword" class="bottoni"/></td>
                            <td><input type="text" style="width:150px; height:16px" name="txt1" id="textbox" class="textbox" placeholder="Author name or part" autofocus></textarea></td>
                        </form></tr>
                    </table>
                </center>
            <?php
            if (sessioneavviata() == True) {
                echo "<br/><br/><center>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE SECTION CAN'T BE USED IN THIS MOMENT!</center><br/>";
            } else {
            		echo "<br/><center><a href='javascript:FinePagina()'>&#8595; end of page</a></center>";
                ?>
                <form name="f2" action="view_preprints.php" method="POST">
                    <center><div><br/><br/><br/><h2>preprints list</h2><hr><br/>                              
                </form>
                            <?php
                            if(isset($_POST['bottoni9'])){
			    	$nome = $_POST['txt1'];
		            	$i = filtropreprint($nome);
		            	if($i==0){
					echo "NO PREPRINTS!";
				}
                            }else{
                            	$i = filtropreprint("");
				if($i==0){
					echo "NO PREPRINTS!";
				}
                            }
                            echo "<center><a href='javascript:window.scrollTo(0,0)'>&#8593; top of page</a></center><br/>";
                        }
                    } else {
                        echo "<center><br/>ACCESS DENIED!</center>";
                        echo '<META HTTP-EQUIV="Refresh" Content="2; URL=./reserved.php">';
                    }
                } else {
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
                }
                ?>
            </div></center>
    </body>
</html>
