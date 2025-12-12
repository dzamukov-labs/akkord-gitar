<?php
//Сообщение
if(file_exists("info.txt"))
 {
  $f=fopen("info.txt","r");
  $info=fread($f,filesize("info.txt"));
  fclose($f);
  unlink("info.txt");

 }
else
  {  	exit("Интересно?");
  }


//Данные настроек
$conf1=file("admin/config/code/align.txt");
foreach($conf1 as $line) $conf[]=rtrim($line);




//Код==================================
$strpath="admin/config/code/topcode.txt";
$size=filesize($strpath);
if($size)
{
 $f=fopen($strpath,'r');
 @$code_top=fread($f, filesize($strpath));
fclose($f);
}

$strpath="admin/config/code/botcode.txt";
$size=filesize($strpath);
if($size)
{
 $f=fopen($strpath,'r');
 @$code_bot=fread($f, filesize($strpath));
fclose($f);
}

$strpath="admin/config/code/leftcode.txt";
$size=filesize($strpath);
if($size)
{
 $f=fopen($strpath,'r');
 @$code_left=fread($f, filesize($strpath));
fclose($f);
}

$strpath="admin/config/code/rigcode.txt";
$size=filesize($strpath);
if($size)
{
 $f=fopen($strpath,'r');
 @$code_rig=fread($f, filesize($strpath));
fclose($f);
}


?>
<html>

<head>


  <title>Настройка подписки </title>
<style>

#nscript {
	        font-size: <?php echo "$conf[5]pt"  ?> ;
	        color:    <?php echo "$conf[4]"  ?> ;

         }

</style>

</head>

<body bgcolor= <?php echo "$conf[6] background=$conf[7]" ?> >

<table width=100% border=0 cellpadding=10>

<?php
 if (@$code_top!="")
 {
   echo"<tr><td colspan=3 valign=top>";
   if($conf[0]==0)
   {
     echo @$code_top;
   }
  else
   {
 	 include("admin/config/code/topcode.txt");
   }
   echo"</td></tr>";

 }

?>


<tr>

<?php
 if (@$code_left!="")
 {
   echo"<td width=25% valign=top >";
   if($conf[2]==0)
   {
     echo @$code_left;
   }
  else
   {
 	 include("admin/config/code/leftcode.txt");
   }

 }
   echo "</td>";
?>


<td id="nscript" valign=top>
<?php echo $info ?>

</td>


<?php
 if (@$code_rig!="")
 {
   echo"<td width=25% valign=top>";
   if($conf[3]==0)
   {
     echo @$code_rig;
   }
  else
   {
 	 include("admin/config/code/rigcode.txt");
   }
   echo "</td>";
 }

?>

</tr>

<tr><td colspan=3>
<?php
 if (@$code_bot!="")
 {
   if($conf[1]==0)
   {
     echo @$code_bot;
   }
  else
   {
 	 include("admin/config/code/botcode.txt");
   }

 }

?>
</td></tr>

</table>



</body>

</html>