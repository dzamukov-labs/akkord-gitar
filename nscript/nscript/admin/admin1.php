<?php
include('cap.php');

if(@$_POST['GO'])
 {
   $strpath="config/code/topcode.txt";
   @$f=fopen($strpath,w);

   if($_POST['top']!="")
   {
    if (@$_POST['top_php']) fwrite($f,"<?php"."\r\n". $_POST['top']."\r\n"."?>");
    else fwrite($f,$_POST['top']);

   }
  else  fwrite($f,"");
  fclose($f);

   $strpath="config/code/botcode.txt";
   @$f=fopen($strpath,w);

   if($_POST['bot']!="")
   {
    if (@$_POST['bot_php']) fwrite($f,"<?php"."\r\n". $_POST['bot']."\r\n"."?>");
    else fwrite($f,$_POST['bot']);
   }
   else  fwrite($f,"");
   fclose($f);

   $strpath="config/code/leftcode.txt";
   @$f=fopen($strpath,w);

  if($_POST['left']!="")
   {
   if (@$_POST['left_php']) fwrite($f,"<?php"."\r\n". $_POST['left']."\r\n"."?>");
   else fwrite($f,$_POST['left']);
   }
  else fwrite($f,"");
  fclose($f);

   $strpath="config/code/rigcode.txt";
   @$f=fopen($strpath,w);

  if($_POST['rig']!="")
  {
   if (@$_POST['right_php']) fwrite($f,"<?php"."\r\n". $_POST['rig']."\r\n"."?>");
   else fwrite($f,$_POST['rig']);
  }
   else fwrite($f,"");
   fclose($f);

   $strpath="config/code/align.txt";
   @$f=fopen($strpath,w);
   //Если PHP
   if (@$_POST['top_php'])fwrite($f,"1"."\r\n");
   else fwrite($f,"0"."\r\n");

   if (@$_POST['bot_php'])fwrite($f,"1"."\r\n");
   else fwrite($f,"0"."\r\n");

   if (@$_POST['left_php'])fwrite($f,"1"."\r\n");
   else fwrite($f,"0"."\r\n");

   if (@$_POST['right_php'])fwrite($f,"1"."\r\n");
   else fwrite($f,"0"."\r\n");

   if(empty($_POST['color'])) fwrite($f,"#000000 \r\n");
   else fwrite($f,@$_POST['color']."\r\n");

   fwrite($f,$_POST['size']."\r\n");

   if(empty($_POST['colorpage']))fwrite($f,"#ffffff \r\n");
   else fwrite($f,@$_POST['colorpage']."\r\n");
   fwrite($f,@$_POST['fon']."\r\n");

   fclose($f);


 }


//Проверка данных---------------------------------------

$TopCode="";
$strpath="config/code/topcode.txt";
@$size=filesize($strpath);
if($size)
 {
   @$f=fopen($strpath,r);
   $TopCode=fread($f, filesize($strpath));
 }
    $TopCode=str_replace("<?php","",$TopCode);
    $TopCode=str_replace("?>","",$TopCode);

 $BotCode="";
$strpath="config/code/botcode.txt";
@$size=filesize($strpath);
if($size)
 {
   @$f=fopen($strpath,r);
   $BotCode=fread($f, filesize($strpath));
 }

    $BotCode=str_replace("<?php","",$BotCode);
    $BotCode=str_replace("?>","",$BotCode);

 $LeftCode="";
$strpath="config/code/leftcode.txt";
@$size=filesize($strpath);
if($size)
 {
   @$f=fopen($strpath,r);
   $LeftCode=fread($f, filesize($strpath));
 }
$LeftCode=str_replace("<?php","",$LeftCode);
    $LeftCode=str_replace("?>","",$LeftCode);

 $RigCode="";
$strpath="config/code/rigcode.txt";
@$size=filesize($strpath);
if($size)
 {
   @$f=fopen($strpath,r);
   $RigCode=fread($f, filesize($strpath));

 }

 $RigCode=str_replace("<?php","",$RigCode);
    $RigCode=str_replace("?>","",$RigCode);

  $strpath="config/code/align.txt";
  @$f=fopen($strpath,r);
  $content=file($strpath);
  fclose($f);




     if ($content[0]==1)  $top_phpCheck='checked';
     if ($content[1]==1)  $bot_phpCheck='checked';
     if ($content[2]==1)  $left_phpCheck='checked';
     if ($content[3]==1)  $right_phpCheck='checked';

 //Размер шрифта
for($i=8; $n<11; $i++, $n++)
 {
     if (@$content[5]==$i)  $chsize[$n]='selected';
     else @$chsize[$n]="";
 }
//-------------------------------------------------------------

?>

<CENTER><TABLE bgcolor=#EBEBEB width=80% CELLPADDING=7 CELLSPACING=0 border=0>
	<TR>
		<TD ><FONT COLOR="#408080" size=+1>Управление кодом</FONT></td></tr>
<tr><td colspan=2 bgcolor=#F0F0F0>
Вы можете оформить страничку, где выводятся сообщения о ходе подписки.
Выберите размер и цвет шрифта, цвет и графический фон главной страницы, вставьте участки своего кода.
<br>
Вставляйте без тегов <font color=green>&lt;html&gt;&lt;body&gt;</font>.
<br>Если вы внедряете код php, поставьте галочку и не вписывайте скобок <font color=#0080FF>&lt;?php &nbsp;&nbsp; ?&gt; </font>

 </td></tr>
<FORM ACTION="admin1.php?sel2=selected" METHOD="POST">

<tr bgcolor=#F0F0F0><td><b>Шрифт, которым выводятся сообщения о ходе подписки</b><br><br>
Цвет&nbsp;<INPUT TYPE="text" NAME="color" SIZE="10"
  VALUE="<? echo @$content[4]; ?>" > <font color=<? echo @$content[4]; ?>>&nbsp;<b>тест</b></font>&nbsp;&nbsp;
 Размер&nbsp; <SELECT NAME="size">
<OPTION value="8" <?  echo @$chsize[0]; ?>>8</option>
<OPTION value="9" <? echo @$chsize[1]; ?>>9</option>
<OPTION value="10" <? echo @$chsize[2]; ?>>10</option>
<OPTION value="11" <? echo @$chsize[3]; ?>>11</option>
<OPTION value="12" <? echo @$chsize[4]; ?>>12</option>

<OPTION value="13" <?  echo @$chsize[5]; ?>>13</option>
<OPTION value="14" <? echo @$chsize[6]; ?>>14</option>
<OPTION value="15" <? echo @$chsize[7]; ?>>15</option>
<OPTION value="16" <? echo @$chsize[8]; ?>>16</option>
<OPTION value="17" <? echo @$chsize[9]; ?>>17</option>
<OPTION value="18" <?  echo @$chsize[10]; ?>>18</option>

</SELECT>
</td></tr>

<tr bgcolor=#F0F0F0><td><b>Вид странички</b><br><br>
Цвет&nbsp;<INPUT TYPE="text" NAME="colorpage" SIZE="10"
  VALUE="<? echo @$content[6]; ?>" > <font color=<? echo @$content[6]; ?>>&nbsp;<b>тест</b></font>
</td></tr>

<tr bgcolor=#F0F0F0><td>Графический фон&nbsp; (ссылка на картинку)<br>
<input name="fon" type="text" size=50 value="<? echo @$content[7]; ?>">
</td></tr>




<tr bgcolor=#F0F0F0><td><b>Верх страницы</b>&nbsp;&nbsp;
Код PHP &nbsp;<input name="top_php" type="checkbox" value="ON" <? echo @$top_phpCheck ?>> <p></p>
 <TEXTAREA NAME="top" ROWS="15" COLS="85"><? echo trim(@$TopCode); ?>
</TEXTAREA></td></tr>

<tr bgcolor=#F0F0F0><td><b>Низ страницы</b>&nbsp;&nbsp;
Код PHP &nbsp;<input name="bot_php" type="checkbox" value="ON" <? echo @$bot_phpCheck ?>>
<p></p>
 <TEXTAREA NAME="bot" ROWS="15" COLS="85"><? echo trim(@$BotCode); ?>
</TEXTAREA></td></tr>

<tr bgcolor=#F0F0F0><td><b>Левый край</b>. &nbsp;&nbsp;
Код PHP &nbsp;<input name="left_php" type="checkbox" value="ON" <? echo @$left_phpCheck ?>>
<p></p>
 <TEXTAREA NAME="left" ROWS="15" COLS="85"><? echo trim(@$LeftCode); ?>
</TEXTAREA></td></tr>

<tr bgcolor=#F0F0F0><td><b>Правый край</b>.&nbsp;&nbsp;
Код PHP &nbsp;<input name="right_php" type="checkbox" value="ON" <? echo @$right_phpCheck ?>>
<p></p>
 <TEXTAREA NAME="rig" ROWS="15" COLS="85"><? echo trim(@$RigCode); ?>
</TEXTAREA></td></tr>

<tr><td align=botton><INPUT TYPE="submit" VALUE="Сохранить" name="GO">
</FORM>



</TD>
	</TR>
</TABLE></CENTER>

</BODY>
</HTML>