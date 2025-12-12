<?php
$config=file('admin/config/mes.txt');
function quit($a)
 {

    $f=fopen("info.txt","w+");
    fwrite($f,$a);
    fclose($f); 	echo "<meta http-equiv='refresh' content='0; url=info.php'>";
    exit;
 }
$info="";
//Если перешли не с формы и не по ссылке ===================================
if(empty($_POST['mail']) && (empty($_GET['adr']) || empty($_GET['id']) ) )
 {
      $info="Введите корректный адрес!!<br>
      <a href=\"javascript: window.history.go(-1)\";>Вернуться</a>";
     quit($info);

 }

//Если перешли по ссылке================================================
if(isset($_GET['adr']) && isset($_GET['id']))
  {     //Проверка соответствия id и адреса
       $strpath="db/email.txt";
   //Если файл существует, но id или адреса такого нет
   if(file_exists($strpath))
      {
    	$arr=file($strpath);
        $mailY=false;
    	foreach($arr as $line)
    	 {
    	 	$expl=explode("*",$line);
            if ($expl[1]==$_GET['adr'] && trim($expl[2])==$_GET['id'])
                {                	$mailY=true;
                	break;
                }
    	 }

       if (!$mailY)
         {         	$info="Подписка не может быть активизирована! Возможно вы уже подписаны.
            <br><a href=http://".$_SERVER['SERVER_NAME'].">На главную</a>";
             quit($info);
         }
       //Если всё нормально, заносим в базу
       $strpath="db/db.txt";

         if(file_exists($strpath))
         {
          //Пользователь может перезагрузить страницу и адрес
          //ещё раз запишется. Чтобы этого не произошло
           $mailY=false;

               $arr1=file($strpath);
    	       foreach($arr1 as $line)
    	        {
    	          $expl=explode("*",$line);
    	 	      if($_GET['adr']==$expl[0])
    	 	       {
    	 	   	     $mailY=true;
    	 	   	     break;
    	 	       }

    	        }


                if($mailY)
                {                	$info="Этот адрес уже подписан на новости!<br>
                    <a href=http://".$_SERVER['SERVER_NAME'].">На главную</a>";
                    quit($info);
                }

    	  $f=fopen($strpath,"a");
    	  fwrite($f,$_GET['adr']."*"."Подписчик"."*"."\r\n");

    	 }


         else
         {
    	  $f=fopen($strpath,"w+");
    	  fwrite($f,$_GET['adr']."*"."Подписчик"."*"."\r\n");
         }
         fclose($f);

         //Удаляем идентификатор


         $strpath="db/email.txt";
         $f=fopen($strpath,"w+");
         $ident=0;
         foreach($arr as $line)
          {             $expl=explode("*",$line);
             if($expl[1]==$_GET['adr'])continue;
             fwrite($f,$line);
             $ident++;
          }
          fclose($f);
          if(!$ident)unlink($strpath);

         $info="Вы подписались на новости сайта!<br>
         <a href=http://".$_SERVER['SERVER_NAME'].">На главную</a>";
         quit($info);

      }

    else
    //А если не существует, то фальсификация или опоздал подписчик
     {       $info="Подписка не может быть активизирована! Возможно прошёл срок активизации или вы уже
       подписаны.<br> Если новости вам не приходят,  подайте заявку через форму подписки ещё раз.<br>
       <a href=http://".$_SERVER['SERVER_NAME'].">На главную</a>";
       quit($info);

     }
  }




//Корректность адреса===============================================

 if (isset($_POST['mail']))
  {
    if(!preg_match("|[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}|i", $_POST['mail']))
     {
      $info="Введите корректный адрес!<br>
      <a href=\"javascript: window.history.go(-1)\";>Вернуться</a>";
      quit($info);

     }
  //Если проверку прошёл, на всякий случай
         $_POST['mail']=trim( $_POST['mail']);
  //Удаляем символ
   $_POST['mail']=str_replace("*","",$_POST['mail']);
         $_POST['mail']=htmlspecialchars($_POST['mail']);
         $_POST['mail']=stripslashes($_POST['mail']);


  //А нет ли такого уже такого адреса=========================
  $mailY=false;
  $strpath="db/db.txt";
  if(file_exists($strpath))
    {       $arr=file($strpath);
    	foreach($arr as $line)
    	 {
    	 	 $expl=explode("*",$line);
    	 	 if($_POST['mail']==$expl[0])
    	 	   {    	 	   	  $mailY=true;
    	 	   	  break;
    	 	   }

    	 }
    }

  if($mailY)
    {    	$info="Этот адрес уже подписан на новости!
        <a href=\"javascript: window.history.go(-1)\";>Вернуться</a>";
        quit($info);
    }

   //А не ждёт ли этот адрес подписки=========================
 $mailY=false;
 $strpath="db/email.txt";
  if(file_exists($strpath))
    {
       $arr=file($strpath);
    	foreach($arr as $line)
    	 {
    	 	$expl=explode("*",$line);
            if ($expl[1]==$_POST['mail'])
                {
                	$mailY=true;
                	break;
                }

    	 }
    }

  if($mailY)
    {      $info="Этот адрес ожидает подтверждения подписки! <br>Пожалуйста проверьте свой
      почтовый ящик!<br><a href=\"javascript: window.history.go(-1)\";>Вернуться</a>";
      quit($info);
    }
 //Очищаем базу от старых записей=================================
  $strpath="db/email.txt";

  if(file_exists($strpath))
    {
    	$arr=file($strpath);
    	foreach($arr as $line)
    	 {    	 	$expl=explode("*",$line);
    	 	//Проверяем, не более ли суток записи
    	 	//Если меньше, переписываем в другой массив
    	 	  if((time()-$expl[0])< (3600*24)) $arr2[]=$line;
    	 }
        if(count($arr2))
         {
           $f=fopen($strpath,"w+");
           foreach($arr2 as $line) fwrite($f,$line);
           fclose($f);
         }
        else
         {         	unlink($strpath);
         }
    }


  //Формируем ссылку для письма на подписку=====================
  //Запись в базу
  $id=rand(1000,9999);
  if(file_exists($strpath))
    {    	$f=fopen($strpath,"a");
    	fwrite($f,time()."*". $_POST['mail']."*".$id."\r\n");
    }

 else
   {
    	$f=fopen($strpath,"w+");
    	fwrite($f,time()."*". $_POST['mail']."*".$id."\r\n");
   }
 fclose($f);

 //Посылаем письмо============================================
  @$config[0]=trim($config[0]);

  if(@$config[0]!="")$adr=$config[0];
  else $adr="http://".$_SERVER['SERVER_NAME'];

  $mailval= $_POST['mail'];
  $url="/nscript/m.php?adr=".$_POST['mail']."&id=".$id;
  $link="http://".$_SERVER['SERVER_NAME'].$url;
  $message="Здравствуйте! Вы подписались на новости сайта $adr
 Для подтверждения подписки перейдите по этой ссылке $link
 Если вы не подтвердите подписку в течение суток, заявку можно будет подать повторно.
 Если ваш адрес кто-то использовал без вашего согласия, просто удалите это сообщение
 С уважением

 Администратор сайта $adr";
 $subject= "Подписка на новости сайта $adr";
 $message=convert_cyr_string($message,"w","k");
 $subject=convert_cyr_string($subject,"w","k");
 $message=str_replace("\r\n","\n",$message);
 $from="Рассылка";
 $from=convert_cyr_string($from,"w","k");


             Mail($mailval, $subject, $message,
             "From:$from<site@site.ru>\r\n");
 $info="Уважаемый посетитель! На указанный адрес отправлено письмо с подтверждением подписки.<br>
 Ваша подписка будет активирована после перехода по ссылке, указанной в письме";
 quit($info);

 }



?>
