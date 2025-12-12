<?php
 include("cap.php");
 $info="";
 $sav=false;
 if(!file_exists("db/temp.txt"))
    {
   	  echo "<meta http-equiv='refresh' content='0; url=admin1.php?sel1=selected'>";
      exit();
   }
 if(isset($_POST['back']))
   {   	  echo "<meta http-equiv='refresh' content='0; url=admin1.php?sel1=selected'>";
      exit();
   }

 $file=file("db/temp.txt");
 $name=trim($file[0]);
 $col=trim($file[1]);
 $val=array();
  for($i=0; $i < $col; $i++) $val[$i]="";

 if(isset($_POST['save']))
   {
     for($i=0; $i < $col; $i++)
        {
        	$val[$i]=$_POST['ask'][$i];
        }      //Проверяем на данные
      for($i=0; $i < $col; $i++)
        {        	if ($_POST['ask'][$i]=="")
        	   {        	   	  $info="<font color=red>Вы ввели не все данные.</font>";
        	   	  break;
        	   }
        }

       if($info=="")
         {
           $f=fopen("db/index.txt","r");
           $index=fread($f,1024);
           fclose($f);
           $name=str_replace("*","",$name);           $f=fopen("db/sett.txt","a");
           fwrite($f,$index."*".date("d.m.Y")."*".$name."*0\r\n");
           fclose($f);

           $f=fopen("db/".$index.".txt","w+");
           for($i=0; $i< $col; $i++)
               {               	 $_POST['ask'][$i]=trim($_POST['ask'][$i]);
               	 $_POST['ask'][$i]=str_replace("*","",$_POST['ask'][$i]);
               	 fwrite($f,$_POST['ask'][$i]."*0\r\n");
               }
           fwrite($f,0);
           fclose($f);

           $f=fopen("db/stat/".$index.".txt","w+");
           fclose($f);

           $f=fopen("db/index.txt","w");
           fwrite($f,++$index);
           fclose($f);

           unlink("db/temp.txt");
           $sav=true;
         }
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
<form action="admin2.php?sel2=selected" method="post" name="frm">
 <TABLE bgcolor=#EBEBEB width=60% >

<tr >
   <td valign=top style=" border:1px solid #d0c9ad; padding:10px;">

   <FONT COLOR="#408080" size=+1>Мастер создания опроса</font><br><br>
   <?php

 if(!$sav)
   {
    echo"Введите вопросы.<br><br>
     $info <br><br>
     <font color=#808080 size=4>$name</font><br><br>";
     for($i=0; $i< $col; $i++)
       {         echo "<input name=ask[$i] type=text  size=60 value='$val[$i]'><br>";
       }
   }
  else
   {      echo "Опрос создан! Вы можете редактировать его в соответствующем
      разделе панели управления.<br>
      Внимание!!! Для того, чтобы опрос отображался, необходимо его активировать (поставить соответствующую галочку
      в разделе Редактирования.)";

   }
    ?>



   <br><br><input type="submit" value="<< Назад" name=back id=button>
<?php
  if(!$sav )echo "<input type=submit value=Сохранить name=save id=button>"
?>





   </td>
 </tr>


</table>


</form>
</BODY>
</HTML>