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
                <div id="div_menu_ricerca" class="contenitore"><center><br/><h2>manual insertion</h2></center>
                </div><center><form name="f1" action="arXiv_panel.php" method="POST">
                    <table>
                        <tr><td align="right">Go to arXiv panel&nbsp&nbsp&nbsp</td>
                            <td><input type="submit" name="bottoni7" value="Back" id="bottone_keyword" class="bottoni"/></td>
                        </tr>
                    </table>
                </form></center>
            <?php
            if (sessioneavviata() == True) {
                echo "<br/><br/><center>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE SECTION CAN'T BE USED IN THIS MOMENT!</center><br/>";
            } else {
                ?>
                <form name="f2" action="manual_insert.php" method="POST" enctype="multipart/form-data">
                    <center><div><br/><br/><br/><h2>preprint informations</h2><h1>field with "*" are required</h1><br/><br>
                            *id of pubblication<br/><br/>
                            <textarea style="width:700px; height:16px" name="id" id="textbox" class="textbox" placeholder="example of id: 0000.0000v1" autofocus></textarea><br/><br/><br/>
                            *data of pubblication<br/><br/>
                            <textarea style="width:700px; height:16px" name="date" id="textbox" class="textbox" placeholder="example of data: 2011-12-30T10:37:35Z"></textarea><br/><br/><br/>
                            *preprint title<br/><br/>
                            <textarea style="width:700px; height:16px" name="title" id="textbox" class="textbox" placeholder="example of title: The geometric..."></textarea><br/><br/><br/>
                            *authors name<br/><br/>
                            <textarea style="width:700px; height:16px" name="author" id="textbox" class="textbox" placeholder="example of author: Mario Rossi, Luca..."></textarea><br/><br/><br/>
                            journal reference<br/><br/>
                            <textarea style="width:700px; height:16px" name="journal" id="textbox" class="textbox" placeholder="example of Journal: Numer. Linear Algebra..."></textarea><br/><br/><br/>
                            comments<br/><br/>
                            <textarea style="width:700px; height:16px" name="comments" id="textbox" class="textbox" placeholder="example of comments: 10 pages..."></textarea><br/><br/><br/>
                            *arXiv category<br/><br/>
                            <textarea style="width:700px; height:16px" name="category" id="textbox" class="textbox" placeholder="example of category: math.NA..."></textarea><br/><br/><br/>
                            *abstract<br/><br/>
                            <textarea style="width:700px; height:300px" name="abstract" id="textbox" class="textbox" placeholder="example of abstract: The geometric..."></textarea><br/><br/><br/>
                            *PDF or other document file<br/>
                            <input type="hidden" name="MAX_FILE_SIZE" value="10000000"><br/>
                            <input type="file" name="fileToUpload" id="fileToUpload"><br/><br/><br/><br/>
                            <input type="submit" name="bottoni8" value="Insert preprint" id="bottone_keyword" class="bottoni"/><br/><br/><br/><br/></form>
                            <?php
                            $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . "arXiv/upload/";
                            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                            if (isset($_POST['bottoni8'])) {
                                $i = 8;
                                if (empty($_POST['id'])) {
                                    echo "INSERT ID!<br/><br/>";
                                    $i--;
                                }
                                if (empty($_POST['title'])) {
                                    echo "INSERT TITLE!<br/><br/>";
                                    $i--;
                                }
                                if (empty($_POST['date'])) {
                                    echo "INSERT DATE!<br/><br/>";
                                    $i--;
                                }
                                if (empty($_POST['author'])) {
                                    echo "INSERT AUTHOR!<br/><br/>";
                                    $i--;
                                }
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
                                if (empty($_POST['category'])) {
                                    echo "INSERT CATEGORY!<br/><br/>";
                                    $i--;
                                }
                                if (empty($_POST['abstract'])) {
                                    echo "INSERT ABSTRACT!<br/><br/>";
                                    $i--;
                                }
                                if ($_FILES['fileToUpload']['size'] > 0) {
                                    if ($i == 8) {
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
                                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                            $fileType = $_FILES["fileToUpload"]["type"];
                                            insert_one_pdf($info[0], $fileType);
                                            echo "PREPRINT " . $info[0] . " INSERTED CORRECTLY!<br/><br/>";
                                        } else {
                                            echo "SORRY, THERE WAS AN ERROR UPLOADING YOUR FILE!<br/><br/>";
                                        }
                                    }
                                } else {
                                    echo "FILE IS REQUIRED!<br/><br/>";
                                }
                            }
                        }
                    } else {
                        echo "<center><br/>ACCESS DENIED!</center>";
                        echo '<META HTTP-EQUIV="Refresh" Content="2; URL=./reserved.php">';
                    }
                } else {
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
                }
                ?>
            </div><br/><br/></center>
    </body>
</html>
