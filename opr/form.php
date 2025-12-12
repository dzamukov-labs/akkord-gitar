 <?php
 $info_opr="";
 //Обработка
 if(isset($_POST['opr_go']))
    {      //Активные опросы
      $file=file("opr/admin/db/sett.txt");
      $c=0;
   	   foreach($file as $line)
      {
       $line=trim($line);
       $expl=explode("*",$line);
       if($expl[3]==1)
         {         	if(isset($_POST['opr_go'][$c]) )break;
         	$c++;
         }
      }

      //Проверка на IP
      $ip=file("opr/admin/db/stat/$expl[0].txt");
      foreach($ip as $line)
       {         $line=trim($line);
         if($line==$_SERVER['REMOTE_ADDR'])
            {            	$info_opr="Вы уже голосовали";
            	break;
            }
       }

      //Если не голосовал
      if($info_opr=="")
         {           $f=fopen("opr/admin/db/stat/$expl[0].txt","a");
           fwrite($f,$_SERVER['REMOTE_ADDR']."\r\n");
           fclose($f);

           $file_opr=file("opr/admin/db/$expl[0].txt");
           $f=fopen("opr/admin/db/$expl[0].txt","w+");

           foreach($file_opr as $line)
             {             	$line=trim($line);
             	$expl_opr=explode("*",$line);
             	if(count($expl_opr)==2)
             	  {
             	    if($expl_opr[0]==$_POST['ask'][$c]) fwrite($f,$expl_opr[0]."*".++$expl_opr[1]."\r\n");
             	    else fwrite($f,$line."\r\n");
             	  }
             	else fwrite($f,++$line);

             }
           fclose($f);
           $info_opr="Спасибо, ваш голос принят.";

         }



    }

 $config=file("opr/admin/conf/sett_view.txt");
 $n=0;
 //Очищаем
 foreach($config as $line)
  {
 	$expl=explode("*", $line);
 	$conf[$n]=trim($expl[2]);
 	$n++;
  }

 $config=file("opr/admin/conf/res_view.txt");
 $n=0;
 //Очищаем
 foreach($config as $line)
  {
 	$expl=explode("*", $line);
 	$conf1[$n]=trim($expl[2]);
 	$n++;
  }
 $click="";

$file=file("opr/admin/db/sett.txt");

?>
 <style>

  #none {
       width:<?echo $conf[1]?>px;
       height:200px;
       background-color:#F3F3F3;
       border-style:solid;
       border-width:1px;
       border-color:#808080;
       text-align:center;
       text-valign:center;
      	font-size:10pt;
        font-family:"Times New Roman", "serif";
        color:#0080C0;
          }

  #info_opr {
       background-color:<?echo $conf1[0]?>;
       border-style:<?echo $conf[9]?>;
       border-width:<?echo $conf[8]?>px;
       border-color:<?echo $conf[7]?>;
       text-align:center;
       text-valign:center;
       height:150px;
       width:100%;
       font-family:<? echo $conf1[5]?>;
       color:<?echo $conf1[1]?>;
       font-size:<?echo $conf1[2]?>pt;
       font-weight:<? echo $conf1[4]?>;
       font-style:<? echo $conf1[3]?>;
       margin-bottom:5px;
       margin-top:5px;
          }

   #res_opr {
       background-color:<?echo $conf1[6]?>;
       border-style:<?echo $conf[9]?>;
       border-width:<?echo $conf[8]?>px;
       border-color:<?echo $conf[7]?>;
       text-align:left;
       width:100%;
       font-family:<? echo $conf1[11]?>;
       color:<?echo $conf1[7]?>;
       font-size:<?echo $conf1[8]?>pt;
       font-weight:<? echo $conf1[10]?>;
       font-style:<? echo $conf1[9]?>;
       margin-bottom:5px;
       margin-top:5px;
          }
  #blank_opr {
       width:<?echo $conf[1]?>px;

          }
   #general {
 	   background-color:<?echo $conf[2]?>;
       border-style:<?echo $conf[5]?>;
       border-width:<?echo $conf[4]?>px;
       border-color:<?echo $conf[3]?>;
       padding:10px;
       width:<?echo $conf[1]?>px;
       text-align:left;

      }
  #opr {
 	   background-color:<?echo $conf[6]?>;
       border-style:<?echo $conf[9]?>;
       border-width:<?echo $conf[8]?>px;
       border-color:<?echo $conf[7]?>;
       padding:10px;
       text-align:left;
       margin-bottom:5px;
       margin-top:5px;
      }

    #ask {
 	   background-color:<?echo $conf[10]?>;
       border-style:<?echo $conf[13]?>;
       border-width:<?echo $conf[12]?>px;
       border-color:<?echo $conf[11]?>;
       padding:1px;
       font-family:<? echo $conf[28]?>;
       color:<?echo $conf[24]?>;
       font-size:<?echo $conf[25]?>pt;
       font-weight:<? echo $conf[27]?>;
       font-style:<? echo $conf[26]?>;
       text-align:left;
       margin-bottom:5px;
       margin-top:5px;

      }
   #head_opr {

       font-family:<? echo $conf[18]?>;
       color:<?echo $conf[14]?>;
       font-size:<?echo $conf[15]?>pt;
       font-weight:<? echo $conf[17]?>;
       font-style:<? echo $conf[16]?>;
       padding:5px;
      }

   #name_opr {

       font-family:<? echo $conf[23]?>;
       color:<?echo $conf[19]?>;
       font-size:<?echo $conf[20]?>pt;
       font-weight:<? echo $conf[22]?>;
       font-style:<? echo $conf[21]?>;

      }
    #but_opr {
       background-color:<?echo $conf[30]?>;
       border-style:<?echo $conf[33]?>;
       border-width:<?echo $conf[32]?>px;
       border-color:<?echo $conf[31]?>;
       padding:1px;
       width:<?echo $conf[29]?>px;
       font-family:<? echo $conf[38]?>;
       color:<?echo $conf[34]?>;
       font-size:<?echo $conf[36]?>pt;
       font-weight:<? echo $conf[37]?>;
       font-style:<? echo $conf[35]?>;

      }
   #reduc
      {      	background-color:<?echo $conf1[6]?>;       font-family:<? echo $conf1[11]?>;
       color:<?echo $conf1[7]?>;
       font-size:<?echo $conf1[8]?>pt;
       font-weight:<? echo $conf1[10]?>;
       font-style:<? echo $conf1[9]?>;

      }
 </style>

<script language='JavaScript1.1' type='text/javascript'>
<!--
  function win(par)
  {
    var n=par;
    mainwin=window.open('/opr/view.php?id='+n+'','',
   'Width=550, height=500,left=100,top=100,status=yes,toolbar=no,menubar=no,scrollbars=yes,resizable=yes');
  }
//-->
</script>
<?php
$none=false;
$activ=false;
  $file=file("opr/admin/db/sett.txt");
  if(count($file)==0)
    {
        $none=true;
      	echo "<table id=none><tr><td>
      	     Опросов не создано!
      	</td></tr></table>";

    }
  //Активные опросы
   	   foreach($file as $line)
      {
       $line=trim($line);
       $expl=explode("*",$line);
       if($expl[3]==1)$activ=true;
      }

    if(!$activ && !$none)
    {

      	echo "<table id=none><tr><td>
      	     Активных опросов не создано!
      	     Активизируйте их в разделе Редактирование.
      	</td></tr></table>";

    }
 if($activ)
  {
      echo "<a name=p></a>
      <form  action=http://$_SERVER[SERVER_NAME]$_SERVER[PHP_SELF]#p method=post name=form_opr>
      <input name=opr_hidden type=hidden value=1>
      <div id=blank_opr>
            <div id=head_opr>$conf[0]</div>
               <div id=general>";
      if ($conf[42]==1) $css_but="";
           else $css_but="id=but_opr";
      $n=0;
      foreach($file as $line)
      {
       if($conf1[13]==2) $click="onclick=win(".$n.")";       $line=trim($line);
       $expl=explode("*",$line);
       if($expl[3]==0)continue;
       if(isset($_POST['opr_go'][$n])&& !isset($_POST['back']))
          {          	echo "<table id=info_opr><tr><td>
      	     $info_opr<br><br>

      	     <input type=submit value=Назад name=back $css_but>
      	     </td></tr></table>";
          }
           if(isset($_POST['res_go'][$n])&& !isset($_POST['back']))
          {
           if($conf1[13]==1)
           {
             $res_index=file("opr/admin/db/$expl[0].txt");
             $res_oll=$res_index[count($res_index)-1];
             echo"<table id=res_opr CELLPADDING=3 CELLSPACING=0 border=0>";
             //Если текстовый
             if($conf1[12]==2)
                {
                  for($i=0; $i< count($res_index)-1; $i++)
                      {
                     	$line=trim($res_index[$i]);
                        $res_expl=explode("*",$res_index[$i]);
                        echo"<tr><td>$res_expl[0]</td><td>$res_expl[1]</td>";
                         if($res_oll!=0)
                           {
                             $proc=$res_expl[1]*100/$res_oll;
                             $expl_proc=explode(".",$proc);
                             if(count($expl_proc)==2)
                               {                          	     $proc="$expl_proc[0].".substr($expl_proc[1],0,1);
                               }
                           }
                         else $proc=0;
                        echo "<td>($proc&nbsp;%)</td></tr>";
                     }                      echo"<tr><td colspace=3>Всего&nbsp;$res_oll</td></tr>";
                }
              else
                {
                  //Набираем цвета                  $color_oll=file("opr/admin/conf/color.txt");
                  $color=array();
                  foreach($color_oll as $line_color)
                    {                      $line_color=trim($line_color);
                      $expl_color=explode("*",$line_color);
                      $color[]=	$expl_color[0];
                    }
                   for($i=0,$col=0; $i< count($res_index)-1; $i++,$col++)
                      {
                     	$line=trim($res_index[$i]);
                        $res_expl=explode("*",$res_index[$i]);
                         if($res_oll!=0)
                           {
                             $proc=$res_expl[1]*100/$res_oll;
                             $expl_proc=explode(".",$proc);
                             if(count($expl_proc)==2)
                               {
                          	     $proc="$expl_proc[0].".substr($expl_proc[1],0,1);
                               }
                           }
                         else $proc=0;
                        echo"<tr><td>
                        <table width=$proc px height=7px bgcolor=$color[$col]>
                        <tr><td></td></tr></table>  </td>
                        <td>$res_expl[1]</td>";


                        echo "<td>($proc&nbsp;%)</td></tr>";
                       if($col==count($color)-1)$col=-1;
                     }
                  echo"<tr><td colspace=3>Всего&nbsp;$res_oll</td></tr></table>";

                   for($i=0,$col=0; $i< count($res_index)-1; $i++,$col++)
                      {
                     	$line=trim($res_index[$i]);
                        $res_expl=explode("*",$res_index[$i]);
                        echo"<table id=reduc CELLPADDING=2><tr><td>
                           <table width=8px height=8px bgcolor=$color[$col]>
                        <tr><td></td></tr></table>

                             </td><td>$res_expl[0]</td></tr>";


                        if($col==count($color)-1)$col=-1;
                     }
                }
                echo "</table><table><tr><td colspace=3><input type=submit value=Назад name=back $css_but></td></tr>
                             </table>";
           }
           else
            {              //Выводим опрос
               $name=$expl[2];
               $file=file("opr/admin/db/$expl[0].txt");
               echo "<div id=opr>
                     <div id=name_opr>$name</div><br>";
               for($i=0; $i<count($file)-1; $i++)
                 {
                   $expl_ask=explode("*",$file[$i]);
          	       echo "<div id=ask><input type=radio name=ask[$n] value='$expl_ask[0]' checked>&nbsp;$expl_ask[0]</div>";
                 }

              echo "<br><input type=submit value='$conf[39]' $css_but name=opr_go[$n]>&nbsp;";
              if ($conf[41]==2)echo "<br>";
              echo "<input type=submit value='$conf[40]' $css_but name=res_go[$n] $click>";

              echo "</div>";
            }

          }

          if((!isset($_POST['opr_go'][$n])&& !isset($_POST['res_go'][$n]))|| isset($_POST['back']))
          {           $name=$expl[2];
           $file=file("opr/admin/db/$expl[0].txt");
           echo "<div id=opr>
                     <div id=name_opr>$name</div><br>";
            for($i=0; $i<count($file)-1; $i++)
              {
                $expl_ask=explode("*",$file[$i]);
          	    echo "<div id=ask><input type=radio name=ask[$n] value='$expl_ask[0]' checked>&nbsp;$expl_ask[0]</div>";
              }

           echo "<br><input type=submit value='$conf[39]' $css_but name=opr_go[$n]>&nbsp;";
           if ($conf[41]==2)echo "<br>";
           echo "<input type=submit value='$conf[40]' $css_but name=res_go[$n] $click>";

           echo "</div>";
          }
       $n++;


      }

      echo "</div></div></form>";
 }

?>