<html><body><head>
<?php
if (empty($_GET['obj']))exit("Ничего интересного здесь нет!!");

$f=fopen("mes/".$_GET['obj'],"r");
$mesdat=getdate($_GET['obj']);
echo "<title>Отослано ".
      $mesdat['mday']." ". $mesdat['mon']." ". $mesdat['year']." ". $mesdat['hours'].":". $mesdat['minutes']."

</title></head>";
$mes=fread($f,filesize("mes/".$_GET['obj']));
$arrmes=explode("/*/",$mes);
$arrmes[6]=str_replace("\r\n","<br>",$arrmes[6]);
echo "<b>$arrmes[0]</b><br>";
echo "$arrmes[1]<br><br>";
echo "<b>$arrmes[2]</b><br>";
echo "$arrmes[3]<br><br>";
echo "<b>$arrmes[4]</b><br>";
echo "$arrmes[5]<br><br>";
echo"<b>Сообщение</b><br>";
echo "$arrmes[6]<br><br>";
echo "$arrmes[7]<br>";
fclose($f);
?>

</body>
</html>