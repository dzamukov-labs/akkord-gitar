<?php
include('cap.php');

if(@$_POST['GO'])
 {

   $d=opendir("mes");
   $i=0;
   //Название файлов в массив
   while(($e=readdir($d))!=false)
    {
     if($e =="." || $e ==".." || $e==".htaccess" || $e=="unsub.txt") continue;
     @$arr_del[@$i]=$e;
     @$i++;
    }
   closedir($d);
  if(count(@$arr_del))
  {
   rsort(@$arr_del);
   $i=0;
   if (count($arr_del)>3)
      {      	 foreach($arr_del as $line)
      	  {      	  	 if($i>2) unlink ("mes/".$arr_del[$i]);
      	  	 $i++;
      	  }
      }
  }
 }



?>



<script language='JavaScript1.1' type='text/javascript'>
<!--

  function win(par)
  {

    var obj=par;
    mainwin=window.open('view.php?obj='+obj+'','',
   'Width=550, height=500,left=100,top=100,status=yes,toolbar=no,menubar=no,scrollbars=yes,resizable=yes');

  }

//-->
</script>


<CENTER><TABLE bgcolor=#EBEBEB width=80% CELLPADDING=7 CELLSPACING=0 border=0>
	<TR>
		<TD colspan=6><FONT COLOR="#408080" size=+1>Отправленные письма</FONT>

		<tr><td colspan=6>Если после даты письма в скобках указана цифра, значит, подчиняясь выбранному лимиту по
		количеству адресов, письмо отправлено дробно.<br><br>
		При очистке архива останутся последние три послания</td></tr>
<FORM ACTION="admin5.php?sel6=selected" METHOD="POST"></td></tr>
<tr><td colspan=6><INPUT TYPE="submit" VALUE="Очистить архив" name="GO">



<?php
unset($arr);
$d=opendir("mes");
$i=0;
//Название файлов в массив
while(($e=readdir($d))!=false)
 {
  if($e =="." || $e ==".." || $e==".htaccess" || $e=="unsub.txt") continue;
  @$arr[@$i]=$e;
  @$i++;
 }
closedir($d);
if (count(@$arr))
 {
   rsort($arr);
   echo "<tr>";
   $i=0;
   $n=0;

   foreach($arr as $line)
    {
      $i++;      echo "<td >";
      $mesdat=getdate($line);
      echo "<a href=# onclick=\"win($arr[$n])\">". $mesdat['mday'].".".$mesdat['mon'].".
      ".$mesdat['year']." ".$mesdat['hours'].":".$mesdat['minutes'];
      //Проверка индекса
      $f=fopen("mes/$line","r");
      $content=fread($f,filesize("mes/$line"));
      fclose($f);
      $expl_cont=explode("/*/",$content);
      if($expl_cont[8]!="@")echo" ($expl_cont[8])";
      echo"</a>";
      echo "</td>";
      if($i==6)
       {       	 $i=0;
       	 echo "</tr><tr>";
       }

      $n++;
    }
    if($i)echo "</tr>";
 }
?>





</FORM>



</TD>
	</TR>
</TABLE></CENTER>

</BODY>
</HTML>