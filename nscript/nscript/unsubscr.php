<?php
 function quit($a)
 {

    $f=fopen("info.txt","w+");
    fwrite($f,$a);
    fclose($f);
 	echo "<meta http-equiv='refresh' content='0; url=info.php'>";
    exit;
 }

 //Если перешли не по ссылке
 if(empty($_GET['un']) || empty($_GET['id'] ))
 {
      $info="Здесь нет ничего интересного.
            <br><a href=http://".$_SERVER['SERVER_NAME'].">На главную</a>";
     quit($info);

 }

 //Проверяем соответствие адреса и id

 if(file_exists("admin/mes/unsub.txt"))
 {
    $arr=file("admin/mes/unsub.txt");
    if (count($arr))
       {       	  foreach($arr as $line)
       	   {       	   	 $expl=explode("*",$line);
       	   	 $expl[1]=trim($expl[1]);
       	   	   if($expl[0]==$_GET['un']&& $expl[1]==$_GET['id'] )
       	   	      {                    //Удаляем из базы
                    $db=file("db/db.txt");
                    $f=fopen("db/db.txt","w+");
                     foreach($db as $line1)
                      {                      	$expl1=explode("*",$line1);
                      	if($expl1[0]==$_GET['un'])continue;
                      	fwrite($f,$line1);

                      }
                      fclose($f);
       	   	      	$info="Вы отписаны от новостей!.
                    <br><a href=http://".$_SERVER['SERVER_NAME'].">На главную</a>";
                    quit($info);

       	   	      }
       	   }
       }

 }

$info="Отписку от новостей произвести не удалось.<br>
<b>Возможные причины</b>: ошибка при наборе в адресной строке браузера или
ссылка устарела. <br>Вы можете написать с этого адреса письмо администратору сайта
с просьбой отписаться от рассылки.
<br><a href=http://".$_SERVER['SERVER_NAME'].">На главную</a>";
quit($info);

?>

