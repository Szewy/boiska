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
					Grafik wszystkich pracowników
			</div>
		
			<div id="day">	
				<div class="list3">
					<?php
						$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
						
						mysqli_select_db($mysqlConnection, "boiska");
						mysqli_set_charset($mysqlConnection, "utf8");
						
						$res = mysqli_query($mysqlConnection, "SELECT imie, nazwisko, data, godzina_od, godzina_do FROM grafik, uzytkownicy WHERE id_pracownika = id_uzytkownika ORDER BY data, godzina_od" );
						$rows = mysqli_num_rows($res);
						
						for($i = 0; $i < $rows; $i++)
						{
							$user = mysqli_fetch_assoc($res);
						
							echo $user["imie"]." ".$user["nazwisko"]." ".$user["data"]." ".$user["godzina_od"]."-".$user["godzina_do"]."<br />";
						}
						
						mysqli_close($mysqlConnection); 
					?>
					
				</div>
			</div>
			
			<a href="index.php"> <div class="button"> Strona główna </div> </a>
			
			<?php require_once("files/buttons2.php"); ?>
		</div>
    </body>
</html>
