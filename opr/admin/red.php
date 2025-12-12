<?php
session_start();
?>
<title>Редактирование темы</title>
<style>
   #blank {
       border-style:solid;
       border-width:1px;
       border-color:#C3C3C3;
       padding:20px;
       font-family:"Times New Roman", "serif";
       color:#808080;
       font-size:10pt;
       width:700px;

       text-align=left;
      }
    #button {

       font-family:"Times New Roman", "serif";
       color:#ffffff;
       font-size:11pt;
       background-color:#B4B4B4;
      font-weight:500;
      text-align:center;
      width:90px;
      }



</style>
<?
$info="";
//Получаем сессию
$strpath="conf/conf.txt";
$content=file($strpath);


if (session_id()!=$content[2])
 {
  $url=urlencode("Пройдите авторизацию!");
  echo "<meta http-equiv=refresh content='0; url=index.php?acc=$url'>";
  exit();
 }

 //Переменные
 if(!isset($_GET['id']))
    {
      echo "<meta http-equiv='refresh' content='0; url=admin3.php?sel3=selected'>";
      exit();
    }

 //Есть ли такой опрос

 if(!file_exists("db/$_GET[id].txt"))
   {
   	  echo "<meta http-equiv='refresh' content='0; url=admin3.php?sel3=selected'>";
      exit();
   }

$info="";
//Обработка кнопок---------------------------------
//Если выход
if(isset($_POST['exit']))
  {  	  echo "<meta http-equiv='refresh' content='0; url=admin3.php?sel3=selected'>";
      exit();
  }

if(isset($_POST['save']))
  {
      //Проверка
      if($_POST['name']=="")$info="Введите данные!";

      for($i=0; $i < count($_POST['ask']); $i++)
        {
        	if ($_POST['ask'][$i]=="")
        	   {
        	   	  $info="Введите данные!";
        	   	  break;
        	   }
        }
    if($info=="")
      {
        //В общем файле
        $list=file("db/sett.txt");
        $f=fopen("db/sett.txt","w+");
        $act=0;
        if(isset($_POST['activ']))$act=1;
        foreach($list as $line)
          {
            $line=trim($line);
            $expl=explode("*",$line);
            $_POST['name']=str_replace("*","",$_POST['name']);          	if($expl[0]!=$_GET['id'])fwrite($f,$line."\r\n");
          	else
          	  {          	  	fwrite($f,"$_GET[id]*$expl[1]*$_POST[name]*$act\r\n");
          	  }
          }

         fclose($f);
        //В файле опроса
        $list=file("db/$_GET[id].txt");
        $f=fopen("db/$_GET[id].txt","w+");

        for($i=0;$i<count($list)-1; $i++)
          {
            $list[$i]=trim($list[$i]);
            $expl=explode("*",$list[$i]);
            $_POST['ask'][$i]=str_replace("*","",$_POST['ask'][$i]);
            fwrite($f,$_POST['ask'][$i]."*".$expl[1]."\r\n");

          }
        fwrite($f,$list[count($list)-1]);
         fclose($f);
  	    echo "<meta http-equiv='refresh' content='0; url=admin3.php?sel3=selected'>";
       exit();
      }
  }

if(isset($_POST['del']))
  {      //В общем файле
        $list=file("db/sett.txt");
        $f=fopen("db/sett.txt","w+");

        foreach($list as $line)
          {
            $line=trim($line);
            $expl=explode("*",$line);
          	if($expl[0]!=$_GET['id'])fwrite($f,$line."\r\n");

          }
         fclose($f);
       unlink("db/$_GET[id].txt");
       unlink("db/stat/$_GET[id].txt");
     echo "<meta http-equiv='refresh' content='0; url=admin3.php?sel3=selected'>";
     exit();
  }
  $list=file("db/sett.txt");
  foreach($list as $line)
    {
      $line=trim($line);      $list_opr=explode("*",$line);
      if($list_opr[0]==$_GET['id'])break;
    }
    $name=$list_opr[2];
    $opr=file("db/$_GET[id].txt");

    echo "<table align=center><tr><td id=blank valign=top>

     <font size=5>Редактировать опрос</font> <br><br>
     Если вы хотите отображать этот опрос, поставьте галочку <b>Активировать</b>
     <form method=post action=red.php?id=$_GET[id]>
     <font color=red>$info</font><br>
     <form action=ped.php?id=$_GET[id] method=post>

     <input name=name type=text value='$name' size=60><br><br>";
    $ask=array();
     for($i=0; $i < count($opr)-1; $i++)
       {
          $opr[$i]=trim($opr[$i]);
          $expl=explode("*",$opr[$i]);          echo "<input name=ask[$i] type=text value='$expl[0]'size=60><br>";
       }
     $check="";
     if($list_opr[3]==1)$check="checked";
     echo"<br><br>
     <input name=activ type=checkbox value=ON $check>&nbsp; Активировать<br><br>
     <input type=submit value=Сохранить id=button name=save>&nbsp;
     <input type=submit value=Удалить id=button name=del>&nbsp;
     <input type=submit value=Выход id=button name=exit>";

     echo"</table></form>";



?>
