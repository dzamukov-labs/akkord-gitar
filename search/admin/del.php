<?php
session_start();
//Получаем сессию
$strpath="conf/conf.txt";
@$f=fopen($strpath, "r");
@$content=file($strpath);
fclose($f);
$n=0;
//Обработка
foreach($content as $line):
  if ($n==2) $sess=$line;
  $n++;

endforeach;

if (session_id()!=$sess)
 {
  $url=urlencode("Пройдите авторизацию!");
  echo "<meta http-equiv=refresh content='0; url=index.php?acc=$url'>";
  exit();
 }

if(empty($_GET['type']) && empty($_GET['id']))exit();
if(!file_exists("conf/shem/".$_GET['type'].".txt"))exit();

$file=file("conf/shem/".$_GET['type'].".txt");
if(($_GET['id']-1) > count($file)) exit();

$f=fopen("conf/shem/".$_GET['type'].".txt","w+");
$n=0;
foreach($file as $line)
  {  	if($_GET['id']!=$n)fwrite($f,$line);
  	$n++;
  }
 fclose($f);
echo "<meta http-equiv='refresh' content='0; url=admin3.php?sel3=selected'>";

?>
