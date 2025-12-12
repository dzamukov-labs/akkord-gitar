<?php

//Настройки
 $config=file("admin/conf/mes1.txt");
 $n=0;
 //Очищаем
 foreach($config as $line)
  {
 	$expl=explode("*", $line);
 	$conf[$n]=trim($expl[1]);
 	$n++;
  }
 //Данные встроенного кода
$conf1=file("admin/conf/code/align.txt");
foreach($conf1 as $line) $conf2[]=rtrim($line);

$strpath="admin/conf/code/topcode.txt";
$size=filesize($strpath);
if($size)
{
 $f=fopen($strpath,'r');
 @$code_top=fread($f, filesize($strpath));
fclose($f);
}

$strpath="admin/conf/code/botcode.txt";
$size=filesize($strpath);
if($size)
{
 $f=fopen($strpath,'r');
 @$code_bot=fread($f, filesize($strpath));
fclose($f);
}

$strpath="admin/conf/code/leftcode.txt";
$size=filesize($strpath);
if($size)
 {
  $f=fopen($strpath,'r');
 @$code_left=fread($f, filesize($strpath));
 fclose($f);
 }
else $conf2[4]=0;

$strpath="admin/conf/code/rigcode.txt";
$size=filesize($strpath);
if($size)
 {
  $f=fopen($strpath,'r');
  @$code_rig=fread($f, filesize($strpath));
  fclose($f);
 }
else $conf2[5]=0;

//Расчёт для центра
$size_center=100-($conf2[4]+$conf2[5]);

?>
<html>
<head>

<style>

#search_block
  {
     background-color:<?echo $conf[12]?>;
     border-style:<?echo $conf[19]?>;
     border-left-width: <?echo $conf[18]?>px;
     border-right-width: <?echo $conf[17]?>px;
     border-top-width: <?echo $conf[15]?>px;
     border-bottom-width: <?echo $conf[16]?>px;
     border-color:<?echo $conf[14]?>;
     padding:5px;
     margin-bottom:10px;
     text-align:left;
     width:<?echo $conf[13]?>%;
  }
 #search_info
  {
    color:<?echo $conf[8]?>;
    font-size:<?echo $conf[9]?>pt;
    font-weight:<?echo $conf[11]?>;
    font-style:<?echo $conf[10]?>;
    font-family:"Times New Roman", "serif";
    text-align:left;
  }
 #search_tit
  {
  	    font-size:<?echo $conf[21]?>pt;
        font-weight:<?echo $conf[23]?>;
        font-style:<?echo $conf[22]?>;
        font-family:"Arial", "sans-serif";
        color:<?echo $conf[20]?>;
        text-align:left;
  }

  #search_tit a
  {
  	   font-size:<?echo $conf[21]?>pt;
        font-weight:<?echo $conf[23]?>;
        font-style:<?echo $conf[22]?>;
        font-family:"Arial", "sans-serif";
        color:<?echo $conf[20]?>;
        text-align:left;
  }

 #con
  {
  	    font-size:<?echo $conf[25]?>pt;
        font-weight:<?echo $conf[27]?>;
        font-style:<?echo $conf[26]?>;
        font-family:"Times New Roman", "serif";
        color:<?echo $conf[24]?>;
  }

#search_content
  {

    background-color:<?echo $conf[3]?>;
    width:<?echo $conf[4]?>%;
    border-style:<?echo $conf[7]?>;
    border-width: <?echo $conf[6]?>px;
    border-color:<?echo $conf[5]?>;
    padding:10px;

  }

 #search_count
  {
  	    font-size:<?echo $conf[29]?>pt;
        font-weight:<?echo $conf[31]?>;
        font-style:<?echo $conf[30]?>;
        font-family:"Times New Roman", "serif";
        color:<?echo $conf[28]?>;

  }
 #search_text_link
  {
  	    font-size:<?echo $conf[33]?>pt;
        font-weight:<?echo $conf[35]?>;
        font-style:<?echo $conf[34]?>;
        font-family:"Times New Roman", "serif";
        color:<?echo $conf[32]?>;
        text-align:right;
  }
 #search_text_link a
  {
  	    font-size:<?echo $conf[33]?>pt;
        font-weight:<?echo $conf[35]?>;
        font-style:<?echo $conf[34]?>;
        font-family:"Times New Roman", "serif";
        color:<?echo $conf[32]?>;
  }
  .navig_activ
         {
          font-family:"Times New Roman", "serif";
          font-size:12pt;
          color:#800040;
          font-weight:700;
         }

     .navig_passiv
        {
          font-family:"Times New Roman", "serif";
          font-size:12pt;
          color:#808080;
          font-weight:400;
       }
      a.navig_passiv
        {
        	Text-decoration: none;
        }
      a.navig_activ
        {
        	Text-decoration: none;
        }

       #navig
       {
        text-align:left;
       }
</style>
<?php
$quit="";
if(file_exists("quit"))
  {  	$f=fopen("quit","r");
  	$quit_arr=fread($f,filesize("quit"));
  	fclose($f);
  	$quit_expl=explode("*",$quit_arr);
  	$quit=$quit_expl[0];
  }

echo "<title>Поиск по запросу :: $quit</title>
</head>
<body bgcolor= $conf[0] background=$conf[1]>

<table width=100% border=0 cellpadding=10 >";


 if (@$code_top!="")
 {
   echo"<tr><td colspan=3 align=$conf2[0] >";
   if($conf2[11]==0)
   {
     echo @$code_top;
   }
  else
   {
 	 include("admin/conf/code/topcode.txt");
   }
   echo"</td></tr>";

 }

?>


<tr>

<?php
 if (@$code_left!="")
 {
   echo"<td width=$conf2[4]% valign=$conf2[2] >";
   if($conf2[13]==0)
   {
     echo @$code_left;
   }
  else
   {
 	 include("admin/conf/code/leftcode.txt");
   }
   echo "</td>";
 }

?>


 <td  valign=top width=<?echo $size_center?>% align=<?echo $conf[40]?>>

<?php
if(isset($_GET['s']))
{
if(file_exists("res.txt") && ($_SERVER['REMOTE_ADDR']==$quit_expl[1]))
{
 $titl=file("res.txt");
 echo "<div id=search_content>";
 //Выводим результат
  if (!count($titl))echo "<div id=search_info>
  По вашему запросу <b>$quit</b> ничего не найдено. Попробуйте подробный поиск.<br><br>
  <form action='search.php' method=post>
  <input name='quit' type='text' value='$quit'  size=40><br><br>
  <input name='toch' type='checkbox' value='ON'>
  точное совпадение&nbsp;&nbsp;
  <input name='registr' type='checkbox' value='ON'>&nbsp;
  учитывать регистр<br>
  <input name=log type=radio value='1' >&nbsp;
  любое слово<br>
  <input name=log type=radio value='2' checked>&nbsp фраза целиком<br><br>
  <input type='submit' value=Поиск id=search_button >
  </form>


  </div>";
  else
     {
         $res=count($titl);
     	 echo "<div id=search_info>По вашему запросу <b>$quit</b> найдено $res документов.</div><br>";

     }

 if(count($titl))
 {
     //Постраничная навигация
      $count_dir_mes=count($titl);
      $mes_count_page=$conf[2];
      if(empty($_GET['page']) || !is_numeric($_GET['page'])|| $_GET['page']<1)$page=1;
      else $page=$_GET['page'];

      if($page > ceil($count_dir_mes/ $mes_count_page))$page=1;
      $start=$page * $mes_count_page-$mes_count_page;
      $pages=ceil($count_dir_mes/ $mes_count_page);

      if(empty($_GET['ind'])|| ($_GET['ind']*3-2)>$pages || $_GET['ind']<0 || !is_numeric($_GET['ind']))$index=1;
     else $index= $_GET['ind'];

    if ($count_dir_mes> $mes_count_page)
      {
       echo"<div id=navig>";
       if($index > 1)echo "
         <a class='navig_passiv' href=res.php?s=1&page=".(($index-1)*3)."&ind=".($index-1)."> << </a> ";

        for($i=$index*3-2,$p=1; $i < $pages+1; $i++,$p++)
          {

            if($p>3 )
          	  {
          	  	echo "<a class='navig_passiv'  href=res.php?s=1&page=".($i)."&ind=".($index+1)."> >> </a> ";
          	  	break;
          	  }
          	if($page==$i)
            echo "<a class='navig_activ' href=res.php?s=1&page=$i&ind=$index> $i </a> ";
            else
            echo "<a class='navig_passiv' href=res.php?s=1&page=$i&ind=$index> $i </a> ";
          }
        echo "</div>";
      }

  $c=1;
   for($x=$start,$y=0; $x<$count_dir_mes; $x++,$y++)
   {
    if($y==$mes_count_page)break;
    $expl=explode("*",$titl[$x]);
    echo "<div id=search_block>";
    if($conf[36]==1)echo "<div id=search_tit>$expl[0]</div>";
    if($conf[37]==1)echo "<div id=con>$expl[1]</div>";
    if($conf[38]==1)echo "<div id=search_count>Совпадений $expl[2]</div>";
    if($conf[39]==1)echo "<div id=search_text_link align=right><a href=bak/".$c.".html target=_blank>текстовая копия</a></div>";
     echo "</div>";

   	 $c++;
   }

   if ($count_dir_mes> $mes_count_page)
      {
       echo"<div id=navig>";
       if($index > 1)echo "
         <a class='navig_passiv' href=res.php?s=1&page=".(($index-1)*3)."&ind=".($index-1)."> << </a> ";

        for($i=$index*3-2,$p=1; $i < $pages+1; $i++,$p++)
          {

            if($p>3 )
          	  {
          	  	echo "<a class='navig_passiv'  href=res.php?s=1&page=".($i)."&ind=".($index+1)."> >> </a> ";
          	  	break;
          	  }
          	if($page==$i)
            echo "<a class='navig_activ' href=res.php?s=1&page=$i&ind=$index> $i </a> ";
            else
            echo "<a class='navig_passiv' href=res.php?s=1&page=$i&ind=$index> $i </a> ";
          }
        echo "</div>";
      }
 }

echo "</div>";
}
else
{	echo"<div id=search_info>Повторите запрос</div>";
}

}
else echo"<div id=search_info>Задайте поисковую строку</div>";
?>

</td>

<?php
 if (@$code_rig!="")
 {
   echo"<td width=$conf2[5]% valign=$conf2[3]>";
   if($conf2[14]==0)
   {
     echo @$code_rig;
   }
  else
   {
 	 include("admin/conf/code/rigcode.txt");
   }
   echo "</td>";
 }

?>

</tr>


<?php
 if (@$code_bot!="")
 {
   echo "<tr><td colspan=3 align=$conf2[1] >";
   if($conf2[12]==0)
   {
     echo @$code_bot;
   }
  else
   {
 	 include("admin/conf/code/botcode.txt");
   }
   echo "</td></tr>";
 }
?>


</table>
</body>
</html>