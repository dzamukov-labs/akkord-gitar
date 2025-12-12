<?php
 include("cap.php");
 $info="";
 if(isset($_POST['go']))
  {
  	//Меняем пароль и логин----------------------------------
  if(@$_POST['login']!="" &&  @$_POST['pasw']!="")
   {
    @$_POST['login']=trim(@$_POST['login']);
    @$_POST['pasw']=trim(@$_POST['pasw']);
    $strpath="conf/conf.txt";
    @$f=fopen($strpath,"w");
    fwrite($f,md5($_POST['login'])."\r\n");
    fwrite($f,md5($_POST['pasw'])."\r\n");
    fwrite($f,session_id());
    fclose($f);
    $info="Данные изменены.";
   }
   else
   $info="Для заполнения обязательны логин и пароль.";
  }

?>
<TABLE align=center bgcolor=#EBEBEB width=80% CELLPADDING=20 CELLSPACING=0 border=0>

<tr >
   <td ><FONT COLOR="#408080" size=+1>Изменить логин и пароль</FONT> </td>
</tr>

<FORM ACTION="admin5.php?sel5=selected" METHOD="POST" name="form">

<tr bgcolor=#F0F0F0><td width=25%>
<?echo $info?><br><br>
Логин<br>
<INPUT TYPE="text" NAME="login" SIZE="10" MAXLENGTH="10" VALUE=""><br>
Пароль<br>
 <INPUT TYPE="text" NAME="pasw" SIZE="10" MAXLENGTH="10" VALUE=""><br><br>
<input type="submit" value="Изменить" name=go>

</td></tr>
</table>
</body>

</html>