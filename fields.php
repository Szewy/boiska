<?php
	session_start();

	if(!isset($_SESSION['user_id']))
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
				Zarezerwowane boiska
			</div>
		
			<div id="day">	
				<div class="list">
					<?php
						$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
						
						mysqli_select_db($mysqlConnection, "boiska");
						mysqli_set_charset($mysqlConnection, "utf8");
						
						$res = mysqli_query($mysqlConnection, "SELECT r.id_boiska, data, godzina_od, godzina_do, typ FROM rezerwacje r,boiska b,typ_boiska t WHERE id_uzytkownika=".$_SESSION['user_id']." AND r.id_boiska = b.id_boiska AND b.id_typu = t.id_typu ORDER BY data, godzina_od");
						$num = mysqli_num_rows($res);
						
						if($num == 0)
						{
							echo "Nie masz żadnych rezerwacji <br />";
						}
						
						for($i = 1;$i <= $num; $i++)
						{
							$field = mysqli_fetch_assoc($res);
							echo "$i. ".$field["data"]." ".$field["godzina_od"]."-".$field["godzina_do"]." boisko nr ".$field["id_boiska"]." (".$field["typ"].")<br />";
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
