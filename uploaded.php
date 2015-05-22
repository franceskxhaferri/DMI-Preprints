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
                return confirm("All unsaved information will be lost, exit?");
            }
        </script>
    </head>
    <body>
        <?php
        #importo file per utilizzare funzioni...
        require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'authorization/sec_sess.php';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/check_nomi_data.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'mysql/func.php');
        sec_session_start();
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 86400)) {
            if ($_SESSION['logged_type'] === "mod" or $_SESSION['logged_type'] === "user") {
                //sessione moderatore
                if ($_SESSION['logged_type'] === "mod"){
                	$ind = "modp.php";
                }else{
                	$ind = "userp.php";
                }
                ?>
                <div id="header-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="12u">
                                <header id="header">
                                    <h1><a href="#" id="logo">DMI Preprints</a></h1>
                                    <nav id="nav">
                                        <a href='view_preprints.php?p=1&w=0'>Publications</a>
                                        <a href="reserved.php" class="current-page-item">Reserved Area</a>
                                    </nav>
                                </header>
                            </div>
                        </div>
                    </div>
                </div>
            <center><div><br/>
                    <form name="f1" action="<?php echo $ind;?>" method="POST">
                        Go back to new insertion: <input type="submit" name="b4" value="Back" id="bottoni" class="bottoni">
                    </form>
                </div>
                <?php
                #lettura preprint caricati
                leggiupload($_SESSION['uid']);
            } else {
                echo '<script type="text/javascript">alert("ACCESS DENIED!");</script>';
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
            }
        } else {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
        }
        ?>
    </div><br/><br/></center>
</body>
</html>