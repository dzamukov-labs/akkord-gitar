<?php
 include("cap.php");
 if(isset($_POST['but_shem']))
   {   	 $f=fopen("conf/shem/shem.txt","w+");
   	 fwrite($f,$_POST['shem']);
   	 fclose($f);
   }

  if(isset($_POST['but_file_scan']))
   {   	 if($_POST['file_scan']!="")
   	   {
   	    $f=fopen("conf/shem/filey.txt","a");
   	    fwrite($f,$_POST['file_scan']."\r\n");
   	    fclose($f);
   	   }
   }

  if(isset($_POST['but_dir_scan']))
   {
   	 if($_POST['dir_scan']!="")
   	   {
   	    $f=fopen("conf/shem/diry.txt","a");
   	    fwrite($f,$_POST['dir_scan']."\r\n");
   	    fclose($f);
   	   }
   }

  if(isset($_POST['but_file_no_scan']))
   {
   	 if($_POST['file_no_scan']!="")
   	   {
   	    $f=fopen("conf/shem/filen.txt","a");
   	    fwrite($f,$_POST['file_no_scan']."\r\n");
   	    fclose($f);
   	   }
   }

   if(isset($_POST['but_dir_no_scan']))
   {
   	 if($_POST['dir_no_scan']!="")
   	   {
   	    $f=fopen("conf/shem/dirn.txt","a");
   	    fwrite($f,$_POST['dir_no_scan']."\r\n");
   	    fclose($f);
   	   }
   }

   if(isset($_POST['but_type_file']))
   {
   	 if($_POST['type_file']!="")
   	   {
   	    $f=fopen("conf/type_file.txt","w+");
   	    fwrite($f,$_POST['type_file']);
   	    fclose($f);
   	   }
   }

 //Проверка данных
 $shem_val=file("conf/shem/shem.txt");
 if($shem_val[0]==1)$check_shem1="checked";
 else $check_shem1="";

 if($shem_val[0]==2)$check_shem2="checked";
 else $check_shem2="";

 $file_type_file=file("conf/type_file.txt");

?>
<style>
#block
  {   font-family:"Times New Roman", "serif";
   font-size:10pt;
   color:#000040;
   font-weight:300;
   overflow:auto;
   width:70%;
   height:100px;
   background-color:#FFFFFF;
   padding:10px;
  }
 #block a
  {
   font-family:"Times New Roman", "serif";
   font-size:10pt;
   color:#000040;
   font-weight:300;

  }
</style>

<TABLE align=center bgcolor=#EBEBEB width=80% CELLPADDING=10 CELLSPACING=0 border=0>

<tr >
   <td><FONT COLOR="#408080" size=+1  >Оптимизация поиска</FONT> </td>
</tr>
<tr >
   <td>Для оптимизации поиска рекомендуется выбрать типы файлов по расширениям. <b>Внимание!</b> Для поиска подходят
   только web-документы, такие как <b>html</b>, <b>php</b> и пр. или текстовые файлы с расширением <b>txt</b>,
   иначе скрипт будет работать с грубыми ошибками. <br>
    Так же нужно определить файлы и каталоги с полезной информацией или исключить из поиска файлы и каталоги, где этой
   информации не содержится.<br> Для удобства ведено две схемы: если у вас большинство информационных страниц, удобнее запретить сканировать
   отдельные файлы или даже целые каталоги, содержащие только служебную информацию (например папки со скриптами)<br>
   Если страниц с информацией меньше, тогда проще внести в список файлов и каталогов те страницы и папки, в которых будет производится поиск.<br>
   Если вы запретили (или разрешили) целый каталог, файлы из него в список вносить не надо!
    Заполните эти списки и выберите, каким списком (разрешительным или запретительным) пользоваться.
    <b>Внимание!</b> Каталоги нужно вставлять без завершающих слешей /<br>
    Например, у вас есть каталог со скриптом по адресу http://ваш_сайт/scripts/script
Т.к. в папке со скриптом кроме исходного кода и служебной информации как правило ничего не бывает, запрещаем его для поиска,
т.е. вносим в список запрещённых каталогов так: scripts/script
Как видите, http://ваш_сайт/ мы опустили.
С файлами тоже самое. Допустим, есть файл с паролями http://ваш_сайт/каталог/pwl.txt Мы бы могли просто запретить доступ в этот каталог,
 но там содержатся и другие документы, важные для поиска. Тогда вносим его в список запрещённых файлов так: каталог/pwl.txt

      </td>
</tr>
<form action="admin3.php?sel3=selected" method="post">


<tr >
   <td>
     Типы файлов по расширениям (вводите через пробел без точки перед расширением) <br>
    <input name="type_file" type="text" value="<? echo $file_type_file[0] ?>" size=85><br>
    <input type="submit" value="Добавить" name=but_type_file><br><br>


    Выберите схему<br>
    <input name="shem" type="radio" value="1" <? echo $check_shem1 ?> >&nbsp;Использовать список запрещённых файлов и каталогов<br>
    <input name="shem" type="radio" value="2" <? echo $check_shem2 ?> >&nbsp;Использовать список разрешённых файлов и каталогов<br><br>
    <input type="submit" value="Выбрать схему" name=but_shem> <br><br>

   <b>Список для файлов, подлежащих сканированию.</b><br><br>
     <div id=block>
     <table>
     <?php
        $scan=array();
        $scan=file("conf/shem/filey.txt");
        $n=0;
        foreach($scan as $line)
          {
             $line=trim($line);          	 echo "<tr><td>$line</td><td>&nbsp;&nbsp;<a href=del.php?id=$n&type=filey>Удалить</a></td></tr>";
          	 $n++;
          }

      ?>
     </table>
     </div><br>
     <input name="file_scan" type="text" size=60>
     <input type="submit" value="Добавить" name=but_file_scan><br><br>

    <b>Список для каталогов, подлежащих сканированию.</b><br><br>
     <div id=block>
     <table>
         <?php
        $scan=array();
        $scan=file("conf/shem/diry.txt");
        $n=0;
        foreach($scan as $line)
          {
             $line=trim($line);
          	 echo "<tr><td>$line</td><td>&nbsp;&nbsp;<a href=del.php?id=$n&type=diry>Удалить</a></td></tr>";
          	 $n++;
          }

      ?>
      </table>
     </div><br>
     <input name="dir_scan" type="text" size=60>
     <input type="submit" value="Добавить" name=but_dir_scan><br><br>

    <b>Список для файлов, не подлежащих сканированию.</b><br><br>
     <div id=block>
     <table>
        <?php
        $scan=array();
        $scan=file("conf/shem/filen.txt");
        $n=0;
        foreach($scan as $line)
          {
             $line=trim($line);
          	 echo "<tr><td>$line</td><td>&nbsp;&nbsp;<a href=del.php?id=$n&type=filen>Удалить</a></td></tr>";
          	 $n++;
          }

      ?>
      </table>
     </div><br>
     <input name="file_no_scan" type="text" size=60>
     <input type="submit" value="Добавить" name=but_file_no_scan><br><br>


     <b>Список для каталогов, не подлежащих сканированию.</b><br><br>
     <div id=block>
     <table >
      <?php
        $scan=array();
        $scan=file("conf/shem/dirn.txt");
        $n=0;
        foreach($scan as $line)
          {
             $line=trim($line);
          	 echo "<tr><td>$line</td><td>&nbsp;&nbsp;<a href=del.php?id=$n&type=dirn>Удалить</a></td></tr>";
          	 $n++;
          }

      ?>

     </table>
     </div><br>
     <input name="dir_no_scan" type="text" size=60>
     <input type="submit" value="Добавить" name=but_dir_no_scan><br><br>
   </td>
</tr>




</form>
</table>

</body>

</html>