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
    <body><?php
        require_once './graphics/header.php';
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
                                    <a href='./index.php' onclick="loading(load);">Publications</a>
                                    <a href="./reserved.php" class="current-page-item" onclick="loading(load);">Reserved Area</a>
                                </nav>
                            </header>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div id="firstContainer">
                <center>
                    <div>
                        <br/><br/>
                        Go back to new insertion: <a style="color:#ffffff;" href="<?php echo $ind; ?>" id="bottoni" class="button" onclick="loading(load);">Back</a>
                    </div>
                    <hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;">
                    <div id="container">
                        <div style="width: 45%;"><br/>
                            <h2>Profile information</h2>
                            <h1>Here you can see and change your account information.</h1>
                        </div><br/>
                        <?php
                        //lettura informazioni account
                        $info = find_account_info($_SESSION['uid']);
                        //TEST DEBUG
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);
                        require_once './reserved/edit_accountForm.php';
                        //TEST DEBUG
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);
                        require_once './reserved/delete_accountForm.php';
                        ?>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                </center>
            </div>
        </div>
        <?php require_once './graphics/loader.php'; ?>
    </body>
</html>
