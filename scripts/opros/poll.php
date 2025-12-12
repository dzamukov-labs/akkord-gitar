<?php

# Проверяем - выбран ли какой-нибудь вариант ответа. Если нет не обрабатываем.
if (!isset($pit)) header("Location: ".$HTTP_REFERER);

# Если файл poll.txt существует - откраваем его и заполняем массив $poll_result
if (file_exists("poll.txt"))
  {$fp = fopen("poll.txt", "r");
   $poll_result = array();
   while (!feof($fp)) {$poll_result[] = (int)fgets($fp);}
   fclose($fp);}

# Если файла poll.txt не существует - смотрим сколько вариантов ответа
# создаем и заполняем массив $poll_result нулевыми значениями
else {require ("poll.inc.php");
      $num = count($poll_pit);
      $poll_result = array();
      for ($i = 0; $i != $num; $i++) {$poll_result[] = 0;}}

# Прибавляем один голос к соответствующему варианту ответа
$poll_result[$pit]++;

# Записываем значения массива $poll_result в файл poll.txt
$fp = fopen("poll.txt", "w");
$num = count($poll_result);
for ($i = 0; $i < $num; $i++)
    {fwrite($fp, $poll_result[$i]);
     if ($i != $num-1) fwrite($fp, chr(10));}
fclose($fp);

# Перенаправляем на страницу с который был вызван скрипт
header("Location: ".$HTTP_REFERER);

?>