<?php
include('cap.php');

if(@$_POST['addGroup'])
 {

   if(!empty($_POST['namegroup']))
   {
    @$_POST['namegroup']=trim(@$_POST['namegroup']);
   //Не ли такой
   $group=file("config/group.txt");
   $search=false;
   foreach($group as $line)
    {       if($_POST['namegroup']==trim($line))
        {        	$search=true;
        	break;
        }

    }

  if(!$search)
   {
    $f=fopen("config/group.txt","a");
    fwrite($f,$_POST['namegroup']."\r\n");
    fclose($f);
   }
   }
 }

if(@$_POST['addMail'])
 {
    @$_POST['mail']=trim(@$_POST['mail']);
    if(!empty($_POST['mail']))
     {
      chdir("..");
      $strpath="db/db.txt";

         if(file_exists($strpath))
         {

           $mailY=false;

               $arr1=file($strpath);
    	       foreach($arr1 as $line)
    	        {
    	          $expl=explode("*",$line);
    	 	      if($_POST['mail']==$expl[0])
    	 	       {
    	 	   	     $mailY=true;
    	 	   	     break;
    	 	       }

    	        }


                if(!$mailY)
                {
                	$f=fopen($strpath,"a");
    	             fwrite($f,$_POST['mail']."*".$_POST['listusergroup']."*".@$_POST['username']."\r\n");
    	             fclose($f);
                }

    	        else
    	        {    	        	echo "<script>window.alert(\"Этот адрес уже записан\")

                 </script>";
    	        }

    	 }


         else
         {
    	   $f=fopen($strpath,"w+");
    	   fwrite($f,$_POST['mail']."*".$_POST['listusergroup']."*".@$_POST['username']."\r\n");
    	   fclose($f);
         }

         chdir("admin");
     }

 }

 if(@$_POST['delGroup'])
 {

    if ($_POST['listgroup']!="" && $_POST['listgroup']!="Подписчик")
      {      	//Есть ли кто-то из группы
      	chdir("..");
        $mail=file("db/db.txt");
        $mailY=false;
        foreach($mail as $line)
         {         	$expl=explode("*",$line);

         	if ($expl[1]==$_POST['listgroup'])
         	   {
         	   	  $mailY=true;
         	   	  break;
         	   }
         }
        chdir("admin");
         if(!$mailY)
           {
             $group=file("config/group.txt");           	 $f=fopen("config/group.txt","w+");
           	 foreach($group as $line)
           	  {

         	    if (trim($line)==$_POST['listgroup']) continue;
           	  	fwrite($f, $line);
           	  }
           	  fclose($f);
           }
           //Если из группы кто-то есть
          else
           {            echo "<script>window.alert(\"Удалить группу невозможно так как в ней есть адреса.\"+
                  \"Переведите адреса в другую группу и повторите удаление\")

                 </script>";

           }


      }



 }



//Проверка данных---------------------------------------
$group=file("config/group.txt");


//-------------------------------------------------------------

?>

<CENTER><TABLE bgcolor=#EBEBEB width=800 CELLPADDING=7 CELLSPACING=0 border=0>
	<TR>
		<TD ><FONT COLOR="#408080" size=+1>Группы</FONT></td></tr>
<tr><td>Здесь вы вручную можете добавить почтовые адреса в общую базу и создать группы пользователей.
Создание отдельных групп позволит выборочно рассылать почтовые сообщения.
Вы можете информировать не только подписчиков новостей, но и персонал, обслуживающий ваш сайт.<br>
Допустим, ваш сайт обслуживают дизайнеры, программисты, верстальщики html, психологи и пр.<br>
Таким образом можно создать группы по специализациям
для персонала сайта.<br> Теперь вы можете отправлять отдельно новости, отдельно служебную информацию
по специализации ваших сотрудников.<br>Группа <b>"Подписчик"</b>- основная группа. Туда по умолчанию
попадают все, кому группа не установлена. Удалить её не удастся.



 </td></tr>
 <tr><td>
<FORM ACTION="admin2.php?sel3=selected" METHOD="POST">
<b>Добавить группу</b><br><br>
Название <br>
<input name="namegroup" type="text" size=50 ><br>
<INPUT TYPE="submit" VALUE="Добавить" name="addGroup"><br><br>
<b>Удалить группу</b><br><br>
Список существующих групп<br>
<select  name="listgroup">

<?php
foreach($group as $line)
 {
    $line=trim($line); 	echo"<option value='$line'>$line</option>";
 }
?>
</select><br>
<INPUT TYPE="submit" VALUE="Удалить" name="delGroup"><br><br>



<b>Добавить адрес</b><br><br>
Адрес<br>
<input name="mail" type="text" size=50 ><br>

Имя<br>
<input name="username" type="text" size=50 ><br>


Группа<br>
<select  name="listusergroup">

<?php
foreach($group as $line)
 {
    $line=trim($line);
 	echo"<option value='$line'>$line</option>";
 }
?>
</select><br>

<INPUT TYPE="submit" VALUE="Добавить" name="addMail">
</FORM>



</TD>
	</TR>
</TABLE></CENTER>

</BODY>
</HTML>