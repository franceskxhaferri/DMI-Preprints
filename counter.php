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
        <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
        <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
        <script>
            webshims.setOptions('waitReady', false);
            webshims.setOptions('forms-ext', {types: 'date'});
            webshims.polyfill('forms forms-ext');
        </script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
        </script>
        <script type="text/javascript"
                src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
        </script>
        <script type="text/javascript" src="./js/allscript.js">
        </script>
    </head>
    <body>
        <?php
        echo "<center>
        <div id='utildiv'>
            <form name='f1' action='view_preprints.php' method='GET' onsubmit='loading(load);'>
                <div style='float:right; width:100%;'>
                            Advanced search options / Full text search:
                    <input type='button' value='Show/Hide' onclick='javascript:showHide(adv);javascript:showHide(adv2);'>
                    or filter results by
                    <select name='f'>
                        <option value='all' selected='selected'>All papers:</option>
                        <option value='author'>Authors:</option>
                        <option value='category'>Category:</option>
                        <option value='year'>Year:</option>
                        <option value='id'>ID:</option>
                    </select>
                    <input type='search' autocomplete = 'on' style='width:40%;' name='r' placeholder='Author name, id of publication, year of publication, etc.' value='" . $_GET['r'] . "'>
                        <input type='submit' name='s' value='Send'>
                </div>
                <div style='clear:both;'></div>
                <div id='adv' hidden=''>
                        Reset selections: 
                        <input type='reset' name='reset' value='Reset'>&nbsp&nbsp
                        Years restrictions: 
                        until 
                        <input type='text' name='year1' style='width:35px' placeholder='Last'>
                        , or from 
                        <input type='text' name='year2' style='width:35px' placeholder='First'>
                        to 
                        <input type='text' name='year3' style='width:35px' placeholder='Last'>
                        &nbsp&nbspResults for page: 
                        <select name='rp'>
                            <option value='5' selected='selected'>5</option>
                            <option value='10'>10</option>
                            <option value='15'>15</option>
                            <option value='20'>20</option>
                            <option value='25'>25</option>
                            <option value='50'>50</option>
                        </select>
                        &nbsp&nbspGo to page:
                        <input type='text' name='p' style='width:25px' placeholder='n&#176;'>
                        <br/>
                        Search on:
                        <label><input type='checkbox' name='d' value='1'>Archived</label>
                        <label><input type='checkbox' name='all' value='1'>Record</label>
                        <label><input type='checkbox' name='h' value='1'>Author</label>
                        <label><input type='checkbox' name='t' value='1'>Title</label>
                        <label><input type='checkbox' name='a' value='1'>Abstract</label>
                        <label><input type='checkbox' name='e' value='1'>Date</label>
                        <label><input type='checkbox' name='y' value='1'>Category</label>
                        <label><input type='checkbox' name='c' value='1'>Comments</label>
                        <label><input type='checkbox' name='j' value='1'>Journal-ref</label>
                        <label><input type='checkbox' name='i' value='1'>ID</label>
                        <br/>
                        Order results by:
                        <label><input type='radio' name='o' value='dated' checked>Date &#8595;</label>
                        <label><input type='radio' name='o' value='datec'>Date &#8593;</label>
                        <label><input type='radio' name='o' value='idd'>Identifier &#8595;</label>
                        <label><input type='radio' name='o' value='idc'>Identifier &#8593;</label>
                        <label><input type='radio' name='o' value='named'>Author-name &#8595;</label>
                        <label><input type='radio' name='o' value='namec'>Author-name &#8593;</label>
                </div>
            </form>
            <div id='adv2' hidden=''>
                <form name='f2' action='view_preprints.php' method='GET' onsubmit='loading(load);'>
                    <font color='#007897'>Full text search: (<a style='color:#007897;' onclick='window.open(this.href);
                            return false' href='http://en.wikipedia.org/wiki/Full_text_search'>info</a>)
                    </font>
                    <br/>
                        Search: <input type='search' autocomplete = 'on' style='width:50%;' name='ft' placeholder='Insert phrase, name, keyword, etc.' value='" . $_GET['ft'] . "'/>
                                       <input type='submit' name='go' value='Send'/><br/>
                        Reset selections: 
                        <input type='reset' name='reset' value='Reset'>&nbsp&nbsp
                        Results for page: 
                        <select name='rp'>
                            <option value='5' selected='selected'>5</option>
                            <option value='10'>10</option>
                            <option value='15'>15</option>
                            <option value='20'>20</option>
                            <option value='25'>25</option>
                            <option value='50'>50</option>
                        </select>
                        &nbsp&nbspGo to page:
                        <input type='text' name='p' style='width:25px' placeholder='n&#176;'>
                        &nbsp&nbsp
                        Search on: 
                        <label><input type='radio' name='st' value='1' checked>Currents</label>
                        <label><input type='radio' name='st' value='0'>Archived</label>
                </form>
            </div>
        </div></center>
        ";
        #funzione incremento contatore visualizzazioni
        #importazione variabili globali
        include $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'impost_car.php';
        #connessione al database...
        $db_connection = mysql_connect($hostname_db, $username_db, $password_db) or trigger_error(mysql_error(), E_USER_ERROR);
        mysql_select_db($db_monte, $db_connection);
        #acquisizione valore
        $id = $_GET['id'];
        $sql = "SELECT * FROM PREPRINTS WHERE id_pubblicazione='" . $id . "'";
        $query = mysql_query($sql) or die(mysql_error());
        $row = mysql_fetch_array($query);
        if ($_GET['i'] == 1) {
            #incremento valore
            $sql = "UPDATE PREPRINTS SET counter='" . ($row['counter'] + 1) . "' WHERE id_pubblicazione='" . $id . "'";
            $query = mysql_query($sql) or die(mysql_error());
            #chiusura connessione al database
            mysql_close($db_connection);
            #reindirizzamento al pdf
            $var = "./pdf/" . $row['Filename'];
            $var2 = "./counter.php?id=" . $id;
            echo "<meta http-equiv=refresh content='0; url=$var2'>";
        } else {
            $var = "./pdf/" . $row['Filename'];
        }
        ?>
        <div onclick="myFunction()">
            <div style="float:left; width:70%; height: 630px;">
                <embed id="emb" src="<?php echo $var; ?>"/>
            </div>
            <font style="font-weight: bold; margin-left:5px;">PUBLICATION INFORMATIONS: </font><br/>
            <div id="divinfo">
                <p style="padding: 6px;">
                    <font style="font-weight: bold;">ID: </font><?php echo $row['id_pubblicazione']; ?><br/><br/>
                    <font style="font-weight: bold;">Submitted by: </font><?php echo $row['uid']; ?><br/>
                    <font style="font-weight: bold;">Date: </font><?php echo $row['data_pubblicazione']; ?><br/><br/>
                    <font style="font-weight: bold;">Category: </font><?php echo $row['categoria']; ?><br/><br/>
                    <font style="font-weight: bold;">Title: </font><?php echo $row['titolo']; ?><br/><br/>
                    <font style="font-weight: bold;">Authors: </font><?php echo $row['autori']; ?><br/><br/>
                    <font style="font-weight: bold;">References: </font><?php echo $row['referenze']; ?><br/><br/>
                    <font style="font-weight: bold;">Comments: </font><?php echo $row['commenti']; ?><br/><br/>
                    <font style="font-weight: bold;">Abstract: </font><?php echo $row['abstract']; ?><br/><br/>
                    <font style="font-weight: bold;">Visualizations: </font><?php echo $row['counter']; ?>
                </p>
            </div>
            <br/><br/><br/>
        </div>
    </body>
</html>
