<?php
require_once 'connection.php'; // подключаем скрипт
 
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
 
// выполняем операции с базой данных
$query ="SELECT * FROM data";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
if($result)
{
    echo "Выполнение запроса прошло успешно";
}

	$data = mysqli_fetch_array($result);
				
				do{
					printf("
					<h2>%s</h2><br>
					<img src = '%s' width = '200px'></img>
					<p>%s</p>
					"
					,$data['title'], $data ['image'],$data['m_desc']);
				}
				while($data = mysqli_fetch_array($result));
 
// закрываем подключение
mysqli_close($link);
?>
<br><p>We have some text here</p>