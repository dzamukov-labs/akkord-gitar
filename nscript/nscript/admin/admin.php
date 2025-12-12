<?php
include('cap.php');


//=------------------------------------------------------------------------------


 if(@$_POST['go'])
   { //Тексты
   	 if(@$_POST['text_head']) $conf[0]=@$_POST['text_head'];
     else $conf[0]="";

     if( @$_POST['head_int']) $conf[1]=1;
     else $conf[1]=0;

   	 if (@$_POST['text_oll']!="")$conf[2]=@$_POST['text_oll'];
   	 else $conf[2]="";


     //Цвета надписей
     if(@$_POST['color_head'])$conf[3]=@$_POST['color_head'];
     else $conf[3]="#000000";

     if(@$_POST['color_oll']) $conf[4]=@$_POST['color_oll'];
     else $conf[4]="#000000";


     //Размер шрифтов
     $conf[5]= @$_POST['size_head'];
     $conf[6]=@$_POST['size_oll'];

     //Начертание
     $conf[7]=@$_POST['font_head'];
     $conf[8]=@$_POST['font_oll'];


      //Цвет фона
     if(@$_POST['color_fon'])$conf[9]= @$_POST['color_fon'];
     else @$conf[9]="#ffffff";

     //Вид рамки
     $conf[10]= @$_POST['border'];

     //ширина рамки
     $conf[11]= @$_POST['border_width'];

     //Цвет рамки
     if (@$_POST['border_left_color'])@$conf[12]= @$_POST['border_left_color'];
     else @$conf[12]="#000000";

     if(@$_POST['border_right_color'])@$conf[13]= @$_POST['border_right_color'];
     else @$conf[13]="#000000";

     if(@$_POST['border_top_color'])@$conf[14]= @$_POST['border_top_color'];
     else @$conf[14]="#000000";

     if(@$_POST['border_bottom_color'])@$conf[15]= @$_POST['border_bottom_color'];
     else @$conf[15]="#000000";

     //Картинки

     //Для заголовка
     if( @$_POST['img_head_on']) @$conf[16]=1;
     else @$conf[16]=0;
     @$conf[17]=@$_POST['usH'];


     //Положение картинок

     $conf[18]=@$_POST['img_align_head'] ;

      //Ширина и высота области формы

       if( @$_POST['width']<=400) @$conf[19]=@$_POST['width'];
      else @$conf[19]=100;

        if( @$_POST['height']<=400) @$conf[20]=@$_POST['height'];
      else @$conf[20]=100;

      @$conf[21]=$_POST['text_button'];
      if (@$_POST['area']>50) @$conf[22]=20;
      else @$conf[22]= $_POST['area'];

        $strpath="config/conf.txt";
        @$f=fopen($strpath,w);
        foreach($conf as $line) fwrite($f, $line."\r\n");
        fclose($f);


        //Меняем пароль и логин----------------------------------
       if(@$_POST['login']!="" &&  @$_POST['pasw']!="")
        {
          @$_POST['login']=trim(@$_POST['login']);
          @$_POST['pasw']=trim(@$_POST['pasw']);
          $strpath="config/log.txt";
          @$f=fopen($strpath, "w");
          fwrite($f,md5($_POST['login'])."\r\n");
          fwrite($f,md5($_POST['pasw'])."\r\n");
          fwrite($f,session_id());
          fclose($f);

        }


   }



   //Проверка данных---------------------------------------


$strpath="config/conf.txt";
@$f=fopen($strpath,r);
$conf=file($strpath);
fclose($f);

 for($i=0; $i<count($conf);$i++)
 {
 	 $conf[$i]=trim($conf[$i]);
 }

if (@$conf[1]==1)@$check_head_int='checked';
else @$check_head_int="";


for($i=10, $n=0; $n<6; $i+=2, @$n++)
 {
     if (@$conf[5]==$i)  @$check_size_head[$n]='selected';
     else @$check_size_head[$n]="";
 }

for($i=8,$n=0; $n<5; $i++, $n++)
 {
     if (@$conf[6]==$i)  @$check_size_oll[$n]='selected';
     else @$check_size_oll[$n]="";
 }




 //Начертание заголовка
 if (@$conf[17]=="normal") @$check_font_head[0]="selected";

 if (@$conf[7]=="italic") @$check_font_head[1]="selected";

 if (@$conf[7]=="bold") @$check_font_head[2]="selected";


 //Начертание подзаголовка
 if (@$conf[8]=="normal") @$check_font_oll[0]="selected";
 else @$check_font_oll[0]="";

 if (@$conf[8]=="italic") @$check_font_oll[1]="selected";


 if (@$conf[8]=="bold") @$check_font_oll[2]="selected";
 else @$check_font_oll[2]="1";



 //Рамка

 if(@$conf[10]=="none") @$check_border[0]="selected";
 if(@$conf[10]=="dotted") @$check_border[1]="selected";
 if(@$conf[10]=="dashed") @$check_border[2]="selected";
 if(@$conf[10]=="solid") @$check_border[3]="selected";
 if(@$conf[10]=="double") @$check_border[4]="selected";

 for($i=1; $i<6; $i++)
 {
     if (@$conf[11]==$i)  @$check_border_width[$i-1]='selected';
     else @$check_border_width[$i-1]="";
 }

if(@$conf[16]==1)@$check_img_head_on ="checked";
else @$check_img_head_on ="";

for($i=1; $i<13; $i++)
 { 	if(@$conf[17]==$i) @$check_usH[$i]="checked";
    else  @$check_usH[$i]="";
 }

//Положение картинки

if (@$conf[18]=="right")@$check_img_align_head_right='checked';
if (@$conf[18]=="left")@$check_img_align_head_left='checked';



?>

<html>
<head>
  <style>



table  {

 	         font-size:10pt;
       }
h1   {	     font-size:18pt;
	     color:   #408080
      }
h2   {
	     font-size:15pt;
	     color:   #408080
      }
h3   {
	     font-size:11pt;

      }


#headPar    {	         font-family:"Times New Roman", "serif";
             color:<?echo $conf[3] ?>;
             font:<?echo $conf[7]." ".  $conf[5]."pt" ?>;

            }

 #ollPar    { 	         font-family:"Times New Roman", "serif";
             color:<?echo $conf[4] ?>;
             font:<?echo $conf[8]." ".  $conf[6]."pt" ?>;

            }




 #userPar {

             border-style:<?echo $conf[10] ?>;
             border-width: <?echo $conf[11] ?>px;
             border-top-color:<?echo $conf[14] ?>;
             border-bottom-color:<?echo $conf[15] ?>;
             border-left-color:<?echo $conf[12] ?>;
             border-right-color:<?echo $conf[13] ?>;
             background-color:<?echo $conf[9] ?>;
             width:<?echo $conf[19] ?>px;
             height:<?echo $conf[20] ?>px;
             padding:10px;
            }

</style>

 <TITLE>Администрирование</TITLE>
</head>
<BODY BGCOLOR='#E6E6E6'>

<TABLE width=80% CELLPADDING=7 CELLSPACING=0 border=0 align=center>

	<TR><td colspan=2 ><h2>Внешний вид</h2></td></tr>
    <tr><td  colspan=2 valign=top>

    <?
     //Картинка
     if($conf[16]==1)
       {
        if($conf[18]=='left') @$imgpos='left';
        if($conf[18]=='right') @$imgpos='right';
       }
    //Если заголовок над формой
     if($conf[1]==0)
      {

        echo "<div id='headPar' >";
        if (@$imgpos=='left')echo "<img src='img/us$conf[17].png'  border='0' align=absmiddle>&nbsp;";
        echo $conf[0];
        if (@$imgpos=='right')echo "&nbsp;<img src='img/us$conf[17].png'  border='0'align=absmiddle>";
        echo "</div>";

      }
     echo "<div id='userPar'>";
     //Если заголовок внутри формы
      if($conf[1]==1)
      {
         echo "<div id='headPar' >";
        if (@$imgpos=='left')echo "<img src='img/us$conf[17].png'  border='0' align=absmiddle>&nbsp;";
        echo $conf[0];
        if (@$imgpos=='right')echo "&nbsp;<img src='img/us$conf[17].png'  border='0'align=absmiddle>";
        echo "</div>";
      }

     //Подзаголовок
     echo "<div id='ollPar' >$conf[2]</div>";
     //Форма
     echo "<input type='text' size=$conf[22] value=>&nbsp;
     <input type='button' value=$conf[21]>";
     echo "</div>";
     ?>
     </td>
	</tr>
       <form name="" action="admin.php?sel1=selected" method="post">
         <tr bgcolor=#F0F0F0 valign=top>
		<TD width=30%><h3>Заголовок</h3>
		 Например <i>Новости сайта</i><br>
		 Если не хотите заголовок, оставьте пустым окно.  <br>
		 Если вы хотите установить заголовок внутри формы подписки, поставьте галочку.
		</td>
		<td><input name="text_head" type="text"  size=60 value="<? echo @$conf[0] ?>"><br>
		<input name="head_int" type="checkbox"<? echo $check_head_int; ?> value="1" >&nbsp;&nbsp;
		Расположить внутри формы.
</td>
</tr>

		<tr  valign=top>
		<TD width=30%><h3>Подзаголовок</h3>
		Более мелким текстом объясняем посетителю, что конкретно надо делать, например:
		<i>Введите свой e-mail</i><br>
		Оставьте пустым окошко, если не хотите, чтобы это значение отображалось.
		</td>
		<td>
		<input name="text_oll" type="text"  size=60 value="<? echo @$conf[2]; ?>">

		</td>
		</tr>

		<tr  bgcolor=#F0F0F0 valign=top>
		<TD width=30%><h3>Форма</h3>

		</td>
		<td>
		Надпись на кнопке<br>
		<input name="text_button" type="text"  size=60 value="<? echo @$conf[21]; ?>"><br>
		Размер текстового поля<br>
		<input name="area" type="text" size=10 value="<? echo @$conf[22]; ?>">

		</td>
		</tr>

		 <tr  valign=top >
		<TD width=30%><h3>Цвета</h3>
		Можете проставить буквенное значение, напр. blue, red,
		или в кодах
		</td>
		<td>
		<table>
		<tr>
		<td>Заголовок</td>
		<td><input name="color_head" type="text" size=10  value="<? echo @$conf[3]; ?>" ></td><td><b><big><font color= <? echo @$conf[3]; ?> > тест
		</font></big></b></td>
		</tr>
		<tr>
		<td>Подзаголовок</td>
		<td><input name="color_oll" type="text"  size=10 value="<? echo @$conf[4]; ?>"></td><td><b><big><font color= <? echo @$conf[4]; ?> > тест
		</font></big></b></td>
		</tr>

		</table>
		</tr>

		 <tr  valign=top bgcolor=#F0F0F0>
		<TD width=30%><h3>Размер шрифта</h3>
        Определён в пунктах. В пунктах измеряется размер шрифтов в Word
		</td>
		<td>
		<table>
		<tr>
		<td>Заголовок</td>
		<td> <SELECT NAME="size_head">
<OPTION value="10" <?  echo @$check_size_head[0]; ?>>10</option>
<OPTION value="12" <?  echo @$check_size_head[1]; ?>>12</option>
<OPTION value="14" <? echo @$check_size_head[2]; ?>>14</option>
<OPTION value="16" <? echo @$check_size_head[3]; ?>>16</option>
<OPTION value="18" <? echo @$check_size_head[4]; ?>>18</option>
<OPTION value="20" <? echo @$check_size_head[5]; ?>>20</option>
</SELECT>&nbsp;&nbsp;pt</td>
		</tr>
		<tr>
		<td>Подзаголовок</td>
		<td> <SELECT NAME="size_oll">
<OPTION value="8" <?  echo @$check_size_oll[0]; ?>>8</option>
<OPTION value="9" <? echo  @$check_size_oll[1]; ?>>9</option>
<OPTION value="10" <? echo @$check_size_oll[2]; ?>>10</option>
<OPTION value="11" <? echo @$check_size_oll[3]; ?>>11</option>
<OPTION value="12" <? echo @$check_size_oll[4]; ?>>12</option>
</SELECT>&nbsp;&nbsp;pt</td>
		</tr>

		</table>
		</tr>
     <tr  valign=top >
      <td>
        <h3>Начертание шрифта</h3>
     </td>
     <td>

     <table>
		<tr>
		<td>Заголовок</td>
		<td><SELECT NAME="font_head">
<OPTION value="normal" <?  echo @$check_font_head[0]; ?> >Нормальный</option>
<OPTION value="italic" <?  echo @$check_font_head[1]; ?> >Наклонный</option>
<OPTION value="bold" <? echo @$check_font_head[2]; ?> >Жирный</option>
</SELECT></td>
		</tr>
		<tr>
		<td>Подзаголовок</td>
		<td><SELECT NAME="font_oll">
<OPTION value="normal" <?  echo @$check_font_oll[0]; ?>>Нормальный</option>
<OPTION value="italic" <?  echo @$check_font_oll[1]; ?>>Наклонный</option>
<OPTION value="bold"<? echo @$check_font_oll[2]; ?>>Жирный</option>
</SELECT></td>
		</tr>

		</table>

     </td>

     </tr>
	 <tr  valign=top bgcolor=#F0F0F0>
		<TD width=30%><h3>Цвет фона</h3>
		Это цвет прямоугольной области с формой.<br>
		Можете проставить буквенное значение, напр. blue, red,
		или в кодах
		</td>
		<td><input name="color_fon" type="text"  size=10 value="<? echo @$conf[9]; ?>" >&nbsp;&nbsp;<b><big><font color= <? echo @$conf[9]; ?> > тест
		</font></big></b></td>
		</tr>

	 <tr  valign=top>
		<TD width=30%><h3>Рамка</h3>
        Рамка вокуг прямоугольной области с формой.<br>
        Определите внешний вид и цвет с четырёх сторон.<br>
        <b>Внимание!</b> При выборе значения 'Двойная', ширину нужно выставить
        не менее 3
		</td>
		<td>
		Вид&nbsp;&nbsp;
		<SELECT NAME="border">
<OPTION value="none" <?  echo @$check_border[0]; ?>>Нет</option>
<OPTION value="dotted" <?  echo @$check_border[1]; ?>>Точки</option>
<OPTION value="dashed" <? echo @$check_border[2]; ?>>Пунктир</option>
<OPTION value="solid" <? echo @$check_border[3]; ?>>Сплошная</option>
<OPTION value="double" <? echo @$check_border[4]; ?>>Двойная</option>
</SELECT>&nbsp;&nbsp;

Ширина в пикселах&nbsp;&nbsp;
		<SELECT NAME="border_width">
<OPTION value="1" <?  echo @$check_border_width[0]; ?>>1</option>
<OPTION value="2" <?  echo @$check_border_width[1]; ?>>2</option>
<OPTION value="3" <?  echo @$check_border_width[2]; ?>>3</option>
<OPTION value="4" <?  echo @$check_border_width[3]; ?>>4</option>
<OPTION value="5" <?  echo @$check_border_width[4]; ?>>5</option>
</SELECT>&nbsp;&nbsp;px<br><br>

<b>Цвет</b><br>
Слева&nbsp;&nbsp;&nbsp;&nbsp;<input name="border_left_color" type="text"  size=10 value="<? echo @$conf[12]; ?>">&nbsp;&nbsp;<b><big><font color= <? echo @$conf[12]; ?> > тест
		</font></big></b>&nbsp;&nbsp;
Справа&nbsp;&nbsp;<input name="border_right_color" type="text" value="<? echo @$conf[13]; ?>" size=10>&nbsp;&nbsp;<b><big><font color= <? echo @$conf[13]; ?> > тест
		</font></big></b><br>
Сверху&nbsp;&nbsp;<input name="border_top_color" type="text" value="<? echo @$conf[14]; ?>" size=10>&nbsp;&nbsp;<b><big><font color= <? echo @$conf[14]; ?> > тест
		</font></big></b>&nbsp;&nbsp;
Снизу&nbsp;&nbsp;&nbsp;&nbsp;<input name="border_bottom_color" type="text" value="<? echo @$conf[15]; ?>" size=10>&nbsp;&nbsp;<b><big><font color= <? echo @$conf[15]; ?> > тест
		</font></big></b>&nbsp;&nbsp;

</td>
</tr>

<tr  valign=top bgcolor=#F0F0F0>
		<TD width=30%><h3>Картинки</h3>
		Поставьте галочку, если хотите, чтобы картинка изображалась около
		заголовка.
		</td>
		<td>

		 <table widnh=100% border=0><tr>
		  <td></td>
          <td><img src="img/us1.png"  alt="" border="0" align=absmiddle></td>
          <td><img src="img/us2.png"  alt="" border="0" align=absmiddle></td>
          <td><img src="img/us3.png"  alt="" border="0" align=absmiddle></td>
          <td><img src="img/us4.png"  alt="" border="0" align=absmiddle></td>
          <td><img src="img/us5.png"  alt="" border="0" align=absmiddle></td>
          <td><img src="img/us6.png"  alt="" border="0" align=absmiddle></td>
          <td><img src="img/us7.png"  alt="" border="0" align=absmiddle></td>
          <td><img src="img/us8.png"  alt="" border="0" align=absmiddle></td>
          <td><img src="img/us9.png"  alt="" border="0" align=absmiddle></td>
          <td><img src="img/us10.png"  alt="" border="0" align=absmiddle></td>
          <td><img src="img/us11.png"  alt="" border="0" align=absmiddle></td>
          <td><img src="img/us12.png"  alt="" border="0" align=absmiddle></td>
           </tr>
           <tr align=center>
           <td><input name="img_head_on" type="checkbox" value="1" <?echo @$check_img_head_on ?> ></td>

           <td><input name="usH" type="radio" value="1" <? echo $check_usH[1] ?> ></td>
           <td><input name="usH" type="radio" value="2" <? echo $check_usH[2] ?>></td>
           <td><input name="usH" type="radio" value="3" <? echo $check_usH[3] ?>></td>
           <td><input name="usH" type="radio" value="4" <? echo $check_usH[4] ?>></td>
           <td><input name="usH" type="radio" value="5" <? echo $check_usH[5] ?>></td>
           <td><input name="usH" type="radio" value="6" <? echo $check_usH[6] ?>></td>
           <td><input name="usH" type="radio" value="7" <? echo $check_usH[7] ?>></td>
           <td><input name="usH" type="radio" value="8" <? echo $check_usH[8] ?>></td>
           <td><input name="usH" type="radio" value="9" <? echo $check_usH[9] ?>></td>
           <td><input name="usH" type="radio" value="10" <? echo $check_usH[10] ?>></td>
           <td><input name="usH" type="radio" value="11" <? echo $check_usH[11] ?>></td>
           <td><input name="usH" type="radio" value="12" <? echo $check_usH[12] ?>> </td>
           </tr>





</td>
</tr>

           </table>

		</td>
		</tr>

        <tr  valign=top >
		<TD><h3>Положение картинки</h3>
		Определите положение картинки рядом с заголовком.
		</td>
		<td>
		Справа&nbsp;&nbsp;
		<input name="img_align_head" type="radio" value="right" <?echo @$check_img_align_head_right; ?> >&nbsp;&nbsp;
		Слева&nbsp;&nbsp;
		<input name="img_align_head" type="radio" value="left" <?echo @$check_img_align_head_left; ?>>
		</tr>


         <tr valign=top  bgcolor=#F0F0F0>
		<TD width=30%><h3>Размер</h3>
		 Определите ширину и высоту формы подписки
		</td>
		<td>
          Ширина&nbsp;&nbsp;
          <input name="width" type="text"  size=10 value="<?echo @$conf[19] ?>">&nbsp;px&nbsp;&nbsp;
           Высота&nbsp;&nbsp;
          <input name="height" type="text"  size=10 value="<?echo @$conf[20] ?>">&nbsp;px
        </td>
        </tr>



 <tr valign=top >
		<TD width=30%><h3>Логин, пароль</h3>
		 Изменить логин и пароль для входа в панель управления
		</td>
		<td>
          Логин&nbsp;&nbsp;
          <input name="login" type="text"  size=10>
           Пароль&nbsp;&nbsp;
          <input name="pasw" type="text"  size=10 >
        </td>
        </tr>

 <TR ><td colspan=2><input type="submit" value="Сохранить" name=go></td></tr>
 </form>
 </table>
</body>
</html>