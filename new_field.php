<?php
	session_start();
	
	if(!isset($_SESSION['user_id']))
		header("location: login.php");
	
	$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
	
	mysqli_select_db($mysqlConnection, "boiska");
	mysqli_set_charset($mysqlConnection, "utf8");
	
	$res = mysqli_query($mysqlConnection, "SELECT admin FROM uzytkownicy WHERE id_uzytkownika=".$_SESSION['user_id']);
	$rows = mysqli_num_rows($res);

	$user = mysqli_fetch_assoc($res);

	mysqli_close($mysqlConnection);
	
	if($user["admin"] == 0)
		header("location: login.php");
	
	$error = "";
	
	if(isset($_POST["type"]) && isset($_POST["area"]))
	{
		if(!empty($_POST["type"]) && !empty($_POST["area"]))
		{
			$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
	
			mysqli_select_db($mysqlConnection, "boiska");
			mysqli_set_charset($mysqlConnection, "utf8");

			$res = mysqli_query($mysqlConnection, "SELECT id_typu FROM typ_boiska WHERE id_typu=".$_POST['type']);
			$rows = mysqli_num_rows($res);

			if($rows == 1)
			{
				$error = "OK";
				mysqli_query($mysqlConnection, "INSERT INTO boiska (id_boiska, id_typu, powierzchnia) VALUES (NULL, ".$_POST['type'].", ".intval($_POST['area']).")");
			}
			else
				$error="Błędne id!";
			
			mysqli_close($mysqlConnection);
		}
		else
		{
			$error = "Podano niepełne informacje o boisku!";
		}
	}
	
	$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<link rel="stylesheet" href="css/styles.css">
		
        <title> Boiska sportowe </title>
    </head>
    <body>  
		<div id="center">
			<div class="header"> 
				Nowe boisko
			</div>
		
			<div id="day">	
				<div id="login">
					<?php
						if($error == "OK")
						{
							echo "Boisko zostało dodane. <br/>";
						}
					?>
					<form action="new_field.php" method="POST">
						Typ: 
						<select name="type" id="add">
							<?php
								$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
								mysqli_select_db($mysqlConnection, "boiska");
								mysqli_set_charset($mysqlConnection, "utf8");
								
								$res = mysqli_query($mysqlConnection, "SELECT * FROM typ_boiska");
								$rows = mysqli_num_rows($res);
								
								for($i = 0; $i < $rows; $i++)
								{
									$type = mysqli_fetch_assoc($res);
									
									echo "<option value=\"".$type["id_typu"]."\">".$type["typ"]."</option>";
								}
							
								mysqli_close($mysqlConnection); 
							?>
						</select> <br />
						
						Powierzchnia:
						<input name="area" type="number">
						<br />
						
						<input name="submit" type="submit" value="Dodaj nowe boisko" class="button">
					</form>
					
					<?php if($error != "OK") echo $error; ?>
				</div>
			</div>
			
			<a href="index.php"> <div class="button"> Strona główna </div> </a>
			
			<?php require_once("files/buttons2.php"); ?>
		</div>
    </body>
</html>
