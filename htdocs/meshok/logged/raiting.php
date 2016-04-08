<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
{
sleep(0.2); // для теста на локальном компе
echo "Вы поставили оценку ".$_GET["user_votes"]." за статью №".$_GET["id_arc"];
}
?>  