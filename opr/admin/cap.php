<?PHP
session_start();
//Получаем сессию
$strpath="conf/conf.txt";
$content=file($strpath);

if (session_id()!=$content[2])
   {
    $url=urlencode("Пройдите авторизацию!");
    echo "<meta http-equiv=refresh content='0; url=index.php?acc=$url'>";
    exit();
   }

if (@$_POST['list']=='1')  echo "<meta http-equiv=refresh content='0; url=admin1.php?sel1=selected'>";
if (@$_POST['list']=='2') echo "<meta http-equiv=refresh content='0; url=admin2.php?sel2=selected'>";
if (@$_POST['list']=='3')  echo "<meta http-equiv=refresh content='0; url=admin3.php?sel3=selected'>";
if (@$_POST['list']=='4')  echo "<meta http-equiv=refresh content='0; url=admin4.php?sel4=selected'>";
if (@$_POST['list']=='5')  echo "<meta http-equiv=refresh content='0; url=admin5.php?sel5=selected'>";
if (@$_POST['list']=='6')  echo "<meta http-equiv=refresh content='0; url=admin6.php?sel6=selected'>";
@$sel2=$_GET['sel2'];

?>
<HTML>
<head>



 <style>
table {

 	     font-size:10pt;
      }



</style>

<TITLE>Администрирование</TITLE>
</head>
<BODY BGCOLOR='#E6E6E6'>
<font color=#808000>Опросы 1.0</font>
<CENTER><table border=0 CELLPADDING=0 CELLSPACING=0  width=70%><tr><td >

<IMG SRC='img/log.png' ALIGN='center' >&nbsp&nbsp&nbsp&nbsp
<font size=+3 color=#408080 ><b><tt>Администрирование</tt></b></font></td>
<td align=right>

<form  action='cap.php' method='post' name='cap'>
<SELECT NAME="list" onchange="cap.submit();">
<OPTION value="1" <? echo @$sel1; ?> >Создание опроса</option>
<OPTION value="3" <? echo @$sel3; ?>   >Редактирование опросов</option>
<OPTION value="4" <? echo @$sel4; ?>  >Внешний вид опросов</option>
<OPTION value="5" <? echo @$sel5; ?>  >Внешний вид результатов</option>
<OPTION value="6" <? echo @$sel6; ?>  >Логин и пароль</option>

</SELECT>


</form>

<?php
//Ссылка для возврата
$link=$_SERVER['PHP_SELF'];
$expl=explode("/",$link);

echo "<a href=http://$_SERVER[SERVER_NAME]><b>Выход</b></a>";

?>
</td></tr>
</table></CENTER><p>



