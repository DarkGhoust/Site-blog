<?php
session_start();
	if (isset($_POST['logout']))
	{
		unset($_SESSION['name']);
		unset($_SESSION['surname']);
		unset($_SESSION['rights']);
		session_destroy();
	}


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
		<title>Админ-панель</title>
		<link rel="stylesheet" type="text/css" href="css/workbench.css">
		
		

	</head>

	<body>
		<div class = wrapper>
		<div class = header>
			<div class = "menu">
			<form action = "Auth.php">
				<button	>Авторизация</button>
			</form>
			<form action = "registration.php">	
				<button>Регистрация</button>	
			</form>
			');
			if (isset($_SESSION['name']))
			{
				printf('<form action = "index.php" method = "POST">	
				<button type = "submit" name = "logout">Выход</button>	
				</form>');
				echo "<h4>Welcome ".$_SESSION['name']."</h4>";
			}
		printf('
			</div>
		</div> 
		<div class = content>
			<div class = left>
					');
					if (isset ($_SESSION['rights']) && $_SESSION['rights'] == '1')
					{
						printf('<form action = "workbench.php" method = "POST">	
							<button type = "submit" name = "add" class = "but">Добавить</button>	
						</form>
						<form action = "workbench.php" method = "POST">	
							<button type = "submit" name = "update" class = "but">Редактировать</button>	
						</form>
						<form action = "workbench.php" method = "POST">	
							<button type = "submit" name = "del" class = "but">Удалить</button>	
						</form>');
						//----------Добавляем инфу-------------
						if (isset ($_POST['add']))
						{
							printf('
							<h2 align = center>Добавление статьи<h2>							
							<form action="workbench.php" method = "POST">
								<table border=0 align = center>
									<tr>
										<td class = name>Заголовок</td>
										<td class = inp> <input type = "title" name = "title" value = ""></input> </td>
									</tr>
									<tr>
										<td class = name>Изображение</td>
										<td class = inp> <input type = "img" name = "image" value = ""></input> </td>
									</tr>
									<tr>
										<td class = name>Мини-описание</td>
										<td class = inp>  <textarea name="m_desc" cols="70" rows="5"></textarea> </td>
									</tr>
									<tr>
										<td class = name>Описание</td>
										<td class = inp> <textarea name="m_desc" cols="70" rows="12"></textarea> </td>
									</tr>
								</table>
								
								<button class = "confirm" type = "submit" name = "insert">Добавить</button>
								
							</form>
							');
						}				 
				
					}
					else
					{
						header("Location: index.php");
					}
						printf('					
				
			</div> 
			<div class = right>
				<a href = "index.php"><h4>Главная</h4></a>
				<a href = "Videos.php"><h4>Видео</h4></a>
				<a href = "photos.php"><h4>Фотографии</h4></a>
				<a href = "about_me.php"><h4>Обо мне</h4></a>
			</div> 
			<div style = "clear:both"></div>
		</div>
		<div class = footer>
			<p>@Created by Andriy Oleniuk</p>
		</div>
		
		</div>
	
	</body>

</html>
');
?>