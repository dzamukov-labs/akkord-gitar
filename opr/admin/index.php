<?php

echo  "<html>
<body>
<center><font color=#C0C0C0>
<font size=+2>Опрос</font></font>
<table CELLPADDING=10 CELLSPACING=10 width=25%><tr><td ></td></tr>
<td>&nbsp</td></tr><tr><td></td></tr>
<tr><td bgcolor=#FFFFE8 ><h3><font color=#408080> Авторизация</font></h3>
<FORM ACTION='admin.php' METHOD='POST'>
<tt><font color=#408080> Имя</font></tt><br>
<INPUT TYPE='text' NAME='login' SIZE='30'  ><p>
<tt><font color=#408080> Пароль</font></tt><br>
<INPUT TYPE='password' NAME='pasw' SIZE='30'  ><p>

<INPUT TYPE='submit' name='go' VALUE='Вход'>
</form><tr><td >";

echo "<font color=red>".@$_GET['acc']."</font>";

echo  " </td></tr>
</td></tr>
</table>
</center>
</body>
</html>";


?>