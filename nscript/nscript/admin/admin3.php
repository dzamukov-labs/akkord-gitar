<?php
include('cap.php');

if (!isset($_GET['count']))$count=9;
else $count= $_GET['count'];

if ($count<0)$count=9;
if (!is_numeric($count))$count=9;


if (!isset($_GET['start']))$start=0;
else $start= $_GET['start'];
if ($start<0)$start=9;
if (!is_numeric($start))$start=9;


if(@$_POST['GO'])
  {
    chdir("..");

    $adr1=file("db/db.txt");
    $f=fopen("db/db.txt","w+");
    $i=0;
    foreach($adr1 as $line)
     {

        //Если удаление
        if(@$_POST['del'][$i])
          {           $i++;
           continue;
          }        $expl=explode("*",$line);

        if($expl[0]==@$_POST['mail'][$i])
           {
             @$_POST['Name'][$i]=trim(@$_POST['Name'][$i]);           	 fwrite($f, $_POST['mail'][$i]."*".$_POST['listgroup'][$i] ."*". @$_POST['Name'][$i]."\r\n");
           }
        else
           {           	  fwrite($f, $line);
           }
        $i++;
     }

     fclose($f);
     chdir("admin");
  }

if(@$_POST['search'])
  {
    @$_POST['search_adr']= trim(@$_POST['search_adr']);

    if(!empty($_POST['search_adr']))
     {
     	chdir("..");
        $adr1=file("db/db.txt");
        chdir("admin");
        $f=fopen("prom","w+");
        $searchY=false;
        foreach($adr1 as $k=>$line)
         {         	$expl=explode("*",$line);
         	$pars=substr($expl[0],0,strlen($_POST['search_adr']));
         	if ($_POST['search_adr']==$pars)
         	    {
         	        $line=trim($line);         	    	$searchY=true;
         	    	fwrite($f,$line."*".$k."\r\n");


         	    }

         }

         if(!$searchY)
          {
         	fwrite($f,"Адрес не найден!");

          }

         fclose($f);
     }

  }

//Проверка данных---------------------------------------


//-------------------------------------------------------------

?>

<div align="center"><TABLE bgcolor=#EBEBEB width=800 CELLPADDING=7 CELLSPACING=0 border=0>
	<TR>
		<TD colspan=2><FONT COLOR="#408080" size=+1>Адреса</FONT></td></tr>
<tr>
<td >
Здесь можно искать и удалять адреса, менять группы для пользователей

 </td>
 <td  align=right >
 Сейчас в базе
 <?php
 chdir("..");
 $adr1=file("db/db.txt");
 chdir("admin");
 echo count($adr1)." адресов";
   ?>

 </td>
 </tr>
 <tr><td colspan=2>
<FORM ACTION="admin3.php?sel4=selected&count=9&start=0" METHOD="POST"
 name='search'>
Вы можете не вводить адрес полностью, а, например, ввести одну букву. Будут выведены все адреса на эту букву.<br><br>
Введите адрес<br>
<input name="search_adr" type="text" size=50><br>
<input type="submit" value="Поиск" name=search>
</form>
</td></tr>
<tr>
 	<td colspan=2>

<div style=" background-color:#ffffff;  width:800px">
<TABLE width=800px border=0 cellpadding=2  CELLSPACING=1>
	<TR bgcolor=#E6E6E6>

 	<td><b>Адрес</b></td> <td><b>Группа</b> </td> <td><b>Имя</b></td>
 	<td><b>Удалить</b></td>

 	</tr>
<form name="body" action="admin3.php?sel4=selected&count=<?php echo $count ?>&start=<?php echo $start ?>" method="post">


<?php

$group=file("config/group.txt");

if(file_exists("prom"))
  {  	$f=fopen("prom","r");
   	$ser=fread($f,1000);
   	fclose($f);
   	if($ser!="Адрес не найден!")
   	  {   	  	$adr=file("prom");
   	  }
   	 else
   	  {
   	    echo "<font color=red>Адрес не найден!</font>";   	  	chdir("..");
        $adr=file("db/db.txt");
        chdir("admin");
   	  }


  }
  else
  {
   chdir("..");
   $adr=file("db/db.txt");
   chdir("admin");
  }
if(file_exists("prom"))
{	unlink("prom");
	if($ser!="Адрес не найден!")@$sear=true;


}

$i=0;
$n=0;
foreach($adr as $k=>$line)
 {
    if ($i< $start)
       {       	$i++;
        continue;
       }
    if ($n > @$count) break;
 	$expl=explode("*",$line);
    if(@$sear)$k=trim($expl[3]);
 	echo "<tr bgcolor=#E6E6E6>
 	<td>
 	$expl[0]
 	<input name=mail[$k] type='hidden' value='$expl[0]'>

 	</td> <td>

 	<select  name=listgroup[$k]>";
 	foreach($group as $line1)
   {

    $line1=trim($line1);
    //Принадлежность к группе
    if ($expl[1]==$line1)$gr='selected';
    else $gr="";
 	echo"<option value='$line1' $gr>$line1</option>";
   }

 	echo"</select>

 	</td> <td>
 	$expl[2]
 	<input name='Name[$k]' type='hidden' value='$expl[2]'>
 	</td>
 	<td><input name='del[$k]' type='checkbox' value='ON'></td>

 	</tr>";

 	$n++;

 }
?>



</TD>
	</TR>
</TABLE></div>

</TD>
	</TR>

	<tr><td align=botton><INPUT TYPE="submit" VALUE="Сохранить" name="GO"></td></tr>
</FORM>
<tr><td>

<?php
if (count($adr)>$count+1)
{
$begin=0;
for($i=1;$i<100000;$i++)
  {  	if($begin >=count($adr))break;
  	echo "<a href='admin3.php?sel4=selected&count=$count&start=$begin'>$i</a>&nbsp;";
    $begin+=$count+1;

  }
}
?>

 </td><td align=right >Вывести <a href="admin3.php?sel4=selected&count=9&start=0">10</a>&nbsp;
<a href="admin3.php?sel4=selected&count=24&start=0">25</a>&nbsp;
<a href="admin3.php?sel4=selected&count=49&start=0">50</a>&nbsp;
<a href="admin3.php?sel4=selected&count=99&start=0">100</a>&nbsp;</td></tr>
</TABLE></div>

</BODY>
</HTML>