<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'mysql/db_select.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'search/main_tabella.php';
?>

<div style="float: left">
    <?php
    print_r(" Login: ");
    print_r($_SESSION['nome']);
    print_r(" UID: " . $_SESSION['uid']);
    print_r(" Tipo di accesso: ");
    print_r($_SESSION['logged_type']);
    ?>
    <form name="f2" action="view_preprints.php?p=1" method="POST">
	    <br/>
	    <button onclick="logout()" id="button_logout" class="bottoni" style="color: red;">logout</button><br/>
	    <input type="submit" name="bottoni2" value="arXiv approved preprints" id="bottone_keyword" class="bottoni"/>
    </form>
</div>
<div style="float: right">
    <br/>
</div>

<script>
    $(document).ready(function() {
        $("button").click(function(event) {
            if (event.target.id !== "button_logout") {
                var cmd = event.target.id.substring(0, 4);
                if (cmd === "elim") {
                    var idTgt = event.target.id.substring(6);
                    idTgt = idTgt.replace('"', '');
                    if (confirm("Eliminare?")) {
                        $("#cont_feedback").load("reserved/submit_removeFilePHP.php", {id: idTgt});
                        location.reload();
                    }
                }
            }
        });
    });
</script>
<div id="contenitore">
    <div>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/dmipreprints/' . 'reserved/submit_uploadForm.php'; ?>
    </div>
    <div>
        <h2>propri preprint</h2>
        <?php stampaTabellaCompleta(interrogaPerUID($_SESSION['uid']), 0); ?>
    </div>
</div>
<div id="cont_feedback">

</div>
