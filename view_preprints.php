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
        <script type="text/javascript">
            //scorri fondo pagina
            function FinePagina() {
                var w = window.screen.width;
                var h = window.screen.height;
                window.scrollTo(w * h, w * h)
            }
            //visualizza ricerca avanzata
            function showHide(id) {
                if (id.style.display != 'block') {
                    id.style.display = 'block';
                    checkCookie();
                    showHide(opt);
                } else {
                    id.style.display = 'none';
                }
            }
            //setta cookie
            function setCookie(cname, cvalue, exdays) {
                var d = new Date();
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toGMTString();
                document.cookie = cname + "=" + cvalue + "; " + expires;
            }
            //legge cookie
            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ')
                        c = c.substring(1);
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }
            //cookie istruzioni fulltext search
            function checkCookie() {
                var adv = getCookie("adv");
                if (adv == "") {
                    alert("EXAMPLE OF USING BOOLEAN OPERATORS(full text search):\n'Milan Rome': this must be one of the two terms.\n'+Milan +Rome': must be present both terms.\n'+Milan Rome': there must be 'Milan' and possibly 'Rome'.\n'+Milan -Rome': there must be 'Milan' but not 'Rome'.\n'+Milan +(<Rome >Venice)': must be present or 'Milan' and 'Rome' or 'Milan' and 'Venice', but the records with 'Milan' and 'Venice' are of greater. ('<' Means less important, '>' means greater relevance).\n'''Milan Rome''': This must be the exact sequence 'Milan Rome'.\n");
                    setCookie("adv", "yes", 15);
                }
            }
            //opzioni di visualizzazione settaggi
            function showHide2(id) {
                if (id.style.display != 'block') {
                    id.style.display = 'block';
                    checkCookie1();
                    showHide2(adv);
                    showHide3(adv2);
                } else {
                    id.style.display = 'none';
                }
            }
            //opzioni di visualizzazione fulltext search
            function showHide3(id) {
                if (id.style.display != 'block') {
                    id.style.display = 'block';
                    showHide2(adv2);
                } else {
                    id.style.display = 'none';
                }
            }
            //avviso cookie impostazioni
            function checkCookie1() {
                var adv = getCookie("opt");
                if (adv == "") {
                    alert("This settings use cookies, your preferences will remain stored in your browser.");
                    setCookie("opt", "yes", 15);
                }
            }
            //cookie mathjax
            function checkCookie2() {
                var math = getCookie("math");
                if (math == "no") {
                    setCookie("math", "yes", 1825);
                    alert("MathJax is now abilited!");
                    window.location.reload();
                } else {
                    setCookie("math", "no", 1825);
                    alert("MathJax is now disabled!");
                    window.location.reload();
                }
            }
            //cookie pageview
            function checkCookie3() {
                var pageview = getCookie("pageview");
                if (pageview == "0") {
                    setCookie("pageview", "1", 1825);
                    alert("On page view is now abilited, PDF will be shown in the page!");
                    window.location.reload();
                } else {
                    adv.style.display = 'none';
                    setCookie("pageview", "0", 1825);
                    alert("On page view is now disabled!");
                    window.location.reload();
                }
            }
            //cookie searchbar in tutte le pagine
            function checkCookie6() {
                var pageview = getCookie("searchbarall");
                if (pageview == "0" || pageview == "") {
                    setCookie("searchbarall", "1", 1825);
                    setCookie("searchbar", "1", 1825);
                    alert("Search Bar is now abilited on all pages, now the bar will appear on every page!");
                    window.location.reload();
                } else {
                    setCookie("searchbarall", "0", 1825);
                    alert("Search Bar is now disabled on all pages, now the bar will appear only in this page!");
                    window.location.reload();
                }
            }
            //cookie searchbar in tutte le pagine
            function checkCookie7() {
                setCookie("searchbarall", "0", 1825);
                alert("Search Bar is now disabled on all pages, use settings menu to riactivate!");
            }
            //settaggio cookie pageview
            function checkCookie4() {
                setCookie("pageview", "0", 1825);
                window.location.reload();
            }
            //chiudi menu click fuori dalla finestra
            function myFunction() {
                adv.style.display = 'none';
                adv2.style.display = 'none';
                opt.style.display = 'none';
            }
            //funzione searchbar fixed
            $(document).ready(function () {
                var s = $("#sticker");
                var pos = s.position();
                $(window).scroll(function () {
                    var windowpos = $(window).scrollTop();
                    if (windowpos >= pos.top) {
                        s.addClass("stick");
                    } else {
                        s.removeClass("stick");
                    }
                });
            });
            //funzione visualizza freccia torna su 
            $(document).ready(function () {
                var s = $("#gotop");
                var pos = s.position();
                $(window).scroll(function () {
                    var windowpos = $(window).scrollTop();
                    if (windowpos >= 100) {
                        s.addClass("gotopview");
                    } else {
                        s.removeClass("gotopview");
                    }
                });
            });
            //funzione animazioni scrolling
            $(document).ready(function () {
                //Check to see if the window is top if not then display button
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        $('#scrollToTop').fadeIn();
                    } else {
                        $('#scrollToTop').fadeOut();
                    }
                });
                //funzione click per lo scrolling
                $('#scrollToTop').click(function () {
                    $('html, body').animate({scrollTop: 0}, 800);
                    return false;
                });
            });
        </script>
        <?php
        $valbotton = "Enable";
        #controllo cookie mathjax
        if ($_COOKIE['math'] == "yes" or ! isset($_COOKIE['math'])) {
            echo "	<script type='text/x-mathjax-config'>
            			MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$']]}});
        		</script>
        		<script type='text/javascript'
                		src='https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML'>
        		</script>";
            $valbotton = "Disable";
        }
        #controllo cookie pageview
        if ($_COOKIE['pageview'] == "") {
            echo "<script>javascript:checkCookie4();</script>";
        } else {
            if ($_COOKIE['pageview'] == "0") {
                $string = "Enable";
            } else {
                $string = "Disable";
            }
        }
        #disabilita searchbar su altre pagine
        if ($_GET['clos'] == "1" && $_COOKIE['searchbarall'] == "1") {
            echo "<script>javascript:checkCookie7();</script>";
            echo "<meta http-equiv='refresh' content='0'; URL=./view_preprints.php>";
        }
        #controllo cookie searchbar all
        if ($_COOKIE['searchbarall'] == "0" or ! isset($_COOKIE['searchbarall'])) {
            $string3 = "Enable";
        } else {
            $string3 = "Disable";
        }
        ?>
    </head>
    <body>
        <?php
        #importo file per utilizzare funzioni...
        require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'authorization/sec_sess.php';
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/check_nomi_data.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'arXiv/insert_remove_db.php');
        sec_session_start();
        if ($_SESSION['logged_type'] === "mod") {
            $t = "Go to arXiv panel";
            $rit = "arXiv_panel.php";
            $nav = "<header id='header'>
                                    <h1><a href='#' id='logo'>DMI Papers</a></h1>
                                    <nav id='nav'>
                                        <a href='./view_preprints.php' class='current-page-item'>Publications</a>
                                        <a href='./reserved.php'>Reserved Area</a>
                                    </nav>
                                </header>";
        } else if ($_SESSION['logged_type'] === "user") {
            $t = "Go to reserved area";
            $rit = "reserved.php";
            $nav = "<header id='header'>
                                    <h1><a href='#' id='logo'>DMI Papers</a></h1>
                                    <nav id='nav'>
                                        <a href='./view_preprints.php' class='current-page-item'>Publications</a>
                                        <a href='./reserved.php'>Reserved Area</a>
                                    </nav>
                                </header>";
        } else {
            $t = "Go to homepage";
            $rit = "main.php";
            $nav = "<header id='header'>
                                    <h1><a href='#' id='logo'>DMI Papers</a></h1>
                                    <nav id='nav'>
                                        <a href='./view_preprints.php' class='current-page-item'>Publications</a>
                                        <a href='./reserved.php'>Reserved Area</a>
                                    </nav>
                                </header>";
        }
        if ($_SESSION['logged_type'] != "mod") {
            $str1 = "<h1><center>in this section are the papers that have been published on DMI archive and papers published by the <a style='color:#007897;' href='./authors_list.php' onclick='window.open(this.href); return false'>authors</a> of the department on arxiv.org</center></h1><br/>";
        }
        ?>
        <div id="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="12u">
                        <?php echo $nav; ?>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <br/>
            <?php
            echo $str1;
            ?>
        </div>
    <center>
        <?php
        echo "<div id='gotop' hidden><a id='scrollToTop' title='Go top'><img style='width:25px; height:25px;' src='./images/top.gif'></a></div>";
        echo "
        <div id='sticker'>
            <form name='f1' action='view_preprints.php' method='GET'>
                <div style='float:right; width:100%;'>
                    To see <a style='color:#007897;' href='archived_preprints.php' onclick='window.open(this.href);
                            return false'>archived</a> (old publications)&nbsp&nbsp&nbsp&nbsp
                    Settings:
                    <input type='button' value='Show/Hide' onclick='javascript:showHide2(opt);'/>&nbsp
                    Advanced:
                    <input type='button' value='Show/Hide' onclick='javascript:showHide(adv);
                            javascript:showHide(adv2);'/>&nbsp&nbsp&nbsp&nbsp
                    Filter results by
                    <select name='f'>
                        <option value='all' selected='selected'>All papers:</option>
                        <option value='author'>Authors:</option>
                        <option value='category'>Category:</option>
                        <option value='year'>Year:</option>
                        <option value='id'>ID:</option>
                    </select>
                    <input type='search' autocomplete = 'on' style='width:30%;' name='r' placeholder='Author name, id of publication, etc.' value='" . $_GET['r'] . "'/>
                           <input type='submit' name='s' value='Send'/>
                </div>
                <div style='clear:both;'></div>
                <div id='adv' hidden style='margin-top:5px;'>
                    <div>
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
                        <label><input type='radio' name='o' value='dated' checked>Date (D)</label>
                        <label><input type='radio' name='o' value='datec'>Date (I)</label>
                        <label><input type='radio' name='o' value='idd'>Identifier (D)</label>
                        <label><input type='radio' name='o' value='idc'>Identifier (I)</label>
                        <label><input type='radio' name='o' value='named'>Author-name (D)</label>
                        <label><input type='radio' name='o' value='namec'>Author-name (I)</label>
                    </div>
                    <br/>
                </div>
            </form>
            <div id='adv2' hidden=''>
                <form name='f2' action='view_preprints.php' method='GET'>
                    <font color='#007897'>Full text search: (<a style='color:#007897;' onclick='window.open(this.href);
                            return false' href='http://en.wikipedia.org/wiki/Full_text_search'>info</a>)
                    </font>
                    <br/>
                    <div style='margin-top:5px;'>
                        Search: <input type='search' autocomplete = 'on' style='width:50%;' name='ft' placeholder='Insert phrase, name, keyword, etc.' value='" . $_GET['ft'] . "'/>
                                       <input type='submit' name='go' value='Send'/>
                    </div>
                    <div style='margin-bottom:5px;'>
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
                        </select>&nbsp&nbsp
                        Search on: 
                        <label><input type='radio' name='st' value='1' checked>Currents</label>
                        <label><input type='radio' name='st' value='0'>Archived</label>
                    </div>
                </form>
            </div>
            <div hidden id='opt' hidden='' style='margin-bottom:5px;'>
                <h1>Settings:</h1>
                MathJax script:&nbsp
                <input type='button' value='" . $valbotton . "' onclick='javascript:checkCookie2();' style='width:50px;'/>&nbsp
                Search Bar on all pages:&nbsp
                <input type='button' value='" . $string3 . "' onclick='javascript:checkCookie6();' style='width:50px;'/>&nbsp
                On page view for PDF:&nbsp
                <input type='button' value='" . $string . "' onclick='javascript:checkCookie3();' style='width:50px;'/>&nbsp
            </div>
        </div><br/>
        ";
        ?>
        <div onclick="myFunction()">
            <?php
#visualizza opzioni avanzate
            if ($_GET['More'] == "More") {
                echo "<script>javascript:showHide(adv);</script>";
            }
#ricerca full text
            if (isset($_GET['go']) && $_GET['go'] != "") {
                searchfulltext();
            }
#ricerca normale
            if (isset($_GET['s']) && $_GET['s'] != "") {
                if (!is_numeric($_GET['year2']) && is_numeric($_GET['year3'])) {
                    echo '<script type="text/javascript">alert("YEAR NOT VALID!(insert both years)");</script>';
                    #funzione lettura e filtro preprint
                    filtropreprint();
                } else {
                    if (!is_numeric($_GET['year3']) && is_numeric($_GET['year2'])) {
                        echo '<script type="text/javascript">alert("YEAR NOT VALID!(insert both years)");</script>';
                        #funzione lettura e filtro preprint
                        filtropreprint();
                    } else {
                        if ($_GET['t'] == 1 or $_GET['a'] == 1 or $_GET['c'] == 1 or $_GET['j'] == 1 or $_GET['h'] == 1 or $_GET['y'] == 1 or $_GET['all'] == 1 or $_GET['d'] == 1 or $_GET['e'] == 1 or $_GET['i'] == 1 or is_numeric($_GET['year1']) or is_numeric($_GET['year2']) or is_numeric($_GET['year3'])) {
                            searchpreprint();
                        } else {
                            #funzione lettura e filtro preprint
                            filtropreprint();
                        }
                    }
                }
            } else {
                if (($_GET['t'] == 1 or $_GET['a'] == 1 or $_GET['c'] == 1 or $_GET['j'] == 1 or $_GET['h'] == 1 or $_GET['y'] == 1 or $_GET['all'] == 1 or $_GET['d'] == 1 or $_GET['e'] == 1 or $_GET['i'] == 1 or is_numeric($_GET['year1']) or is_numeric($_GET['year2']) or is_numeric($_GET['year3'])) && $_GET['go'] != "Send") {
                    searchpreprint();
                } else {
                    if ($_GET['go'] != "Send") {
                        #funzione lettura e filtro preprint
                        filtropreprint();
                    }
                }
            }
            ?>
        </div><br/>
    </center>
</body>
</html>
