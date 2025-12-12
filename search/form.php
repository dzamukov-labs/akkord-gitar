<?php
$config=file("search/admin/conf/mes.txt");
$n=0;
//Очищаем
foreach($config as $line)
  {
 	$expl=explode("*", $line);
 	$conf[$n]=trim($expl[2]);
 	$n++;
  }
?>
<style>
   #search_button {
  	   color:<?echo $conf[17]?>;
       font-family:"Times New Roman", "serif";
 	   font-size:<?echo $conf[18]?>pt;
 	   font-weight:<?echo $conf[20]?>;
 	   font-style:<?echo $conf[19]?>;
 	   background-color:<?echo $conf[16]?>;
       border-style:<?echo $conf[23]?>;
       border-width:<?echo $conf[22]?>px;
       border-color:<?echo $conf[21]?>;
      }
    #s_search {
  	   color:<?echo $conf[8]?>;
       font-family:"Times New Roman", "serif";
 	   font-size:<?echo $conf[9]?>pt;
 	   font-weight:<?echo $conf[11]?>;
 	   font-style:<?echo $conf[10]?>;
 	   background-color:<?echo $conf[7]?>;
       padding:5px;
       width:<?echo $conf[5]?>px;
       border-style:<?echo $conf[14]?>;
       border-width:<?echo $conf[13]?>px;
       border-color:<?echo $conf[12]?>;
       text-align:left;
      }

    #head_search {
  	   color:<?echo $conf[1]?>;
       font-family:"Times New Roman", "serif";
 	   font-size:<?echo $conf[2]?>pt;
 	   font-weight:<?echo $conf[4]?>;
 	   font-style:<?echo $conf[3]?>;
       text-align:left;

      }

</style>

<?php
echo "<script language='JavaScript1.1' type='text/javascript'>
<!--

 function ins(i)
 {
      var val=document.search.quit.value;
      var p1=";  if ($conf[0]!="") echo "\"<div id=head_search>$conf[0]</div>\"+";
      echo  "\"<input name='quit' type='text' ID='quit' size=$conf[6]>&nbsp;&nbsp;\"+
        \" <input type='submit' value=$conf[15] id=search_button >&nbsp;&nbsp;\"+
        \"<a href='javascript:ins(2)'><img src='/search/img/down.png' alt='Подробный поиск' border=0></a>\";


      var p2=";if ($conf[0]!="") echo "\"<div id=head_search>$conf[0]</div>\"+";
       echo "\"<input name='quit' type='text' ID='quit' size=$conf[6]>&nbsp;&nbsp;\"+
        \" <input type='submit' value=$conf[15] id=search_button >&nbsp;&nbsp;\"+
        \"<a href='javascript:ins(1)'><img src='/search/img/up.png' alt='Закрыть' border=0></a><br>\"+
        \"<input name='toch' type='checkbox' value='ON'>&nbsp;\"+
        \"точное совпадение<br>\"+
        \"<input name='registr' type='checkbox' value='ON'>&nbsp;\"+
        \"учитывать регистр<br>\"+
        \"<input name=log type=radio value='1' >&nbsp;\"+
        \"любое слово<br>\"+
         \"<input name=log type=radio value='2' checked>&nbsp;\"+
        \"фраза целиком\";

      var insp;
      switch (i)
       {
        case 1: insp=p1;
                break;
        case 2: insp= p2;
                break;
       }
      document.getElementById('s_search').innerHTML = insp;
      document.search.quit.value=val;

 }


//--></script>";



echo"<div align=$conf[24]><form name='search' action='/search/search.php' method='post'>

        <div id=s_search>";
        if ($conf[0]!="") echo "<div id=head_search>$conf[0]</div>";
        echo "<input name='quit' type='text'  ID='quit' size=$conf[6]>
        <input type='submit' value=$conf[15] id=search_button >";
        if($conf[25]==1) echo "&nbsp;
        <a href=\"javascript:ins(2);\"><img src='/search/img/down.png' alt='Подробный поиск' border=0></a>";
        echo"</div>
        </form></div>";

?>



