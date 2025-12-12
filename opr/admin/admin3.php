<?php
 include("cap.php");
$info="";

?>
 <style>

     .l
        {

       }

   a.l
     {
      text-decoration:solid;
      color:#808080;
      font-family:"Times New Roman", "serif";
      font-size:10pt;
      font-weight:300;
     }
 </style>
<TABLE align=center bgcolor=#EBEBEB width=80% CELLPADDING=10 CELLSPACING=0 border=0>

<tr >
   <td colspan=3><FONT COLOR="#408080" size=+1>Редактирование опросов</FONT>

   </td>
</tr>
 <?php
   $file=file("db/sett.txt");
   foreach($file as $line)
     {       $line=trim($line);
       $expl=explode("*",$line);
       $date=$expl[1]; $name=$expl[2];

       if($expl[3]==0)$activ="Неактивен";
       else $activ="Активен";

       $opr=file("db/$expl[0].txt");
       echo  "<tr>
                <td>$date</td>  <td>$name</td> <td>$activ</td>
             </tr>
       <tr><td colspan=3>

       <table>";

       for($i=0;$i< (count($opr)-1);$i++)
         {
           $opr[$i]=trim($opr[$i]);
           $expl_opr=explode("*",$opr[$i]);           echo "<tr>
                    <td>$expl_opr[0]</td> <td>$expl_opr[1]</td>
                 </tr>";

         }
       $oll=$opr[(count($opr)-1)];
       echo "<tr><td colspan=2 style=\"border-top:1px solid #ffffff;\" >
           <b>Всего голосов</b> $oll </td></tr></table>
             </td></tr>

             <tr><td style=\"border-bottom:1px solid #d0c9ad;\" colspan=3 align=right>
             <a href=red.php?id=$expl[0] class=l>Редактировать</a>
             </td></tr>";

     }
   if(count($file)==0)echo"<tr><td>Опросов не создано!</td></tr>";

  ?>

</table>

</body>

</html>