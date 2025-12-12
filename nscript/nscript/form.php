<?php
//Отправка писем===========================
//Проверяем, нет ли неотправленой почты
if(file_exists("nscript/admin/send/adr.txt"))
  {  	//Если есть, определяем  кличество адресов за один раз и интервал отправки
  	$f=fopen("nscript/admin/send/count.txt","r");
  	$r=fread($f,100);
  	fclose($f);
  	$tool=explode("*",$r);

  	//Определяем количество отправленных писем и время последней отправки
  	$f=fopen("nscript/admin/send/count_adr.txt","r");
  	$r=fread($f,100);
  	fclose($f);
  	$conf=explode("*",$r);
  	//Прошло ли достаточно времени
  	if((time()-$conf[1]) > ($tool[1]*60))
  	   {         //Если прошло, отправляем:
         //Письмо
           $f=fopen("nscript/admin/send/mes.txt","r");
  	       $m=fread($f,filesize("nscript/admin/send/mes.txt"));
  	       fclose($f);
  	       $mes=explode("/*/",$m);

           $subject=$mes[0];
           $p=$mes[2];
           $message=$mes[1]."\r\n \r\n".$p;
           $mes_unsub="----------------------------------------------------------
           Для того, чтобы отписаться от рассылки, перейдите по этой ссылке \r\n";
           $message=convert_cyr_string($message,"w","k");
           $subject=convert_cyr_string($subject,"w","k");
           $message=str_replace("\r\n","\n",$message);
           $mes_unsub=convert_cyr_string($mes_unsub,"w","k");
           $link="http://".$_SERVER['SERVER_NAME']."/nscript/unsubscr.php?";

         //Адреса
         $adr=file("nscript/admin/send/adr.txt");

         $f=fopen("nscript/admin/mes/unsub.txt","a");
         $limit=false;
         $conf[2]++;
         for($i=$conf[0],$n=0; $i!=count($adr); $i++,$n++)
          {
             $adr[$i]=trim($adr[$i]);             if($n==$tool[0])
              {
                //Обновляем данные
                $f=fopen("nscript/admin/send/count_adr.txt","w+");
                fwrite($f,$conf[0]+$n."*".time()."*".$conf[2]);
                fclose($f);
                $limit=true;                break;
              }
            $id=rand(1000,9999);
          	fwrite($f,$adr[$i]."*".$id."\r\n");
          	$url="un=$adr[$i]&id=$id";

          	$from="Рассылка";
          	$from=convert_cyr_string($from,"w","k");
            Mail($adr[$i], $subject, $message."\r\n".$mes_unsub.$link.$url,
            "From:$from<site@site.ru>\r\n");
            $adr_save[]=$adr[$i];

          }

          //Сохраняем письмо
           $f=fopen("nscript/admin/mes/".time(),"w+");
           fwrite($f," "."/*/"." ");

            fwrite($f,"/*/");

            fwrite($f,"Для адресов"."/*/");

           foreach($adr_save as $line)
             {
             	fwrite($f,$line." ");
             }
           fwrite($f,"/*/");

           fwrite($f,"Тема"."/*/");
           fwrite($f,$mes[0]);

           fwrite($f,"/*/");
           fwrite($f,$mes[1]);

           fwrite($f,"/*/");
           fwrite($f,$mes[2]);
           fwrite($f,"/*/".$conf[2]);

           fclose($f);

          if(!@$limit)
        {
        	//Значит все письма отправлены, удаляем настройки
            unlink("nscript/admin/send/adr.txt");
            unlink("nscript/admin/send/mes.txt");
            unlink("nscript/admin/send/count_adr.txt");

        }

  	   }



  }

$strpath="nscript/admin/config/conf.txt";
$adrself=getcwd();
for($i=0; $i<100; $i++)
 {
    if(file_exists("public_html"))break;
    if (!file_exists($strpath)) chdir("..");
    else break;

 }

if (file_exists($strpath))
 {
    $f=fopen($strpath,"r");
 	$narr=file($strpath);
 	fclose($f);

 }

 foreach($narr as $line)
  {  	$nscript[]=trim($line);
  }
chdir($adrself);

?>
<style>

#nscr_headPar    {
             font-family:"Times New Roman", "serif";
             color:<?echo $nscript[3] ?>;
             font:<?echo $nscript[7]." ".  $nscript[5]."pt" ?>;

            }

 #nscr_ollPar    {
             font-family:"Times New Roman", "serif";
             color:<?echo $nscript[4] ?>;
             font:<?echo $nscript[8]." ".  $nscript[6]."pt" ?>;

            }




 #nscr_userPar {
             font-family:"Times New Roman", "serif";
             border-style:<?echo $nscript[10] ?>;
             border-width: <?echo $nscript[11] ?>px;
             border-top-color:<?echo $nscript[14] ?>;
             border-bottom-color:<?echo $nscript[15] ?>;
             border-left-color:<?echo $nscript[12] ?>;
             border-right-color:<?echo $nscript[13] ?>;
             background-color:<?echo $nscript[9] ?>;
             width:<?echo $nscript[19] ?>px;
             height:<?echo $nscript[20] ?>px;
             padding:10px;
            }

</style>

<?php
 echo "<form action='http://".$_SERVER['SERVER_NAME']."/nscript/m.php' method='post'>";
  //Картинка
     if($nscript[16]==1)
       {
        if($nscript[18]=='left') @$imgpos='left';
        if($nscript[18]=='right') @$imgpos='right';
       }
    //Если заголовок над формой
     if($nscript[1]==0)
      {

        echo "<div id='nscr_headPar' >";
        if (@$imgpos=='left')echo "<img src='http://".$_SERVER['SERVER_NAME']."/nscript/admin/img/us$nscript[17].png'  border='0' align=absmiddle>&nbsp;";
        echo $nscript[0];
        if (@$imgpos=='right')echo "&nbsp;<img src='http://".$_SERVER['SERVER_NAME']."/nscript/admin/img/us$nscript[17].png'  border='0' align=absmiddle>";
        echo "</div>";

      }
     echo "<div id='nscr_userPar'>";
     //Если заголовок внутри формы
      if($nscript[1]==1)
      {
         echo "<div id='nscr_headPar' >";
        if (@$imgpos=='left')echo "<img src='http://".$_SERVER['SERVER_NAME']."/nscript/admin/img/us$nscript[17].png'  border='0' align=absmiddle>&nbsp;";
        echo $nscript[0];
        if (@$imgpos=='right')echo "&nbsp;<img src='http://".$_SERVER['SERVER_NAME']."/nscript/admin/img/us$nscript[17].png'  border='0' align=absmiddle>";
        echo "</div>";
      }

     //Подзаголовок
     echo "<div id='nscr_ollPar' >$nscript[2]</div>";
     //Форма
     echo "<input type='text' name='mail' size=$nscript[22]>&nbsp;
     <input type='submit' value=$nscript[21]>";
     echo "</div>";

     echo "</form>";

?>

</body>

</html>