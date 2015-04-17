<div id="upload_form_div" style="margin: 20px auto;width: 100%;display: table">
    <div id="upload_table" style="margin: 0 auto;width: 100%;display: table">
        <form style="width: 50%;margin: 0 auto" enctype="multipart/form-data" action="reserved/submit_uploadPHP.php" method="POST" >
            <h2>Upload new Preprint</h2>
            <ul>
                <li>
                    <label for="uid">Title</label>
                </li>
                <li style="margin-top: 10px">
                    <textarea style="width:500px; height:16px" type="text" class="textbox" name="titolo" required autofocus></textarea>
                </li>
                <li style="margin-top: 10px">
                    <label for="uid">Authors</label>
                </li>
                <li style="margin-top: 10px">
                    <textarea style="width:500px; height:16px" type="text" class="textbox" name="collaboratori" required></textarea>
                </li>
                <li style="margin-top: 10px">
                    <label for="abstract">Abstract</label>
                </li>
                <li style="margin-top: 10px">
                    <textarea style="width:500px; height:300px" maxlength="1000" name="abstract" class="textbox" required></textarea>
                </li><br/>
                <li  style="text-align: right">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
                    <input name="userfile" type="file"/>
                </li>
                <li style="text-align: right">
                    <br/><input type="submit" class="bottoni" value="Insert" />
                </li>
            </ul>
        </form>
    </div>
</div>
