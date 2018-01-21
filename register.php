<?php
	session_start();
	
	if(isset($_SESSION['user_id']))
		header("location: index.php");
	
	$error = "";
	
	if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['surname'])) 
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		$name=$_POST['name'];
		$surname=$_POST['surname'];
		
		$username = stripslashes($username);
		$password = stripslashes($password);
		$name = stripslashes($name);
		$surname = stripslashes($surname);
		
		if(strlen($username) < 3 || strlen($username) > 30 || strlen($password) < 3 || strlen($password) > 30 || 
		   strlen($name) < 3 || strlen($name) > 30 || strlen($surname) < 3 || strlen($surname) > 40)
			$error = "Niepoprawnie wypełnione pola!";
		else 
		{
			$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
			
			$username = mysqli_real_escape_string($mysqlConnection, $username);
            
            mysqli_select_db($mysqlConnection, "boiska");
            mysqli_set_charset($mysqlConnection, "utf8");
			
			$res = mysqli_query($mysqlConnection, "SELECT id_uzytkownika FROM uzytkownicy WHERE login='$username'");
			$rows = mysqli_num_rows($res);
		
			if ($rows == 0)
			{
				$password = mysqli_real_escape_string($mysqlConnection, $password);
				$name = mysqli_real_escape_string($mysqlConnection, $name);
				$surname = mysqli_real_escape_string($mysqlConnection, $surname);
				
				mysqli_query($mysqlConnection, "INSERT INTO uzytkownicy (id_uzytkownika, login, haslo, imie, nazwisko, admin, pracownik) VALUES (NULL, '$username', '$password', '$name', '$surname', '0', '0');");
				
				$res = mysqli_query($mysqlConnection, "SELECT id_uzytkownika FROM uzytkownicy WHERE login='$username'");			
				$user = mysqli_fetch_assoc($res);
				
				mysqli_close($mysqlConnection);
				
				$_SESSION['user_id'] = $user["id_uzytkownika"];
				
				header("location: index.php");
			}
			else
				$error = "Podany login istnieje już w bazie!";
			
			mysqli_close($mysqlConnection);
		}
	}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<link rel="stylesheet" href="css/styles.css">
		
        <title> Boiska sportowe - rejestracja </title>
    </head>
    <body>        
        <div id="center">
			<div class="header"> 
				Rejestracja
			</div>
		
			<div id="day">	
				<div id="login">
					<form action="register.php" method="POST">
					<label> Login: </label>
					<input name="username" type="text">
					<br />
					<label> Hasło: </label>
					<input name="password" type="password">
					<br/>
					<label> Imię: </label>
					<input name="name" type="text">
					<br />
					<label> Nazwisko: </label>
					<input name="surname" type="text">
					<br />
					<input name="submit" type="submit" value="Zarejestruj się" class="button">
				</form>
		
				<?php echo $error; ?>
				</div>
			</div>
			
			<a href="index.php"> <div class="button"> Strona główna </div> </a>
		</div>
    </body>
</html>
