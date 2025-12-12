<?php
include('cap.php');


//======================================================
if(@$_POST['GO'])
 {
  if(!file_exists("send/adr.txt"))
   {

  $f=fopen("send/count.txt","w+");
  fwrite($f,$_POST['count']."*".$_POST['min']);
  fclose($f);
  $f=fopen('config/mes.txt','w+');
  @$_POST['name_site']= trim(@$_POST['name_site']);
  fwrite($f,$_POST['name_site']."\r\n");

  @$_POST['sub_mes']=trim(@$_POST['sub_mes']);
  fwrite($f,@$_POST['sub_mes']."\r\n");
  fclose($f);

  $f=fopen('config/ps.txt','w+');
  @$_POST['ps']=trim(@$_POST['ps']);
  fwrite($f,@$_POST['ps']);
  fclose($f);

  //Рассылка=============================
 @$_POST['mes']=trim($_POST['mes']);
 if(($_POST['mes'])!="")
 {
  //Тема и сайт
  $subj=file('config/mes.txt');
  //адреса
  chdir("..");
  $arr=file('db/db.txt');
  chdir("admin");

   //Адреса в архив
      foreach(@$arr as $line)
        {
        	$expl=explode("*",$line);
        	$adr[]=$expl[0];

        }
  if(count(@$adr))
   {

    //Группы
      $group=file('config/group.txt');
      //Данные для письма
      @$subj[0]=trim($subj[0]);
      @$subj[1]=trim($subj[1]);
      @$_POST['ps']=trim(@$_POST['ps']);

       if(@$subj[0]!="")$adres=$subj[0];
       else $adres="Рассылка";

      if(@$subj[1]!="")$subject=$subj[1];
      else $subject="Новости сайта $adres";
       $subject1=$subject;
       if(@$_POST['ps']!="")@$p=@$_POST['ps'];
       else @$p="Администратор сайта $adres";
       $p1=$p;
       //Очистка от двойного перевода строки

       $_POST['mes']=str_replace("\r\n","\n",$_POST['mes']);
       @$_POST['ps']=str_replace("\r\n","\n",@$_POST['ps']);

       $message=$_POST['mes']."\r\n \r\n".$p;
       $message1=$_POST['mes'];
       $from=$_SERVER['SERVER_NAME'];
       $mes_unsub="----------------------------------------------------------
       Для того, чтобы отписаться от рассылки, перейдите по этой ссылке \r\n";
       $message=convert_cyr_string($message,"w","k");
       $subject=convert_cyr_string($subject,"w","k");
       $mes_unsub=convert_cyr_string($mes_unsub,"w","k");
       $adres=convert_cyr_string($adres,"w","k");
       $link="http://".$_SERVER['SERVER_NAME']."/nscript/unsubscr.php?";

       $limit=false;
     //Если установлено Для всех
      if(@$_POST['gr_oll'])
      {
        $f=fopen("mes/unsub.txt","w+");
        $i=0;
        foreach($adr as $line)
          {
            //Если лимит превышен: cохраняем все адреса в файле,
            //выходим. Затем  копируем образ
            //письма в папку с отсроченными письмами
            if($_POST['count']==$i )
              {              	$limit=true;
              	$f1=fopen("send/adr.txt","w+");
              	 foreach($adr as $line1)
              	   {              	   	 fwrite($f1,$line1."\r\n");
              	   }
                $f1=fopen("send/count_adr.txt","w+");
                fwrite($f1,$_POST['count']."*".time()."*"."0");
                fclose($f1);
              	break;
              }

            $id=rand(1000,9999);          	fwrite($f,$line."*".$id."\r\n");
          	$url="un=$line&id=$id";
            $adr_save[]=$line;            Mail($adr[$i], $subject, $message."\r\n".$mes_unsub.$link.$url,
            "From:$adres<site@site.ru>\r\n");
          	$i++;
          }

           $group1[0]="Для всех групп";
           $send=true;
           fclose($f);
      }

   //А иначе
    else
    {
    //Отделяем отмеченные группы
    if(count(@$_POST['gr'])!=0)
      {        $i=0;
        foreach($group as $line)
          {            if (@$_POST['gr'][$i])$group1[]=trim($line);
            $i++;
          }

        //Отделяем адреса отмеченных групп

        foreach($arr as $line)
         {         	$expl=explode("*",$line);
            if(in_array($expl[1],$group1 ))$adr_gr[]=$expl[0];
         }

        if(count(@$adr_gr)!=0)
        {
          $f=fopen("mes/unsub.txt","w+");
          $i=0;
          	  foreach($adr_gr as $line)
           	    {
           	        //Если лимит превышен: cохраняем все адреса в файле,
           	        //сохраняем количество отправленых писем
                    //выходим. Затем  копируем образ
                    //письма в папку с отсроченными письмами
                   if($_POST['count']==$i)
                    {
              	      $limit=true;
              	      $f1=fopen("send/adr.txt","w+");
              	      foreach($adr_gr as $line1)
              	       {
              	   	     fwrite($f1,$line1."\r\n");
              	       }
                      fclose($f1);
                        $f1=fopen("send/count_adr.txt","w+");
                        fwrite($f1,$_POST['count']."*".time()."*"."0");
                        fclose($f1);
              	      break;
                    }

           	        $adr_save[]=$line;
           	    	$id=rand(1000,9999);
          	        fwrite($f,$line."*".$id."\r\n");
                	$url="un=$line&id=$id";
                    Mail($adr_gr[$i], $subject, $message."\r\n".$mes_unsub.$link.$url,
                    "From:$adres<site@site.ru>\r\n");
          	        $i++;
           	    }
          $send=true;
          fclose($f);
        }


      }

     }
     //Сохраняем письмо
     if(@$send)
        {           $f=fopen("mes/".time(),"w+");
           fwrite($f,"Для групп"."/*/");
           foreach($group1 as $line)
             {             	fwrite($f,$line." ");
             }
            fwrite($f,"/*/");

            fwrite($f,"Для адресов"."/*/");

           foreach($adr_save as $line)
             {
             	fwrite($f,$line." ");
             }
           fwrite($f,"/*/");

           fwrite($f,"Тема"."/*/");
           fwrite($f,$subject1);

           fwrite($f,"/*/");
           fwrite($f,$message1);

           fwrite($f,"/*/");
           fwrite($f,$p1);
           if($limit)fwrite($f,"/*/"."0");
           else fwrite($f,"/*/"."@");
           fclose($f);

           if($limit)
            {               //Копируем
                 $f=fopen("send/mes.txt","w+");
                 fwrite($f,$subject1);
                 fwrite($f,"/*/");
                 fwrite($f,$message1);
                 fwrite($f,"/*/");
                 fwrite($f,$p1);
                 fclose($f);

            }

        }
   }
  }


  }
  else
   {   	echo "<script>alert('Вначале отправьте  всю почту')</script>";
   }
 }







//==================================================

if(@$_POST['send_but'])
   {
       //Определяем количество отправленных писем и время последней отправки
  	$f=fopen("send/count_adr.txt","r");
  	$r=fread($f,100);
  	fclose($f);
  	$conf=explode("*",$r);


         //Письмо
           $f=fopen("send/mes.txt","r");
  	       $m=fread($f,filesize("send/mes.txt"));
  	       fclose($f);
  	       $mes=explode("/*/",$m);
           $subject=$mes[0];
           $p=$mes[2];
           $message=$mes[1]."\r\n \r\n".$p;

           $from="Рассылка";
           $from=convert_cyr_string($from,"w","k");
           $mes_unsub="----------------------------------------------------------
           Для того, чтобы отписаться от рассылки, перейдите по этой ссылке \r\n";
           $message=convert_cyr_string($message,"w","k");
           $subject=convert_cyr_string($subject,"w","k");
           $mes_unsub=convert_cyr_string($mes_unsub,"w","k");
           $link="http://".$_SERVER['SERVER_NAME']."/nscript/unsubscr.php?";

         //Адреса
         $adr=file("send/adr.txt");
         $f=fopen("mes/unsub.txt","a");

         for($i=$conf[0],$n=0; $i!=count($adr); $i++,$n++)
          {

            $adr[$i]=trim($adr[$i]);
            $id=rand(1000,9999);
          	fwrite($f,$adr[$i]."*".$id."\r\n");
          	$url="un=$adr[$i]&id=$id";
            Mail($adr[$i], $subject, $message."\r\n".$mes_unsub.$link.$url,
            "From:$from<site@site.ru>\r\n");
            $adr_save[]=$adr[$i];

          }

          //Сохраняем письмо
           $f=fopen("mes/".time(),"w+");
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
           fwrite($f,"/*/".++$conf[2]);

           fclose($f);


        	//Значит все письма отправлены, удаляем настройки
            unlink("send/adr.txt");
            unlink("send/mes.txt");
            unlink("send/count_adr.txt");

   }


   if(@$_POST['del_send_but'])
     {     	 unlink("send/adr.txt");
         unlink("send/mes.txt");
         unlink("send/count_adr.txt");
     }

 $arr=file('config/mes.txt');

 if(filesize("config/ps.txt")!=0)
 {
 $f=fopen("config/ps.txt","r");
 $ps_txt=fread($f,filesize("config/ps.txt"));
 fclose($f);
 }

$f=fopen("send/count.txt","r");
$subcount=fread($f,1000);
fclose($f);
$explsub=explode("*",$subcount);

for ($i=0,$n=10; $i<10; $i++,$n+=10)
  {  	if ($explsub[0]==$n)$sel[$i]="selected";
  	else $sel[$i]="";

  	if ($explsub[1]==$n)$sel1[$i]="selected";
  	else $sel1[$i]="";
  }

?>


<CENTER><TABLE bgcolor=#EBEBEB width=80% CELLPADDING=7 CELLSPACING=0 border=0>
	<TR>
		<TD colspan=2><FONT COLOR="#408080" size=+1>Рассылка писем</FONT></td></tr>
<tr><td colspan=2>
Определите название сайта, тему и содержание письма, а так же допустимый объём рассылки.

 </td></tr>

<tr><td colspan=2>
        <?php

           //Проверяем, нет ли неотправленой почты
            if(file_exists("send/adr.txt"))
               {               	//Сколько осталость
               	$adr_count=file("send/adr.txt");
               	$f=fopen("send/count_adr.txt","r");
  	            $r=fread($f,100);
  	            fclose($f);
  	            $conf=explode("*",$r);
                $nadr=count($adr_count)-$conf[0];
               	echo "<form name='sendmail' action='admin4.php?sel5=selected' method='post'>
                      <font color=red>Внимание!</font> Согдасно выставленному лимиту не всем адресатам
                      отправлено сообщение. Осталось <b>$nadr</b> адресов <br>
                      Перед отправкой следующего сообщения, необходимо предыдущее разослать всем
                      адресатам.<br>Вы можете отправить письма по оставшимся адресам или отменить рассылку. <br><br>
                      <input type='submit' value='Отправить сейчас ' name='send_but'> &nbsp;&nbsp;
                      <input type='submit' value='Отменить рассылку' name='del_send_but'>

                      </form>";
               }


          ?>
        </td></tr>

<tr><td colspan=2>
<FORM ACTION="admin4.php?sel5=selected" METHOD="POST">
<b>Объём рассылки</b><br>
Рассылка писем-это нагрузка на сервер, к тому же у вашего хостера может быть лимит на
количество писем в единицу времени. Поэтому вы можете определить, сколько писем и с какой периодичностью
рассылать.<br>
Рекомендуется максимальная рассылка 100 писем за раз.<br>
Количество писем&nbsp;
<select size="1" name="count">


  <option value="20" <? echo $sel[1] ?>>20</option>
  <option value="30" <? echo $sel[2] ?>>30</option>
  <option value="40" <? echo $sel[3] ?>>40</option>
  <option value="50" <? echo $sel[4] ?>>50</option>
  <option value="60" <? echo $sel[5] ?>>60</option>
  <option value="70" <? echo $sel[6] ?>>70</option>
  <option value="80" <? echo $sel[7] ?>>80</option>
  <option value="90" <? echo $sel[8] ?>>90</option>
  <option value="100" <? echo $sel[9] ?>>100</option>


</select>&nbsp;&nbsp;&nbsp;&nbsp;
Периодичность в минутах&nbsp;
<select size="1" name="min">

  <option value="10" <? echo $sel1[0] ?>>10</option>
  <option value="20" <? echo $sel1[1] ?>>20</option>
  <option value="30" <? echo $sel1[2] ?>>30</option>
  <option value="40" <? echo $sel1[3] ?>>40</option>
  <option value="50" <? echo $sel1[4] ?>>50</option>
  <option value="60" <? echo $sel1[5] ?>>60</option>
  <option value="70" <? echo $sel1[6] ?>>70</option>
  <option value="80" <? echo $sel1[7] ?>>80</option>
  <option value="90" <? echo $sel1[8] ?>>90</option>
  <option value="100" <? echo $sel1[9] ?>>100</option>

</select>



 </td></tr>

 <TR>
		<TD colspan=2>


<b>Название сайта</b><br> Если оставить окошко пустым-
во всех сообщениях будет выводится <b>Рассылка</b><br>
<input name="name_site" type="text" size=50 value="<?php echo trim(@$arr[0]) ?>"><br><br>

<b>Тема письма</b><br> Если оставить окошко пустым, тема будет: "Новости сайта
 (название сайта или адрес)"<br>
<input name="sub_mes" type="text" size=50 value="<?php echo trim(@$arr[1]) ?>"><br><br>

<b>Подпись</b><br> Если оставить окошко пустым, подпись будет:<br>
"С уважением Администратор сайта
 (название сайта или адрес)"<br>
 Здесь можно написать что-нибудь вроде: На сегодня все новости исчерпаны.<br>
 ***************************************<br>
 Рассылку ведёт для вас<br>Вася Пупкин!!!<br>

 <textarea name="ps" rows=5 cols=70 ><?php echo @$ps_txt ?></textarea>


</td>

</tr>

<tr><td >
Сообщение<br>
 <textarea name="mes" rows=20 cols=70 ></textarea>
</td>
<td valign=top>
<b>Группы</b><br>
<input name='gr_oll' type='checkbox' value='ON' checked>Для всех<br>
<?php
 $group=file("config/group.txt");
 $i=0;
 foreach($group as $line)
  {
  	echo"<input name='gr[$i]' type='checkbox' value='ON'>$line<br>";
  	$i++;
  }
?>

</td>
</tr>
<tr><td colspan=2><INPUT TYPE="submit" VALUE="Отправить" name="GO">
</FORM>



</TD>

	</TR>
</TABLE></CENTER>

</BODY>
</HTML>