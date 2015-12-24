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
        require_once './graphics/header.php';
//sessione moderatore
        if ($_SESSION['logged_type'] === "mod") {
            $ind = "modp.php";
        } else {
            $ind = "userp.php";
        }
        if ($_COOKIE['searchbarall'] == "1") {
            #search bar
            require_once './graphics/searchbar_bottom.php';
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
            <center><br/><br/><br/><br/><br/><br/><h2>My Uploads</h2>
                <div>
                    <br/>
                    <a style="color:#ffffff;" href="<?php echo $ind; ?>" id="bottoni" class="button" onclick="loading(load);">Back</a>
                    <br/><br/>  
                </div>
                <?php
                #lettura preprint caricati
                leggiupload($_SESSION['uid']);
                require_once './graphics/loader.php';
                ?>
            </center>
        </div>
        <br/>
        <br/>
        <br/>
    </body>
</html>
