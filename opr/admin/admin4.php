<?php
 include("cap.php");

 if(isset($_POST['go']))
   {     $f=fopen("conf/sett_view.txt","w");
     fwrite($f,"0*Заголовок*".$_POST['head']."\r\n");

     //Главный блок
     if($_POST['general_width']=="" || !is_numeric($_POST['general_width']) || $_POST['general_width'] < 100)
        fwrite($f,"1*Ширина главного блока*400\r\n");
     else
        fwrite($f,"1*Ширина главного блока*".$_POST['general_width']."\r\n");

     if($_POST['general_fon']=="") fwrite($f,"2*Фон главного блока*#ffffff\r\n");
     else fwrite($f,"2*Фон главного блока*".$_POST['general_fon']."\r\n");

      if($_POST['general_line_color']=="") fwrite($f,"3*Цвет рамки главного блока*#ffffff\r\n");
     else fwrite($f,"3*Цвет рамки главного блока*".$_POST['general_line_color']."\r\n");

     fwrite($f,"4*Ширина рамки главного блока*".$_POST['general_line_size']."\r\n");
     fwrite($f,"5*Тип рамки главного блока*".$_POST['general_line_type']."\r\n");

     //Блок для каждого опроса

     if($_POST['opr_fon']=="") fwrite($f,"6*Фон блока опроса*#ffffff\r\n");
     else fwrite($f,"6*Фон блока опроса*".$_POST['opr_fon']."\r\n");

     if($_POST['opr_line_color']=="") fwrite($f,"7*Цвет рамки блока опроса*#ffffff\r\n");
     else fwrite($f,"7*Цвет рамки блока опроса*".$_POST['opr_line_color']."\r\n");

     fwrite($f,"8*Ширина рамки блока опроса*".$_POST['opr_line_size']."\r\n");
     fwrite($f,"9*Тип рамки блока опроса*".$_POST['opr_line_type']."\r\n");

     //Блок для каждого вопроса

     if($_POST['ask_fon']=="") fwrite($f,"10*Фон блока вопроса*#ffffff\r\n");
     else fwrite($f,"10*Фон блока вопроса*".$_POST['ask_fon']."\r\n");

     if($_POST['ask_line_color']=="") fwrite($f,"11*Цвет рамки блока вопроса*#ffffff\r\n");
     else fwrite($f,"11*Цвет рамки блока вопроса*".$_POST['ask_line_color']."\r\n");

     fwrite($f,"12*Ширина рамки блока вопроса*".$_POST['ask_line_size']."\r\n");
     fwrite($f,"13*Тип рамки блока вопроса*".$_POST['ask_line_type']."\r\n");

     //Шрифты
     if($_POST['head_font_color']=="") fwrite($f,"14*Цвет шрифта заголовка*#000000\r\n");
     else fwrite($f,"14*Цвет шрифта заголовка*".$_POST['head_font_color']."\r\n");

     fwrite($f,"15*Размер шрифта заголовка*".$_POST['head_font_size']."\r\n");
     fwrite($f,"16*Начертание шрифта заголовка*".$_POST['head_font_type']."\r\n");
     fwrite($f,"17*Жирность шрифта заголовка*".$_POST['head_font_width']."\r\n");
     fwrite($f,"18*Название шрифта заголовка*".$_POST['head_font_name']."\r\n");

     if($_POST['opr_font_color']=="") fwrite($f,"19*Цвет шрифта названия опроса*#000000\r\n");
     else fwrite($f,"19*Цвет шрифта названия опроса*".$_POST['opr_font_color']."\r\n");

     fwrite($f,"20*Размер шрифта названия опроса*".$_POST['opr_font_size']."\r\n");
     fwrite($f,"21*Начертание шрифта названия опроса*".$_POST['opr_font_type']."\r\n");
     fwrite($f,"22*Жирность шрифта названия опроса*".$_POST['opr_font_width']."\r\n");
     fwrite($f,"23*Название шрифта названия опроса*".$_POST['opr_font_name']."\r\n");

     if($_POST['ask_font_color']=="") fwrite($f,"24*Цвет шрифта названия вопроса*#000000\r\n");
     else fwrite($f,"24*Цвет шрифта названия вопроса*".$_POST['ask_font_color']."\r\n");

     fwrite($f,"25*Размер шрифта названия вопроса*".$_POST['ask_font_size']."\r\n");
     fwrite($f,"26*Начертание шрифта названия вопроса*".$_POST['ask_font_type']."\r\n");
     fwrite($f,"27*Жирность шрифта названия вопроса*".$_POST['ask_font_width']."\r\n");
     fwrite($f,"28*Название шрифта названия вопроса*".$_POST['ask_font_name']."\r\n");

     //Кнопки
      if($_POST['but_size']=="" || !is_numeric($_POST['but_size']) || $_POST['but_size']< 20)
            fwrite($f,"29*Ширина кнопки*80\r\n");
      else  fwrite($f,"29*Ширина кнопки*".$_POST['but_size']."\r\n");

     if($_POST['but_color']=="") fwrite($f,"30*Цвет кнопки*#808080\r\n");
     else fwrite($f,"30*Цвет кнопки*".$_POST['but_color']."\r\n");

      if($_POST['but_line_color']=="") fwrite($f,"31*Цвет рамки кнопки*#ffffff\r\n");
     else fwrite($f,"31*Цвет рамки кнопки*".$_POST['but_line_color']."\r\n");

     fwrite($f,"32*Ширина рамки кнопки*".$_POST['but_line_size']."\r\n");
     fwrite($f,"33*Тип рамки кнопки*".$_POST['but_line_type']."\r\n");


      if($_POST['but_font_color']=="") fwrite($f,"34*Цвет шрифта кнопки*#000000\r\n");
     else fwrite($f,"34*Цвет шрифта кнопки*".$_POST['but_font_color']."\r\n");

     fwrite($f,"35*Размер шрифта кнопки*".$_POST['but_font_size']."\r\n");
     fwrite($f,"36*Начертание шрифта кнопки*".$_POST['but_font_type']."\r\n");
     fwrite($f,"37*Жирность шрифта кнопки*".$_POST['but_font_width']."\r\n");
     fwrite($f,"38*Название шрифта кнопки*".$_POST['but_font_name']."\r\n");

     if($_POST['but_text1']=="") fwrite($f,"39*Надпись на кнопке голосования*Голосовать\r\n");
     else fwrite($f,"39*Надпись на кнопке голосования*".$_POST['but_text1']."\r\n");

     if($_POST['but_text2']=="") fwrite($f,"40*Надпись на кнопке результатов*Результаты\r\n");
     else fwrite($f,"40*Надпись на кнопке результатов*".$_POST['but_text2']."\r\n");

     fwrite($f,"41*Расположение кнопок*".$_POST['but_align']."\r\n");

     if(isset($_POST['css']))fwrite($f,"40*CSS*1");
     else fwrite($f,"42*CSS*0");
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


  //===Заполняем===================================

  //Рамка главного блока
  //Тип рамки
if($conf[5]=="none")$sel_general_line_type[0]="selected";
if($conf[5]=="dotted")$sel_general_line_type[1]="selected";
if($conf[5]=="dashed")$sel_general_line_type[2]="selected";
if($conf[5]=="solid")$sel_general_line_type[3]="selected";
if($conf[5]=="double")$sel_general_line_type[4]="selected";

//Ширина рамки
for($i=0; $i<6; $i++)
 {
   if($conf[4]==$i) $sel_general_line_size[$i]="selected";
   else $sel_general_line_size[$i]="";
 }

 //Рамка опроса
  //Тип рамки
if($conf[9]=="none")$sel_opr_line_type[0]="selected";
if($conf[9]=="dotted")$sel_opr_line_type[1]="selected";
if($conf[9]=="dashed")$sel_opr_line_type[2]="selected";
if($conf[9]=="solid")$sel_opr_line_type[3]="selected";
if($conf[9]=="double")$sel_opr_line_type[4]="selected";

//Ширина рамки
for($i=0; $i<6; $i++)
 {
   if($conf[8]==$i) $sel_opr_line_size[$i]="selected";
   else $sel_opr_line_size[$i]="";
 }

 //Рамка вопроса
  //Тип рамки
if($conf[13]=="none")$sel_ask_line_type[0]="selected";
if($conf[13]=="dotted")$sel_ask_line_type[1]="selected";
if($conf[13]=="dashed")$sel_ask_line_type[2]="selected";
if($conf[13]=="solid")$sel_ask_line_type[3]="selected";
if($conf[13]=="double")$sel_ask_line_type[4]="selected";

//Ширина рамки
for($i=0; $i<6; $i++)
 {
   if($conf[12]==$i) $sel_ask_line_size[$i]="selected";
   else $sel_ask_line_size[$i]="";
 }


//Шрифты-------------------------
//Заголовок
//Размер шрифта

for($i=10,$n=0; $i<22; $i+=2,$n++)
 {
   if($conf[15]==$i) $sel_head_font_size[$n]="selected";
   else $sel_head_font_size[$n]="";

 }
 //Тип
 if($conf[16]=="normal") $sel_head_font_type[0]="selected";
 if($conf[16]=="italic") $sel_head_font_type[1]="selected";

 //Жирность
 for($i=100,$n=0; $i<800; $i+=100,$n++)
 {
   if($conf[17]==$i) $sel_head_font_width[$n]="selected";
   else $sel_head_font_width[$n]="";
 }

//Название
if($conf[18]=="Times New Roman, serif")$sel_head_font_name[0]="selected";
if($conf[18]=="Arial, sans-serif")$sel_head_font_name[1]="selected";
if($conf[18]=="Tahoma, sans-serif")$sel_head_font_name[2]="selected";
if($conf[18]=="Verdana, sans-serif")$sel_head_font_name[3]="selected";
if($conf[18]=="Courier New, monospace")$sel_head_font_name[4]="selected";
if($conf[18]=="Calisto MT, cursive")$sel_head_font_name[5]="selected";
if($conf[18]=="Broadway, fantasy")$sel_head_font_name[6]="selected";


//Опрос
//Размер шрифта

for($i=10,$n=0; $i<22; $i+=2,$n++)
 {
   if($conf[20]==$i) $sel_opr_font_size[$n]="selected";
   else $sel_opr_font_size[$n]="";

 }
 //Тип
 if($conf[21]=="normal") $sel_opr_font_type[0]="selected";
 if($conf[21]=="italic") $sel_opr_font_type[1]="selected";

 //Жирность
 for($i=100,$n=0; $i<800; $i+=100,$n++)
 {
   if($conf[22]==$i) $sel_opr_font_width[$n]="selected";
   else $sel_opr_font_width[$n]="";
 }

//Название
if($conf[23]=="Times New Roman, serif")$sel_opr_font_name[0]="selected";
if($conf[23]=="Arial, sans-serif")$sel_opr_font_name[1]="selected";
if($conf[23]=="Tahoma, sans-serif")$sel_opr_font_name[2]="selected";
if($conf[23]=="Verdana, sans-serif")$sel_opr_font_name[3]="selected";
if($conf[23]=="Courier New, monospace")$sel_opr_font_name[4]="selected";
if($conf[23]=="Calisto MT, cursive")$sel_opr_font_name[5]="selected";
if($conf[23]=="Broadway, fantasy")$sel_opr_font_name[6]="selected";


//Вопрос
//Размер шрифта

for($i=10,$n=0; $i<22; $i+=2,$n++)
 {
   if($conf[25]==$i) $sel_ask_font_size[$n]="selected";
   else $sel_ask_font_size[$n]="";

 }
 //Тип
 if($conf[26]=="normal") $sel_ask_font_type[0]="selected";
 if($conf[26]=="italic") $sel_ask_font_type[1]="selected";

 //Жирность
 for($i=100,$n=0; $i<800; $i+=100,$n++)
 {
   if($conf[27]==$i) $sel_ask_font_width[$n]="selected";
   else $sel_ask_font_width[$n]="";
 }

//Название
if($conf[28]=="Times New Roman, serif")$sel_ask_font_name[0]="selected";
if($conf[28]=="Arial, sans-serif")$sel_ask_font_name[1]="selected";
if($conf[28]=="Tahoma, sans-serif")$sel_ask_font_name[2]="selected";
if($conf[28]=="Verdana, sans-serif")$sel_ask_font_name[3]="selected";
if($conf[28]=="Courier New, monospace")$sel_ask_font_name[4]="selected";
if($conf[28]=="Calisto MT, cursive")$sel_ask_font_name[5]="selected";
if($conf[28]=="Broadway, fantasy")$sel_ask_font_name[6]="selected";


//Кнопки==========================================
  //Тип рамки
if($conf[33]=="none")$sel_but_line_type[0]="selected";
if($conf[33]=="dotted")$sel_but_line_type[1]="selected";
if($conf[33]=="dashed")$sel_but_line_type[2]="selected";
if($conf[33]=="solid")$sel_but_line_type[3]="selected";
if($conf[33]=="double")$sel_but_line_type[4]="selected";

//Ширина рамки
for($i=0; $i<6; $i++)
 {
   if($conf[32]==$i) $sel_but_line_size[$i]="selected";
   else $sel_but_line_size[$i]="";
 }

//Шрифт
//Размер шрифта

for($i=10,$n=0; $i<22; $i+=2,$n++)
 {
   if($conf[35]==$i) $sel_but_font_size[$n]="selected";
   else $sel_but_font_size[$n]="";

 }
 //Тип
 if($conf[36]=="normal") $sel_but_font_type[0]="selected";
 if($conf[36]=="italic") $sel_but_font_type[1]="selected";

 //Жирность
 for($i=100,$n=0; $i<800; $i+=100,$n++)
 {
   if($conf[37]==$i) $sel_but_font_width[$n]="selected";
   else $sel_but_font_width[$n]="";
 }

//Название
if($conf[38]=="Times New Roman, serif")$sel_but_font_name[0]="selected";
if($conf[38]=="Arial, sans-serif")$sel_but_font_name[1]="selected";
if($conf[38]=="Tahoma, sans-serif")$sel_but_font_name[2]="selected";
if($conf[38]=="Verdana, sans-serif")$sel_but_font_name[3]="selected";
if($conf[38]=="Courier New, monospace")$sel_but_font_name[4]="selected";
if($conf[38]=="Calisto MT, cursive")$sel_but_font_name[5]="selected";
if($conf[38]=="Broadway, fantasy")$sel_but_font_name[6]="selected";

//Расположение
if($conf[41]==1)$check_but_align[0]="checked";
if($conf[41]==2)$check_but_align[1]="checked";

//CSS
if($conf[42]==1)$check_css="checked";

?>
<script language='JavaScript1.1' type='text/javascript'>
<!--
  function win(par)
  {
    var obj=par;
    mainwin=window.open('rgb.html','',
   'Width=550, height=500,left=100,top=100,status=yes,toolbar=no,menubar=no,scrollbars=yes,resizable=yes');
  }
//-->
</script>
 <style>

  #none {
       width:200px;
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

  #blank {
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

       bot-margin:10px;
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
       margin-bottom:2px;

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
    #but {
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
 </style>

<TABLE align=center bgcolor=#EBEBEB width=90% CELLPADDING=10 CELLSPACING=0 border=0>

<tr >
   <td colspan=2><FONT COLOR="#408080" size=+1>Внешний вид опросов</FONT></td>

</tr>

<tr >
   <td colspan=2>
   <?php
    $file=file("db/sett.txt");
    if(count($file)==0)
      {      	echo "<table id=none><tr><td>
      	     Опросов не создано!
      	</td></tr></table>";
      }
     else
     {       $expl=explode("*",$file[0]);
       $name=$expl[2];
       $file=file("db/$expl[0].txt");

       echo "<div id=blank>
            <div id=head>$conf[0]</div>
               <div id=general>


                  <div id=opr>
                     <div id=name>$name</div><br>";
        for($i=0; $i<count($file)-1; $i++)
          {
            $expl_ask=explode("*",$file[$i]);          	echo "<div id=ask><input type=radio name=ask checked>&nbsp;$expl_ask[0]</div>";
          }

       if ($conf[42]==1) $css_but="";
       else $css_but="id=but";
       echo "<br><input type=button value='$conf[39]' $css_but>&nbsp;";
       if ($conf[41]==2)echo "<br>";
       echo "<input type=button value='$conf[40]' $css_but>";

       echo "</div>

       </div></div>";


     }


    ?>



   </td>

</tr>

<tr >
   <td colspan=2><a href=# onclick=win()>Таблица цветовых кодов</a>  </td>

</tr>

<FORM ACTION="admin4.php?sel4=selected" METHOD="POST">

<tr >
   <td style=" border-bottom:1px solid #d0c9ad;"><b>Общий заголовок</b><br>
   Можно оставить пустым </td>
   <td style=" border-bottom:1px solid #d0c9ad;">
   <input name="head" type="text" value="<? echo @$conf[0] ?>" size=60> </td>

</tr>

<tr >
   <td colspan=2><b>Главный блок
   общий для всех опросов</b></td>
</tr>

<tr>
   <td  width=35% valign=top>Ширина в px </td>
    <td>   <input name="general_width" type="text"  size=10 value="<? echo @$conf[1] ?>">

    </td>
</tr>

<tr>
   <td  width=35% valign=top>Фон </td>
    <td>   <input name="general_fon" type="text"  size=10 value="<? echo @$conf[2] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[2] ?> > тест
		</font></big></b>
    </td>
</tr>

<tr>
   <td style=" border-bottom:1px solid #d0c9ad;">Цвет ширина и тип рамки</td>
   <td style=" border-bottom:1px solid #d0c9ad;">
         <INPUT TYPE="text" NAME="general_line_color" SIZE="10"  VALUE="<? echo @$conf[3] ?>">
         &nbsp;<font color="<? echo @$conf[3]; ?>">&nbsp;&nbsp;<b>тест</b></font>&nbsp;&nbsp;&nbsp;

         &nbsp;&nbsp;&nbsp;<select  name="general_line_size">
           <option value="0" <? echo @$sel_general_line_size[0] ?> >0</option>
           <option value="1" <? echo @$sel_general_line_size[1] ?> >1</option>
           <option value="2" <? echo @$sel_general_line_size[2] ?> >2</option>
           <option value="3" <? echo @$sel_general_line_size[3] ?> >3</option>
           <option value="4" <? echo @$sel_general_line_size[4] ?> >4</option>
           <option value="5" <? echo @$sel_general_line_size[5] ?> >5</option>
        </select>&nbsp;px&nbsp;&nbsp;&nbsp;
        <SELECT NAME="general_line_type">
<OPTION value="none" <?  echo @$sel_general_line_type[0]; ?>>Нет</option>
<OPTION value="dotted" <?  echo @$sel_general_line_type[1]; ?>>Точки</option>
<OPTION value="dashed" <? echo @$sel_general_line_type[2]; ?>>Пунктир</option>
<OPTION value="solid" <? echo @$sel_general_line_type[3]; ?>>Сплошная</option>
<OPTION value="double" <? echo @$sel_general_line_type[4]; ?>>Двойная</option>
</SELECT>

        </td>
</tr>

<tr >
   <td colspan=2><b>Блок для каждого опроса</b></td>
</tr>

<tr>
   <td  width=35% valign=top>Фон </td>
    <td>   <input name="opr_fon" type="text"  size=10 value="<? echo @$conf[6] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[6] ?> > тест
		</font></big></b>
    </td>
</tr>

<tr>
   <td style=" border-bottom:1px solid #d0c9ad;">Цвет ширина и тип рамки</td>
   <td style=" border-bottom:1px solid #d0c9ad;">
         <INPUT TYPE="text" NAME="opr_line_color" SIZE="10"  VALUE="<? echo @$conf[7] ?>">
         &nbsp;<font color="<? echo @$conf[7]; ?>">&nbsp;&nbsp;<b>тест</b></font>&nbsp;&nbsp;&nbsp;

         &nbsp;&nbsp;&nbsp;<select  name="opr_line_size">
           <option value="0" <? echo @$sel_opr_line_size[0] ?> >0</option>
           <option value="1" <? echo @$sel_opr_line_size[1] ?> >1</option>
           <option value="2" <? echo @$sel_opr_line_size[2] ?> >2</option>
           <option value="3" <? echo @$sel_opr_line_size[3] ?> >3</option>
           <option value="4" <? echo @$sel_opr_line_size[4] ?> >4</option>
           <option value="5" <? echo @$sel_opr_line_size[5] ?> >5</option>
        </select>&nbsp;px&nbsp;&nbsp;&nbsp;
        <SELECT NAME="opr_line_type">
<OPTION value="none" <?  echo @$sel_opr_line_type[0]; ?>>Нет</option>
<OPTION value="dotted" <?  echo @$sel_opr_line_type[1]; ?>>Точки</option>
<OPTION value="dashed" <? echo @$sel_opr_line_type[2]; ?>>Пунктир</option>
<OPTION value="solid" <? echo @$sel_opr_line_type[3]; ?>>Сплошная</option>
<OPTION value="double" <? echo @$sel_opr_line_type[4]; ?>>Двойная</option>
</SELECT>

        </td>
</tr>



<tr >
   <td colspan=2><b>Блок для каждого вопроса</b></td>
</tr>

<tr>
   <td  width=35% valign=top>Фон </td>
    <td>   <input name="ask_fon" type="text"  size=10 value="<? echo @$conf[10] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[10] ?> > тест
		</font></big></b>
    </td>
</tr>

<tr>
   <td style=" border-bottom:1px solid #d0c9ad;">Цвет ширина и тип рамки</td>
   <td style=" border-bottom:1px solid #d0c9ad;">

         <INPUT TYPE="text" NAME="ask_line_color" SIZE="10"  VALUE="<? echo @$conf[11] ?>">
         &nbsp;<font color="<? echo @$conf[11]; ?>">&nbsp;&nbsp;<b>тест</b></font>&nbsp;&nbsp;&nbsp;

         &nbsp;&nbsp;&nbsp;<select  name="ask_line_size">
           <option value="0" <? echo @$sel_ask_line_size[0] ?> >0</option>
           <option value="1" <? echo @$sel_ask_line_size[1] ?> >1</option>
           <option value="2" <? echo @$sel_ask_line_size[2] ?> >2</option>
           <option value="3" <? echo @$sel_ask_line_size[3] ?> >3</option>
           <option value="4" <? echo @$sel_ask_line_size[4] ?> >4</option>
           <option value="5" <? echo @$sel_ask_line_size[5] ?> >5</option>
        </select>&nbsp;px&nbsp;&nbsp;&nbsp;
        <SELECT NAME="ask_line_type">
<OPTION value="none" <?  echo @$sel_ask_line_type[0]; ?>>Нет</option>
<OPTION value="dotted" <?  echo @$sel_ask_line_type[1]; ?>>Точки</option>
<OPTION value="dashed" <? echo @$sel_ask_line_type[2]; ?>>Пунктир</option>
<OPTION value="solid" <? echo @$sel_ask_line_type[3]; ?>>Сплошная</option>
<OPTION value="double" <? echo @$sel_ask_line_type[4]; ?>>Двойная</option>
</SELECT>

        </td>
</tr>

<tr >
   <td colspan=2><b>Шрифты</b></td>

</tr>

<tr >
   <td>Общий заголовок<br>
   Цвет, размер в пунктах, начертание шрифта, жирность,
   название
   </td>
   <td>
       <input name="head_font_color" type="text"  size=10 value="<? echo @$conf[14] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[14]; ?> > тест
		</font></big></b>&nbsp;
		<SELECT NAME="head_font_size">
<OPTION value="10" <?  echo @$sel_head_font_size[0]; ?>>10</option>
<OPTION value="12" <?  echo @$sel_head_font_size[1]; ?>>12</option>
<OPTION value="14" <? echo @$sel_head_font_size[2]; ?>>14</option>
<OPTION value="16" <? echo @$sel_head_font_size[3]; ?>>16</option>
<OPTION value="18" <? echo @$sel_head_font_size[4]; ?>>18</option>
<OPTION value="20" <? echo @$sel_head_font_size[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt&nbsp;

<SELECT NAME="head_font_type">
<OPTION value="normal" <?  echo @$sel_head_font_type[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$sel_head_font_type[1]; ?> >Наклонный</option>
</SELECT>

<SELECT NAME="head_font_width">
<OPTION value="100" <?  echo @$sel_head_font_width[0]; ?> >100</option>
<OPTION value="200" <?  echo @$sel_head_font_width[1]; ?> >200</option>
<OPTION value="300" <?  echo @$sel_head_font_width[2]; ?> >300</option>
<OPTION value="400" <?  echo @$sel_head_font_width[3]; ?> >400</option>
<OPTION value="500" <?  echo @$sel_head_font_width[4]; ?> >500</option>
<OPTION value="600" <?  echo @$sel_head_font_width[5]; ?> >600</option>
<OPTION value="700" <?  echo @$sel_head_font_width[6]; ?> >700</option>
</SELECT>

<SELECT NAME="head_font_name">
<OPTION value="Times New Roman, serif" <?  echo @$sel_head_font_name[0]; ?> >Times New Roman</option>
<OPTION value="Arial, sans-serif" <?  echo @$sel_head_font_name[1]; ?> >Arial</option>
<OPTION value="Tahoma, sans-serif" <?  echo @$sel_head_font_name[2]; ?> >Tahoma</option>
<OPTION value="Verdana, sans-serif" <?  echo @$sel_head_font_name[3]; ?> >Verdana</option>
<OPTION value="Courier New, monospace" <?  echo @$sel_head_font_name[4]; ?> >Courier New</option>
<OPTION value="Calisto MT, cursive" <?  echo @$sel_head_font_name[5]; ?> >Calisto MT</option>
<OPTION value="Broadway, fantasy" <?  echo @$sel_head_font_name[6]; ?> >Broadway</option>

</SELECT>
   </td>

</tr>


<tr >
   <td>Название опроса<br>
   Цвет, размер в пунктах, начертание шрифта, жирность,
   название
   </td>
   <td>
       <input name="opr_font_color" type="text"  size=10 value="<? echo @$conf[19] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[19]; ?> > тест
		</font></big></b>&nbsp;
		<SELECT NAME="opr_font_size">
<OPTION value="10" <?  echo @$sel_opr_font_size[0]; ?>>10</option>
<OPTION value="12" <?  echo @$sel_opr_font_size[1]; ?>>12</option>
<OPTION value="14" <? echo @$sel_opr_font_size[2]; ?>>14</option>
<OPTION value="16" <? echo @$sel_opr_font_size[3]; ?>>16</option>
<OPTION value="18" <? echo @$sel_opr_font_size[4]; ?>>18</option>
<OPTION value="20" <? echo @$sel_opr_font_size[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt&nbsp;

<SELECT NAME="opr_font_type">
<OPTION value="normal" <?  echo @$sel_opr_font_type[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$sel_opr_font_type[1]; ?> >Наклонный</option>
</SELECT>

<SELECT NAME="opr_font_width">
<OPTION value="100" <?  echo @$sel_opr_font_width[0]; ?> >100</option>
<OPTION value="200" <?  echo @$sel_opr_font_width[1]; ?> >200</option>
<OPTION value="300" <?  echo @$sel_opr_font_width[2]; ?> >300</option>
<OPTION value="400" <?  echo @$sel_opr_font_width[3]; ?> >400</option>
<OPTION value="500" <?  echo @$sel_opr_font_width[4]; ?> >500</option>
<OPTION value="600" <?  echo @$sel_opr_font_width[5]; ?> >600</option>
<OPTION value="700" <?  echo @$sel_opr_font_width[6]; ?> >700</option>
</SELECT>

<SELECT NAME="opr_font_name">
<OPTION value="Times New Roman, serif" <?  echo @$sel_opr_font_name[0]; ?> >Times New Roman</option>
<OPTION value="Arial, sans-serif" <?  echo @$sel_opr_font_name[1]; ?> >Arial</option>
<OPTION value="Tahoma, sans-serif" <?  echo @$sel_opr_font_name[2]; ?> >Tahoma</option>
<OPTION value="Verdana, sans-serif" <?  echo @$sel_opr_font_name[3]; ?> >Verdana</option>
<OPTION value="Courier New, monospace" <?  echo @$sel_opr_font_name[4]; ?> >Courier New</option>
<OPTION value="Calisto MT, cursive" <?  echo @$sel_opr_font_name[5]; ?> >Calisto MT</option>
<OPTION value="Broadway, fantasy" <?  echo @$sel_opr_font_name[6]; ?> >Broadway</option>
</SELECT>
   </td>
   </tr>

<tr >
   <td style=" border-bottom:1px solid #d0c9ad;">Название вопроса<br>
   Цвет, размер в пунктах, начертание шрифта, жирность,
   название
   </td>
   <td style=" border-bottom:1px solid #d0c9ad;">
       <input name="ask_font_color" type="text"  size=10 value="<? echo @$conf[24] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[24]; ?> > тест
		</font></big></b>&nbsp;
		<SELECT NAME="ask_font_size">
<OPTION value="10" <?  echo @$sel_ask_font_size[0]; ?>>10</option>
<OPTION value="12" <?  echo @$sel_ask_font_size[1]; ?>>12</option>
<OPTION value="14" <? echo @$sel_ask_font_size[2]; ?>>14</option>
<OPTION value="16" <? echo @$sel_ask_font_size[3]; ?>>16</option>
<OPTION value="18" <? echo @$sel_ask_font_size[4]; ?>>18</option>
<OPTION value="20" <? echo @$sel_ask_font_size[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt&nbsp;

<SELECT NAME="ask_font_type">
<OPTION value="normal" <?  echo @$sel_ask_font_type[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$sel_ask_font_type[1]; ?> >Наклонный</option>
</SELECT>

<SELECT NAME="ask_font_width">
<OPTION value="100" <?  echo @$sel_ask_font_width[0]; ?> >100</option>
<OPTION value="200" <?  echo @$sel_ask_font_width[1]; ?> >200</option>
<OPTION value="300" <?  echo @$sel_ask_font_width[2]; ?> >300</option>
<OPTION value="400" <?  echo @$sel_ask_font_width[3]; ?> >400</option>
<OPTION value="500" <?  echo @$sel_ask_font_width[4]; ?> >500</option>
<OPTION value="600" <?  echo @$sel_ask_font_width[5]; ?> >600</option>
<OPTION value="700" <?  echo @$sel_ask_font_width[6]; ?> >700</option>
</SELECT>

<SELECT NAME="ask_font_name">
<OPTION value="Times New Roman, serif" <?  echo @$sel_ask_font_name[0]; ?> >Times New Roman</option>
<OPTION value="Arial, sans-serif" <?  echo @$sel_ask_font_name[1]; ?> >Arial</option>
<OPTION value="Tahoma, sans-serif" <?  echo @$sel_ask_font_name[2]; ?> >Tahoma</option>
<OPTION value="Verdana, sans-serif" <?  echo @$sel_ask_font_name[3]; ?> >Verdana</option>
<OPTION value="Courier New, monospace" <?  echo @$sel_ask_font_name[4]; ?> >Courier New</option>
<OPTION value="Calisto MT, cursive" <?  echo @$sel_ask_font_name[5]; ?> >Calisto MT</option>
<OPTION value="Broadway, fantasy" <?  echo @$sel_ask_font_name[6]; ?> >Broadway</option>

</SELECT>
   </td>
</tr>

<tr >
   <td colspan=2><b>Кнопки</b></td>
</tr>

<tr>
   <td> Размер в пикселах</td>

   <td><input name="but_size" type="text" value="<? echo @$conf[29]?>" size=10> </td>
</tr>

<tr>
   <td>Цвет</td>

   <td><input name="but_color" type="text"  size=10 value="<? echo @$conf[30] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[30]; ?> > тест
		</font></big></b></td>
</tr>

<tr>
   <td>Цвет, ширина и тип рамки </td>

   <td>

             <INPUT TYPE="text" NAME="but_line_color" SIZE="10"  VALUE="<? echo @$conf[31] ?>">
         &nbsp;<font color="<? echo @$conf[31]; ?>">&nbsp;&nbsp;<b>тест</b></font>&nbsp;&nbsp;&nbsp;

         &nbsp;&nbsp;&nbsp;<select  name="but_line_size">
           <option value="0" <? echo @$sel_but_line_size[0] ?> >0</option>
           <option value="1" <? echo @$sel_but_line_size[1] ?> >1</option>
           <option value="2" <? echo @$sel_but_line_size[2] ?> >2</option>
           <option value="3" <? echo @$sel_but_line_size[3] ?> >3</option>
           <option value="4" <? echo @$sel_but_line_size[4] ?> >4</option>
           <option value="5" <? echo @$sel_but_line_size[5] ?> >5</option>
        </select>&nbsp;px&nbsp;&nbsp;&nbsp;
        <SELECT NAME="but_line_type">
<OPTION value="none" <?  echo @$sel_but_line_type[0]; ?>>Нет</option>
<OPTION value="dotted" <?  echo @$sel_but_line_type[1]; ?>>Точки</option>
<OPTION value="dashed" <? echo @$sel_but_line_type[2]; ?>>Пунктир</option>
<OPTION value="solid" <? echo @$sel_but_line_type[3]; ?>>Сплошная</option>
<OPTION value="double" <? echo @$sel_but_line_type[4]; ?>>Двойная</option>
</SELECT>
   </td>
</tr>


<tr >
   <td>Шрифт<br>
   Цвет, размер в пунктах, начертание шрифта, жирность,
   название
   </td>
   <td>
       <input name="but_font_color" type="text"  size=10 value="<? echo @$conf[34] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[34]; ?> > тест
		</font></big></b>&nbsp;
		<SELECT NAME="but_font_size">
<OPTION value="10" <?  echo @$sel_but_font_size[0]; ?>>10</option>
<OPTION value="12" <?  echo @$sel_but_font_size[1]; ?>>12</option>
<OPTION value="14" <? echo @$sel_but_font_size[2]; ?>>14</option>
<OPTION value="16" <? echo @$sel_but_font_size[3]; ?>>16</option>
<OPTION value="18" <? echo @$sel_but_font_size[4]; ?>>18</option>
<OPTION value="20" <? echo @$sel_but_font_size[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt&nbsp;

<SELECT NAME="but_font_type">
<OPTION value="normal" <?  echo @$sel_but_font_type[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$sel_but_font_type[1]; ?> >Наклонный</option>
</SELECT>

<SELECT NAME="but_font_width">
<OPTION value="100" <?  echo @$sel_but_font_width[0]; ?> >100</option>
<OPTION value="200" <?  echo @$sel_but_font_width[1]; ?> >200</option>
<OPTION value="300" <?  echo @$sel_but_font_width[2]; ?> >300</option>
<OPTION value="400" <?  echo @$sel_but_font_width[3]; ?> >400</option>
<OPTION value="500" <?  echo @$sel_but_font_width[4]; ?> >500</option>
<OPTION value="600" <?  echo @$sel_but_font_width[5]; ?> >600</option>
<OPTION value="700" <?  echo @$sel_but_font_width[6]; ?> >700</option>
</SELECT>

<SELECT NAME="but_font_name">
<OPTION value="Times New Roman, serif" <?  echo @$sel_but_font_name[0]; ?> >Times New Roman</option>
<OPTION value="Arial, sans-serif" <?  echo @$sel_but_font_name[1]; ?> >Arial</option>
<OPTION value="Tahoma, sans-serif" <?  echo @$sel_but_font_name[2]; ?> >Tahoma</option>
<OPTION value="Verdana, sans-serif" <?  echo @$sel_but_font_name[3]; ?> >Verdana</option>
<OPTION value="Courier New, monospace" <?  echo @$sel_but_font_name[4]; ?> >Courier New</option>
<OPTION value="Calisto MT, cursive" <?  echo @$sel_but_font_name[5]; ?> >Calisto MT</option>
<OPTION value="Broadway, fantasy" <?  echo @$sel_but_font_name[6]; ?> >Broadway</option>
</SELECT>
   </td>
   </tr>

<tr >
   <td>Надписи на кнопках</td>
   <td>
       Голосования &nbsp;<input name="but_text1" type="text" value="<? echo @$conf[39] ?>">&nbsp;&nbsp;
       Результатов &nbsp;<input name="but_text2" type="text" value="<? echo @$conf[40] ?>">
   </td>
</tr>

<tr >
   <td>Расположение</td>
   <td>
      рядом&nbsp;<input name="but_align" type="radio" value="1" <? echo @$check_but_align[0] ?>> &nbsp;&nbsp;
      в столбик&nbsp;<input name="but_align" type="radio" value="2" <? echo @$check_but_align[1] ?>>
   </td>
</tr>

<tr >
   <td style=" border-bottom:1px solid #d0c9ad;">Убрать CSS-стили.<br>
   Кнопки примут классический стиль</td>
   <td style=" border-bottom:1px solid #d0c9ad;">
       <input name="css" type="checkbox" value="ON" <? echo @$check_css ?>>
   </td>
</tr>

<tr >
   <td colspan=2> <input type="submit" value="Сохранить" name=go>  </td>
</tr>

</form>
</table>

</body>

</html>