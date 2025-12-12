<?php
 include("cap.php");

 if(isset($_POST['go']))
   {
     $f=fopen("conf/res_view.txt","w");

     if($_POST['war_fon']=="") fwrite($f,"0*Фон оповещения*#ffffff\r\n");
     else fwrite($f,"0*Фон оповещения*".$_POST['war_fon']."\r\n");

     if($_POST['war_font_color']=="") fwrite($f,"1*Цвет шрифта оповещения*#000000\r\n");
     else fwrite($f,"1*Цвет шрифта оповещения*".$_POST['war_font_color']."\r\n");

     fwrite($f,"2*Размер шрифта оповещения*".$_POST['war_font_size']."\r\n");
     fwrite($f,"3*Начертание шрифта оповещения*".$_POST['war_font_type']."\r\n");
     fwrite($f,"4*Жирность шрифта оповещения*".$_POST['war_font_width']."\r\n");
     fwrite($f,"5*Название шрифта оповещения*".$_POST['war_font_name']."\r\n");

     if($_POST['res_fon']=="") fwrite($f,"6*Фон результатов*#ffffff\r\n");
     else fwrite($f,"6*Фон результатов*".$_POST['res_fon']."\r\n");

     if($_POST['res_font_color']=="") fwrite($f,"7*Цвет шрифта результатов*#000000\r\n");
     else fwrite($f,"7*Цвет шрифта результатов*".$_POST['res_font_color']."\r\n");

     fwrite($f,"8*Размер шрифта результатов*".$_POST['res_font_size']."\r\n");
     fwrite($f,"9*Начертание шрифта результатов*".$_POST['res_font_type']."\r\n");
     fwrite($f,"10*Жирность шрифта результатов*".$_POST['res_font_width']."\r\n");
     fwrite($f,"11*Название шрифта результатов*".$_POST['res_font_name']."\r\n");

     fwrite($f,"12*вывод графический или текстовый*".$_POST['view']."\r\n");
     fwrite($f,"13*вывод в отдельном окне*".$_POST['open']);
     fclose($f);
   }

  $config=file("conf/res_view.txt");
 $n=0;
 //Очищаем
 foreach($config as $line)
  {
 	$expl=explode("*", $line);
 	$conf1[$n]=trim($expl[2]);
 	$n++;
  }

$config=file("conf/sett_view.txt");
 $n=0;
 //Очищаем
 foreach($config as $line)
  {
 	$expl=explode("*", $line);
 	$conf[$n]=trim($expl[2]);
 	$n++;
  }
  //Шрифты-------------------------
//Оповещение
//Размер шрифта

for($i=10,$n=0; $i<22; $i+=2,$n++)
 {
   if($conf1[2]==$i) $sel_war_font_size[$n]="selected";
   else $sel_war_font_size[$n]="";

 }
 //Тип
 if($conf1[3]=="normal") $sel_war_font_type[0]="selected";
 if($conf1[3]=="italic") $sel_war_font_type[1]="selected";

 //Жирность
 for($i=100,$n=0; $i<800; $i+=100,$n++)
 {
   if($conf1[4]==$i) $sel_war_font_width[$n]="selected";
   else $sel_war_font_width[$n]="";
 }

//Название
if($conf1[5]=="Times New Roman, serif")$sel_war_font_name[0]="selected";
if($conf1[5]=="Arial, sans-serif")$sel_war_font_name[1]="selected";
if($conf1[5]=="Tahoma, sans-serif")$sel_war_font_name[2]="selected";
if($conf1[5]=="Verdana, sans-serif")$sel_war_font_name[3]="selected";
if($conf1[5]=="Courier New, monospace")$sel_war_font_name[4]="selected";
if($conf1[5]=="Calisto MT, cursive")$sel_war_font_name[5]="selected";
if($conf1[5]=="Broadway, fantasy")$sel_war_font_name[6]="selected";

//Результаты
//Размер шрифта
for($i=10,$n=0; $i<22; $i+=2,$n++)
 {
   if($conf1[8]==$i) $sel_res_font_size[$n]="selected";
   else $sel_res_font_size[$n]="";

 }
 //Тип
 if($conf1[9]=="normal") $sel_res_font_type[0]="selected";
 if($conf1[9]=="italic") $sel_res_font_type[1]="selected";

 //Жирность
 for($i=100,$n=0; $i<800; $i+=100,$n++)
 {
   if($conf1[10]==$i) $sel_res_font_width[$n]="selected";
   else $sel_res_font_width[$n]="";
 }

//Название
if($conf1[11]=="Times New Roman, serif")$sel_res_font_name[0]="selected";
if($conf1[11]=="Arial, sans-serif")$sel_res_font_name[1]="selected";
if($conf1[11]=="Tahoma, sans-serif")$sel_res_font_name[2]="selected";
if($conf1[11]=="Verdana, sans-serif")$sel_res_font_name[3]="selected";
if($conf1[11]=="Courier New, monospace")$sel_res_font_name[4]="selected";
if($conf1[11]=="Calisto MT, cursive")$sel_res_font_name[5]="selected";
if($conf1[11]=="Broadway, fantasy")$sel_res_font_name[6]="selected";

if($conf1[12]==1) $check_view[0]="checked";
if($conf1[12]==2) $check_view[1]="checked";

if($conf1[13]==1) $check_open[0]="checked";
if($conf1[13]==2) $check_open[1]="checked";
?>


<script language='JavaScript1.1' type='text/javascript'>
<!--
  function win1(par)
  {
    var obj=par;
    mainwin=window.open('rgb.html','',
   'Width=550, height=500,left=100,top=100,status=yes,toolbar=no,menubar=no,scrollbars=yes,resizable=yes');
  }
  function win(par)
  {
    var n=par;
    mainwin=window.open('/opr/view.php?id='+n+'','',
   'Width=550, height=500,left=100,top=100,status=yes,toolbar=no,menubar=no,scrollbars=yes,resizable=yes');
  }
//-->
</script>

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
   #head {

       font-family:<? echo $conf[18]?>;
       color:<?echo $conf[14]?>;
       font-size:<?echo $conf[15]?>pt;
       font-weight:<? echo $conf[17]?>;
       font-style:<? echo $conf[16]?>;
       padding:5px;
      }

   #name {

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
      {
      	background-color:<?echo $conf1[6]?>;
       font-family:<? echo $conf1[11]?>;
       color:<?echo $conf1[7]?>;
       font-size:<?echo $conf1[8]?>pt;
       font-weight:<? echo $conf1[10]?>;
       font-style:<? echo $conf1[9]?>;

      }
 </style>

<TABLE align=center bgcolor=#EBEBEB width=90% CELLPADDING=10 CELLSPACING=0 border=0>

<tr >
   <td colspan=2><FONT COLOR="#408080" size=+1>Внешний вид результатов</FONT><br>
   Оповещения выводяться, когда пользователь проголосовал. Если проголосовал впервые- выводится оповещение, что его голос
   защитан, если уже голосовал, выводится, что он уже учавствовал в опросе.</td>

</tr>
<tr >
   <td colspan=2>
<?php
  $file=file("db/sett.txt");
    if(count($file)==0)
      {
      	echo "<table id=none><tr><td>
      	     Опросов не создано!
      	</td></tr></table>";
      }
     else
     {
        echo "
      <form  action=admin5.php?sel5=selected method=post name=form_opr>

      <div id=blank_opr>
            <div id=head>$conf[0]</div>
               <div id=general>";
      if ($conf[42]==1) $css_but="";
           else $css_but="id=but_opr";

         $click="";

       $file[0]=trim($file[0]);
       $expl=explode("*",$file[0]);

             $res_index=file("db/$expl[0].txt");
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
                               {
                          	     $proc="$expl_proc[0].".substr($expl_proc[1],0,1);
                               }
                           }
                         else $proc=0;
                        echo "<td>($proc&nbsp;%)</td></tr>";
                     }
                      echo"<tr><td colspace=3>Всего&nbsp;$res_oll</td></tr>";

                }
              else
                {
                  //Набираем цвета
                  $color_oll=file("conf/color.txt");
                  $color=array();
                  foreach($color_oll as $line_color)
                    {
                      $line_color=trim($line_color);
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
                echo "</table><table><tr><td colspace=3><input type=button value=Назад name=back $css_but></td></tr>
                             </table>";
              echo "</div></div></form>";

     }
?>
</td>
</tr>
<tr >
   <td colspan=2><a href=# onclick=win1()>Таблица цветовых кодов</a>  </td>
</tr>
<FORM ACTION="admin5.php?sel5=selected" METHOD="POST">

<tr >
   <td colspan=2><b>Оповещения</b></td>
</tr>
<tr>
   <td  width=35% valign=top>Фон</td>
    <td>   <input name="war_fon" type="text"  size=10 value="<? echo @$conf1[0] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf1[0] ?> > тест
		</font></big></b><br><br>
    </td>
</tr>

<tr>
   <td  width=35% valign=top style=" border-bottom:1px solid #d0c9ad;">Шрифт.
     Цвет, размер в пунктах, начертание шрифта, жирность,
   название</td>
             <td style=" border-bottom:1px solid #d0c9ad;">
       <input name="war_font_color" type="text"  size=10 value="<? echo @$conf1[1] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf1[1]; ?> > тест
		</font></big></b>&nbsp;
		<SELECT NAME="war_font_size">
<OPTION value="10" <?  echo @$sel_war_font_size[0]; ?>>10</option>
<OPTION value="12" <?  echo @$sel_war_font_size[1]; ?>>12</option>
<OPTION value="14" <? echo @$sel_war_font_size[2]; ?>>14</option>
<OPTION value="16" <? echo @$sel_war_font_size[3]; ?>>16</option>
<OPTION value="18" <? echo @$sel_war_font_size[4]; ?>>18</option>
<OPTION value="20" <? echo @$sel_war_font_size[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt&nbsp;

<SELECT NAME="war_font_type">
<OPTION value="normal" <?  echo @$sel_war_font_type[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$sel_war_font_type[1]; ?> >Наклонный</option>
</SELECT>

<SELECT NAME="war_font_width">
<OPTION value="100" <?  echo @$sel_war_font_width[0]; ?> >100</option>
<OPTION value="200" <?  echo @$sel_war_font_width[1]; ?> >200</option>
<OPTION value="300" <?  echo @$sel_war_font_width[2]; ?> >300</option>
<OPTION value="400" <?  echo @$sel_war_font_width[3]; ?> >400</option>
<OPTION value="500" <?  echo @$sel_war_font_width[4]; ?> >500</option>
<OPTION value="600" <?  echo @$sel_war_font_width[5]; ?> >600</option>
<OPTION value="700" <?  echo @$sel_war_font_width[6]; ?> >700</option>
</SELECT>

<SELECT NAME="war_font_name">
<OPTION value="Times New Roman, serif" <?  echo @$sel_war_font_name[0]; ?> >Times New Roman</option>
<OPTION value="Arial, sans-serif" <?  echo @$sel_war_font_name[1]; ?> >Arial</option>
<OPTION value="Tahoma, sans-serif" <?  echo @$sel_war_font_name[2]; ?> >Tahoma</option>
<OPTION value="Verdana, sans-serif" <?  echo @$sel_war_font_name[3]; ?> >Verdana</option>
<OPTION value="Courier New, monospace" <?  echo @$sel_war_font_name[4]; ?> >Courier New</option>
<OPTION value="Calisto MT, cursive" <?  echo @$sel_war_font_name[5]; ?> >Calisto MT</option>
<OPTION value="Broadway, fantasy" <?  echo @$sel_war_font_name[6]; ?> >Broadway</option>

</SELECT>
   </td>



</tr>


<tr >
   <td colspan=2><b>Результаты</b></td>
</tr>
<tr>
   <td  width=35% valign=top>Фон</td>
    <td>   <input name="res_fon" type="text"  size=10 value="<? echo @$conf1[6] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf1[6] ?> > тест
		</font></big></b><br><br>
    </td>
</tr>

<tr>
   <td  width=35% valign=top>Шрифт.
     Цвет, размер в пунктах, начертание шрифта, жирность,
   название</td>
             <td >
       <input name="res_font_color" type="text"  size=10 value="<? echo @$conf1[7] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf1[7]; ?> > тест
		</font></big></b>&nbsp;
		<SELECT NAME="res_font_size">
<OPTION value="10" <?  echo @$sel_res_font_size[0]; ?>>10</option>
<OPTION value="12" <?  echo @$sel_res_font_size[1]; ?>>12</option>
<OPTION value="14" <? echo @$sel_res_font_size[2]; ?>>14</option>
<OPTION value="16" <? echo @$sel_res_font_size[3]; ?>>16</option>
<OPTION value="18" <? echo @$sel_res_font_size[4]; ?>>18</option>
<OPTION value="20" <? echo @$sel_res_font_size[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt&nbsp;

<SELECT NAME="res_font_type">
<OPTION value="normal" <?  echo @$sel_res_font_type[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$sel_res_font_type[1]; ?> >Наклонный</option>
</SELECT>

<SELECT NAME="res_font_width">
<OPTION value="100" <?  echo @$sel_res_font_width[0]; ?> >100</option>
<OPTION value="200" <?  echo @$sel_res_font_width[1]; ?> >200</option>
<OPTION value="300" <?  echo @$sel_res_font_width[2]; ?> >300</option>
<OPTION value="400" <?  echo @$sel_res_font_width[3]; ?> >400</option>
<OPTION value="500" <?  echo @$sel_res_font_width[4]; ?> >500</option>
<OPTION value="600" <?  echo @$sel_res_font_width[5]; ?> >600</option>
<OPTION value="700" <?  echo @$sel_res_font_width[6]; ?> >700</option>
</SELECT>

<SELECT NAME="res_font_name">
<OPTION value="Times New Roman, serif" <?  echo @$sel_res_font_name[0]; ?> >Times New Roman</option>
<OPTION value="Arial, sans-serif" <?  echo @$sel_res_font_name[1]; ?> >Arial</option>
<OPTION value="Tahoma, sans-serif" <?  echo @$sel_res_font_name[2]; ?> >Tahoma</option>
<OPTION value="Verdana, sans-serif" <?  echo @$sel_res_font_name[3]; ?> >Verdana</option>
<OPTION value="Courier New, monospace" <?  echo @$sel_res_font_name[4]; ?> >Courier New</option>
<OPTION value="Calisto MT, cursive" <?  echo @$sel_res_font_name[5]; ?> >Calisto MT</option>
<OPTION value="Broadway, fantasy" <?  echo @$sel_res_font_name[6]; ?> >Broadway</option>

</SELECT>
   </td>
</tr>

<tr>
   <td  width=35% valign=top>Вывод результатов опроса</td>
    <td>
    <input name="view" type="radio" value="1" <?  echo @$check_view[0]; ?>>&nbsp; Графический&nbsp;&nbsp;
    <input name="view" type="radio" value="2" <?  echo @$check_view[1]; ?>>&nbsp;Текстовый
    </td>
</tr>

<tr>
   <td  width=35% valign=top style=" border-bottom:1px solid #d0c9ad;">Где показывать результаты</td>
    <td style=" border-bottom:1px solid #d0c9ad;">
    <input name="open" type="radio" value="1" <?  echo @$check_open[0]; ?>>&nbsp;В блоке опроса &nbsp;&nbsp;
    <input name="open" type="radio" value="2" <?  echo @$check_open[1]; ?>>&nbsp;В отдельном окне
    </td>
</tr>

<tr >
   <td colspan=2><input type="submit" value="Сохранить" name=go></td>
</tr>

</form>
</table>

</body>

</html>