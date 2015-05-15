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
            function confirmExit()
            {
                return confirm("All unsaved information will be lost, continue?");
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
                                        <a href="main.php">DMI Publications</a>
                                        <a href='view_preprints.php?p=1&w=0'>arXiv Publications</a>
                                        <a href="reserved.php" class="current-page-item">Reserved Area</a>
                                    </nav>
                                </header>

                            </div>
                        </div>
                    </div>
                </div>
                <div><center><br/><br/><h2>manual insertion</h2></center>
                </div><center><form name="f1" action="arXiv_panel.php" method="GET">
                    <table>
                        <tr><td align="right">Go to arXiv panel&nbsp&nbsp&nbsp</td>
                            <td><input type="submit" name="b1" value="Back" id='bottone_keyword' class='bottoni' onclick="return confirmExit()"/></td>
                        </tr>
                    </table>
                </form></center><hr style="display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;">
            <?php
            if (sessioneavviata() == True) {
                echo "<br/><br/><center>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE SECTION CAN'T BE USED IN THIS MOMENT!</center><br/>";
            } else {
                ?>
                <form name="f2" action="manual_insert.php" method="POST" enctype="multipart/form-data">
                    <center><div><br/><h2>preprint informations</h2><h1>field with "*" are required</h1><br/><input type="reset" name="reset" value="Reset" style='width:40px;' id='bottone_keyword' class='bottoni'/><br/><br/>
                            *id of pubblication<br/><br/>
                            <textarea style="width:65%; height:16px" name="id" id="textbox" class="textbox" required placeholder="example of id: 0000.0000v1" autofocus></textarea><br/><br/><br/>
                            *data of pubblication<br/><br/>
                            <textarea style="width:65%; height:16px" name="date" id="textbox" class="textbox" required placeholder="example of data: 2011-12-30T10:37:35Z"></textarea><br/><br/><br/>
                            *preprint title<br/><br/>
                            <textarea style="width:65%; height:16px" name="title" id="textbox" class="textbox" required placeholder="example of title: The geometric..."></textarea><br/><br/><br/>
                            *authors name<br/><br/>
                            <textarea style="width:65%; height:16px" name="author" id="textbox" class="textbox" required placeholder="example of author: Mario Rossi, Luca..."></textarea><br/><br/><br/>
                            journal reference<br/><br/>
                            <textarea style="width:65%; height:16px" name="journal" id="textbox" class="textbox" placeholder="example of Journal: Numer. Linear Algebra..."></textarea><br/><br/><br/>
                            comments<br/><br/>
                            <textarea style="width:65%; height:16px" name="comments" id="textbox" class="textbox" placeholder="example of comments: 10 pages..."></textarea><br/><br/><br/>
                            *arXiv category<br/><br/>
                            <textarea style="width:65%; height:16px" name="category" id="textbox" class="textbox" required placeholder="example of category: math.NA..."></textarea><br/><br/><br/>
                            *abstract<br/><br/>
                            <textarea style="width:65%; height:300px" name="abstract" id="textbox" class="textbox" required placeholder="example of abstract: The geometric..."></textarea><br/><br/><br/>
                            *PDF or other document file<br/>
                            <input type="hidden" name="MAX_FILE_SIZE" value="10000000"><br/>
                            <input type="file" required name="fileToUpload" id="fileToUpload"><br/><br/>
                            <input type="submit" name="bottoni8" value="Insert preprint" style='width:80px;' id='bottone_keyword' class='bottoni' onclick="return confirmInsert()"/><br/><br/>
                            </form>
                            <?php
                            $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints' . "/upload/";
                            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                            if (isset($_POST['bottoni8'])) {
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
                                    echo '<script type="text/javascript">alert("Preprint ' . $info[0] . ' inserted correctly!");</script>';
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
