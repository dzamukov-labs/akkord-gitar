<?php
  setlocale (LC_ALL, array ('ru_RU.CP1251', 'rus_RUS.1251'));
  //Забираем расширения и каталоги
  $file_type_file=file("admin/conf/type_file.txt");
  $expl_type=explode(" ",$file_type_file[0]);
  //Схема
  $shem=file("admin/conf/shem/shem.txt");
  $dir_scan=array();
  $file_scan=array();

   //Проверяем схему
    if($shem[0]==1)
       {
       	 //Используется список запрещённых файлов и каталогов
         $dir_scan=file("admin/conf/shem/dirn.txt");
         $file_scan=file("admin/conf/shem/filen.txt");
       }
    else
       {       	 $dir_scan=file("admin/conf/shem/diry.txt");
         $file_scan=file("admin/conf/shem/filey.txt");
       }
    $n=0;


   foreach($dir_scan as $line)
     {
       $line=trim($line);
       $line="./".$line;       $dir_scan[$n]=$line;
       $n++;
     }
   $n=0;
   foreach($file_scan as $line)
     {
       $line=trim($line);
       $line="./".$line;
       $file_scan[$n]=$line;
       $n++;
     }



  $count_query_res=0;
  //Начало функции=========================================================================
  function scan_dir($dirname)
  {
    global $f1,$quit,$count_bak,$title,$expl_type,$shem,$dir_scan,$file_scan,$count_query_res;
    $dir_scan_true=false;

   //Проверяем на запрещённые каталоги
   //Если на запрещённые каталоги
   if($shem[0]==1)
      {      	if(in_array($dirname,$dir_scan))$dir_scan_true=true;

      }
   else
      {      	if(!in_array($dirname,$dir_scan))$dir_scan_true=true;

      }

   //Если список пуст
   if(count($dir_scan)==0) $dir_scan_true=false;


   if($dirname !="./search" && $dir_scan_true==false)
   {
     // Открываем текущую директорию
     $dir = opendir($dirname);

     // Читаем в цикле директорию
     while (($file = readdir($dir)) !== false)
     {
      // Проверяем не равно ли значение переменной
      // $file текущей или вышележащей директории
      if($file != "." && $file != "..")
     {

        //Проверка на файлы
       if(is_file($dirname."/".$file))
        {
          $file_scan_true=false;
          if($shem[0]==1)
          {
      	  if(in_array($dirname."/".$file,$file_scan))$file_scan_true=true;
          }
         else
          {
      	  if(!in_array($dirname."/".$file,$file_scan))$file_scan_true=true;
          }
        }

         //Если список пуст
         if(count($file_scan)==0) $file_scan_true=false;


        //если файл
        if((is_file($dirname."/".$file)) &&  $file_scan_true==false)
          {

             //Проверка расширения
             $expl=explode(".",$file);
             if(in_array($expl[count($expl)-1],$expl_type))
             {

                //поисковую строку в массив
                  if(isset($_POST['log']))
                     {
                       if($_POST['log']==1)$arr_quit=explode(" ",$quit);
                       else $arr_quit[0]=$quit;
                     }
                   else $arr_quit[0]=$quit;

               $stop=false;
               $pre_stop=false;
               $pre_stop1=false;
               $start=0;
               $search_res=false;
          	   $read=file_get_contents("$dirname/$file");

               $count=0;
          	   // Извлекаем название HTML-страницы
          	   $title="";
                $pattern = "|<title>(.*?)</title>|siU";
                   if(preg_match($pattern, $read, $title_arr))
                     {
                       $title= $title_arr[1];
                     }

                $read= preg_replace("'<style[^>]*?>.*?</style>'si", "", $read);
                $read= preg_replace("'<script[^>]*?>.*?</script>'si", "", $read);
                $read= preg_replace("'<head[^>]*?>.*?</head>'si", "", $read);
                $read= preg_replace("|<meta[^>]+>|si", "", $read);
                $read_bak=$read;
                $read= strip_tags($read);
                $read= preg_replace( "'&(nbsp|#160);'i", " ", $read);
                $read= preg_replace( "'([\r\n])[\s]+'", " ", $read);



                 $search_res=false;
                //==========================================================
                 //Критерии поиска==========================================
                 //Если не задействован подробный поиск, ищем полную фразу как есть в любых сочетаниях

                 foreach($arr_quit as $line)
                   {                       if(isset($_POST['toch'])) $pattern="/\b".$line."\b/";
                       else $pattern="/$line/";
                       if(!isset($_POST['registr']))$pattern.="i";

                      $count+=preg_match_all($pattern,$read,$arr);

                   }


                //=========================================================

               if($count)
               {
                $count_query_res++;
                $read_bak= strip_tags($read_bak,"<br><p><font><b><i><u><pre><table><td><tr><h1><h2><h3><h4><h5>");
                $read_bak= preg_replace( "'&(nbsp|#160);'i", " ", $read_bak);
                $read_bak= preg_replace( "'([\r\n])[\s]+'", " ", $read_bak);
                //Выделение в тексте========================================
                foreach($arr_quit as $line)
                 {
                   if(strpos($read_bak,$line)===false) $line=strtolower($line);
                   if(strpos($read_bak,$line)===false) $line=ucfirst($line);
                   if(strpos($read_bak,$line)===false) $line=ucwords($line);
                   if(strpos($read_bak,$line)===false) $line=strtoupper($line);
                   $read_bak=  str_replace($line,"<span id=select>$line</span>", $read_bak);
                 }

                  $count_bak++;
                  $f=fopen("search/bak/".$count_bak.".html","w+");
                  fwrite($f,"<html><head><title>Текстовая копия по запросу :: $quit</title>
                               <style>
 	                              #select
 	                                {
                                     font-weight:700;
                                     color:#ffffff;
                                     background-color:#0080C0;
                                     }
                               </style>
                               </head>
                               <body>
                               $read_bak
                               </body></html>");

                  fclose($f);
                  //Выделяем текст================================================
                  foreach($arr_quit as $line)
                   {
                       //Перебераем варианты запроса

                       if(strpos($read,$line)===false) $line=strtolower($line);
                       if(strpos($read,$line)===false) $line=ucfirst($line);
                       if(strpos($read,$line)===false) $line=ucwords($line);
                       if(strpos($read,$line)===false) $line=strtoupper($line);
                        $word_pos= strpos($read,$line);
                        if($word_pos!==false) break;
                   }


                    $to_word = substr($read, 0, $word_pos);
                    $start = strrpos($to_word, ".");
                    if ($start != 0) $start++; else $start=0;
                    $to_stop = substr($read, $word_pos);

                    $stop = strpos($to_stop, ".") + 1 + $word_pos;
                    if(strpos($read,".",$word_pos)===false)$stop=strlen($read)+1;
                    $read=substr($read,$start,(++$stop-$start));

                   //======================================================================

                   $link=substr_replace($dirname,"",0,2);
                   if($title=="") $title="Документ без названия";

                    if($link!="")
                       $link1="<a href=http://$_SERVER[SERVER_NAME]/$link/$file target=_blank>$title</a>";
                    else
                       $link1="<a href=http://$_SERVER[SERVER_NAME]/$file target=_blank>$title</a>";

                     fwrite($f1,"$link1*$read*$count\r\n");

               }
             }

       }

      // Если перед нами директория, вызываем рекурсивно
      // функцию scan_dir
      if(is_dir($dirname."/".$file))
         {
           scan_dir($dirname."/".$file);
         }
     }

   }
    // Закрываем директорию
    closedir($dir);
   }



 }

if(isset($_POST['quit']) && $_POST['quit']!="")
  {     $_POST['quit']=strip_tags($_POST['quit']);
     $_POST['quit']=str_replace("/","",$_POST['quit']);
     $_POST['quit']=str_replace("\\","",$_POST['quit']);
     $_POST['quit']=str_replace("[","",$_POST['quit']);
     $_POST['quit']=str_replace("]","",$_POST['quit']);
     $_POST['quit']=str_replace("*","",$_POST['quit']);
     $_POST['quit']=str_replace("|","",$_POST['quit']);
     $_POST['quit']=str_replace("(","",$_POST['quit']);
     $_POST['quit']=str_replace(")","",$_POST['quit']);
     $_POST['quit']=str_replace("}","",$_POST['quit']);
     $_POST['quit']=str_replace("{","",$_POST['quit']);
     $_POST['quit']=str_replace("^","",$_POST['quit']);
     $_POST['quit']=str_replace("#","",$_POST['quit']);
     $_POST['quit']=str_replace("?","",$_POST['quit']);
     $_POST['quit']=str_replace("@","",$_POST['quit']);
     $_POST['quit']=str_replace(".","",$_POST['quit']);
     $_POST['quit']=str_replace("%","",$_POST['quit']);
     $_POST['quit']=str_replace("+","",$_POST['quit']);
     $_POST['quit']=str_replace("~","",$_POST['quit']);


  }

//Конец функции=====================================================================
if(isset($_POST['quit']) && $_POST['quit']!="")
 {
  $f1=fopen("res.txt","w+");
  $d = opendir("bak");

    while(($e=readdir($d))!=false)
    {

      if($e != "." && $e != "..") unlink("bak/$e");

    }
   closedir($d);

   $r=fopen("quit","w+");
   fwrite($r,$_POST['quit']."*".$_SERVER['REMOTE_ADDR']);
   fclose($r);

   $j=fopen("admin/conf/jurnal.txt","a");
   chdir("..");
   $title=array();
   // Имя директории
   $dirname = ".";
   $quit=$_POST['quit'];
   $quit=trim($quit);
   scan_dir($dirname);
   fclose($f1);

   //Для журнала
   $jurnal=date("d.m.y H:i")."*".$_POST['quit'];
   if(isset($_POST['toch']))$jurnal.="* точное совпадение";
   else $jurnal.="* любое сочетание";

   if(isset($_POST['registr']))$jurnal.="* учитывать регистр";
   else $jurnal.="* не учитывать регистр";

   if(isset($_POST['log']))
      {
         if($_POST['log']==1) $jurnal.="* любое слово";
         if($_POST['log']==2) $jurnal.="* фраза целиком";
      }
   else $jurnal.="* фраза целиком";
   $jurnal.="*найдено документов $count_query_res\r\n";

   fwrite($j,$jurnal);
   fclose($j);
  echo "<meta http-equiv='refresh' content='0; url=res.php?s=1'>";
 }
else
 {
      $r=fopen("quit","w+");
      fwrite($r,"*");
      fclose($r); 	echo "<meta http-equiv='refresh' content='0; url=res.php'>";

 }
?>
