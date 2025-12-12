<?php

require("poll.inc.php");
print("<table>");

# Печатаем вопрос
print("<tr><td colspan=\"2\">".$poll_question."</td></tr>");

# Если файл poll.txt существует - обрабатываем его...
if (file_exists("poll.txt"))
# Считываем из файла данные в массив $poll_result
  {$fp = fopen("poll.txt", "r");
   $poll_result = array();
   while (!feof($fp)) {$poll_result[] = (int)fgets($fp);}
   fclose($fp);
# Печатаем в цикле ответ и количество кликов на него
   for($i=0; $i < count($poll_result); $i++)
     {print "<tr><td>".$poll_pit[$i]."</td><td>".$poll_result[$i]."</td></tr>";}
# Печатаем дату начала опроса
   print ("<tr><td colspan=\"2\">Опрос начат: ".$poll_start."</td></tr>");}

# Если файла poll.txt не существует значит никто ещё не проголосовал
else {print "<tr><td colspan=\"2\">Пока никто не ответил</td></tr>";}

print "</table>";

?>