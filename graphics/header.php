<?php

#importo file per utilizzare funzioni...
require_once './conf.php';
require_once './mysql/db_conn.php';
require_once './authorization/sec_sess.php';
require_once './authorization/auth.php';
require_once './arXiv/arXiv_parsing.php';
require_once './arXiv/functions.php';
require_once './mysql/functions.php';

sec_session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] < 86400)) {
    if ($_SESSION['logged_type'] === "mod" or $_SESSION['logged_type'] === "user") {
        if ($_COOKIE['searchbarall'] == "1") {
            #search bar
            //require_once './graphics/searchbar_bottom.php';
        }
    } else {
        echo '<script type="text/javascript">alert("ACCESS DENIED!");</script>';
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
        exit(0);
    }
} else {
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./reserved.php">';
    exit(0);
}
?>
