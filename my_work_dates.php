<?php
	session_start();

	if(!isset($_SESSION['user_id']))
		header("location: login.php");
	
	$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
	
	mysqli_select_db($mysqlConnection, "boiska");
	mysqli_set_charset($mysqlConnection, "utf8");
	
	$res = mysqli_query($mysqlConnection, "SELECT pracownik FROM uzytkownicy WHERE id_uzytkownika=".$_SESSION['user_id']);
	$rows = mysqli_num_rows($res);

	$user = mysqli_fetch_assoc($res);

	mysqli_close($mysqlConnection);
	
	if($user["pracownik"] == 0)
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
					Grafik
			</div>
		
			<div id="day">	
				<div class="list4">
					<?php
						$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
						
						mysqli_select_db($mysqlConnection, "boiska");
						mysqli_set_charset($mysqlConnection, "utf8");
						
						$res = mysqli_query($mysqlConnection, "SELECT data, godzina_od, godzina_do FROM grafik WHERE id_pracownika=".$_SESSION['user_id']);
						$num = mysqli_num_rows($res);
						
						if($num == 0)
						{
							echo "Nie masz żadnego dnia pracy w grafiku <br />";
						}
						
						for($i = 1;$i <= $num; $i++)
						{
							$day = mysqli_fetch_assoc($res);
							echo "$i. ".$day["data"]." ".$day["godzina_od"]."-".$day["godzina_do"]."<br />";
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
