<?php

#funzione per la verifica se ci sono sessioni attive

function sessioneavviata() {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $var = True;
    $a = date("Ymd", time());
    $datas = datasessione();
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT attivo FROM sessione";
    $result = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if (($row['attivo'] == 0) or ( $datas < $a - 1)) {
        $var = False;
    }
    mysql_close($db_connection);
    return $var;
}

#funzione di avvio della sessione

function avviasessione() {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $a = date("Ymd", time());
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "UPDATE sessione SET attivo='1'";
    $result = mysql_query($sql) or die(mysql_error());
    $sql = "UPDATE sessione_data SET data='" . $a . "'";
    $result = mysql_query($sql) or die(mysql_error());
    mysql_close($db_connection);
}

#funzione per terminare la sessione

function chiudisessione() {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "UPDATE sessione SET attivo='0'";
    $result = mysql_query($sql) or die(mysql_error());
    mysql_close($db_connection);
}

#funzione verifica nuovo nome

function nomiprec($nome) {
    #cerca se il nome se era stato gia cercato...
    $nome = trim($nome);
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT * FROM AUTORI_BACKUP WHERE nome='" . $nome . "'";
    $query = mysql_query($sql) or die(mysql_error());
    $array = mysql_fetch_row($query);
    if ($array[0] == $nome) {
        mysql_close($db_connection);
        return True;
    } else {
        mysql_close($db_connection);
        return False;
    }
}

# funzione filtro lettura preprint

function filtropreprint() {
    $copia = $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . "arXiv/pdf/";
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $risperpag = 5;
    $p = $_GET['p'];
    $limit = $risperpag * $p - $risperpag;
    if ($_GET['f'] == "author") {
        $querytotale = mysql_query("SELECT * FROM PREPRINTS WHERE autori LIKE '%" . $_GET['r'] . "%' AND checked='1'");
        $ristot = mysql_num_rows($querytotale);
        $npag = ceil($ristot / $risperpag);
        $sql = "SELECT * FROM PREPRINTS WHERE autori LIKE '%" . $_GET['r'] . "%' AND checked='1' LIMIT " . $limit . "," . $risperpag . "";
        $result = mysql_query($sql) or die(mysql_error());
    } else if ($_GET['f'] == "category") {
        $querytotale = mysql_query("SELECT * FROM PREPRINTS WHERE categoria LIKE '%" . $_GET['r'] . "%' AND checked='1'");
        $ristot = mysql_num_rows($querytotale);
        $npag = ceil($ristot / $risperpag);
        $sql = "SELECT * FROM PREPRINTS WHERE categoria LIKE '%" . $_GET['r'] . "%' AND checked='1'";
        $result = mysql_query($sql) or die(mysql_error());
    } else if ($_GET['f'] == "year") {
        $querytotale = mysql_query("SELECT * FROM PREPRINTS WHERE data_pubblicazione LIKE '%" . $_GET['r'] . "%' AND checked='1'");
        $ristot = mysql_num_rows($querytotale);
        $npag = ceil($ristot / $risperpag);
        $sql = "SELECT * FROM PREPRINTS WHERE data_pubblicazione LIKE '%" . $_GET['r'] . "%' AND checked='1'";
        $result = mysql_query($sql) or die(mysql_error());
    } else {
        $querytotale = mysql_query("SELECT * FROM PREPRINTS WHERE autori LIKE '%" . $_GET['r'] . "%' AND checked='1'");
        $ristot = mysql_num_rows($querytotale);
        $npag = ceil($ristot / $risperpag);
        $sql = "SELECT * FROM PREPRINTS WHERE autori LIKE '%" . $_GET['r'] . "%' AND checked='1' LIMIT " . $limit . "," . $risperpag . "";
        $result = mysql_query($sql) or die(mysql_error());
    }
    $i = $limit;
    while ($row = mysql_fetch_array($result)) {
        $i++;
        echo "<div style='width:850px;'><h1>" . $i . ".<br/><br/>Id of pubblication:</h1><br/>" . $row['id_pubblicazione'] . "<br/><br/><br/>";
        echo "<h1>Title:</h1><br/>" . stripslashes($row['titolo']) . "<br/><br/><br/>";
        echo "<h1>Date of pubblication:</h1><br/>" . stripslashes($row['data_pubblicazione']) . "<br/><br/><br/>";
        echo "<h1>Author/s:</h1><br/>" . stripslashes($row['autori']) . "<br/><br/><br/>";
        echo "<h1>Journal reference:</h1><br/>" . stripslashes($row['referenze']) . "<br/><br/><br/>";
        echo "<h1>Comments:</h1><br/>" . stripslashes($row['commenti']) . "<br/><br/><br/>";
        echo "<h1>Category:</h1><br/>" . stripslashes($row['categoria']) . "<br/><br/><br/>";
        echo "<h1>Abstract:</h1><br/>" . stripslashes($row['abstract']) . "<br/><br/><br/>";
        echo "<a style='color:#5d93a2;' href=./arXiv/pdf/" . $row['Filename'] . " onclick='window.open(this.href);return false' title='" . $row['id_pubblicazione'] . "'>PDF</a><br/>";
        echo "</div><br/><hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'><br/>";
    }
    if ($ristot != 0) {
        if ($p != 1) {
            echo '<a style="color:#5d93a2; text-decoration: none;" href="view_preprints.php?p=' . ($p - 1) . '&r=' . $_GET['r'] . '"> &#8656 </a>';
        }
        echo "&nbsp&nbsp&nbsp&nbsp" . $p . "&nbsp&nbsp&nbsp&nbsp";
        if ($p != $npag) {
            echo '<a style="color:#5d93a2; text-decoration: none;" href="view_preprints.php?p=' . ($p + 1) . '&r=' . $_GET['r'] . '"> &#8658 </a>';
        }
    }
    echo "<br/><br/><br/>";
    echo "RESULTS: " . $limit . " - " . $p * "5" . "
    <br/><br/>TOTAL OF ELEMENTS: " . $ristot . "<br/><br/><br/>";
    mysql_close($db_connection);
}

#funzione lettura preprint archiviati

function leggipreprintarchiviati() {
    $copia = $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . "arXiv/pdf/";
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $risperpag = 5;
    $p = $_GET['p'];
    $limit = $risperpag * $p - $risperpag;
    $querytotale = mysql_query("SELECT * FROM PREPRINTS_ARCHIVIATI WHERE checked='1'");
    $ristot = mysql_num_rows($querytotale);
    if ($_GET['c'] != "Remove all") {
        $npag = ceil($ristot / $risperpag);
        $sql = "SELECT * FROM PREPRINTS_ARCHIVIATI WHERE checked='1' LIMIT " . $limit . "," . $risperpag . "";
        $result = mysql_query($sql) or die(mysql_error());
        $i = $limit;
        while ($row = mysql_fetch_array($result)) {
            $i++;
            echo "<div style='width:850px;'><h1>" . $i . ".<br/><br/>Id of pubblication:</h1><br/>" . $row['id_pubblicazione'] . "<br/><br/><br/>";
            echo "<h1>Title:</h1><br/>" . stripslashes($row['titolo']) . "<br/><br/><br/>";
            echo "<h1>Date of pubblication:</h1><br/>" . stripslashes($row['data_pubblicazione']) . "<br/><br/><br/>";
            echo "<h1>Author/s:</h1><br/>" . stripslashes($row['autori']) . "<br/><br/><br/>";
            echo "<h1>Journal reference:</h1><br/>" . stripslashes($row['referenze']) . "<br/><br/><br/>";
            echo "<h1>Comments:</h1><br/>" . stripslashes($row['commenti']) . "<br/><br/><br/>";
            echo "<h1>Category:</h1><br/>" . stripslashes($row['categoria']) . "<br/><br/><br/>";
            echo "<h1>Abstract:</h1><br/>" . stripslashes($row['abstract']) . "<br/><br/><br/>";
            echo "</div><br/><hr style='display: block; height: 1px; border: 0; border-top: 1px solid #ccc; margin: 1em 0; padding: 0;'><br/>";
        }
        if ($ristot != 0) {
            if ($p != 1) {
                echo '<a style="color:#5d93a2; text-decoration: none;" href="archived_preprints.php?p=' . ($p - 1) . '&r=' . $_GET['r'] . '"> &#8656 </a>';
            }
            echo "&nbsp&nbsp&nbsp&nbsp" . $p . "&nbsp&nbsp&nbsp&nbsp";
            if ($p != $npag) {
                echo '<a style="color:#5d93a2; text-decoration: none;" href="archived_preprints.php?p=' . ($p + 1) . '&r=' . $_GET['r'] . '"> &#8658 </a>';
            }
        }
    } else {
        if ($ristot != 0) {
            cancellapreprint();
            echo '<META HTTP-EQUIV="Refresh" Content="2; URL=./archived_preprints.php?p=1">';
        } else {
            $limit = 0;
            echo "NO PREPRINTS!";
        }
    }
    echo "<br/><br/><br/>";
    echo "RESULTS: " . $limit . " - " . $p * "5" . "
    <br/><br/>TOTAL OF ELEMENTS: " . $ristot . "<br/><br/><br/>";
    mysql_close($db_connection);
    return $ristot;
}

# funzione cancellazione preprint

function cancellaselected($id) {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "DELETE FROM PREPRINTS WHERE id_pubblicazione='" . $id . "'";
    $result = mysql_query($sql) or die(mysql_error());
    mysql_close($db_connection);
}

# funzione cancellazione preprint archiviati

function cancellapreprint() {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "DELETE FROM PREPRINTS_ARCHIVIATI WHERE checked='1'";
    $result = mysql_query($sql) or die(mysql_error());
    echo "PREPRINTS DELETED!<br/><br/><br/>";
    mysql_close($db_connection);
}

#funzione che cerca se il preprint è stato già scaricato nell'esecuzione in corso

function preprintscaricati($id) {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $var = False;
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT id FROM temp";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        if ($row['id'] == $id) {
            $var = True;
        }
    }
    mysql_close($db_connection);
    return $var;
}

#funzione per l'inserimento dell'id dentro temp

function aggiornapreprintscaricati($id) {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "INSERT INTO temp (id) VALUES ('" . $id . "') ON DUPLICATE KEY UPDATE id = VALUES(id)";
    $result = mysql_query($sql) or die(mysql_error());
    mysql_close($db_connection);
}

#funzione per la cancellazione del contenuto temp

function azzerapreprint() {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT id FROM temp";
    $result = mysql_query($sql) or die(mysql_error());
    while ($row = mysql_fetch_array($result)) {
        $sql = "DELETE FROM temp WHERE id='" . $row['id'] . "'";
        $query = mysql_query($sql) or die(mysql_error());
    }
    mysql_close($db_connection);
}

#funzione che cerca se il nome è presente

function cercapreprint($id) {
    #cerca se il nome se era stato gia cercato...
    $id = trim($id);
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT * FROM PREPRINTS WHERE id_pubblicazione='" . $id . "'";
    $result = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if ($row['nome'] == $nome) {
        $var[0] = $row['id_pubblicazione'];
        $var[1] = stripslashes($row['titolo']);
        $var[2] = stripslashes($row['data_pubblicazione']);
        $var[3] = stripslashes($row['autori']);
        $var[4] = stripslashes($row['referenze']);
        $var[5] = stripslashes($row['commenti']);
        $var[6] = stripslashes($row['categoria']);
        $var[7] = stripslashes($row['abstract']);
    }
    mysql_close($db_connection);
    return $var;
}

#funzione che cerca se il nome è presente

function cercanome($nome) {
    #cerca se il nome se era stato gia cercato...
    $nome = trim($nome);
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $var = False;
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT * FROM AUTORI WHERE nome='" . $nome . "'";
    $result = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_array($result);
    if ($row['nome'] == $nome) {
        $var = True;
    }
    mysql_close($db_connection);
    return $var;
}

#funzione aggiornamento nomi_ultimo_lancio

function aggiornanomi() {
    #leggo i nuovi nomi e li inserisco in array...
    $array = legginomi();
    #cerca se il nome se era stato gia cercato...
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT nome FROM AUTORI_BACKUP";
    $result = mysql_query($sql) or die(mysql_error());
    $nl2 = count($array);
    while ($row = mysql_fetch_array($result)) {
        $sql = "DELETE FROM AUTORI_BACKUP WHERE nome='" . $row['nome'] . "'";
        $query = mysql_query($sql) or die(mysql_error());
    }
    #aggiorno i nomi...
    for ($i = 0; $i < $nl2; $i++) {
        $sql = "INSERT INTO AUTORI_BACKUP (nome) VALUES ('" . $array[$i] . "')";
        $query = mysql_query($sql) or die(mysql_error());
    }
    mysql_close($db_connection);
}

# funzione lettura nomi

function legginomi() {
    #leggo i nuovi nomi e li inserisco in array...
    #cerca se il nome se era stato gia cercato...
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT nome FROM AUTORI";
    $result = mysql_query($sql) or die(mysql_error());
    $i = 0;
    while ($row = mysql_fetch_array($result)) {
        $array[$i] = $row['nome'];
        $i++;
    }
    mysql_close($db_connection);
    return $array;
}

#funzione scrittura nomi

function scrivinomi($nomi) {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT nome FROM AUTORI";
    $result = mysql_query($sql) or die(mysql_error());
    $nl2 = count($nomi);
    while ($row = mysql_fetch_array($result)) {
        $sql = "DELETE FROM AUTORI WHERE nome='" . $row['nome'] . "'";
        $query = mysql_query($sql) or die(mysql_error());
    }
    #aggiorno i nomi...
    for ($i = 0; $i < $nl2; $i++) {
        $sql = "INSERT INTO AUTORI (nome) VALUES ('" . $nomi[$i] . "') ON DUPLICATE KEY UPDATE nome = VALUES(nome)";
        $query = mysql_query($sql) or die(mysql_error());
    }
    mysql_close($db_connection);
}

#funzione inserimento nuovo utente

function aggiungiutente($nome, $a) {
    #leggo i nuovi nomi e li inserisco in array...
    $array = legginomi();
    while (strpos($nome, "  ") !== FALSE) {
        echo "<center>NAME NOT VALID! DETECTED CONSECUTIVE SPACE INSIDE FIELD NAME!</center><br/>";
        return;
    }
    $array2 = explode(",", $nome);
    $nl = count($array2);
    $l = count($array);
    for ($i = 0; $i < $nl; $i++) {
        $temp = $array2[$i];
        $temp = trim($temp);
        $temp = strtoupper($temp);
        #verifico se il nome è già presente...
        $array[$l] = $temp;
        $l++;
        $ris = cercanome($temp);
        if ($ris == False) {
            if ($a == 1) {
                echo "<center>&#171; " . $temp . " &#187; INSERTED!</center><br/>";
                #aggiorno i nomi se ci sono nomi da aggiungere...
                scrivinomi($array);
            } else {
                echo "<center>&#171; " . $temp . " &#187; NOT FOUND!</center><br/>";
            }
        } else {
            if ($a == 1) {
                echo "<center>&#171; " . $temp . " &#187; EXISTS!</center><br/>";
            } else {
                echo "<center>&#171; " . $temp . " &#187; FOUND!</center><br/>";
            }
        }
    }
}

#data ultima sessione

function datasessione() {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT data FROM sessione_data";
    $result = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $data = $row['data'];
    mysql_close($db_connection);
    return $data;
}

#ritorno la data come intero

function dataprec() {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT data FROM DATA_ULTIMO_LANCIO";
    $result = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $data = $row['data'];
    mysql_close($db_connection);
    $data = trim($data);
    $data = substr($data, 0, 10);
    $data = str_replace("-", "", $data);
    #conversione della stringa in intero
    $data = intval($data);
    return $data;
}

#ritorno la data come una stringa

function datastring() {
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT data FROM DATA_ULTIMO_LANCIO";
    $result = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $data = $row['data'];
    mysql_close($db_connection);
    return $data;
}

#aggiorno data_ultimo_lancio con la data di ultimo lancio

function aggiornadata() {
    $a = date("Y-m-d H:i", time());
    #definizione parametri di connessione al database
    $hostname_db = "localhost";
    $db_monte = "dmipreprints"; //nome del database
    $username_db = "root"; //l'username
    $password_db = "1234"; // password
    $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
    mysql_select_db($db_monte, $db_connection);
    $sql = "SELECT data FROM DATA_ULTIMO_LANCIO";
    $result = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_array($result);
    $sql = "DELETE FROM DATA_ULTIMO_LANCIO WHERE data='" . $row['data'] . "'";
    $query = mysql_query($sql) or die(mysql_error());
    #aggiorno la data...
    $sql = "INSERT INTO DATA_ULTIMO_LANCIO (data) VALUES ('" . $a . "') ON DUPLICATE KEY UPDATE data = VALUES(data)";
    $query = mysql_query($sql) or die(mysql_error());
    mysql_close($db_connection);
}

?>
