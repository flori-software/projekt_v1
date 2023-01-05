<form action="login.php" method="post"> 
<label class="reg_label">Userid</label>
<span class="pflichtmarker"> * </span> <input name="userid" maxlength="30"
<?php
if (isset($_POST['userid']))
    echo "value='" . $_POST['userid'] . "'";
?>
/>
<span class="fehlermeldung"></span>
<br>
<label class="reg_label">Passwort</label>
<span class="pflichtmarker"> * </span> <input name="pw" maxlength="30"
<?php
if (isset($_POST['passwort']))
    echo "value='" . $_POST['passwort'] . "'";
?>
/>
<span class="fehlermeldung"></span>
<br>
<input type="submit" value="Daten absenden">
</form>