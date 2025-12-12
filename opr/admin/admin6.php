<?php
 include("cap.php");
 $info="";
 if(isset($_POST['go']))
   {   	 if($_POST['login']!="" && $_POST['pasw']!="")
   	    {   	    	$file= file("conf/conf.txt");
   	    	$f=fopen("conf/conf.txt","w");
   	    	fwrite($f,md5($_POST['login'])."\r\n".md5($_POST['pasw'])."\r\n".$file[2]);
   	    	fclose($f);
            $info="Данные изменены!";
   	    }
   	  else $info="Должны быть заполнены логин и пароль!";
   }
?>


<TABLE align=center bgcolor=#EBEBEB width=80% CELLPADDING=10 CELLSPACING=0 border=0>

<tr >
   <td colspan=2><FONT COLOR="#408080" size=+1>Доступ в админпанель</FONT> </td>
</tr>
<tr >
   <td colspan=2>
     Здесь вы можете изменить логин и парль для доступа в админпанель. <br>
     <?PHP echo "<font color=red>$info</font>"?>
   </td>
</tr>
  <form action="admin6.php?sel6=selected" method="post">
 <tr >
   <td width=10%>Логин</td>
   <td><input name="login" type="text"></td>
</tr>
<tr >
   <td>Пароль</td>
   <td><input name="pasw" type="text"></td>

   <tr >

   <td colspan=2><input type="submit" value="Сохранить" name=go></td>
</tr>
</tr>
 </form>
</table>

</body>

</html>