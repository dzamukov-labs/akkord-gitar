
<?php
 if(!isset($_GET['id']))exit();

  $file=file("admin/db/sett.txt");
  if(count($file)==0) exit();
  if($_GET['id'] > (count($file)-1)) exit();

  $config=file("admin/conf/sett_view.txt");

   //Активные опросы
      $c=0;
   	   foreach($file as $line)
      {
       $line=trim($line);
       $expl=explode("*",$line);
       if($expl[3]==1)
         {
         	if($_GET['id']==$c)
         	  {         	  	$index=$expl[0];
         	    break;
         	  }
         	$c++;
         }
      }

 $n=0;
 //Очищаем
 foreach($config as $line)
  {
 	$expl=explode("*", $line);
 	$conf[$n]=trim($expl[2]);
 	$n++;
  }

 $config=file("admin/conf/res_view.txt");
 $n=0;
 //Очищаем
 foreach($config as $line)
  {
 	$expl=explode("*", $line);
 	$conf1[$n]=trim($expl[2]);
 	$n++;
  }
if ($conf[42]==1) $css_but="";
           else $css_but="id=but_opr";
  ?>
 <style>

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
  <?php
             $res_index=file("admin/db/$index.txt");
             $res_oll=$res_index[count($res_index)-1];
             echo"<table id=res_opr CELLPADDING=5 CELLSPACING=0 border=0>";
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
                  $color_oll=file("admin/conf/color.txt");
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
                         $proc1=$proc * 2;
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
                        echo"<table  id=reduc CELLPADDING=5><tr><td>
                           <table width=8px height=8px bgcolor=$color[$col]>
                        <tr><td></td></tr></table>

                             </td><td>$res_expl[0]</td></tr></table>";
                        if($col==count($color)-1)$col=-1;
                     }
                }
            echo"<br><br>";


?>
<table><tr><td><form name="" action="" method="post">
    <input type="button" value="Закрыть" onclick="window.close()" <? echo $css_but ?>>
</form></td></tr></table>
