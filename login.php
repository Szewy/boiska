<?php
	session_start();
	
	if(isset($_SESSION['user_id']))
		header("location: index.php");
	
	$error = ''; 
	
	if (isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['password'])) 
	{
		if (empty($_POST['username']))
			$error = "Login błędny";
		else if(empty($_POST['password']))
			$error = "Hasło błędne";
		else
		{
			$username=$_POST['username'];
			$password=$_POST['password'];
		
			$username = stripslashes($username);
			$password = stripslashes($password);
		
            $mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
			
			$username = mysqli_real_escape_string($mysqlConnection, $username);
			$password = mysqli_real_escape_string($mysqlConnection, $password);
            
            mysqli_select_db($mysqlConnection, "boiska");
            mysqli_set_charset($mysqlConnection, "utf8");
			
			$res = mysqli_query($mysqlConnection, "SELECT id_uzytkownika FROM uzytkownicy WHERE haslo='$password' AND login='$username'");
			$rows = mysqli_num_rows($res);
		
			if ($rows == 1) 
			{
				$user = mysqli_fetch_assoc($res);
				$_SESSION['user_id'] = $user["id_uzytkownika"];
				
				header("location: index.php"); 
			} 
			else 
			{
				$error = "Nieprawidłowy login lub hasło";
			}
			
			mysqli_close($mysqlConnection); 
		}
	}
	
	if(isset($_SESSION['user_id']))
		header("location: index.php");
?>

<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<link rel="stylesheet" href="css/styles.css">
		
        <title> Boiska sportowe - logowanie </title>
    </head>
    <body>  
		<div id="center">
			<div class="header"> 
				Logowanie
			</div>
			<div id="login">
				<form action="login.php" method="POST">
					<label> Login: </label>
					<input name="username" type="text">
					<br />
					<label> Hasło: </label>
					<input name="password" type="password">
					<br/>
					<input name="submit" type="submit" value="Zaloguj się" class="button">
				</form>
		
				<?php echo $error; ?>
			</div>
			<a href="index.php"> <div class="button"> Strona główna </div> </a>
		</div>
    </body>
</html>
