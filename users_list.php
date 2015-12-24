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
    <body><?php
        require_once './graphics/header.php';
        echo "<div id='gotop' hidden><a id='scrollToTop' title='Go top'><img style='width:25px; height:25px;' src='./images/top.gif'></a></div>";
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
            <br/><br/><br/><br/><br/><br/>
            <center>
                <h2>EXTERNAL USERS</h2>
                <div>
                    <br/>
                    <a style="color:#ffffff;" href="./modp.php" id="bottone_keyword" class="button" onclick="loading(load);">Back</a><br>
                    <br/>
                </div>
                <div>
                    <div id="container">
                        <?php
                        $order = "registrazione DESC";
                        echo "<center><form name='f1' action='users_list.php' id='f1' method='GET' onsubmit='loading(load);'>
                            <div>
                            <div align='left' class='boxContainerOrderUsers'>Order by:<br/>";
                        $array_opt = array('regd' => array('Registration', 'registrazione DESC', 'desc'),
                            'regc' => array('Registration', 'registrazione ASC', 'asc'),
                            'accd' => array('Access', 'accesso DESC', 'desc'),
                            'accc' => array('Access', 'accesso ASC', 'asc'),
                            'named' => array('Name', 'nome DESC', 'desc'),
                            'namec' => array('Name', 'nome ASC', 'asc'),
                            'snamed' => array('Surname', 'cognome DESC', 'desc'),
                            'snamec' => array('Surname', 'cognome ASC', 'asc'),
                            'verd' => array('Verification', 'verificato DESC', 'desc'),
                            'verc' => array('Verification', 'verificato ASC', 'asc'));
                        foreach ($array_opt as $key => $value) {
                            (($value[2] == 'desc')) ? $freccia = '&#8595;<br/>' : $freccia = '&#8593;<br/>';
                            if ($_GET['o'] == $key or $_POST['o'] == $key) {
                                $checked = "checked";
                                $order = $value[1];
                            } else {
                                $checked = "";
                            }
                            $html .= "<label><input type='radio' name='o' onClick='setOrder();' value='" . $key . "' " . $checked . ">" . $value[0] . " " . $freccia . "</label>";
                        }
                        print $html;
#lista utenti registrati
                        $nomi = find_accounts($order);
                        echo "</div></div><div class='UserListBox'><table id='table'>
<tr id='thhead'><td id='tdh' colspan='7' align='center'>EXTERNAL MEMBERS</td></tr>";
                        echo "<tr id='th'><td id='tdh'><label><input type='checkbox' class='checkall1' name='all1' onChange='toggle(this)'/>N&deg;:</label></td><td id='tdh' align='center'>NAME:</td><td id='tdh' align='center'>SURNAME:</td><td id='tdh' align='center'>EMAIL:</td><td id='tdh' align='center'>LAST ACCESS:</td><td id='tdh' align='center'>REGISTERED:</td><td id='tdh' align='center'>VERIFIED:</td></tr>";
#creazione della tabella html dei file all'interno di pdf_downloads
                        $y = 1;
                        $i = 0;
                        while ($row = mysqli_fetch_array($nomi)) {
                            echo "<tr id='th'><td id='td'><label><input type='checkbox' name='" . $i . "' value='checked' class='checkall1'/>$y.</label></td><td id='td'>" . $row['nome'] . "</td><td id='td'>" . $row['cognome'] . "</td><td id='td'>" . $row['email'] . "</td><td id='td'>" . $row['accesso'] . "</td><td id='td'>" . $row['registrazione'] . "</td><td id='td'>" . $row['verificato'] . "</td></tr>";
                            $array[$i] = $row['email'];
                            $y++;
                            $i++;
                        }
                        echo "</table></div></center><input type='submit' class='button' name='b3' value='Remove' onclick='return confirmDelete6()'></center></form>";
                        if (isset($_GET['b3'])) {
                            $k = 0;
                            for ($j = 0; $j < $i; $j++) {
                                #controllo di quali checkbox sono state selezionate
                                if ($_GET[$j] == "checked") {
                                    $array2[$k] = $array[$j];
                                    $k++;
                                }
                            }
                            //eliminazione utenti selezionati
                            remove_accounts($array2);
                            //inserisco i nomi eliminati all'interno di una stringa per poi visualizzarla all'utente
                            $nomieliminati = implode(", ", $array2);
                            if ($nomieliminati == "") {
                                echo '<script type="text/javascript">alert("No users selected!");</script>';
                            } else {
                                echo '<script type="text/javascript">alert("User/s deleted correctly!");</script>';
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./users_list.php">';
                            }
                        }
                        require_once './graphics/loader.php';
                        ?>
                    </div>
                </div>
            </center>
        </div>
    </body>
</html>
