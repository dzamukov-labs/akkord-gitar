<?php
 include("cap.php");

 if(isset($_POST['go']))
   {
     $f=fopen("conf/mes1.txt","w+");
     fwrite($f,"0 цвет страницы*".$_POST['color_page']."\r\n");
     fwrite($f,"1 фон страницы*".$_POST['background_page']."\r\n");

     if(!is_numeric($_POST['count_search']) ||  $_POST['count_search']=="")
         fwrite($f,"2 сколько результатов*10\r\n");
     else
         fwrite($f,"2 сколько результатов*".$_POST['count_search']."\r\n");

     fwrite($f,"3 цвет главного блока*".$_POST['color_block']."\r\n");

     if(!is_numeric($_POST['width_block']) || $_POST['width_block']=="")
        fwrite($f,"4 ширина главного блока*70\r\n");
     else
     fwrite($f,"4 ширина главного блока*".$_POST['width_block']."\r\n");

     fwrite($f,"5 цвет рамки главного блока*".$_POST['border_color_block']."\r\n");
     fwrite($f,"6 ширина рамки главного блока*".$_POST['border_size_block']."\r\n");
     fwrite($f,"7 тип рамки главного блока*".$_POST['border_type_block']."\r\n");

     fwrite($f,"8 цвет шрифта информации*".$_POST['color_font_info']."\r\n");
     fwrite($f,"9 размер шрифта информации*".$_POST['size_font_info']."\r\n");
     fwrite($f,"10 ничертание шрифта информации*".$_POST['type_font_info']."\r\n");
     fwrite($f,"11 жирность шрифта информации *".$_POST['width_font_info']."\r\n");

     fwrite($f,"12 цвет блока с одним поиском*".$_POST['color_search']."\r\n");

     if(!is_numeric($_POST['width_search']) || $_POST['width_search']=="")
         fwrite($f,"13 ширина блока с одним поиском*100\r\n");
     else
         fwrite($f,"13 ширина блока с одним поиском*".$_POST['width_search']."\r\n");


     fwrite($f,"14 цвет рамки блока с одним поиском*".$_POST['border_color_search']."\r\n");
     fwrite($f,"15 ширина верхней рамки блока с одним поиском*".$_POST['border_size_top_search']."\r\n");
     fwrite($f,"16 ширина нижней рамки блока с одним поиском*".$_POST['border_size_bottom_search']."\r\n");
     fwrite($f,"17 ширина правой рамки блока с одним поиском*".$_POST['border_size_right_search']."\r\n");
     fwrite($f,"18 ширина левой рамки блока с одним поиском*".$_POST['border_size_left_search']."\r\n");
     fwrite($f,"19 тип рамки блока с одним поиском*".$_POST['border_type_search']."\r\n");

     fwrite($f,"20 цвет шрифта титле*".$_POST['color_font_title']."\r\n");
     fwrite($f,"21 размер шрифта титле*".$_POST['size_font_title']."\r\n");
     fwrite($f,"22 начертание шрифта титле*".$_POST['type_font_title']."\r\n");
     fwrite($f,"23 жирность шрифта титле*".$_POST['width_font_title']."\r\n");

     fwrite($f,"24 цвет шрифта предложения*".$_POST['color_font_content']."\r\n");
     fwrite($f,"25 размер шрифта предложения*".$_POST['size_font_content']."\r\n");
     fwrite($f,"26 начертание шрифта предложения*".$_POST['type_font_content']."\r\n");
     fwrite($f,"27 жирность шрифта предложения*".$_POST['width_font_content']."\r\n");

     fwrite($f,"28 цвет шрифта совпадений*".$_POST['color_font_count']."\r\n");
     fwrite($f,"29 размер шрифта совпадений*".$_POST['size_font_count']."\r\n");
     fwrite($f,"30 начертание шрифта совпадений*".$_POST['type_font_count']."\r\n");
     fwrite($f,"31 жирность шрифта совпадений*".$_POST['width_font_count']."\r\n");

     fwrite($f,"32 цвет шрифта текстовой ссылки*".$_POST['color_font_text_link']."\r\n");
     fwrite($f,"33 размер шрифта текстовой ссылки*".$_POST['size_font_text_link']."\r\n");
     fwrite($f,"34 начертание шрифта текстовой ссылки*".$_POST['type_font_text_link']."\r\n");
     fwrite($f,"35 жирность шрифта текстовой ссылки*".$_POST['width_font_text_link']."\r\n");

     if(isset($_POST['title_view'])) fwrite($f,"36 показывать название документа*1\r\n");
     else fwrite($f,"36 показывать название документа*0\r\n");

     if(isset($_POST['pred_view'])) fwrite($f,"37 показывать предложение с поисковой строкой*1\r\n");
     else fwrite($f,"37 показывать предложение с поисковой строкой*0\r\n");

     if(isset($_POST['count_view'])) fwrite($f,"38 показывать количество совпадений*1\r\n");
     else fwrite($f,"38 показывать количество совпадений*0\r\n");

     if(isset($_POST['text_view'])) fwrite($f,"39 показывать ссылку на текстовую копию*1\r\n");
     else fwrite($f,"39 показывать ссылку на текстовую копию*0\r\n");

     fwrite($f,"40 align главного блока*".$_POST['block_align']);

     fclose($f);
   }



  //====================Проверка данных-------------
 $config=file("conf/mes1.txt");
 $n=0;
 //Очищаем
 foreach($config as $line)
  {
 	$expl=explode("*", $line);
 	$conf[$n]=trim($expl[1]);
 	$n++;
  }

//Что показывать
if($conf[36]==1)$check_title_view="checked";
else $check_title_view ="";

if($conf[37]==1)$check_pred_view="checked";
else $check_pred_view ="";

if($conf[38]==1)$check_count_view="checked";
else $check_count_view ="";

if($conf[39]==1)$check_text_view="checked";
else $check_text_view ="";



 //Рамка главного блока

//Тип рамки
if($conf[7]=="none")$sel_border_type_block[0]="selected";
if($conf[7]=="dotted")$sel_border_type_block[1]="selected";
if($conf[7]=="dashed")$sel_border_type_block[2]="selected";
if($conf[7]=="solid")$sel_border_type_block[3]="selected";
if($conf[7]=="double")$sel_border_type_block[4]="selected";


//Ширина рамки
for($i=0; $i<6; $i++)
 {
   if($conf[6]==$i) $sel_border_size_block[$i]="selected";
   else $sel_border_size_block[$i]="";
 }
//Ориентация блока
if($conf[40]=='left') $check_align_block[0]="checked";
if($conf[40]=='center') $check_align_block[1]="checked";
if($conf[40]=='right') $check_align_block[2]="checked";

//Шрифт информационной строки

//Размер
for($i=10,$n=0; $i<22; $i+=2,$n++)
 {
   if($conf[9]==$i) $sel_size_font_info[$n]="selected";
   else $sel_size_font_info[$n]="";

 }

 //Тип
 if($conf[10]=="normal") $sel_type_font_info[0]="selected";
 if($conf[10]=="italic") $sel_type_font_info[1]="selected";

 //Жирность
 for($i=100,$n=0; $i<800; $i+=100,$n++)
 {
   if($conf[11]==$i) $sel_width_font_info[$n]="selected";
   else $sel_width_font_info[$n]="";

 }

//Блок с одним результатом поиска
//Тип рамки
if($conf[19]=="none")$sel_border_type_search[0]="selected";
if($conf[19]=="dotted")$sel_border_type_search[1]="selected";
if($conf[19]=="dashed")$sel_border_type_search[2]="selected";
if($conf[19]=="solid")$sel_border_type_search[3]="selected";
if($conf[19]=="double")$sel_border_type_search[4]="selected";


//Ширина верхней рамки
for($i=0; $i<6; $i++)
 {
   if($conf[15]==$i) $sel_border_size_top_search[$i]="selected";
   else $sel_border_size_top_search[$i]="";
 }

 //Ширина нижней рамки
for($i=0; $i<6; $i++)
 {
   if($conf[16]==$i) $sel_border_size_bottom_search[$i]="selected";
   else $sel_border_size_bottom_search[$i]="";
 }

 //Ширина правой рамки
for($i=0; $i<6; $i++)
 {
   if($conf[17]==$i) $sel_border_size_right_search[$i]="selected";
   else $sel_border_size_right_search[$i]="";
 }

 //Ширина левой рамки
for($i=0; $i<6; $i++)
 {
   if($conf[18]==$i) $sel_border_size_left_search[$i]="selected";
   else $sel_border_size_left_search[$i]="";
 }


//Шрифт title

//Размер
for($i=10,$n=0; $i<22; $i+=2,$n++)
 {
   if($conf[21]==$i) $sel_size_font_title[$n]="selected";
   else $sel_size_font_title[$n]="";

 }

 //Тип
 if($conf[22]=="normal") $sel_type_font_title[0]="selected";
 if($conf[22]=="italic") $sel_type_font_title[1]="selected";

 //Жирность
 for($i=100,$n=0; $i<800; $i+=100,$n++)
 {
   if($conf[23]==$i) $sel_width_font_title[$n]="selected";
   else $sel_width_font_title[$n]="";

 }



//Шрифт предложения

//Размер
for($i=10,$n=0; $i<22; $i+=2,$n++)
 {
   if($conf[25]==$i) $sel_size_font_content[$n]="selected";
   else $sel_size_font_content[$n]="";

 }

 //Тип
 if($conf[26]=="normal") $sel_type_font_content[0]="selected";
 if($conf[26]=="italic") $sel_type_font_content[1]="selected";

 //Жирность
 for($i=100,$n=0; $i<800; $i+=100,$n++)
 {
   if($conf[27]==$i) $sel_width_font_content[$n]="selected";
   else $sel_width_font_content[$n]="";

 }

 //Шрифт совпадений

 //Размер
for($i=10,$n=0; $i<22; $i+=2,$n++)
 {
   if($conf[29]==$i) $sel_size_font_count[$n]="selected";
   else $sel_size_font_conten[$n]="";

 }

 //Тип
 if($conf[30]=="normal") $sel_type_font_count[0]="selected";
 if($conf[30]=="italic") $sel_type_font_count[1]="selected";

 //Жирность
 for($i=100,$n=0; $i<800; $i+=100,$n++)
 {
   if($conf[31]==$i) $sel_width_font_count[$n]="selected";
   else $sel_width_font_count[$n]="";

 }

//Шрифт текстовой ссылки

 //Размер
for($i=10,$n=0; $i<22; $i+=2,$n++)
 {
   if($conf[33]==$i) $sel_size_font_text_link[$n]="selected";
   else $sel_size_font_text_link[$n]="";

 }

 //Тип
 if($conf[34]=="normal") $sel_type_font_text_linkt[0]="selected";
 if($conf[34]=="italic") $sel_type_font_text_link[1]="selected";

 //Жирность
 for($i=100,$n=0; $i<800; $i+=100,$n++)
 {
   if($conf[35]==$i) $sel_width_font_text_link[$n]="selected";
   else $sel_width_font_text_link[$n]="";

 }



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

 <TABLE align=center bgcolor=#EBEBEB width=80% CELLPADDING=10 CELLSPACING=0 border=0>
 <FORM ACTION="admin2.php?sel2=selected" METHOD="POST" name="form">
<tr >
   <td colspan=2><FONT COLOR="#408080" size=+1>Внешний вид страницы с результатами поиска</FONT><br>

   </td>
 </tr>
<tr ><td colspan=2>  <a href=# onclick=win()>Таблица цветовых кодов</a></td></tr>

<tr >
   <td colspan=2><b>Страница</b><br>

   </td>
 </tr>

<tr >
   <td width=35% valign=top>
      Цвет
   </td>
   <td >
       <input name="color_page" type="text"  size=10 value="<? echo @$conf[0] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[0]; ?> > тест
		</font></big></b>
   </td>
 </tr>

 <tr >
   <td width=35% valign=top >
      Графический фон<br>
      Адрес рисунка вставляйте полностью, т.е. http://ваш_сайт/путь
   </td>
   <td valign=top >
       <input name="background_page" type="text"  size=50 value="<? echo @$conf[1] ?>">

   </td>
 </tr>

 <tr >
   <td width=35% valign=top >
      Что показывать
   </td>
   <td valign=top >
       <input name="title_view" type="checkbox" value="ON" <? echo @$check_title_view ?> > &nbsp;Название документа<br />
        <input name="pred_view" type="checkbox" value="ON" <? echo @$check_pred_view ?>> &nbsp;Предложение с поисковой строкой<br />
         <input name="count_view" type="checkbox" value="ON" <? echo @$check_count_view ?>> &nbsp;Количество совпадений<br />
          <input name="text_view" type="checkbox" value="ON" <? echo @$check_text_view ?>> &nbsp;Ссылка на текстовую копию<br />

   </td>
 </tr>

<tr >
   <td width=35% valign=top style=" border-bottom:1px solid #d0c9ad;">
      Сколько результатов поиска на страницу
   </td>
   <td valign=top style=" border-bottom:1px solid #d0c9ad;">
       <input name="count_search" type="text"  size=10 value="<? echo @$conf[2] ?>">

   </td>
 </tr>

 <tr >
   <td colspan=2><b>Главный блок со всеми результатами поиска</b><br>
   </td>
 </tr>

  <tr >
   <td width=35% valign=top >
    Цвет
   </td>
   <td valign=top >
      <input name="color_block" type="text"  size=10 value="<? echo @$conf[3] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[3]; ?> > тест
		</font></big></b>
   </td>
 </tr>

<tr >
   <td width=35% valign=top >
      Ширина отностительно центральной части страницы.<br>
      Внимание! Если у вас в настройках <b>Управления кодом</b> определён код для
      правой и(или) левой части страницы, то этот процент будет расчитываться от центральной части.<br>
      <b>Более</b> 90% ставить не рекомендуется в связи с неоднозначностью отображения страницы
      разными браузерами!
   </td>
   <td valign=top >
       <input name="width_block" type="text"  size=10 value="<? echo @$conf[4] ?>">&nbsp;%

   </td>
 </tr>

 <tr>
   <td >Цвет, ширина и тип рамки</td>
   <td >
         <INPUT TYPE="text" NAME="border_color_block" SIZE="10"  VALUE="<? echo @$conf[5] ?>">
         &nbsp;<font color="<? echo @$conf[5]; ?>">&nbsp;&nbsp;<b>тест</b></font>&nbsp;&nbsp;&nbsp;

         &nbsp;&nbsp;&nbsp;<select  name="border_size_block">
           <option value="0" <? echo @$sel_border_size_block[0] ?> >0</option>
           <option value="1" <? echo @$sel_border_size_block[1] ?> >1</option>
           <option value="2" <? echo @$sel_border_size_block[2] ?> >2</option>
           <option value="3" <? echo @$sel_border_size_block[3] ?> >3</option>
           <option value="4" <? echo @$sel_border_size_block[4] ?> >4</option>
           <option value="5" <? echo @$sel_border_size_block[5] ?> >5</option>
        </select>&nbsp;px&nbsp;&nbsp;&nbsp;
        <SELECT NAME="border_type_block">
<OPTION value="none" <?  echo @$sel_border_type_block[0]; ?>>Нет</option>
<OPTION value="dotted" <?  echo @$sel_border_type_block[1]; ?>>Точки</option>
<OPTION value="dashed" <? echo @$sel_border_type_block[2]; ?>>Пунктир</option>
<OPTION value="solid" <? echo @$sel_border_type_block[3]; ?>>Сплошная</option>
<OPTION value="double" <? echo @$sel_border_type_block[4]; ?>>Двойная</option>
</SELECT>

        </td>
</tr>
<tr>
   <td  width=35% valign=top  style=" border-bottom:1px solid #d0c9ad;">Расположение на странице</td>
    <td  style=" border-bottom:1px solid #d0c9ad;">
         <input name="block_align" type="radio" value="left" <? echo @$check_align_block[0]; ?>>&nbsp;Слева&nbsp;
         <input name="block_align" type="radio" value="center" <? echo @$check_align_block[1]; ?>>&nbsp;По центру&nbsp;
         <input name="block_align" type="radio" value="right" <? echo @$check_align_block[2]; ?>>&nbsp;Справа
    </td>
</tr>
<tr >
   <td colspan=2><b>Информационная строка с результатами поиска (вверху страницы)</b><br>
   </td>
 </tr>


<tr>
   <td  width=35% valign=top style=" border-bottom:1px solid #d0c9ad;">Шрифт. Цвет, размер, начертание, жирность.</td>
    <td style=" border-bottom:1px solid #d0c9ad;"> <input name="color_font_info" type="text"  size=10 value="<? echo @$conf[8]; ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[8]; ?> > тест
		</font></big></b>&nbsp;
		<SELECT NAME="size_font_info">
<OPTION value="10" <?  echo @$sel_size_font_info[0]; ?>>10</option>
<OPTION value="12" <?  echo @$sel_size_font_info[1]; ?>>12</option>
<OPTION value="14" <? echo @$sel_size_font_info[2]; ?>>14</option>
<OPTION value="16" <? echo @$sel_size_font_info[3]; ?>>16</option>
<OPTION value="18" <? echo @$sel_size_font_info[4]; ?>>18</option>
<OPTION value="20" <? echo @$sel_size_font_info[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt&nbsp;

<SELECT NAME="type_font_info">
<OPTION value="normal" <?  echo @$sel_type_font_info[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$sel_type_font_info[1]; ?> >Наклонный</option>
</SELECT>

<SELECT NAME="width_font_info">
<OPTION value="100" <?  echo @$sel_width_font_info[0]; ?> >100</option>
<OPTION value="200" <?  echo @$sel_width_font_info[1]; ?> >200</option>
<OPTION value="300" <?  echo @$sel_width_font_info[2]; ?> >300</option>
<OPTION value="400" <?  echo @$sel_width_font_info[3]; ?> >400</option>
<OPTION value="500" <?  echo @$sel_width_font_info[4]; ?> >500</option>
<OPTION value="600" <?  echo @$sel_width_font_info[5]; ?> >600</option>
<OPTION value="700" <?  echo @$sel_width_font_info[6]; ?> >700</option>
</SELECT>

    </td>
</tr>

<tr >
   <td colspan=2><b>Блок с одним результатом поиска</b><br>
   </td>
 </tr>

 <tr >
   <td width=35% valign=top >
    Цвет
   </td>
   <td valign=top >
      <input name="color_search" type="text"  size=10 value="<? echo @$conf[12] ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[12]; ?> > тест
		</font></big></b>
   </td>
 </tr>

<tr >
   <td width=35% valign=top >
      Ширина отностительно главного блока
   </td>
   <td valign=top >
       <input name="width_search" type="text"  size=10 value="<? echo @$conf[13] ?>">&nbsp;%

   </td>
 </tr>

 <tr>
   <td style=" border-bottom:1px solid #d0c9ad;">Цвет, ширина рамки в px с четырёх сторон-
   верх-низ-право-лево, тип рамки</td>
   <td style=" border-bottom:1px solid #d0c9ad;">
         <INPUT TYPE="text" NAME="border_color_search" SIZE="10"  VALUE="<? echo @$conf[14] ?>">
         &nbsp;<font color="<? echo @$conf[14]; ?>">&nbsp;&nbsp;<b>тест</b></font><br><br>

	         <select  name="border_size_top_search">
           <option value="0" <? echo @$sel_border_size_top_search[0] ?> >0</option>
           <option value="1" <? echo @$sel_border_size_top_search[1] ?> >1</option>
           <option value="2" <? echo @$sel_border_size_top_search[2] ?> >2</option>
           <option value="3" <? echo @$sel_border_size_top_search[3] ?> >3</option>
           <option value="4" <? echo @$sel_border_size_top_search[4] ?> >4</option>
           <option value="5" <? echo @$sel_border_size_top_search[5] ?> >5</option>
        </select>&nbsp;&nbsp;


         <select  name="border_size_bottom_search">
           <option value="0" <? echo @$sel_border_size_bottom_search[0] ?> >0</option>
           <option value="1" <? echo @$sel_border_size_bottom_search[1] ?> >1</option>
           <option value="2" <? echo @$sel_border_size_bottom_search[2] ?> >2</option>
           <option value="3" <? echo @$sel_border_size_bottom_search[3] ?> >3</option>
           <option value="4" <? echo @$sel_border_size_bottom_search[4] ?> >4</option>
           <option value="5" <? echo @$sel_border_size_bottom_search[5] ?> >5</option>
        </select>&nbsp;&nbsp;


         <select  name="border_size_right_search">
           <option value="0" <? echo @$sel_border_size_right_search[0] ?> >0</option>
           <option value="1" <? echo @$sel_border_size_right_search[1] ?> >1</option>
           <option value="2" <? echo @$sel_border_size_right_search[2] ?> >2</option>
           <option value="3" <? echo @$sel_border_size_right_search[3] ?> >3</option>
           <option value="4" <? echo @$sel_border_size_right_search[4] ?> >4</option>
           <option value="5" <? echo @$sel_border_size_right_search[5] ?> >5</option>
        </select>&nbsp;&nbsp;


         <select  name="border_size_left_search">
           <option value="0" <? echo @$sel_border_size_left_search[0] ?> >0</option>
           <option value="1" <? echo @$sel_border_size_left_search[1] ?> >1</option>
           <option value="2" <? echo @$sel_border_size_left_search[2] ?> >2</option>
           <option value="3" <? echo @$sel_border_size_left_search[3] ?> >3</option>
           <option value="4" <? echo @$sel_border_size_left_search[4] ?> >4</option>
           <option value="5" <? echo @$sel_border_size_left_search[5] ?> >5</option>
        </select>&nbsp;&nbsp;

        Тип рамки&nbsp;
        <SELECT NAME="border_type_search">
<OPTION value="none" <?  echo @$sel_border_type_search[0]; ?>>Нет</option>
<OPTION value="dotted" <?  echo @$sel_border_type_search[1]; ?>>Точки</option>
<OPTION value="dashed" <? echo @$sel_border_type_search[2]; ?>>Пунктир</option>
<OPTION value="solid" <? echo @$sel_border_type_search[3]; ?>>Сплошная</option>
<OPTION value="double" <? echo @$sel_border_type_search[4]; ?>>Двойная</option>
</SELECT>
        </td>
</tr>

<tr >
   <td colspan=2><b>Название документа (страницы)</b><br>
   </td>
 </tr>

<tr>
   <td  width=35% valign=top style=" border-bottom:1px solid #d0c9ad;">
   Шрифт. Цвет, размер, начертание, жирность.</td>
    <td style=" border-bottom:1px solid #d0c9ad;">
     <input name="color_font_title" type="text"  size=10 value="<? echo @$conf[20]; ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[20]; ?> > тест
		</font></big></b>&nbsp;
		<SELECT NAME="size_font_title">
<OPTION value="10" <?  echo @$sel_size_font_title[0]; ?>>10</option>
<OPTION value="12" <?  echo @$sel_size_font_title[1]; ?>>12</option>
<OPTION value="14" <? echo @$sel_size_font_title[2]; ?>>14</option>
<OPTION value="16" <? echo @$sel_size_font_title[3]; ?>>16</option>
<OPTION value="18" <? echo @$sel_size_font_title[4]; ?>>18</option>
<OPTION value="20" <? echo @$sel_size_font_title[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt&nbsp;

<SELECT NAME="type_font_title">
<OPTION value="normal" <?  echo @$sel_type_font_title[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$sel_type_font_title[1]; ?> >Наклонный</option>
</SELECT>

<SELECT NAME="width_font_title">
<OPTION value="100" <?  echo @$sel_width_font_title[0]; ?> >100</option>
<OPTION value="200" <?  echo @$sel_width_font_title[1]; ?> >200</option>
<OPTION value="300" <?  echo @$sel_width_font_title[2]; ?> >300</option>
<OPTION value="400" <?  echo @$sel_width_font_title[3]; ?> >400</option>
<OPTION value="500" <?  echo @$sel_width_font_title[4]; ?> >500</option>
<OPTION value="600" <?  echo @$sel_width_font_title[5]; ?> >600</option>
<OPTION value="700" <?  echo @$sel_width_font_title[6]; ?> >700</option>
</SELECT>

    </td>
</tr>

<tr >
   <td colspan=2><b>Предложение из документа, где может встречаться искомая строка
    (выводится под названием документа)</b><br>
   </td>
 </tr>

<tr>
   <td  width=35% valign=top style=" border-bottom:1px solid #d0c9ad;">
   Шрифт. Цвет, размер, начертание, жирность.</td>
    <td style=" border-bottom:1px solid #d0c9ad;">
     <input name="color_font_content" type="text"  size=10 value="<? echo @$conf[24]; ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[24]; ?> > тест
		</font></big></b>&nbsp;
		<SELECT NAME="size_font_content">
<OPTION value="10" <?  echo @$sel_size_font_content[0]; ?>>10</option>
<OPTION value="12" <?  echo @$sel_size_font_content[1]; ?>>12</option>
<OPTION value="14" <? echo @$sel_size_font_content[2]; ?>>14</option>
<OPTION value="16" <? echo @$sel_size_font_content[3]; ?>>16</option>
<OPTION value="18" <? echo @$sel_size_font_content[4]; ?>>18</option>
<OPTION value="20" <? echo @$sel_size_font_content[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt&nbsp;

<SELECT NAME="type_font_content">
<OPTION value="normal" <?  echo @$sel_type_font_content[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$sel_type_font_content[1]; ?> >Наклонный</option>
</SELECT>

<SELECT NAME="width_font_content">
<OPTION value="100" <?  echo @$sel_width_font_content[0]; ?> >100</option>
<OPTION value="200" <?  echo @$sel_width_font_content[1]; ?> >200</option>
<OPTION value="300" <?  echo @$sel_width_font_content[2]; ?> >300</option>
<OPTION value="400" <?  echo @$sel_width_font_content[3]; ?> >400</option>
<OPTION value="500" <?  echo @$sel_width_font_content[4]; ?> >500</option>
<OPTION value="600" <?  echo @$sel_width_font_content[5]; ?> >600</option>
<OPTION value="700" <?  echo @$sel_width_font_content[6]; ?> >700</option>
</SELECT>

    </td>
</tr>

<tr >
   <td colspan=2><b>Строка с количеством совпадений</b><br>
   </td>
 </tr>

<tr>
   <td  width=35% valign=top style=" border-bottom:1px solid #d0c9ad;">
   Шрифт. Цвет, размер, начертание, жирность.</td>
    <td style=" border-bottom:1px solid #d0c9ad;">
     <input name="color_font_count" type="text"  size=10 value="<? echo @$conf[28]; ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[28]; ?> > тест
		</font></big></b>&nbsp;
		<SELECT NAME="size_font_count">
<OPTION value="10" <?  echo @$sel_size_font_count[0]; ?>>10</option>
<OPTION value="12" <?  echo @$sel_size_font_count[1]; ?>>12</option>
<OPTION value="14" <? echo @$sel_size_font_count[2]; ?>>14</option>
<OPTION value="16" <? echo @$sel_size_font_count[3]; ?>>16</option>
<OPTION value="18" <? echo @$sel_size_font_count[4]; ?>>18</option>
<OPTION value="20" <? echo @$sel_size_font_count[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt&nbsp;

<SELECT NAME="type_font_count">
<OPTION value="normal" <?  echo @$sel_type_font_count[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$sel_type_font_count[1]; ?> >Наклонный</option>
</SELECT>

<SELECT NAME="width_font_count">
<OPTION value="100" <?  echo @$sel_width_font_count[0]; ?> >100</option>
<OPTION value="200" <?  echo @$sel_width_font_count[1]; ?> >200</option>
<OPTION value="300" <?  echo @$sel_width_font_count[2]; ?> >300</option>
<OPTION value="400" <?  echo @$sel_width_font_count[3]; ?> >400</option>
<OPTION value="500" <?  echo @$sel_width_font_count[4]; ?> >500</option>
<OPTION value="600" <?  echo @$sel_width_font_count[5]; ?> >600</option>
<OPTION value="700" <?  echo @$sel_width_font_count[6]; ?> >700</option>
</SELECT>

    </td>
</tr>

<tr >
   <td colspan=2><b>Ссылка на текстовую копию</b><br>
   </td>
 </tr>

<tr>
   <td  width=35% valign=top style=" border-bottom:1px solid #d0c9ad;">
   Шрифт. Цвет, размер, начертание, жирность.</td>
    <td style=" border-bottom:1px solid #d0c9ad;">
     <input name="color_font_text_link" type="text"  size=10 value="<? echo @$conf[32]; ?>">
   &nbsp;&nbsp;<b><big><font color= <? echo @$conf[32]; ?> > тест
		</font></big></b>&nbsp;
		<SELECT NAME="size_font_text_link">
<OPTION value="10" <?  echo @$sel_size_font_text_link[0]; ?>>10</option>
<OPTION value="12" <?  echo @$sel_size_font_text_link[1]; ?>>12</option>
<OPTION value="14" <? echo @$sel_size_font_text_link[2]; ?>>14</option>
<OPTION value="16" <? echo @$sel_size_font_text_link[3]; ?>>16</option>
<OPTION value="18" <? echo @$sel_size_font_text_link[4]; ?>>18</option>
<OPTION value="20" <? echo @$sel_size_font_text_link[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt&nbsp;

<SELECT NAME="type_font_text_link">
<OPTION value="normal" <?  echo @$sel_type_font_text_link[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$sel_type_font_text_link[1]; ?> >Наклонный</option>
</SELECT>

<SELECT NAME="width_font_text_link">
<OPTION value="100" <?  echo @$sel_width_font_text_link[0]; ?> >100</option>
<OPTION value="200" <?  echo @$sel_width_font_text_link[1]; ?> >200</option>
<OPTION value="300" <?  echo @$sel_width_font_text_link[2]; ?> >300</option>
<OPTION value="400" <?  echo @$sel_width_font_text_link[3]; ?> >400</option>
<OPTION value="500" <?  echo @$sel_width_font_text_link[4]; ?> >500</option>
<OPTION value="600" <?  echo @$sel_width_font_text_link[5]; ?> >600</option>
<OPTION value="700" <?  echo @$sel_width_font_text_link[6]; ?> >700</option>
</SELECT>

    </td>
</tr>

<tr >
   <td colspan=2><input type="submit" value="Сохранить" name="go"></td>
 </tr>
 </form>
 </table>