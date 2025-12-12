<?php
 include("cap.php");
 $info="";
 $val="";
 $col="";

 if(isset($_POST['go']))
   {      $val=$_POST['name'];
      $col=$_POST['col'];
      if($_POST['name']=="")$info="Введите название<br>";
      if($_POST['col']=="" || $_POST['col']==0 ||
         $_POST['col']==1 ||!is_numeric($_POST['col']))$info.="Введите количество вопросов<br>";

      if($info=="")
       {
         //Сохраняем данные
         $_POST['name']=str_replace("*","",$_POST['name']);
         $f=fopen("db/temp.txt","w+");
         fwrite($f,$_POST['name']."\r\n".$_POST['col']);
         fclose($f);
         echo "<meta http-equiv='refresh' content='0; url=admin2.php'>";
         exit();
       }

   }

if(file_exists("db/temp.txt"))
  {  	$file=file("db/temp.txt");
  	$val=trim($file[0]);
  	if(isset($file[1]))$col=trim($file[1]);
  }

?>
 <style>
  #button {

       font-family:"Times New Roman", "serif";
       color:#408080;
       font-size:9pt;
       background-color:#C0C0C0;
      font-weight:600;
      text-align:center;
      width:80px;
      }
 </style>

<CENTER>
<form action="admin1.php?sel1=selected" method="post" name="frm">
 <TABLE bgcolor=#EBEBEB width=60% height=50% >

<tr >
   <td valign=top style=" border:1px solid #d0c9ad; padding:10px;">

   <FONT COLOR="#408080" size=+1>Мастер создания опроса</font><br><br>
   Создайте опрос за два шага.<br><br>
   <?php echo "<font color=red>$info</font><br>" ?>
   Название<br><input name="name" type="text" value="<? echo $val ?>" size=60><br><br>
   Количество вопросов<br><input name="col" type="text" value="<? echo $col ?>" size=5><br><br>

   <input type="submit" value="Далее >>" name=go id=button>





   </td>
 </tr>


</table>


</form>
</BODY>
</HTML>