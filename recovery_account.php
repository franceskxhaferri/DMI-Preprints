<!DOCTYPE html>
<html>
    <?php echo "
<head>
<title>DMI Preprints</title>
<!--<script src=\"js/jquery.min.js\"></script>-->
<script type=\"text/javascript\" src=\"js/jquery-1.11.1.min.js\"></script>
<script src=\"js/config.js\"></script>
<script src=\"js/skel.min.js\"></script>
<script src=\"js/skel-panels.min.js\"></script>
<noscript>
<link rel=\"stylesheet\" href=\"css/skel-noscript.css\" />
<link rel=\"stylesheet\" href=\"css/style.css\" />
<link rel=\"stylesheet\" href=\"css/style-desktop.css\" />
</noscript>
<link rel=\"stylesheet\" href=\"css/main.css\" />
<script src=\"js/targetweb-modal-overlay.js\"></script>
<link href='css/targetweb-modal-overlay.css' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
<!--[if lte IE 9]><link rel=\"stylesheet\" href=\"css/ie9.css\" /><![endif]-->
<!--[if lte IE 8]><script src=\"js/html5shiv.js\"></script><![endif]-->
<script src=\"http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js\"></script>
<script src=\"http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js\"></script>
<script>
    webshims.setOptions('waitReady', false);
    webshims.setOptions('forms-ext', {types: 'date'});
    webshims.polyfill('forms forms-ext');
</script>
<script type=\"text/x-mathjax-config\">
    MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
</script>
<script type=\"text/javascript\"
        src=\"http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML\">
</script>

<script type=\"text/javascript\" src=\"./js/allscript.js\">
</script>
</head> "; ?>
    <body>
        <div id="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="12u">
                        <header id="header">
                            <h1><a href="#" id="logo">DMI Preprints</a></h1>
                            <nav id="nav">
                                <a href="./index.php">Publications</a>
                                <a href="./reserved.php" class="current-page-item">Reserved Area</a>
                            </nav>
                        </header>
                    </div>
                </div>
            </div>
        </div>
        <br/><br/>
    <center>
        <div id="firstContainer">
            <div style="width: 45%;">
                <h1>You forgot your login credentials?</h1><br/>
                To reset your password please enter the email address provided during registration.
            </div><br/><br/>
            <?php
            require_once './graphics/loader.php';
            //TEST DEBUG
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            require_once './reserved/reset_passForm.php';
            ?>
    </center>
</center>
</body>
</html>
