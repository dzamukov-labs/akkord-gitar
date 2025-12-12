<?php
include("cap.php");
$file=array();

if(isset($_POST['go']))
         {
         	$f=fopen("conf/jurnal.txt","w+");
         	fclose($f);
         }

$file=file("conf/jurnal.txt");
$file=array_reverse($file);
//Постраничная навигация
      $count_dir_mes=count($file);
      $mes_count_page=30;
      if(empty($_GET['page']) || !is_numeric($_GET['page']) || $_GET['page']<1)$page=1;
      else $page=$_GET['page'];

      if($page > ceil($count_dir_mes/ $mes_count_page))$page=1;
      $start=$page * $mes_count_page-$mes_count_page;
      $pages=ceil($count_dir_mes/ $mes_count_page);

      if(empty($_GET['ind'])|| ($_GET['ind']*3-2)>$pages || !is_numeric($_GET['ind']) || $_GET['ind']<1)$index=1;
       else $index= $_GET['ind'];


?>
<style>
 #cap
  {  	font-family:"Times New Roman", "serif";
    font-size:10pt;
    color:#ffffff;
    font-weight:700;
    background-color:#0080FF;
  }
</style>
<TABLE  width=80% CELLPADDING=10 CELLSPACING=0 border=0 align=center>

<tr >
   <td><FONT COLOR="#408080" size=+1  >Журнал запросов</FONT><br><br>
    <form action="admin6.php?sel6=selected" method="post">
    <input type="submit" value="Очистить журнал" name=go>
</form>
    </td>
</tr>
</table>



        <TABLE width=80% align=center border=0 cellpadding=2  CELLSPACING=1>
         <tr id=cap><td >Дата</td> <td >Запрос</td> <td >Совпадение</td> <td>Регистр</td>
          <td >Фраза</td> <td>Количество документов</td></tr>
        <?php
           for($x=$start,$y=0; $x<$count_dir_mes; $x++,$y++)
           {
             if($y==$mes_count_page)break;           	 $expl=explode("*",$file[$x]);
           	 echo "<tr><td>$expl[0]</td> <td>$expl[1]</td>
           	  <td>$expl[2]</td> <td>$expl[3]</td> <td>$expl[4]</td><td>$expl[5]</td></tr>";
           }

          ?>

    <tr><td colspace=5>


 <?php
   if ($count_dir_mes> $mes_count_page)
      {
       if($index > 1)echo "
         <a class='navig_passiv' href=admin6.php?sel6=selected&page=".(($index-1)*3)."&ind=".($index-1)."> << </a> ";

        for($i=$index*3-2,$p=1; $i < $pages+1; $i++,$p++)
          {

            if($p>3 )
          	  {
          	  	echo "<a class='navig_passiv'  href=admin6.php?sel6=selected&page=".($i)."&ind=".($index+1)."> >> </a> ";
          	  	break;
          	  }
          	if($page==$i)
            echo "<a class='navig_activ' href=admin6.php?sel6=selected&page=$i&ind=$index> $i </a> ";
            else
            echo "<a class='navig_passiv' href=admin6.php?sel6=selected&page=$i&ind=$index> $i </a> ";
          }
      }
?>
</td></tr>
</table>