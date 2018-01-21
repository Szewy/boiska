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
	
	$new = "";
	if(isset($_POST["day"]) && isset($_POST["from"]) && isset($_POST["to"]) )
	{
		if(!empty($_POST["day"]) && !empty($_POST["from"]) && !empty($_POST["to"]))
		{
			if($_POST["from"] >= $_POST["to"])
				$new = "Błędne godziny! <br/>";
			else
			{
				$new = "Termin dodany do grafiku. <br />";
				
				$mysqlConnection = @mysqli_connect("localhost", "root", "vertrigo") or die(mysql_error());
				
				mysqli_select_db($mysqlConnection, "boiska");
				mysqli_set_charset($mysqlConnection, "utf8");
	
				mysqli_query($mysqlConnection, "INSERT INTO grafik(id_grafiku, id_pracownika, data, godzina_od, godzina_do) VALUES (NULL, '".$_SESSION['user_id']."', '".date("Y")."-".date("n")."-".$_POST["day"]."', '".$_POST["from"].":00:00', '".$_POST["to"].":00:00')");
				
				mysqli_close($mysqlConnection);
			}
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
				Nowy dzień pracy
			</div>
		
			<div id="day">	
				<div id="login">
					<?php echo $new; ?>

					<form action="new_work_date.php" method="POST">
						Dzień miesiąca:
						<select name="day">
							<?php
								$number_days_in_month = cal_days_in_month(CAL_GREGORIAN, date("n"), date("Y")); 
								for($i = date("d")+1; $i <= $number_days_in_month; $i++)
									echo "<option value=\"$i\"> $i </option> ";
							?>
						</select> <br />
						
						Godzina od: 
						<select name="from">
							<?php
								for($i = 8; $i <= 22; $i++)
									echo "<option value=\"$i\"> $i:00 </option> ";
							?>
						</select> <br />
						
						Godzina do: 
						<select name="to">
							<?php
								for($i = 9; $i <= 22; $i++)
									echo "<option value=\"$i\"> $i:00 </option> ";
							?>
						</select> <br />
						
						<input name="submit" type="submit" value="Zatwierdź w grafiku" class="button">
					</form>
				</div>
			</div>
			
			<a href="index.php"> <div class="button"> Strona główna </div> </a>
			
			<?php require_once("files/buttons2.php"); ?>
		</div>
    </body>
</html>
