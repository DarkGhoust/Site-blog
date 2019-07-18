<?php
	require_once 'connection.php'; // подключаем скрипт
	 
	// подключаемся к серверу
	$link = mysqli_connect($host, $user, $password, $database) 
		or die("Ошибка " . mysqli_error($link));
		
$query ="SELECT * FROM data";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
printf('
 
<html>

	<head>
		<meta charset="utf-8">
		<title>Мой блог</title>
		<link rel="stylesheet" type="text/css" href="css/index_style.css">
		
		

	</head>

	<body>
		<div class = wrapper>
		<div class = header>
			<div class = "menu">
			<form action = "Auth.php">
				<button	>Авторизація</button>
			</form>
			<form action = "registration.php">	
				<button>Реєстрація</button>	
			</form>
			</div>
		</div> 
		<div class = content>
			<div class = left>
					');
						$data = mysqli_fetch_array($result);
															
						do{
							printf("
							<div class = article>
								<img src = '%s' width = '200px'></img>
								<a class=title href=#><h2>%s</h2></a>																
								<p align = 'justify'>%s</p>
								<div style = 'clear:both'></div>
							</div>
							"
							,$data['image'], $data ['title'],$data['m_desc']);
						}
						while($data = mysqli_fetch_array($result));
						
						mysqli_close($link);
						printf('					
				
			</div> 
			<div class = right>
				<a href = "phpinfo.php">Главная</a>
				<a href = "confirmation.php">Статьи</a>
				<a href = #>Видео</a>
				<a href = #>Фотографии</a>
			</div> 
			<div style = "clear:both"></div>
		</div>
		<div class = footer></div>
		
		</div>
	
	</body>

</html>
');
?>