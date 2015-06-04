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
        <script type="text/javascript">
            checked = false;
            function checkedAll(f1) {
                var aa = document.getElementById('f1');
                if (checked == false)
                {
                    checked = true
                }
                else
                {
                    checked = false
                }
                for (var i = 0; i < aa.elements.length; i++) {
                    aa.elements[i].checked = checked;
                }
            }
            function FinePagina()
            {
                var w = window.screen.width;
                var h = window.screen.height;
                window.scrollTo(w * h, w * h)
            }
            function confirmDelete()
            {
                return confirm("Remove selected papers?");
            }
            function confirmInsert()
            {
                return confirm("Insert selected papers?");
            }
        </script>
    </head>
    <body>
        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'authorization/sec_sess.php';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/check_nomi_data.php');
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
                                        <a href='./view_preprints.php'>Publications</a>
                                        <a href="./reserved.php" class="current-page-item">Reserved Area</a>
                                    </nav>
                                </header>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <center><br/><br/>
                        <h2>APPROVE DMI PAPER</h2>
                        Go to admin panel&nbsp&nbsp&nbsp
                        <a style="height:17px; color:white;" href="./modp.php" id="bottone_keyword" class="bottoni">Back</a><br/>
                    </center>
                </div><br/>
                <div>
                    <?php
                    include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/insert_remove_db.php');
                    include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/arXiv_parsing.php');
                    include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'mysql/func.php');
                    #importazione variabili globali
                    include $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'impost_car.php';
                    echo "<center><a style='text-decoration: none;' href='javascript:FinePagina()'> &nbsp&nbsp&nbsp&nbsp&nbsp&#8595;&nbsp&nbsp&nbsp&nbsp&nbsp </a></center>";
                    echo "<hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>";
                    #leggere cartella...
                    #Imposto la directory da leggere
                    $directory = $basedir;
                    echo "<form name='f3' action='approve_preprints.php' id='f1' method='GET'><center><table>";
                    #Apriamo una directory e leggiamone il contenuto.
                    if (is_dir($directory)) {
                        #Apro l'oggetto directory
                        if ($directory_handle = opendir($directory)) {
                            #Scorro l'oggetto fino a quando non è termnato cioè false
                            echo "<tr><td><input type='checkbox' name='checkall' onclick='checkedAll(f1);'/></td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspNAME:</td><td>&nbsp&nbsp&nbspRECORD:</td><td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCREATED:</td></tr>";
                            $i = 0;
                            $y = 1;
                            while (($file = readdir($directory_handle)) !== false) {
                                #Se l'elemento trovato è diverso da una directory
                                #o dagli elementi . e .. lo visualizzo a schermo
                                if ((!is_dir($file)) & ($file != ".") & ($file != "..") & ($file != "index.html")) {
                                    $array[$i] = $file;
                                    $ids = $file;
                                    $ids = substr($ids, 0, -4);
                                    echo "<tr><td colspan='2'><label><input type='checkbox' name='" . $i . "' value='checked'/>$y.&nbsp&nbsp&nbsp<a href=./upload_dmi/" . $file . " onclick='window.open(this.href);return false' title='" . $file . "'>" . $file . "</a></label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td><td><a href=./manual_edit.php?id=" . $ids . " onclick='window.open(this.href);return false' title='" . $ids . "'>" . $ids . "</a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>";
                                    #recupero data creazione file
                                    $dat = date("Y-m-d H:i", filemtime($basedir . $file));
                                    echo "<td>&nbsp&nbsp&nbsp$dat</td></tr>";
                                    $i++;
                                    $y++;
                                }
                            }
                            echo "</table></center><center><br/><input type='submit' name='b2' value='Remove' style='width:70px;' id='bottone_keyword' class='bottoni' onclick='return confirmDelete()'><input type='submit' name='b3' value='Insert' style='width:70px;' id='bottone_keyword' class='bottoni' onclick='return confirmInsert()'></center></form>";
                            #Chiudo la lettura della directory.
                            closedir($directory_handle);
                        }
                    }
                    $z = 0;
                    $lunghezza = $i;
                    #eliminazione pdf, lettura cartella e ...
                    if (isset($_GET['b2'])) {
                        for ($j = 0; $j < $lunghezza; $j++) {
                            $percorso = $basedir . $array[$j];
                            $percorso2 = $copia . $array[$j];
                            $delete = $_GET[$j];
                            if ($delete == "checked") {
                                $z++;
                                if (is_dir($directory)) {
                                    if ($directory_handle = opendir($directory)) {
                                        while (($file = readdir($directory_handle)) !== false) {
                                            if ((!is_dir($file)) & ($file != ".") & ($file != "..") & ($file != "index.html")) {
                                                if ($file == $array[$j]) {
                                                    #cancello file...
                                                    unlink($percorso);
                                                    unlink($percorso2);
                                                    #cancello riga database...
                                                    remove_preprints($array[$j]);
                                                }
                                            }
                                        }
                                        #Chiudo la lettura della directory.
                                        closedir($directory_handle);
                                    }
                                }
                            }
                        }
                        #controllo se sono stati selezionati preprint da rimuovere
                        if ($z == 0) {
                            echo '<script type="text/javascript">alert("No paper selected!");</script>';
                        } else {
                            echo '<script type="text/javascript">alert("' . $z . ' papers removed correctly!");</script>';
                            #aggiorno la pagina dopo 0 secondi
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./approve_preprints.php">';
                        }
                    }
                    #inserimento pdf, lettura cartella e ...
                    if (isset($_GET['b3'])) {
                        for ($j = 0; $j < $lunghezza; $j++) {
                            $percorso = $basedir . $array[$j];
                            $percorso2 = $copia . $array[$j];
                            $delete = $_GET[$j];
                            if ($delete == "checked") {
                                $z++;
                                if (is_dir($directory)) {
                                    if ($directory_handle = opendir($directory)) {
                                        while (($file = readdir($directory_handle)) !== false) {
                                            if ((!is_dir($file)) & ($file != ".") & ($file != "..") & ($file != "index.html")) {
                                                if ($file == $array[$j]) {
                                                    $idd = substr($file, 0, -4);
                                                    #inserimento file nel database
                                                    insertopdf($idd);
                                                }
                                            }
                                        }
                                        #Chiudo la lettura della directory.
                                        closedir($directory_handle);
                                    }
                                }
                            }
                        }
                        #controllo se sono stati selezionati preprint da rimuovere
                        if ($z == 0) {
                            echo '<script type="text/javascript">alert("No papers selected!");</script>';
                        } else {
                            echo '<script type="text/javascript">alert("' . $z . ' papers inserted correctly!");</script>';
                            #aggiorno la pagina dopo 0 secondi
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./approve_preprints.php">';
                        }
                    }


                    echo "<hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'>";
                    echo "<center><a style='text-decoration: none;' href='javascript:window.scrollTo(0,0)'> &nbsp&nbsp&nbsp&nbsp&nbsp&#8593;&nbsp&nbsp&nbsp&nbsp&nbsp </a></center><br/>";
                    #avviso per utente di nessun preprint
                    if ($i == 0) {
                        echo '<script type="text/javascript">alert("No paper to be checked!");</script>';
                    }
                } else {
                    echo '<script type="text/javascript">alert("ACCESS DENIED!");</script>';
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
                }
            } else {
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
            }
            ?>
            <br/>
        </div>
    </body>
</html>
