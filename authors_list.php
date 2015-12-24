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
        <script type="text/javascript" src="./js/allscript.js">
        </script>
    </head>
    <body>
        <?php
        require_once './graphics/header.php';
        ?>
        <div onclick="myFunction2()">
            <div id="header-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="12u">
                            <header id="header">
                                <h1 id="logo"><a href="#" >DMI Papers</a></h1>
                                <nav id="nav">
                                    <a href='./view_preprints.php' onclick="loading(load);">Publications</a>
                                    <a href="./reserved.php" class="current-page-item" onclick="loading(load);">Reserved Area</a>
                                </nav>
                            </header>
                        </div>
                    </div>
                </div>
            </div><br/><br/><br/><br/>
            <center>
                <br/><br/>
                <h2>AUTHORS LIST</h2>
                <div>
                    <br/>
                    <a style="color:#ffffff;" href="./arXiv_panel.php" id="bottone_keyword" class="button" onclick="loading(load);">Back</a><br>
                    <br/>
                    <div class="boxContainerInsertAuthors">
                        <form name="f2" action="authors_list.php" method="POST">
                            <label>
                                Add author's?
                                <input type="checkbox" name="insert" value="1" checked/>
                            </label><br/><br/>
                            <input type="search" style="width:100%;" class='textbox' autocomplete = "on" required name="txt1" placeholder="name1, name2, name3, name..." autofocus />
                            <br/><br/>
                            <input type="submit" name="b2" value="Send" id="bottone_keyword" class="button"/>
                        </form>
                    </div>
                </div>
            </center>
            <div>
                <?php
                if (sessioneavviata() == True) {
                    echo "<center><br/><br/>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE LIST CAN'T BE CHANGED IN THIS MOMENT!</center><br/>";
                } else {
                    if (isset($_POST['b2'])) {
                        $name = $_POST['txt1'];
                        $insert = $_POST['insert'];
                        #funzione inserimento nuovi autori
                        aggiungiutente($name, $insert);
                    }
                    #visualizzo lista utenti...	
                    $nomi = legginomi();
                    #conto lunghezza array
                    $lunghezza = count($nomi);
                    echo "<form name='f1' action='authors_list.php' id='f1' method='POST' onsubmit='loading(load);'>
                            <center><table id='table' style='width:35%;'>";
                    echo "<tr id='th'>"
                    . "<td id='tdh'><label><input type='checkbox' class='checkall1' name='all1' onChange='toggle(this)'/>N&deg;:</label></td>"
                    . "<td id='tdh' align='center'>NAME:</td></tr>";
                    #creazione della tabella html dei file all'interno di pdf_downloads
                    $y = 1;
                    for ($i = 0; $i < $lunghezza; $i++) {
                        echo "<tr id='th'>"
                        . "<td id='td'><label><input type='checkbox' name='" . $i . "' value='checked' class='checkall1'/>$y.</label></td>"
                        . "<td id='td'>" . $nomi[$i] . "</td></tr>";
                        $y++;
                    }
                    echo "</table><input type='submit' class='button' name='b3' value='Remove' onclick='return confirmDelete4()'></center></form>";
                    if ($lunghezza == 0) {
                        #richiamo funzione per corretto update successivo
                        aggiornanomi();
                    }
                    if (isset($_POST['b3'])) {
                        $k = 0;
                        $z = 0;
                        #lunghezza array nomi
                        $lunghezza = count($nomi);
                        for ($j = 0; $j < $lunghezza; $j++) {
                            $delete = $_POST[$j];
                            #controllo di quali checkbox sono state selezionate
                            if ($delete != "checked") {
                                $array[$k] = $nomi[$j];
                                $k++;
                            } else {
                                $array2[$z] = $nomi[$j];
                                $z++;
                            }
                        }
                        #scrittura dei nomi sul database
                        scrivinomi($array);
                        #inserisco i nomi eliminati all'interno di una stringa per poi visualizzarla all'utente
                        $nomieliminati = implode(", ", $array2);
                        if ($nomieliminati == "") {
                            echo '<script type="text/javascript">alert("No author selected!");</script>';
                        } else {
                            echo '<script type="text/javascript">alert("' . $nomieliminati . ' deleted from list!");</script>';
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./authors_list.php">';
                        }
                    }
                }
                require_once './graphics/loader.php';
                ?>
            </div>
        </div>
    </body>
</html>
