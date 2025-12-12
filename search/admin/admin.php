<?php
session_start();

if(@$_POST['login']=="" && @$_POST['pasw']=="")
 {
  echo "<meta http-equiv=refresh content='0; url=index.php'>";
  exit();
 }

$strpath="conf/conf.txt";
@$f=fopen($strpath,r);
$content=file($strpath);
fclose($f);

for($i=0; $i<2; $i++)
{
  $content[$i]=str_replace("\r\n","",$content[$i]);
  $content[$i]=trim( $content[$i]);

}

@$_POST['login']=trim(@$_POST['login']);
@$_POST['pasw']=trim(@$_POST['pasw']);

if((@$content[0]!=md5(@$_POST['login'])) || (@$content[1]!=md5(@$_POST['pasw']))):
$url=urlencode("Неправильный логин или пароль");
echo "<meta http-equiv=refresh content='0; url=index.php?acc= $url'>";
exit();
endif;

//Сохраняем сессию в настройках
$strpath="conf/conf.txt";
@$f=fopen($strpath, "r");
@$content=file($strpath);
fclose($f);
$n=0;
//Обработка
 @$f=fopen($strpath,"w");
  fwrite($f,$content[0]);
  fwrite($f,$content[1]);
  fwrite($f,session_id());
  fclose($f);

echo "<meta http-equiv=refresh content='0; url=admin1.php'>";


?>