<?PHP
session_start();
//Получаем сессию
$strpath="conf/conf.txt";
@$f=fopen($strpath, "r");
@$content=file($strpath);
fclose($f);
$n=0;
//Обработка
foreach($content as $line):
  if ($n==2) $sess=$line;
  $n++;

endforeach;

if (session_id()!=$sess):
  $url=urlencode("Пройдите авторизацию!");
  echo "<meta http-equiv=refresh content='0; url=index.php?acc=$url'>";
  exit();
endif;

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
  .navig_activ
         {
          font-family:"Times New Roman", "serif";
          font-size:12pt;
          color:#800040;
          font-weight:700;
         }

     .navig_passiv
        {
          font-family:"Times New Roman", "serif";
          font-size:12pt;
          color:#808080;
          font-weight:400;
       }
      a.navig_passiv
        {
        	Text-decoration: none;
        }
      a.navig_activ
        {
        	Text-decoration: none;
        }
</style>

<TITLE>Администрирование</TITLE>
</head>
<BODY BGCOLOR='#E6E6E6'>
<font color=#808000>Поиск по сайту 1.1</font>
<CENTER><table border=0 CELLPADDING=0 CELLSPACING=0  width=70%><tr><td >

<IMG SRC='img/log.png' ALIGN='center' >&nbsp&nbsp&nbsp&nbsp
<font size=+3 color=#408080 ><b><tt>Администрирование</tt></b></font></td>
<td align=right>

<form  action='cap.php' method='post' name='cap'>
<SELECT NAME="list" onchange="cap.submit();">
<OPTION value="1" <? echo @$sel1; ?> >Внешний вид формы</option>
<OPTION value="2" <? echo @$sel2; ?>   >Внешний вид результатов поиска</option>
<OPTION value="3" <? echo @$sel3; ?>  >Оптимизация поиска</option>
<OPTION value="4" <? echo @$sel4; ?>  >Управление кодом</option>
<OPTION value="5" <? echo @$sel5; ?>  >Логин и пароль</option>
<OPTION value="6" <? echo @$sel6; ?>  >Журнал запросов</option>
</SELECT>


</form>

<?php
//Ссылка для возврата

echo "<a href=http://".$_SERVER['SERVER_NAME'].">Выход</a>";

?>
</td></tr>
</table></CENTER><p>



