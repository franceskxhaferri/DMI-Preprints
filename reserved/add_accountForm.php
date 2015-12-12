<?php
//form creazione nuovo account
echo '<div id="top_content"><table>
        <tr>
            <td align="right"> Enter email:<br/></td>
            <td><input name="mail" type="email" id="email" class="textbox" style="height: 14pt;" placeholder="example@abc.com" required maxlength="100"></td>
        </tr>
        <tr>
            <td align="right">Enter username:<br/></td>
            <td><input name="username" type="text" id="usrn" class="textbox" style="height: 14pt;" placeholder="uid(least 4 char)" required maxlength="100"></td>
        </tr>
        <tr>
            <td align="right">Enter password:<br/></td>
            <td><input name="password" type="password" id="pw" class="textbox" style="height: 14pt;" placeholder="password(least 6 char)" required maxlength="100"></td>
        </tr>
        <tr>
            <td align="right">Re-enter password:<br/></td>
            <td><input type="password" id="pw2" class="textbox" style="height: 14pt;" placeholder="retype password" required maxlength="100"></td>
        </tr>
    </table><br/>
    	<button id="button_login" style="width: 110px;" class="button" onclick="chkRegistration()">Submit</button>
    </div><div id="bottom_content"></div>';
?>
