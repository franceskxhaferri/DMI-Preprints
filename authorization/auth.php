<?php

function LDAPAuth($UID) {
    global $ldaphost, $ldapport;
    $ldapconn = ldap_connect($ldaphost, $ldapport) or die("errore connessione LDAP server:  $ldaphost");
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
    $ds = $ldapconn;
    $dn = "ou=users,dc=dmi,dc=unipg,dc=it";
    //l'utente deve avere la licenza all'uso di dmipreprints
    $filter = "(&(carLicense=dmipreprints)(uid=$UID))";
    //selezione dei campi di interesse per il ritorno
    $justthese = array("sn");
    //ricerca nell'albero LDAP
    $sr = ldap_search($ds, $dn, $filter, $justthese);
    $info = ldap_get_entries($ds, $sr);
    return $info;
}

function RADIUSAuth($UID, $PASSWORD) {
    global $ip_radius_server, $shared_secret;
    require_once './radius.class.php';
    $radius = new Radius($ip_radius_server, $shared_secret);
    $result = $radius->AccessRequest($UID, $PASSWORD);
    if ($result) {
        echo 'RADIUS OK';
        return true;
    } else {
        echo 'RADIUS ERRORE';
        return false;
    }
}

function InternalAuth($UID, $PASSWORD) {
    global $db_connection;
    $hash = md5($PASSWORD);
    //da inserire nella query: WHERE verificato=yes
    #verifica se esistono preprints precedenti e li sposto...
    $sql = "SELECT COUNT(*) AS TOTALFOUND FROM ACCOUNTS WHERE email='" . $UID . "' AND password='" . $hash . "'";
    $query = mysqli_query($db_connection, $sql) or die(mysql_error());
    $row = mysqli_fetch_array($query);
    if ($row['TOTALFOUND'] > 0) {
        return true;
    } else {
        return false;
    }
}

function GetNameAuth($UID) {
    global $db_connection;
    $sql = "SELECT nome,cognome FROM ACCOUNTS WHERE email='" . $UID . "'";
    $query = mysqli_query($db_connection, $sql) or die(mysql_error());
    $row = mysqli_fetch_array($query);
    return $row['nome'] . " " . $row['cognome'];
}

function UpdateLastAuth($UID) {
    global $db_connection;
    $sql = "UPDATE ACCOUNTS SET accesso='" . date("c", time()) . "' WHERE email='" . $UID . "'";
    $query = mysqli_query($db_connection, $sql) or die(mysql_error());
}

function SearchAccount($UID) {
    global $db_connection;
    $sql = "SELECT COUNT(*) AS TOTALFOUND FROM ACCOUNTS WHERE email='" . $UID . "'";
    $query = mysqli_query($db_connection, $sql) or die(mysql_error());
    $row = mysqli_fetch_array($query);
    if ($row['TOTALFOUND'] > 0) {
        return true;
    } else {
        return false;
    }
}

function SearchAccountUser($UID) {
    global $db_connection;
    #verifica se esistono preprints precedenti e li sposto...
    $sql = "SELECT COUNT(*) AS TOTALFOUND FROM ACCOUNTS WHERE email='" . $UID . "'";
    $query = mysqli_query($db_connection, $sql) or die(mysql_error());
    $row = mysqli_fetch_array($query);
    if ($row['TOTALFOUND'] > 0) {
        return true;
    } else {
        return false;
    }
}

?>
