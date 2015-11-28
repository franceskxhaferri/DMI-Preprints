<?php
//import dei parametri per la connessione
include './impost_car.php';
//connessione al database
$db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
mysql_select_db($db_monte, $db_connection);

?>
