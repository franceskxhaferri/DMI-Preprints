<?php

#funzione per la verifica se ci sono sessioni attive

function sessioneavviata() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
#importazione variabili globali
    $var = True;
    $a = date("Ymd", time());
    $datas = datasessione();
    $sql = "SELECT attivo FROM sessione";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    $row = mysqli_fetch_array($result);
    if (($row['attivo'] == 0) or ( $datas < $a - 1)) {
        $var = False;
    }
    mysqli_close($db_connection);
    return $var;
}

#funzione di avvio della sessione

function avviasessione() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $a = date("Ymd", time());
    $sql = "UPDATE sessione SET attivo='1'";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    $sql = "UPDATE sessione_data SET data='" . $a . "'";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    mysqli_close($db_connection);
}

#funzione per terminare la sessione

function chiudisessione() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $sql = "UPDATE sessione SET attivo='0'";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    mysqli_close($db_connection);
}

#funzione verifica nuovo nome

function nomiprec($nome) {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    #cerca se il nome se era stato gia cercato...
    $nome = trim($nome);
    $sql = "SELECT * FROM AUTORI_BACKUP WHERE nome='" . $nome . "'";
    $query = mysqli_query($db_connection, $sql) or die(mysql_error());
    $array = mysqli_fetch_row($query);
    if ($array[0] == $nome) {
        mysqli_close($db_connection);
        return True;
    } else {
        mysqli_close($db_connection);
        return False;
    }
}

# funzione cancellazione preprint

function cancellaselected($id) {
    include './conf.php';
    include './mysql/db_conn.php';
    $sql = "DELETE FROM PREPRINTS WHERE id_pubblicazione='" . $id . "'";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    mysqli_close($db_connection);
}

# funzione cancellazione preprint archiviati

function cancellapreprint() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $sql = "SELECT * FROM PREPRINTS_ARCHIVIATI WHERE checked='1'";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    while ($row = mysqli_fetch_array($result)) {
        unlink($basedir4 . $row['Filename']);
    }
    $sql = "TRUNCATE TABLE PREPRINTS_ARCHIVIATI";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    mysqli_close($db_connection);
}

#funzione che controlla se si sono verificate interruzioni nell'ultimo update

function controllainterruzione() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $var = False;
    $sql = "SELECT id FROM temp";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    if ((mysqli_num_rows($result)) != 0) {
        $var = True;
    }
    mysqli_close($db_connection);
    return $var;
}

#funzione che cerca se il preprint è stato già scaricato nell'esecuzione in corso

function preprintscaricati($id) {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $var = False;
    $sql = "SELECT id FROM temp";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    while ($row = mysqli_fetch_array($result)) {
        if ($row['id'] == $id) {
            $var = True;
        }
    }
    mysqli_close($db_connection);
    return $var;
}

#funzione per l'inserimento dell'id dentro temp

function aggiornapreprintscaricati($id) {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $sql = "INSERT INTO temp (id) VALUES ('" . $id . "') ON DUPLICATE KEY UPDATE id = VALUES(id)";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    mysqli_close($db_connection);
}

#funzione per la cancellazione del contenuto temp

function azzerapreprint() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $sql = "TRUNCATE TABLE temp";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    mysqli_close($db_connection);
}

#funzione che cerca se il preprint se è presente

function cercapreprint($id) {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $id = trim($id);
    $sql = "SELECT * FROM PREPRINTS WHERE id_pubblicazione='" . $id . "'";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    $row = mysqli_fetch_array($result);
    if ($row['nome'] == $nome) {
        $var[0] = $row['id_pubblicazione'];
        $var[1] = ($row['titolo']);
        $var[2] = ($row['data_pubblicazione']);
        $var[3] = ($row['autori']);
        $var[4] = ($row['referenze']);
        $var[5] = ($row['commenti']);
        $var[6] = ($row['categoria']);
        $var[7] = ($row['abstract']);
        $var[8] = ($row['uid']);
        $var[9] = ($row['Filename']);
    }
    mysqli_close($db_connection);
    return $var;
}

#funzione che cerca se il nome è presente

function cercanome($nome) {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    #cerca se il nome se era stato gia cercato...
    $nome = trim($nome);
    $var = False;
    $sql = "SELECT * FROM AUTORI WHERE nome='" . $nome . "'";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    $row = mysqli_fetch_array($result);
    if ($row['nome'] == $nome) {
        $var = True;
    }
    mysqli_close($db_connection);
    return $var;
}

#funzione aggiornamento nomi_ultimo_lancio

function aggiornanomi() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    #leggo i nuovi nomi e li inserisco in array...
    $array = legginomi();
    $sql = "TRUNCATE TABLE AUTORI_BACKUP";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    $nl2 = count($array);
    #aggiorno i nomi...
    for ($i = 0; $i < $nl2; $i++) {
        $sql = "INSERT INTO AUTORI_BACKUP (nome) VALUES ('" . $array[$i] . "')";
        $query = mysqli_query($db_connection, $sql) or die(mysql_error());
    }
    mysqli_close($db_connection);
}

# funzione lettura nomi

function legginomi() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $sql = "SELECT nome FROM AUTORI";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $array[$i] = $row['nome'];
        $i++;
    }
    mysqli_close($db_connection);
    return $array;
}

#funzione scrittura nomi

function scrivinomi($nomi) {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $sql = "TRUNCATE TABLE AUTORI";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    $nl2 = count($nomi);
    #aggiorno i nomi...
    for ($i = 0; $i < $nl2; $i++) {
        $sql = "INSERT INTO AUTORI (nome) VALUES ('" . $nomi[$i] . "') ON DUPLICATE KEY UPDATE nome = VALUES(nome)";
        $query = mysqli_query($db_connection, $sql) or die(mysql_error());
    }
    mysqli_close($db_connection);
}

#funzione inserimento nuovo utente

function aggiungiutente($nome, $a) {
    #leggo i nuovi nomi e li inserisco in array...
    $array = legginomi();
    while (strpos($nome, "  ") !== FALSE) {
        echo '<script type="text/javascript">alert("NAME NOT VALID! DETECTED CONSECUTIVE SPACE INSIDE FIELD NAME!");</script>';
        return;
    }
    $array2 = explode(",", $nome);
    $nl = count($array2);
    $l = count($array);
    for ($i = 0; $i < $nl; $i++) {
        $temp = $array2[$i];
        $temp = trim($temp);
        $temp = ucwords($temp);
        #verifico se il nome è già presente...
        $array[$l] = $temp;
        $l++;
        $ris = cercanome($temp);
        if ($ris == False) {
            if ($a == 1) {
                #aggiorno i nomi se ci sono nomi da aggiungere...
                scrivinomi($array);
                echo '<script type="text/javascript">alert("' . $temp . ' inserted!");</script>';
            } else {
                echo '<script type="text/javascript">alert("' . $temp . ' not found!");</script>';
            }
        } else {
            if ($a == 1) {
                echo '<script type="text/javascript">alert("' . $temp . ' exists!");</script>';
            } else {
                echo '<script type="text/javascript">alert("' . $temp . ' found!");</script>';
            }
        }
    }
}

#data ultima sessione

function datasessione() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $sql = "SELECT data FROM sessione_data";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    $row = mysqli_fetch_array($result);
    $data = $row['data'];
    mysqli_close($db_connection);
    return $data;
}

#ritorno la data come intero

function dataprec() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $sql = "SELECT data FROM DATA_ULTIMO_LANCIO";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    $row = mysqli_fetch_array($result);
    $data = $row['data'];
    mysqli_close($db_connection);
    $data = trim($data);
    $data = substr($data, 0, 10);
    $data = str_replace("-", "", $data);
    #conversione della stringa in intero
    $data = intval($data);
    return $data;
}

#ritorno la data come una stringa

function datastring() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $sql = "SELECT data FROM DATA_ULTIMO_LANCIO";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    $row = mysqli_fetch_array($result);
    $data = $row['data'];
    mysqli_close($db_connection);
    return $data;
}

#aggiorno data_ultimo_lancio con la data di ultimo lancio

function aggiornadata() {
    include './conf.php';
//import connessione database
    include './mysql/db_conn.php';
    $a = date("Y-m-d H:i", time());
    $sql = "SELECT data FROM DATA_ULTIMO_LANCIO";
    $result = mysqli_query($db_connection, $sql) or die(mysql_error());
    $row = mysqli_fetch_array($result);
    $sql = "DELETE FROM DATA_ULTIMO_LANCIO WHERE data='" . $row['data'] . "'";
    $query = mysqli_query($db_connection, $sql) or die(mysql_error());
    #aggiorno la data...
    $sql = "INSERT INTO DATA_ULTIMO_LANCIO (data) VALUES ('" . $a . "') ON DUPLICATE KEY UPDATE data = VALUES(data)";
    $query = mysqli_query($db_connection, $sql) or die(mysql_error());
    mysqli_close($db_connection);
}

?>
