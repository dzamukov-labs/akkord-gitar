<?php
include('cap.php');

if(@$_POST['GO'])
 {

   $strpath="conf/code/topcode.txt";
   @$f=fopen($strpath,"w+");

   if($_POST['top']!="")
   {
    if (@$_POST['top_php']) fwrite($f,"<?php"."\r\n". $_POST['top']."\r\n"."?>");
    else fwrite($f,$_POST['top']);

   }
  else  fwrite($f,"");
  fclose($f);

   $strpath="conf/code/botcode.txt";
   @$f=fopen($strpath,"w+");

   if($_POST['bot']!="")
   {
    if (@$_POST['bot_php']) fwrite($f,"<?php"."\r\n". $_POST['bot']."\r\n"."?>");
    else fwrite($f,$_POST['bot']);
   }
   else  fwrite($f,"");
   fclose($f);

   $strpath="conf/code/leftcode.txt";
   @$f=fopen($strpath,"w+");

  if($_POST['left']!="")
   {
   if (@$_POST['left_php']) fwrite($f,"<?php"."\r\n". $_POST['left']."\r\n"."?>");
   else fwrite($f,$_POST['left']);
   }
  else fwrite($f,"");
  fclose($f);

   $strpath="conf/code/rigcode.txt";
   @$f=fopen($strpath,"w+");

  if($_POST['rig']!="")
  {
   if (@$_POST['right_php']) fwrite($f,"<?php"."\r\n". $_POST['rig']."\r\n"."?>");
   else fwrite($f,$_POST['rig']);
  }
   else fwrite($f,"");
   fclose($f);


   $strpath="conf/code/align.txt";
   @$f=fopen($strpath,"w+");
   if(@$_POST['topA']['pos']==1)fwrite($f,"left\r\n");
   if(@$_POST['topA']['pos']==2)fwrite($f,"center\r\n");
   if(@$_POST['topA']['pos']==3)fwrite($f,"right\r\n");

   if(@$_POST['botA']['pos']==1)fwrite($f,"left\r\n");
   if(@$_POST['botA']['pos']==2)fwrite($f,"center\r\n");
   if(@$_POST['botA']['pos']==3)fwrite($f,"right\r\n");

   if(@$_POST['leftA']['pos']==1)fwrite($f,"top\r\n");
   if(@$_POST['leftA']['pos']==2)fwrite($f,"bottom\r\n");
   if(@$_POST['leftA']['pos']==3)fwrite($f,"center\r\n");

   if(@$_POST['rigA']['pos']==1)fwrite($f,"top\r\n");
   if(@$_POST['rigA']['pos']==2)fwrite($f,"bottom\r\n");
   if(@$_POST['rigA']['pos']==3)fwrite($f,"center\r\n");


   fwrite($f,@$_POST['procL']."\r\n");
   fwrite($f,@$_POST['procR']."\r\n");
   fwrite($f,"-\r\n");


   fwrite($f,"0\r\n");
   fwrite($f,"0\r\n");
   fwrite($f,"0\r\n");
   fwrite($f,"0\r\n");


   if (@$_POST['top_php'])fwrite($f,"1"."\r\n");
   else fwrite($f,"0"."\r\n");

   if (@$_POST['bot_php'])fwrite($f,"1"."\r\n");
   else fwrite($f,"0"."\r\n");

   if (@$_POST['left_php'])fwrite($f,"1"."\r\n");
   else fwrite($f,"0"."\r\n");

   if (@$_POST['right_php'])fwrite($f,"1");
   else fwrite($f,"0");

   fclose($f);


 }


//Проверка данных---------------------------------------

$TopCode="";
$strpath="conf/code/topcode.txt";
@$size=filesize($strpath);
if($size)
 {
   @$f=fopen($strpath,r);
   $TopCode=fread($f, filesize($strpath));
 }
    $TopCode=str_replace("<?php","",$TopCode);
    $TopCode=str_replace("?>","",$TopCode);

 $BotCode="";
$strpath="conf/code/botcode.txt";
@$size=filesize($strpath);
if($size)
 {
   @$f=fopen($strpath,r);
   $BotCode=fread($f, filesize($strpath));
 }

    $BotCode=str_replace("<?php","",$BotCode);
    $BotCode=str_replace("?>","",$BotCode);

 $LeftCode="";
$strpath="conf/code/leftcode.txt";
@$size=filesize($strpath);
if($size)
 {
   @$f=fopen($strpath,r);
   $LeftCode=fread($f, filesize($strpath));
 }
$LeftCode=str_replace("<?php","",$LeftCode);
    $LeftCode=str_replace("?>","",$LeftCode);

 $RigCode="";
$strpath="conf/code/rigcode.txt";
@$size=filesize($strpath);
if($size)
 {
   @$f=fopen($strpath,r);
   $RigCode=fread($f, filesize($strpath));

 }

 $RigCode=str_replace("<?php","",$RigCode);
    $RigCode=str_replace("?>","",$RigCode);

  $strpath="conf/code/align.txt";
  $content=file($strpath);
  $n=0;
  foreach($content as $line)
   {   	 $content[$n]=rtrim($content[$n]);
   	 $n++;
   }

if (@$content[0]=="left") @$Topcheck_L="checked";
if (@$content[0]=="center") @$Topcheck_C="checked";
if (@$content[0]=="right") @$Topcheck_R="checked";

if (@$content[1]=="left") @$Botcheck_L="checked";
if (@$content[1]=="center") @$Botcheck_C="checked";
if (@$content[1]=="right") @$Botcheck_R="checked";

if (@$content[2]=="top") @$Leftcheck_T="checked";
if (@$content[2]=="bottom") @$Leftcheck_B="checked";
if (@$content[2]=="center") @$Leftcheck_C="checked";

if (@$content[3]=="top") @$Rigcheck_T="checked";
if (@$content[3]=="bottom") @$Rigcheck_B="checked";
if (@$content[3]=="center") @$Rigcheck_C="checked";

//Процент  L
$n=0;
for($i=10; $n<4; $i+=5, $n++)
  {

     if (@$content[4]==$i)  $sel[$n]='selected';
     else @$sel[$n]="";

  }

  $n=0;
for($i=10; $n<4; $i+=5, $n++)
  {
     if (@$content[5]==$i)  $sel1[$n]='selected';
     else @$sel1[$n]="";

  }




     if ($content[11]==1)  $top_phpCheck='checked';
     if ($content[12]==1)  $bot_phpCheck='checked';
     if ($content[13]==1)  $left_phpCheck='checked';
     if ($content[14]==1)  $right_phpCheck='checked';


//-------------------------------------------------------------

?>

<CENTER><TABLE bgcolor=#EBEBEB width=80% CELLPADDING=7 CELLSPACING=0 border=0>
	<TR>
		<TD colspan='2' ><FONT COLOR="#408080" size=+1>Управление кодом</FONT></td></tr>
<tr><td colspan=2 bgcolor=#F0F0F0><FONT SIZE=-1>
Для интеграции вашего интерфейса на страницу с поиском вы можете вставить участки своего кода
.<br>
Вставляйте без тегов <font color=green>&lt;html&gt;&lt;body&gt;</font>.<br>Вы можете установить
процентное соотношение правой и левой частей относительно всей страницы. Размеры правой и левой частей
устанавливаются в %.
Если код какой-либо части не определён, её процентная доля не учитывается.<br> Размер центральной части (т.е.
самого блока с результатами поиска) устанавливается во внешнем виде страницы с поиском.
<br>Если вы внедряете код php, поставьте галочку и не вписывайте скобок <font color=#0080FF>&lt;?php &nbsp;&nbsp; ?&gt; </font>

 </td></tr>
<FORM ACTION="admin4.php?sel4=selected" METHOD="POST">
<tr><td colspan=2 bgcolor=#F0F0F0><FONT SIZE=-1>
<b>Соотношение</b>&nbsp;&nbsp;Левая часть&nbsp;
<SELECT NAME="procL" >
<OPTION value="10" <? echo @$sel[0]; ?>>10</option>
<OPTION value="15" <? echo @$sel[1]; ?>>15</option>
<OPTION value="20" <? echo @$sel[2]; ?>>20</option>
<OPTION value="25" <? echo @$sel[3]; ?>>25</option>

</SELECT>&nbsp;%&nbsp;&nbsp;

&nbsp;Правая часть&nbsp;<SELECT NAME="procR" >
<OPTION value="10" <? echo @$sel1[0]; ?>>10</option>
<OPTION value="15" <? echo @$sel1[1]; ?>>15</option>
<OPTION value="20" <? echo @$sel1[2]; ?>>20</option>
<OPTION value="25" <? echo @$sel1[3]; ?>>25</option>

</SELECT>&nbsp;%
</td></tr>

<tr bgcolor=#F0F0F0><td><b>Верх страницы</b>. <br>
Слева<input name="topA[pos]" type="radio" value=1 <?  echo @$Topcheck_L; ?> >
&nbsp;По центру<input name="topA[pos]" type="radio" value=2 <? echo @$Topcheck_C; ?>>
&nbsp;Справа<input name="topA[pos]" type="radio" value=3 <? echo @$Topcheck_R; ?>>

&nbsp;&nbsp;Код PHP &nbsp;<input name="top_php" type="checkbox" value="ON" <? echo @$top_phpCheck ?>> <p></p>
 <TEXTAREA NAME="top" ROWS="15" COLS="85"><? echo trim(@$TopCode); ?>
</TEXTAREA></td></tr>

<tr bgcolor=#F0F0F0><td><b>Низ страницы</b>. <br>
Слева<input name="botA[pos]" type="radio" value=1 <?  echo @$Botcheck_L; ?> >
&nbsp;По центру<input name="botA[pos]" type="radio" value=2 <? echo @$Botcheck_C; ?>>
&nbsp;Справа<input name="botA[pos]" type="radio" value=3 <? echo @$Botcheck_R; ?>>

&nbsp;&nbsp;Код PHP &nbsp;<input name="bot_php" type="checkbox" value="ON" <? echo @$bot_phpCheck ?>>
<p></p>
 <TEXTAREA NAME="bot" ROWS="15" COLS="85"><? echo trim(@$BotCode); ?>
</TEXTAREA></td></tr>

<tr bgcolor=#F0F0F0><td><b>Левый край</b>. <br>
Верх<input name="leftA[pos]" type="radio" value=1 <?  echo @$Leftcheck_T; ?> >
&nbsp;Низ<input name="leftA[pos]" type="radio" value=2 <? echo @$Leftcheck_B; ?>>
&nbsp;Центр<input name="leftA[pos]" type="radio" value=3 <? echo @$Leftcheck_C; ?>>

&nbsp;&nbsp;Код PHP &nbsp;<input name="left_php" type="checkbox" value="ON" <? echo @$left_phpCheck ?>>
<p></p>
 <TEXTAREA NAME="left" ROWS="15" COLS="85"><? echo trim(@$LeftCode); ?>
</TEXTAREA></td></tr>

<tr bgcolor=#F0F0F0><td><b>Правый край</b>. <br>
Верх<input name="rigA[pos]" type="radio" value=1 <?  echo @$Rigcheck_T; ?> >
&nbsp;Низ<input name="rigA[pos]" type="radio" value=2 <? echo @$Rigcheck_B; ?>>
&nbsp;Центр<input name="rigA[pos]" type="radio" value=3 <? echo @$Rigcheck_C; ?>>

&nbsp;&nbsp;Код PHP &nbsp;<input name="right_php" type="checkbox" value="ON" <? echo @$right_phpCheck ?>>
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