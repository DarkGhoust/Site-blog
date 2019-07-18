<?php	

	require 'db.php';
	
	require_once 'connection.php'; // подключаем скрипт
	 
	// подключаемся к серверу
	$link = mysqli_connect($host, $user, $password, $database) 
		or die("Ошибка " . mysqli_error($link));
		

$data  = $_POST;

if (isset ($data['subm']))
	{		$errors = array();
		if ($data['name'] == '')		
			{	$errors[] = 'Enter your name!';		}		
		if ($data['surname'] == '')		
			{			$errors[] = 'Enter your surname!';		}		
		if ($data['login'] == '')		{			$errors[] = 'Enter your login!';		}		
		if ($data['password'] == '')		{			$errors[] = 'Enter your password!';		}		
		if ($data['email'] == '')		{			$errors[] = 'Enter your email!';		}				
		if (empty ($errors))		{	
			$name = $data['name'];
			$surname = $data['surname'];
			$login = $data['login'];
			$pass = $data['password'];
			$email = $data['email'];
			$token = generateRandomString();
			
		//	if (empty(R::find('users','login = '.$login.'')) || empty(R::find('users','email = '.$email.'')))
		//	{
				$query ="select id from users where login = '$login'";	
					R::exec("insert into users (name, surname, login, password, email, token) 
				values ('$name','$surname','$login','$password','$email','$token'	)"); 
				
				$ref = "http://ipz-16030b.wd.nubip.edu.ua/confirmation.php?token=$token";
				mail("$email", "Подтвердите регистрацию", "Чтобы подтвердить регистрацию, перейдите по ссылке: $ref"); 

				echo '<div class= "error"><p>Registration  successfull. </p></div>';
		//	}
		//	else {
		//		echo '<div class=successfull"><p>Such user was created before!</p></div>';
		//	}
		
			
		}		
		else 
		{
			printf('<div class = "error"><h3>'.array_shift($errors).'</h3></div>');
		}	
	}
?>
<?php
function generateRandomString($length = 18) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
<html>

	<head>
		<meta charset="utf-8">
		<title>Registration</title>
		<link rel="stylesheet" type="text/css" href="css/reg.css">
	

	</head>

	<body>
	<div class = "cont">
		<div class = "frame">
		
			<h2 align = center>Registration<h2>							<form action="registration.php" method = "POST">
				<table border=0 align = center>
					<tr>
						<td class = name>Name</td>
						<td class = inp> <input type = "name" name = "name" value = "<?php echo @$data['name']?>"></input> </td>
					</tr>
					<tr>
						<td class = name>Surname</td>
						<td class = inp> <input type = "surname" name = "surname" value = "<?php echo @$data['surname']?>"></input> </td>
					</tr>
					<tr>
						<td class = name>Login</td>
						<td class = inp> <input type = "login" name = "login" value = "<?php echo @$data['login']?>"></input> </td>
					</tr>
					<tr>
						<td class = name>Password</td>
						<td class = inp> <input type = "password" name = "password" ></input> </td>
					</tr>
					<tr>
						<td class = name>E-mail</td>
						<td class = inp> <input type = "email" name = "email" value = "<?php echo @$data['email']?>"></input> </td>
					</tr>
				
				</table>
						 <button type = "submit" name = "subm">Register</button>
						 <p>Already have an account. <a href="Auth.php">Auth</a></p>
			</form>
		</div>

	


	</div>	
	</body>

</html>