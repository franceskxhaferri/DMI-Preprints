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
    <body><?php
        require_once './graphics/header.php';
        ?>
        <div onclick="myFunction2()">
            <div id="header-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="12u">
                            <header id="header">
                                <h1><a href="#" id="logo">DMI Papers</a></h1>
                                <nav id="nav">
                                    <a href='./index.php' onclick="loading(load);">Publications</a>
                                    <a href="./reserved.php" class="current-page-item" onclick="loading(load);">Reserved Area</a>
                                </nav>
                            </header>
                        </div>
                    </div>
                </div>
            </div><br/>
            <div id="firstContainer">
                <center>
                    <h2>manual insertion</h2>
                </center>
                <center><br/>
                    <a style="color:#ffffff;" href="./arXiv_panel.php" id="bottone_keyword" class="button" onclick="return confirmExit()" >Back</a><br/><br/>
                    <a style='color:#1976D2;' href='http://arxiv.org/' onclick='window.open(this.href);
                            return false' title='arXiv'>arXiv.org</a>
                </center><br/>
                <?php
                if (sessioneavviata() == True) {
                    echo "<br/><br/><center>SORRY ONE DOWNLOAD/UPDATE SESSION IS RUNNING AT THIS TIME! THE SECTION CAN'T BE USED IN THIS MOMENT!</center><br/>";
                    exit(0);
                } else {
                    ?>
                    <center>
                        <div>
                            <form name='f3' action='manual_insert.php' method='POST' onsubmit="loading(load);">
                                Get paper informations from arXiv:
                                <input type='search' autocomplete = 'on' name='id' required class='textfield' placeholder='Insert id(arXiv): 0000.0000'/>
                                <input type='submit' name='b7' value='Get' id='bottone_keyword' class='button' ><br/>
                            </form>
                        </div>
                    </center><br/>
                    <?php
                    if (isset($_POST['b7'])) {
                        echo "<div hidden>";
                        $id = trim($_POST['id']);
                        arxiv_call($id, 0);
                        for ($i = 1; $i < 11; $i++) {
                            $id1 = $id . "v" . $i;
                            $ris = cercapreprint($id1);
                            if ($id1 == $ris[0]) {
                                #azzeramento file temporaneo...
                                azzerapreprint();
                                break;
                            }
                        }
                    }
                    echo "</div>";
                    if ($id1 == $ris[0] && isset($_POST['b7'])) {
                        $arcid1 = str_replace("/", "-", $id1);
                        #inserimento mediante arxiv
                        echo "
                <form name='f1' action='manual_insert.php' method='POST' enctype='multipart/form-data' onclick='myFunction()' onsubmit='loading(load);'>
                    <center><div><h2>paper informations</h2><h1>field with '*' are required.</h1><br/><input type='reset' name='reset' value='Reset'><br/><br/></center>
                        <div id='divinsertcateg'>
                        <div style='float:right; width:49%;'><div style='font-weight: bold;'>document:</div><div style='float:right; width:49%;'><a href='" . $basedir3 . $arcid1 . ".pdf' onclick='window.open(this.href);return false' style='color:#1976D2;' title='" . $arcid1 . ".pdf'>VIEW</a></div></div>
                        <div style='font-weight: bold;'>
                            id(not editable):
                        </div>
                            <textarea readonly style='width:49%;' name='id' id='textbox' class='textbox1' placeholder='example of id: 0000.0000v1'>" . $ris[0] . "</textarea><br/><br/>
                        <div style='font-weight: bold;'>
                            date(not editable):
                        </div>
                            <textarea readonly style='width:49%;' name='data' id='textbox' class='textbox1' placeholder='example of data: 2011-12-30T10:37:35Z'>" . $ris[2] . "</textarea>
                        </div>
                           <div>
                               <div id='divinsert'>
                                   <div id='divcontinsert'>
                                       *category:<br/>
                                       <textarea name='category' id='textbox' class='textbox1' required placeholder='example of category: math.NA...' onkeyup='UpdateMathcat(this.value)' >" . $ris[6] . "</textarea>
                                   </div>
                               </div>
                               <div id='divpreview'>
                                   <div style='font-weight: bold;'>
                                       preview:
                                   </div>
                                   <div id='divcontpreview'>
                                       <div id='categorydiv'></div>
                                   </div>
                               </div>
                           </div>
                           <div>
                               <div id='divinsert'>
                                   <div id='divcontinsert'>
                                       *title:<br/>
                                       <textarea name='title' id='textbox' class='textbox1' required placeholder='example of title: The geometric...' onkeyup='UpdateMathtit(this.value)'>" . $ris[1] . "</textarea>
                                   </div>
                               </div>
                               <div id='divpreview'>
                                   <div style='font-weight: bold;'>
                                       preview:
                                   </div>
                                   <div id='divcontpreview'>
                                       <div id='titlediv'></div>
                                   </div>
                               </div>
                           </div>
                           <div>
                               <div id='divinsert'>
                                   <div id='divcontinsert'>
                                       *authors:<br/>
                                       <textarea name='author' id='textbox' class='textbox1' required placeholder='example of author: Mario Rossi, Luca...' onkeyup='UpdateMathaut(this.value)'>" . $ris[3] . "</textarea>
                                   </div>
                               </div>
                               <div id='divpreview'>
                                   <div style='font-weight: bold;'>
                                       preview:
                                   </div>
                                   <div id='divcontpreview'>
                                       <div id='authordiv'></div>
                                   </div>
                               </div>
                           </div>
                           <div>
                               <div id='divinsert'>
                                   <div id='divcontinsert'>
                                       journal ref:<br/>
                                       <textarea name='journal' id='textbox' class='textbox1' placeholder='example of Journal: Numer. Linear Algebra...' onkeyup='UpdateMathjou(this.value)'>" . $ris[4] . "</textarea>
                                   </div>
                               </div>
                               <div id='divpreview'>
                                   <div style='font-weight: bold;'>
                                       preview:
                                   </div>
                                   <div id='divcontpreview'>
                                       <div id='journaldiv'></div>
                                   </div>
                               </div>
                           </div>
                           <div>
                               <div id='divinsert'>
                                   <div id='divcontinsert'>
                                       comments:<br/>
                                       <textarea name='comments' id='textbox' class='textbox1' placeholder='example of comments: 10 pages...' onkeyup='UpdateMathcom(this.value)'>" . $ris[5] . "</textarea>
                                   </div>
                               </div>
                               <div id='divpreview'>
                                   <div style='font-weight: bold;'>
                                       preview:
                                   </div>
                                   <div id='divcontpreview'>
                                       <div id='commentsdiv'></div>
                                   </div>
                               </div>
                           </div>
                           <div>
                               <div id='divinsert'>
                                   <div id='divcontinsertabs'>
                                       *abstract:<br/>
                                       <textarea name='abstract' id='textboxabs' class='textbox1' required placeholder='example of abstract: The geometric...' onkeyup='UpdateMathabs(this.value)'>" . $ris[7] . "</textarea>
                                   </div>
                               </div>
                               <div id='divpreview'>
                                   <div style='font-weight: bold;'>
                                       preview:
                                   </div>
                                   <div id='divcontpreviewabs'>
                                       <div id='abstractdiv'></div>
                                   </div>
                               </div>
                           </div>
                           <div style='clear:both;'></div>
                            <center><div style='font-weight: bold;'>file to upload:</div>
                            <input type='hidden' name='MAX_FILE_SIZE' value='10000000'>
                            <input type='file' name='fileToUpload' id='fileToUpload'><br/><br/>
                            <input type='submit' name='b9' value='Remove' id='bottone_keyword' class='button' onclick='return confirmDelete()'/>
                            <input type='submit' name='b10' value='Insert' id='bottone_keyword' class='button' onclick='return confirmInsert()'/></center>
                            </form>";
                        echo "
                            	<script type='text/javascript'>
                                        function confirmExit(){
                                            var x = confirm('All unsaved changes will be lost, it will be moved to check section, continue?');
                                            if (x) {
                                                loading(load);
                                                return x;
                                            } else {
                                                return x;
                                            }
                                        }
				</script>
				";
                        $ris[1] = str_replace("<br />", "", $ris[1]);
                        $ris[1] = str_replace("\n", "", $ris[1]);
                        $ris[7] = str_replace("<br />", "", $ris[7]);
                        $ris[7] = str_replace("\n", "", $ris[7]);
                        echo "<script type='text/javascript'>UpdateMathcat('" . $ris[6] . "')</script>
				    <script type='text/javascript'>UpdateMathtit('" . $ris[1] . "')</script>
				    <script type='text/javascript'>UpdateMathaut('" . $ris[3] . "')</script>
				    <script type='text/javascript'>UpdateMathjou('" . $ris[4] . "')</script>
				    <script type='text/javascript'>UpdateMathcom('" . $ris[5] . "')</script>
				    <script type='text/javascript'>UpdateMathabs('" . $ris[7] . "')</script>";
                        ############################################################################################################
                    } else {
                        #inserimento manuale
                        echo "<form name='f2' action='manual_insert.php' method='POST' enctype='multipart/form-data' onclick='myFunction()' onsubmit='loading(load);' id='form'>
                            <center><div><h2>paper informations</h2><h1>field with '*' are required</h1><br/><input type='reset' name='reset' value='Reset'/><br/></center>
                        <div id='divinsertcateg'>
                            <div style='font-weight: bold;'>*id:</div>
                            <textarea style='width:49%;' name='id' id='textbox' class='textbox1' required placeholder='example of id: 0000.0000v1' autofocus></textarea><br/><br/>
                            <div style='font-weight: bold;'>*date:</div>
                            <textarea style='width:49%;' name='date' id='textbox' class='textbox1' required placeholder='example of data: 2011-12-30T10:37:35Z'></textarea>
                        </div>
                        <div>
                            <div id='divinsert'>
                                <div id='divcontinsert'>
                                    *category:<br/>
                                    <textarea name='category' id='textbox' class='textbox1' required placeholder='example of category: math.NA...' onkeyup='UpdateMathcat(this.value)' ></textarea>
                                </div>
                            </div>
                            <div id='divpreview'>
                                <div style='font-weight: bold;'>
                                    preview:
                                </div>
                                <div id='divcontpreview'>
                                    <div id='categorydiv'></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div id='divinsert'>
                                <div id='divcontinsert'>
                                    *title:<br/>
                                    <textarea name='title' id='textbox' class='textbox1' required placeholder='example of title: The geometric...' onkeyup='UpdateMathtit(this.value)'></textarea>
                                </div>
                            </div>
                            <div id='divpreview'>
                                <div style='font-weight: bold;'>
                                    preview:
                                </div>
                                <div id='divcontpreview'>
                                    <div id='titlediv'></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div id='divinsert'>
                                <div id='divcontinsert'>
                                    *authors:<br/>
                                    <textarea name='author' id='textbox' class='textbox1' required placeholder='example of author: Mario Rossi, Luca...' onkeyup='UpdateMathaut(this.value)'></textarea>
                                </div>
                            </div>
                            <div id='divpreview'>
                                <div style='font-weight: bold;'>
                                    preview:
                                </div>
                                <div id='divcontpreview'>
                                    <div id='authordiv'></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div id='divinsert'>
                                <div id='divcontinsert'>
                                    journal ref:<br/>
                                    <textarea name='journal' id='textbox' class='textbox1' placeholder='example of Journal: Numer. Linear Algebra...' onkeyup='UpdateMathjou(this.value)'></textarea>
                                </div>
                            </div>
                            <div id='divpreview'>
                                <div style='font-weight: bold;'>
                                    preview:
                                </div>
                                <div id='divcontpreview'>
                                    <div id='journaldiv'></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div id='divinsert'>
                                <div id='divcontinsert'>
                                    comments:<br/>
                                    <textarea name='comments' id='textbox' class='textbox1' placeholder='example of comments: 10 pages...' onkeyup='UpdateMathcom(this.value)'></textarea>
                                </div>
                            </div>
                            <div id='divpreview'>
                                <div style='font-weight: bold;'>
                                    preview:
                                </div>
                                <div id='divcontpreview'>
                                    <div id='commentsdiv'></div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div id='divinsert'>
                                <div id='divcontinsertabs'>
                                    *abstract:<br/>
                                    <textarea name='abstract' id='textboxabs' class='textbox1' required placeholder='example of abstract: The geometric...' onkeyup='UpdateMathabs(this.value)'></textarea>
                                </div>
                            </div>
                            <div id='divpreview'>
                                <div style='font-weight: bold;'>
                                    preview:
                                </div>
                                <div id='divcontpreviewabs'>
                                    <div id='abstractdiv'></div>
                                </div>
                            </div>
                        </div>
                        <div style='clear:both;'></div>
                            <center><div style='font-weight: bold;'>*file to upload:</div>
                            <input type='hidden' name='MAX_FILE_SIZE' value='10000000'>
                            <input type='file' required name='fileToUpload' id='fileToUpload'><br/><br/>
                            <input type='submit' name='b8' value='Insert' id='bottone_keyword' class='button' onclick='return confirmInsert()'/></center>
                            </form>
                        <script>
                            UpdateMathcat('Here it will show a preview of what you write on category');
			    UpdateMathtit('Here it will show a preview of what you write on title');
			    UpdateMathjou('Here it will show a preview of what you write on journal reference');
			    UpdateMathcom('Here it will show a preview of what you write on comments');
			    UpdateMathaut('Here it will show a preview of what you write on authors');
			    UpdateMathabs('Here it will show a preview of what you write on abstract');
			</script>";
                        ############################################################################################################
                    }
                    $target_file = $basedir2 . basename($_FILES["fileToUpload"]["name"]);
                    $type = "document/pdf"; // impostato il tipo per un'pdf
                    #bottone insert manually
                    if (isset($_POST['b8'])) {
                        if (empty($_POST['journal'])) {
                            $info[4] = "No journal ref";
                        } else {
                            $info[4] = $_POST['journal'];
                        }
                        if (empty($_POST['comments'])) {
                            $info[5] = "No journal ref";
                        } else {
                            $info[5] = $_POST['comments'];
                        }
                        $info[0] = $_POST['id'];
                        $info[1] = $_POST['title'];
                        $info[2] = $_POST['date'];
                        $info[3] = $_POST['author'];
                        $info[6] = $_POST['category'];
                        $info[7] = $_POST['abstract'];
                        #richiamo della funzione per il versionamento dei preprints
                        version_preprint($info[0]);
                        #richiamo della funzione per inserire le info del preprint all'interno del database
                        insert_preprints($info);
                        #upload del file selezionato
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            $fileType = $_FILES["fileToUpload"]["type"];
                            #inserimento file nel database
                            insert_one_pdf($info[0], $fileType);
                            echo '<script type="text/javascript">alert("Paper ' . $_POST['id'] . ' inserted correctly!");</script>';
                        } else {
                            echo '<script type="text/javascript">alert("Sorry, there was an error uploading your file!");</script>';
                        }
                    }
                    #bottone delete
                    if (isset($_POST['b9'])) {
                        #eliminazione del preprint selezionato
                        unlink($basedir3 . $_POST['id'] . ".pdf");
                        cancellaselected($_POST['id']);
                        echo '<script type="text/javascript">alert("Paper ' . $_POST['id'] . ' removed correctly!");</script>';
                        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./arXiv_panel.php">';
                    }
                    #bottone inserimento
                    if (isset($_POST['b10'])) {
                        if (empty($_POST['journal'])) {
                            $info[4] = "No journal ref";
                        } else {
                            $info[4] = $_POST['journal'];
                        }
                        if (empty($_POST['comments'])) {
                            $info[5] = "No journal ref";
                        } else {
                            $info[5] = $_POST['comments'];
                        }
                        $info[0] = $_POST['id'];
                        $info[1] = $_POST['title'];
                        $info[2] = $_POST['data'];
                        $info[3] = $_POST['author'];
                        $info[6] = $_POST['category'];
                        $info[7] = $_POST['abstract'];
                        #richiamo della funzione per il versionamento dei preprints
                        version_preprint($info[0]);
                        #richiamo della funzione per inserire le info del preprint all'interno del database
                        update_preprints($info);
                        #inserimento del pdf sul database
                        insert_one_pdf2($_POST['id']);
                        #spostamento del file pdf
                        copy($basedir3 . $_POST['id'] . ".pdf", $copia . $_POST['id'] . ".pdf");
                        unlink($basedir3 . $_POST['id'] . ".pdf");
                        if ($_FILES["fileToUpload"]["size"] > 0) {
                            #caricamento del file scelto
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                $fileType = $_FILES["fileToUpload"]["type"];
                                #spostamento pdf
                                #inserimento nel database del file
                                insert_one_pdf($info[0], $fileType);
                                echo '<script type="text/javascript">alert("Paper ' . $_POST['id'] . ' inserted correctly!");</script>';
                                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./arXiv_panel.php">';
                            } else {
                                echo '<script type="text/javascript">alert("Error, file not uploaded!");</script>';
                            }
                        } else {
                            echo '<script type="text/javascript">alert("Paper ' . $_POST['id'] . ' inserted correctly!");</script>';
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./arXiv_panel.php">';
                        }
                    }
                }
                ?>
            </div>
            <br/>
        </div>
        <?php require_once './graphics/loader.php'; ?>
    </body>
</html>
